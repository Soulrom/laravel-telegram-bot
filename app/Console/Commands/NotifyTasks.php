<?php

namespace App\Console\Commands;

use App\Jobs\SendTasksNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class NotifyTasks extends Command
{
    protected $signature = 'notify:tasks';
    protected $description = 'Notify users about their tasks';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Отримання завдань через API
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
        $tasks = collect($response->json())
            ->filter(fn($task) => !$task['completed'] && $task['userId'] <= 5) // Фільтруємо завдання
            ->values();

        // Перетворення колекції на масив
        $tasksArray = $tasks->toArray();

        // Отримання всіх підписаних користувачів
        $users = User::where('subscribed', true)->get();

        // Диспетчеризація завдань для кожного користувача
        foreach ($users as $user) {
            SendTasksNotification::dispatch($user, $tasksArray);
        }

        $this->info('Tasks notifications sent!');
    }
}
