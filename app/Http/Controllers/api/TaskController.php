<?php

namespace App\Http\Controllers\api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'DESC')->get();

        return TaskResource::collection($tasks);

    }
    public function toDoTaskList()
    {
        $tasks = Task::orderBy('id', 'DESC')->where('status_id', 1)->get();

        return TaskResource::collection($tasks);


    }
    public function progressTaskList()
    {
        $tasks = Task::orderBy('id', 'DESC')->where('status_id', 2)->get();

        return TaskResource::collection($tasks);

    }
    public function doneTaskList()
    {
        $tasks = Task::orderBy('id', 'DESC')->where('status_id', 3)->get();

        return TaskResource::collection($tasks);

    }

    public function create()
    {
        //
    }

    public function store(TaskRequest $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:56'],
        ]);


        $request['status_id'] = 1;

        $task = new Task;
        $task->title = $request->title;
        $task->status_id = $request->status_id;
        $task->save();

        return response()->json($task);
    }

    public function moveToProgress($id){
        $task = Task::where('id', $id)->first();
        $task->status_id = 2;
        $task->save();
        return response()->json($task);
    }
    public function moveToDone($id){
        $task = Task::where('id', $id)->first();
        $task->status_id = 3;
        $task->save();
        return response()->json($task);
    }

    public function taskDelete($id)
    {
        $task = Task::where('id', $id)->first();
        $task->delete();
        return response()->json($task);
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        //
    }
}
