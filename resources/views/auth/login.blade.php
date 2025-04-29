<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MyResep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background-color: #fff;
            color: #000;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .form-section {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .form-section p {
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .forgot-password {
            font-size: 12px;
            float: right;
            margin-top: -20px;
            margin-bottom: 20px;
            color: #133c1f;
            text-decoration: none;
        }

        .btn {
            background-color: #133c1f;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        .text-center {
            margin-top: 20px;
            font-size: 14px;
        }

        .text-center a {
            color: #133c1f;
            font-weight: 600;
            text-decoration: none;
        }

        .logo-section {
            flex: 1;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-left: 1px solid #ddd;
        }

        .logo-section img {
            max-width: 300px;
        }

        .logo-title {
            font-size: 36px;
            font-weight: bold;
            margin-top: 20px;
            color: #133c1f;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <h2>Welcome back!</h2>
        <p>Enter your Credentials to access your account</p>

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <a class="forgot-password" href="#">forgot password</a>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>

        <div class="text-center">
            Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </div>

    <div class="logo-section">
        <img src="{{ asset('images/myresep-logo.png') }}" alt="MyResep Logo">
        <div class="logo-title">MYRESEP</div>
    </div>
</div>

</body>
</html>
