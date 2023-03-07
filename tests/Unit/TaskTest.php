<?php

namespace Tests\Unit;


use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    public function test_task_belongs_to_todo_list()
    {

        $todoList = $this->createTodoList();
        $task = $this->createTask($todoList);

        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}
