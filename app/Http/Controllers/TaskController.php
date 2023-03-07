<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpStatusCodes;

class TaskController extends Controller
{
    /**
     * @return Response
     */
    public function index(TodoList $todoList): Response
    {
        return response($todoList->tasks);
    }

    /**
     * @param TaskRequest $request
     *
     * @return Task
     */
    public function store(TaskRequest $request, TodoList $todoList): Task
    {
        return $todoList->tasks()->create($request->all());
    }

    /**
     * @param TaskRequest $request
     * @param Task        $task
     *
     * @return Response
     */
    public function update(TaskRequest $request, Task $task): Response
    {
        $task->update(['title' => $request->title]);

        return response($task);
    }

    /**
     * @param Task $task
     *
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response('', HttpStatusCodes::HTTP_NO_CONTENT);
    }
}
