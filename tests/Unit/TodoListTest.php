<?php

namespace Tests\Unit;


use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_todo_list_can_has_many_tasks()
    {
        $todoList = $this->createTodoList();
        $this->createTask($todoList);

        $this->assertInstanceOf(Task::class, $todoList->tasks->first());
    }
}
