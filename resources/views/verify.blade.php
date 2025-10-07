<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .verify-box {
            background-color: #fff;
            width: 400px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .verify-box h4 {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .verify-box p {
            font-size: 15px;
            color: #555;
        }
        .form-control {
            border-radius: 6px;
            padding: 10px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #1877f2;
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #166fe5;
        }
        .resend-link {
            color: #1877f2;
            text-decoration: none;
            font-size: 14px;
        }
        .resend-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="verify-box text-center">
    <h4>Enter the code from your email</h4>
    <p>We’ve sent a verification code to <strong>{{ session('email_for_verification') }}</strong></p>

    <form method="POST" action="{{ route('verify.code') }}">
        @csrf
        <input type="text" name="code" class="form-control mb-3 text-center" placeholder="Enter code" required>
        <button type="submit" class="btn btn-primary w-100">Continue</button>
    </form>
</div>

</body>
</html>
