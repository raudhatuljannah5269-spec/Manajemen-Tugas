<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Deskripsi tugas uji coba',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    /** @test */
    public function user_can_toggle_task_status()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id, 'status' => false]);

        $this->actingAs($user)->post("/tasks/{$task->id}/toggle");

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'status' => true]);
    }
}
