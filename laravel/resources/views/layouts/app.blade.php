<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WZond</title>

    <!-- Bootstrap 5 и FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Кастомные стили -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Скрипты -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=65085185-e802-42da-be67-8e4ad9343c5c"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="gray">

    <!-- Навигационная панель -->
    <nav class="navbar col-12 d-flex flex-wrap navbar-expand-lg">
        <div class="container-nav">
            <!-- Логотип -->
            <a href="/" class="logo col">WzOnd</a>

            <!-- Бургер-меню для мобилок -->
            <button class="navbar-toggler col" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="nav-links">
                        <!-- Основные ссылки -->
                        <div class="d-flex flex-column align-items-center flex-lg-row gap-2">
                            <a href="/" class="nav-button">Главная</a>
                            <a href="#" class="nav-button">Услуги</a>
                            <a href="#" class="nav-button">Цены</a>
                            <a href="{{ route('help') }}" class="nav-button">FAQs</a>
                            <a href="#" class="nav-button">О нас</a>
                        
    
                        <!-- Авторизация/Профиль -->
                            <div class="d-flex align-items-center ms-lg-3 mt-2 mt-lg-0">
                                @auth
                                    <div class="dropdown d-none d-lg-block">
                                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                            <img src="https://github.com/mdo.png" 
                                                alt="avatar" 
                                                width="32" 
                                                height="32" 
                                                class="rounded-circle">
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('profile') }}">Профиль</a></li>
                                            <li><a class="dropdown-item" href="#">Настройки</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li class="px-2">
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger w-100" type="submit">Выйти</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- На мобилке кнопка с аватаром отключается и заменяется 2мя --}}
                                    <a href="{{ route('profile') }}" class="nav-button d-block d-lg-none">Профиль</a>
                                    <form class="position-absolute bottom-0 start-50 translate-middle-x mb-5" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger w-100 d-block d-lg-none" type="submit">Выйти</button>
                                    </form>
                                @endauth
        
                                @guest
                                    <div class="d-flex flex-column flex-lg-row gap-2">
                                        <a class="btn btn-primary" href="{{ route('login') }}">Вход</a>
                                        <a class="btn btn-outline-primary" href="{{ route('register') }}">Регистрация</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="page-content">
        @yield('content')    
    </main>

    <!-- Подвал -->
    <footer class="footer mt-1">
        <div class="footer-bg">
            <div class="container">
                <!-- Верхняя часть футера -->
                <div class="footer-header row align-items-center py-4">
                    <div class="col-12 col-md-4 text-center text-md-start">
                        <a href="/" class="logo text-white-50">WzOnd</a>
                    </div>
                    
                    <div class="col-12 col-md-8 mt-3 mt-md-0">
                        <div class="social-links d-flex justify-content-center justify-content-md-end gap-3">
                            <a href="https://facebook.com" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com" class="social-link twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://instagram.com" class="social-link instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://linkedin.com" class="social-link linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://github.com" class="social-link github">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Навигация в футере -->
                <nav class="row col-12 d-none d-md-block border-bottom pb-4">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                          <a class="nav-link text-white" aria-current="page" href="#">Главная</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-white" href="#">Помощь</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-white" href="#">Партнерство</a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link text-white">О нас</a>
                        </li>
                      </ul>
                </nav>

                <!-- Копирайт -->
                <div class="row pt-4">
                    <div class="col-12 text-center">
                        <p class="mb-0 text-white-50">© 2025 WZond. Все права защищены.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Кастомный скрипт для скрытия навигации -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            let lastScroll = 0;

            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > lastScroll && currentScroll > 100) {
                    navbar.style.top = `-${navbar.offsetHeight}px`;
                } else {
                    navbar.style.top = '0';
                }
                
                lastScroll = currentScroll;
            });
        });
    </script>

</body>
</html>