<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }
        h1 {
            font-size: 24px;
            color: #1c1e21;
            margin-bottom: 10px;
        }
        p {
            color: #606770;
            font-size: 15px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: #1c1e21;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.2s;
        }
        input[type="email"]:focus {
            outline: none;
            border-color: #1877f2;
        }
        .error-message {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
        }
        .btn-primary {
            width: 100%;
            padding: 12px 16px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #166fe5;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1877f2;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Find Your Account</h1>
        <p>Please enter your email address to search for your account.</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify.user') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="Enter your email"
                >
         @if ($errors->any())
            <div class="error-message" style="background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
                @endforeach
             </ul>
            </div>
         @endif
         </div>

            <button type="submit" class="btn-primary">
                Send code
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">Back to Login</a>
    </div>
</body>
</html>