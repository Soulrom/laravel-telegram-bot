<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTasksNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $tasks;

    public function __construct(User $user, array $tasks)
    {
        $this->user = $user;
        $this->tasks = $tasks;
    }

    public function handle()
    {
        // Логіка для відправки повідомлення користувачеві.
        // Наприклад, через Telegram або email.
    }

    // Add getter methods for testing
    public function getUser(): User
    {
        return $this->user;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
