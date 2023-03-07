<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpCodeEnum;

class TodoListController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return response(TodoList::all());
    }

    /**
     * @param TodoList $todolist
     *
     * @return Response
     */
    public function show(TodoList $todoList): Response
    {
        return response($todoList);
    }

    /**
     * @param TodoListRequest $request
     *
     * @return TodoList
     */
    public function store(TodoListRequest $request): TodoList
    {
        return TodoList::create(['name' => $request->name]);
    }

    /**
     * @param TodoList $todoList
     *
     * @return Response
     */
    public function destroy(TodoList $todoList): Response
    {
        $todoList->delete();

        return response('', HttpCodeEnum::HTTP_NO_CONTENT);
    }

    public function update(TodoListRequest $request, TodoList $todoList)
    {
        $todoList->update(['name' => $request->name]);

        return response($todoList);
    }
}
