<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCompletedTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_status_can_be_changed()
    {
        $todoList = $this->createTodoList();
        $task = $this->createTask($todoList);

        $this->patchJson(route('task.update', $task->id), ['status' => Task::STATUS_STARTED]);

        $this->assertDatabaseHas('tasks', ['status' => Task::STATUS_STARTED]);
    }
}
