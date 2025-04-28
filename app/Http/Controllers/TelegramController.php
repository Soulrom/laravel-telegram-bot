<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Client([
            'base_uri' => 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/',
        ]);
    }

    // Обробка webhook запиту
    public function handle(Request $request)
    {
        $update = $request->all();  // Отримуємо всі дані, надіслані Telegram через POST-запит

        // Перевірка, чи є повідомлення в даних
        if (isset($update['message'])) {
            $message = $update['message'];
            $chatId = $message['chat']['id'];
            $text = $message['text'];

            // Відправка повідомлення користувачу
            $this->telegram->post('sendMessage', [
                'json' => [
                    'chat_id' => $chatId,
                    'text' => "Ви надіслали повідомлення: $text"
                ]
            ]);
        }

        return response('OK', 200);  // Відповідь для Telegram, що запит успішно оброблено
    }

    // Налаштування webhook
    public function setWebhook()
    {
        $webhookUrl = env('TELEGRAM_WEBHOOK_URL');  // URL для webhook

        // Викликаємо Telegram API для встановлення webhook
        $response = $this->telegram->post('setWebhook', [
            'json' => [
                'url' => $webhookUrl
            ]
        ]);

        return response()->json($response->getBody()->getContents());
    }
}
