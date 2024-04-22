<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasksAndBugs = Task::orderByDesc('id')->get();

        return response()->json($tasksAndBugs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'creator' => 'required|exists:users,id',
            'tester' => 'required|exists:users,id',
            'assignee' => 'required|exists:users,id',
            'status' => 'required|string|in:pause,in_progress,testing,release',
            'type' => 'required|string|in:task,bug',
        ]);

        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    public function show(string $id)
    {
        $item = Task::with('creator', 'tester', 'assignee')->findOrFail($id);
        $comments = $item->comments()->with('user')->get();
        $userId = auth()->id(); // Get the authenticated user's ID
        $authenticatedUserId = ['userId' => $userId]; // Data to pass to the Vue component

        return Inertia::render('TaskComponent', [
            'item' => $item,
            'comments' => $comments,
            'authenticatedUserId' => $authenticatedUserId
        ]);
    }
    
    public function destroy(string $id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);

        // Delete the task
        $task->delete();

        // Return success response
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        // Find the task by its ID with related models loaded
        $task = Task::findOrFail($id);

        // Update the task with the request data
        $task->update($request->all());

        // Refetch the task with related models after updating
        $updatedTask = Task::with('creator', 'tester', 'assignee')->findOrFail($id);

        // Return the updated task
        return response()->json($updatedTask);
    }
}