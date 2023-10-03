<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskRequest;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get(); 
        return TaskResource::collection($tasks); 
    }

    public function show($id)
    {
        $task = Task::with('user')->find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return new TaskResource($task);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'title' => 'required|string|max:255',
          'description' => 'required|string|max:255',
          'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
        }
        // $validatedData = $request->validated();

        $task = Task::create($request->all());

        return response()->json(['message' => 'Success store task'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->update($request->all());

        return response()->json(['message' => 'Success update task'], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Success delete task'], 200);
    }
}