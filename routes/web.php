<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;

// Главная страница
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});


// Добавьте этот маршрут в `routes/web.php`
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');



// Страница о нас
Route::get('/about', [PageController::class, 'about'])->name('about');

// Страницы для аутентификации
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Страница личного кабинета (доступна только авторизованным пользователям)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Список товаров
Route::get('/stocks', function () {
    return \App\Models\Stock::all();
});

// Страница для сохранения товара
Route::get('/stocks/save', [StockController::class, 'index']);

