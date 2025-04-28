<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Jobs\SendTasksNotification;

class NotifyTasksTest extends TestCase
{
    use RefreshDatabase;

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        // Reset Faker's unique generator
        $this->faker = \Faker\Factory::create();
        $this->faker->unique(true);
    }

    public function test_it_sends_task_notifications_to_subscribed_users()
    {
        // Create a user with a unique telegram_id
        $user = User::factory()->create([
            'telegram_id' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'subscribed' => true,
        ]);

        // Assert that the user was created successfully
        $this->assertDatabaseHas('users', ['telegram_id' => $user->telegram_id]);

        // Create mocks for external API
        Http::fake([
            'https://jsonplaceholder.typicode.com/todos' => Http::response([
                ['userId' => 1, 'title' => 'Task 1', 'completed' => false],
                ['userId' => 2, 'title' => 'Task 2', 'completed' => false],
            ], 200),
        ]);

        // Mock job dispatching
        Bus::fake();

        // Call the command
        $this->artisan('notify:tasks')
            ->expectsOutput('Tasks notifications sent!')
            ->assertExitCode(0);

        // Verify that the job was dispatched
        Bus::assertDispatched(SendTasksNotification::class, function ($job) use ($user) {
            return $job->getUser()->id === $user->id && count($job->getTasks()) === 2;
        });
    }
}
