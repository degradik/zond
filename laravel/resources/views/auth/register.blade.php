<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="full_name" placeholder="Полное имя" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required>
    <button type="submit">Зарегистрироваться</button>
</form>