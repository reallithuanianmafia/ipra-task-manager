@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title:</label><br>
        <input type="text" name="title" value="{{ $task->title }}"><br>
        <label>Content:</label><br>
        <textarea name="content">{{ $task->content }}</textarea><br>
        <label>Creator:</label><br>
        <input type="text" name="creator" value="{{ $task->creator }}"><br>
        <label>Tester:</label><br>
        <input type="text" name="tester" value="{{ $task->tester }}"><br>
        <label>Assignee:</label><br>
        <input type="text" name="assignee" value="{{ $task->assignee }}"><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="pause" {{ $task->status == 'pause' ? 'selected' : '' }}>Pause</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="testing" {{ $task->status == 'testing' ? 'selected' : '' }}>Testing</option>
            <option value="release" {{ $task->status == 'release' ? 'selected' : '' }}>Release</option>
        </select><br>
        <button type="submit">Update Task</button>
    </form>
@endsection
