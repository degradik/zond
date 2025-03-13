<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WZond</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=65085185-e802-42da-be67-8e4ad9343c5c"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="gray">
<nav class="navbar">
    <div class="container-nav">
        <!-- ЛОГО -->
        <a href="/" class="logo">Brand</a>

        <!-- КНОПКА ПРОФИЛЯ + МЕНЮ (ТОЛЬКО ДЛЯ МОБИЛЬНЫХ) -->
        <div class="mobile-actions">
            <!-- Кнопка профиля -->
            @auth
                <a href="{{ route('profile') }}" class="profile-btn">
                    <i class="fas fa-user-circle"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="profile-btn">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            @endauth

            <!-- Кнопка меню -->
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- ССЫЛКИ МЕНЮ -->
        <div class="nav-links" id="navLinks">
            <a href="#" class="nav-button">Главная</a>
            <a href="#" class="nav-button">Услуги</a>
            <a href="#" class="nav-button">Цены</a>
            <a href="#" class="nav-button">FAQs</a>
            <a href="#" class="nav-button">О нас</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button class="btn btn-danger w-100">Выйти</button>
                </form>
            @endauth

            @guest
                <div class="d-flex flex-column gap-2 mt-3">
                    <a class="btn btn-primary" href="{{ route('login') }}">Вход</a>
                    <a class="btn btn-outline-primary" href="{{ route('register') }}">Регистрация</a>
                </div>
            @endguest
        </div>
    </div>
</nav>


    <div class="page-content">
        @yield('content')    
    </div>
      

    <div class="footer">
        <div class="footer-bg">
            <div class="container col-12 d-flex flex-wrap">
                <div class="footer-header col-12 d-flex flex-wrap py-5">
                    <a href="/" class="logo">Brand</a>
                    <div class="col justify-content-end social-links">
                        <a href="https://facebook.com" target="_blank" class="social-link facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="social-link twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="social-link instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="social-link linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://github.com" target="_blank" class="social-link github">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                <ul class="nav col-12 flex-wrap d-flex nav-pills nav-fill border-bottom pb-5">
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary" >Link</a>
                    </li>
                </ul>
                <div class="col-12 pt-5">
                    <p class="text-center text-white">© 2025</p>
                </div>
            </div>
        </div>
        
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>