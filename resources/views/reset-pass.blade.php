<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        .alert-error {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
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
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.2s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Your Password</h1>
        <p>Enter your new password below.</p>

        <form method="POST" action="{{ route('verify.password') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ session('email_for_verification') }}" 
                    required 
                    readonly
                >
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="Enter new password"
                >
                @error('error')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                    placeholder="Confirm new password"
                >
            </div>

            <button type="submit" class="btn-primary">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>