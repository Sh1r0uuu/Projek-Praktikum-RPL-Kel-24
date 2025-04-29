<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyResep</title>
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
        input[type="text"],
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
        .checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .checkbox input {
            margin-right: 10px;
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
            max-width: 200px;
        }
        .logo-title {
            font-size: 36px;
            font-weight: bold;
            margin-top: 20px;
        }
        .admin-link {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #133c1f;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <a href="{{ route('login') }}" class="admin-link">Login Sebagai Admin</a>
        <h2>Get Started Now</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="checkbox">
                <input type="checkbox" required>
                <span>I agree to the <a href="#">terms & policy</a></span>
            </div>

            <button class="btn" type="submit">Daftar</button>
        </form>

        <div class="text-center">
            Have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>

    <div class="logo-section">
        <img src="{{ asset('images/myresep-logo.png') }}" alt="MyResep Logo">
        <div class="logo-title">MYRESEP</div>
    </div>
</div>
</body>
</html>
