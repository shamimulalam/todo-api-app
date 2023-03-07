<?php

namespace App\Http\Controllers;

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
     * @param Request $request
     *
     * @return TodoList
     */
    public function store(Request $request): TodoList
    {
        $request->validate(['name' => ['required']]);
        return TodoList::create(['name' => $request->name]);
    }

    public function destroy(TodoList $todoList): Response
    {
        $todoList->delete();

        return response('', HttpCodeEnum::HTTP_NO_CONTENT);
    }

    public function update(Request $request, TodoList $todoList)
    {
        $request->validate(['name' => ['required']]);

        $todoList->update(['name' => $todoList->name]);

        return response($todoList);
    }
}
