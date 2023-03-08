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

    public function test_if_todo_list_is_deleted_then_all_its_tasks_will_be_deleted()
    {
        $todoList = $this->createTodoList();
        $this->createTask($todoList);
        $task = $this->createTaskAlone();

        $todoList->delete();

        $this->assertDatabaseMissing('todo_lists', ['id' => $todoList->id]);
        $this->assertDatabaseMissing('tasks', ['todo_list_id' => $todoList->id]);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);

    }
}
