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
</head>
<body class="gray">
    <nav class="navbar">
        <div class=" container-nav">
            <!-- Логотип или название сайта -->
            <a href="/" class="logo me-5">Brand</a>
    
            <!-- Кнопки навигации -->
            <div class="nav-links">
                <a href="#" class="nav-button fs-5">Главная</a>
                <a href="#" class="nav-button fs-5">Link</a>
                <a href="#" class="nav-button fs-5">Link</a>
                <a href="#" class="nav-button fs-5">Link</a>
                <a href="#" class="nav-button fs-5">FAQs</a>
                <a href="#" class="nav-button fs-5">О нас</a>
                @auth
                    <div class="dropdown text-end d-flex align-items-center">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Профиль</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="justify-content-center d-flex">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger px-5" type="submit">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                
                @guest
                    <a class="btn btn-primary d-flex align-items-center" href="{{ route('login') }}">Вход</a>
                    <a class="btn btn-primary d-flex align-items-center" href="{{ route('register') }}">Регистрация</a>
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