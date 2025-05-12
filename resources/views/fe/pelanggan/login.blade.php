<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --primary-color: #4e89a6;
        --secondary-color: #57a5b8;
        --black: #000000;
        --white: #ffffff;
        --gray: #efefef;
        --gray-2: #757575;
        --error-color: #ff3333;
    }

    * {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100vh;
        overflow: hidden;
    }
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }
    .container {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: none;
    }

    .form-wrapper {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .form {
        background-color: var(--white);
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .form-title {
        text-align: center;
        margin-bottom: 2rem;
        color: var(--primary-color);
    }

    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        color: var(--gray-2);
    }

    .input-group input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        border: 2px solid var(--gray);
        border-radius: 0.5rem;
        outline: none;
        transition: all 0.3s;
    }

    .input-group input:focus {
        border-color: var(--primary-color);
    }

    .btn-submit {
        width: 100%;
        padding: 1rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: var(--secondary-color);
    }

    .form-footer {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.9rem;
    }

    .form-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .error-message {
        color: var(--error-color);
        font-size: 0.8rem;
        margin-top: 0.3rem;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <form class="form" method="POST" action="{{ route('pelanggan.login.submit') }}">
                @csrf
                <h2 class="form-title">Sign In</h2>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="katakunci" placeholder="Password" required>
                </div>
                @error('katakunci')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                @if($errors->has('login'))
                    <div class="error-message" style="text-align:center;">{{ $errors->first('login') }}</div>
                @endif

                <button type="submit" class="btn-submit">Sign In</button>

                <div class="form-footer">
                    <span>Don't have an account? </span>
                    <a href="{{ route('pelanggan.register') }}">Sign up here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>