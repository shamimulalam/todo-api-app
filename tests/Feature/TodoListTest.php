<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as HttpCodeEnum;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    private TodoList $todoList;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $user = $this->authUser();
        $this->todoList = $this->createTodoList(['user_id' => $user->id]);
    }

    /**
     * Test fetching todo list
     */
    public function test_fetch_all_todo_list(): void
    {
        $this->createTodoList();

        $response = $this->getJson(route('todo-list.index'))->assertOk();

        $this->assertCount(1, $response->json());
    }

    public function test_fetch_single_todo_list(): void
    {
        $response = $this->getJson(route('todo-list.show', $this->todoList->id))
                         ->assertOk()
                         ->json();

        $this->assertSame($this->todoList->name, $response['name']);
    }

    public function test_while_storing_todo_list_name_field_is_required(): void
    {
        $this->postJson(route('todo-list.store'))
             ->assertUnprocessable()
             ->assertJsonValidationErrorFor('name');
    }

    public function test_store_new_todo_list(): void
    {
        $todoList = TodoList::factory()->make();
        $this->postJson(route('todo-list.store'), ['name' => $todoList->name])
             ->assertCreated();

        $this->assertDatabaseHas('todo_lists', ['name' => $todoList->name]);
    }

    public function test_while_updating_todo_list_name_field_is_required(): void
    {
        $this->patchJson(route('todo-list.update', $this->todoList->id))
             ->assertUnprocessable()
             ->assertJsonValidationErrorFor('name');
    }

    public function test_update_todo_list(): void
    {
        $updatedName = 'Hello Todo List';
        $this->patchJson(route('todo-list.update', $this->todoList->id), ['name' => $updatedName])
             ->assertOk();

        $this->assertDatabaseHas('todo_lists', ['name' => $updatedName]);
    }

    public function test_delete_todo_list(): void
    {
        $this->deleteJson(route('todo-list.destroy', $this->todoList->id))
             ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->todoList->name]);
    }
}
