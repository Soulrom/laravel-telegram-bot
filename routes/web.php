<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;

Route::get('/', function () {
    return view('welcome');
});

// Для обробки webhook запиту
Route::post('/bot/webhook', [TelegramController::class, 'handle']);

// Для налаштування webhook в Telegram
Route::post('/bot/set-webhook', [TelegramController::class, 'setWebhook']);
