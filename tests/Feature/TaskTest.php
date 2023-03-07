<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private TodoList $todoList;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->todoList = $this->createTodoList();
        $this->task     = $this->createTask($this->todoList);
    }

    /**
     * A basic feature test example.
     */
    public function test_fetch_all_task_of_a_todo_list(): void
    {
        $response = $this->getJson(route('todo-list.task.index', $this->todoList->id))->assertOk()->json();

        $this->assertEquals(1, count($response));
        $this->assertEquals($this->task->title, $response[0]['title']);
        $this->assertEquals($this->task->id, $response[0]['id']);
    }

    public function test_store_a_task_of_a_todo_list()
    {
        $taskFactory = Task::factory()->make();

        $this->postJson(route('todo-list.task.store', $this->todoList->id), ['title' => $taskFactory->title])->assertCreated();

        $this->assertDatabaseHas('tasks', ['title' => $taskFactory->title, 'todo_list_id' => $this->todoList->id]);
    }

    public function test_update_a_task_of_a_todo_list()
    {
        $updatedTitle = 'Updated title';
        $this->patchJson(route('task.update', $this->task->id), ['title' => $updatedTitle])->assertOk();

        $this->assertDatabaseHas('tasks', ['title' => $updatedTitle]);
    }

    public function test_delete_a_task()
    {
        $this->deleteJson(route('task.destroy', $this->task->id))->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['title' => $this->task->title]);
    }
}
