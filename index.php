<!doctype html>
<html lang="bg">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Финансова помощ – Вашият партньор в кредитите</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to bottom right, rgba(0,0,0,0.6), rgba(0,0,0,0.7)),
                  url('https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1950&q=80') no-repeat center/cover;
      color: #fff;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.96);
      color: #111;
      border-radius: 18px;
      box-shadow: 0 12px 40px rgba(0,0,0,0.25);
      padding: 30px 40px;
      max-width: 650px;
      width: 100%;
      animation: fadeIn 0.8s ease-in-out;
      backdrop-filter: blur(10px);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      color: #0b3d91;
      font-size: 26px;
      margin-bottom: 10px;
    }

    h2 {
      text-align: center;
      color: #333;
      font-weight: 500;
      font-size: 16px;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 600;
    }

    input[type="text"], input[type="number"], select {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-sizing: border-box;
      font-size: 15px;
    }

    input:focus, select:focus {
      border-color: #0b3d91;
      outline: none;
      box-shadow: 0 0 0 3px rgba(11,61,145,0.15);
    }

    .row {
      display: flex;
      gap: 10px;
    }

    .row .col {
      flex: 1;
    }

    .radio-group {
      display: flex;
      gap: 14px;
      align-items: center;
      margin-top: 5px;
    }

    button {
      display: block;
      width: 100%;
      background: linear-gradient(90deg, #0b3d91, #2563eb);
      color: #fff;
      font-weight: 700;
      border: none;
      padding: 14px;
      border-radius: 10px;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    button:hover {
      background: linear-gradient(90deg, #2563eb, #0b3d91);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(37,99,235,0.3);
    }

    .small {
      font-size: 13px;
      color: #555;
      margin-top: 6px;
    }

    .success, .error {
      margin-top: 14px;
      padding: 12px;
      border-radius: 8px;
      text-align: center;
      font-weight: 600;
    }

    .success { background: #e6ffed; color: #064c2b; }
    .error { background: #ffe7e7; color: #6b0b0b; }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #777;
      margin-top: 16px;
    }

    .money-banner {
      width: 100%;
      height: 160px;
      border-radius: 12px;
      background: url('https://images.unsplash.com/photo-1601597111034-66b1e0b32d8b?auto=format&fit=crop&w=900&q=80') no-repeat center/cover;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container" role="main">
    <div class="money-banner"></div>
    <h1>Бърз достъп до финансова помощ</h1>
    <h2>Попълнете заявката и наш експерт ще се свърже с вас</h2>

    <form id="leadForm">
      <div class="row">
        <div class="col">
          <label for="name">Име</label>
          <input id="name" name="name" type="text" placeholder="Иван" required />
        </div>
        <div class="col">
          <label for="surname">Фамилия</label>
          <input id="surname" name="surname" type="text" placeholder="Иванов" required />
        </div>
      </div>

      <label for="age">Възраст</label>
      <input id="age" name="age" type="number" min="18" max="120" placeholder="35" />

      <label for="total_loans">Обща сума на кредитите (лв.)</label>
      <input id="total_loans" name="total_loans" type="text" placeholder="20000" />

      <label for="monthly_payment">Месечна вноска по кредитите (лв.)</label>
      <input id="monthly_payment" name="monthly_payment" type="text" placeholder="450" />

      <label for="marital_status">Семейно положение</label>
      <select id="marital_status" name="marital_status">
        <option value="">— избери —</option>
        <option value="Неомъжен/Неомъжена">Неомъжен/Неомъжена</option>
        <option value="Женен/Омъжена">Женен/Омъжена</option>
        <option value="Разведен/Разведена">Разведен/Разведена</option>
        <option value="Вдовица/Вдовец">Вдовица/Вдовец</option>
      </select>

      <label>Имате ли недвижимо имущество?</label>
      <div class="radio-group">
        <label><input type="radio" name="real_estate" value="Да" checked> Да</label>
        <label><input type="radio" name="real_estate" value="Не"> Не</label>
      </div>

      <label for="phone">Телефонен номер</label>
      <input id="phone" name="phone" type="text" placeholder="+3598XXXXXXXX" required />

      <div class="small">Вашите данни са защитени. Ще бъдат използвани само за връзка с вас.</div>

      <button type="submit">Изпрати заявка</button>
      <div id="result"></div>
    </form>

    <div class="footer">© 2025 Вашата финансова компания</div>
  </div>

  <script>
    const form = document.getElementById('leadForm');
    const resultBox = document.getElementById('result');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      resultBox.innerHTML = '';
      const formData = new FormData(form);
      try {
        const res = await fetch('send.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();
        if (data.status === 'ok') {
          resultBox.innerHTML = '<div class="success">✅ Заявката е изпратена успешно!</div>';
          form.reset();
        } else {
          resultBox.innerHTML = '<div class="error">❌ Грешка при изпращането.</div>';
        }
      } catch (err) {
        resultBox.innerHTML = '<div class="error">⚠️ Възникна проблем при връзката със сървъра.</div>';
      }
    });
  </script>
</body>
</html>
