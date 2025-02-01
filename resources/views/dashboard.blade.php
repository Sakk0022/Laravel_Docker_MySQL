<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
</head>
<body>
    <h1>Добро пожаловать в личный кабинет!</h1>
    <p>Здесь можно управлять своим аккаунтом и просматривать информацию.</p>

    <a href="{{ url('/stocks/save') }}">Перейти к списку товаров</a>


    <!-- Logout form using POST method -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Выйти</button>
    </form>
</body>
</html>
