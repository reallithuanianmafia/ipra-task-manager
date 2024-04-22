<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'text' => 'required',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Add the user_id to the request data
        $requestData = $request->all();
        $requestData['user_id'] = $userId;

        // Create the comment
        $comment = Comment::create($requestData);

        // Eager load the user relationship on the comment
        $comment->load('user');

        // Return the created comment with user information
        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
            $comment = Comment::findOrFail($id);
            $comment->text = $request->text;
            $comment->save();
            return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(null, 204);
    }
}