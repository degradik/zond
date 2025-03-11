<h1>Профиль пользователя: {{ $user->name }}</h1>
<p>Email: {{ $user->email }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Выйти</button>
</form>