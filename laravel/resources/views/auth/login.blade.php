{{-- <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Войти</button>
</form> --}}

<div class="login-container">
    <h2>Войти в аккаунт</h2>
    
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Пароль" required>
        </div>

        <button type="submit" class="btn-login">Войти</button>
    </form>

    <p class="register-link">
        Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
    </p>
</div>

<!-- Стили -->
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #eef8f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
        text-align: center;
    }


    .login-container h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-form .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .login-form input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
        font-size: 16px;
    }

    .login-form input:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        outline: none;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-login:hover {
        background-color: #45a049;
        transform: translateY(-2px);
    }

    .register-link {
        margin-top: 15px;
        font-size: 14px;
        color: #555;
    }

    .register-link a {
        color: #4CAF50;
        text-decoration: none;
        transition: color 0.3s;
    }

    .register-link a:hover {
        color: #388E3C;
    }

    /* ✅ Адаптив для мобильных */
    @media (max-width: 480px) {
        .login-container {
            padding: 30px 20px;
        }

        .btn-login {
            font-size: 14px;
            padding: 12px;
        }

        .login-form input {
            font-size: 14px;
        }
    }
</style>
