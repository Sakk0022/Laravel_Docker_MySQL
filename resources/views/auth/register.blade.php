<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Имя" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
</body>
</html>
