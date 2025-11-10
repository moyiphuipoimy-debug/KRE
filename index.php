<?php
// send.php
// Настройте эти две переменные перед использованием:
$botToken = '7598958067:AAG5yenJcMwODqbeN6H7UsldO23GJkOBuOU';   // пример: 123456789:ABCdefGHI...
$chatId   = '-1005648417950';     // пример: -1001234567890 или 123456789

header('Content-Type: application/json; charset=utf-8');

// Только POST-запросы
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Метод не разрешен.']);
    exit;
}

// Получаем и очищаем входные данные
$input = $_POST;

// Функция простой очистки
function clean($val) {
    $val = trim($val);
    $val = strip_tags($val);
    // убираем лишние пробелы
    $val = preg_replace('/\s+/', ' ', $val);
    return $val;
}

$name        = isset($input['name']) ? clean($input['name']) : '';
$surname     = isset($input['surname']) ? clean($input['surname']) : '';
$age         = isset($input['age']) ? clean($input['age']) : '';
$totalLoans  = isset($input['total_loans']) ? clean($input['total_loans']) : '';
$monthly     = isset($input['monthly_payment']) ? clean($input['monthly_payment']) : '';
$marital     = isset($input['marital_status']) ? clean($input['marital_status']) : '';
$realEstate  = isset($input['real_estate']) ? clean($input['real_estate']) : '';
$phone       = isset($input['phone']) ? clean($input['phone']) : '';

// Минимальная валидация
$errors = [];
if ($name === '') $errors[] = 'Име е задължително.';
if ($surname === '') $errors[] = 'Фамилия е задължителна.';
if ($phone === '') $errors[] = 'Телефонният номер е задължителен.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'errors' => $errors]);
    exit;
}

// Формируем сообщение (используем HTML parse mode и экранируем)
function esc($s) {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$message  = "<b>Новая заявка с лендинга</b>\n";
$message .= "<b>Име:</b> " . esc($name) . "\n";
$message .= "<b>Фамилия:</b> " . esc($surname) . "\n";
$message .= "<b>Възраст:</b> " . esc($age) . "\n";
$message .= "<b>Обща сума на кредитите:</b> " . esc($totalLoans) . "\n";
$message .= "<b>Месечна вноска:</b> " . esc($monthly) . "\n";
$message .= "<b>Семейно положение:</b> " . esc($marital) . "\n";
$message .= "<b>Имате недвижимо имущество:</b> " . esc($realEstate) . "\n";
$message .= "<b>Телефон:</b> " . esc($phone) . "\n";
$message .= "<b>От:</b> " . esc($_SERVER['REMOTE_ADDR']) . " (" . date('Y-m-d H:i:s') . ")";

// Отправка запроса к Telegram API
$telegramUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

$postFields = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'HTML',
    'disable_web_page_preview' => true,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $telegramUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$curlErr = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Curl error: ' . $curlErr]);
    exit;
}

// Парсим ответ (без строгой проверки)
$respData = json_decode($response, true);
if ($httpCode === 200 && isset($respData['ok']) && $respData['ok'] === true) {
    echo json_encode(['status' => 'ok', 'message' => 'Успешно изпратено']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Неуспешна заявка към Telegram.', 'telegram_response' => $respData]);
}
