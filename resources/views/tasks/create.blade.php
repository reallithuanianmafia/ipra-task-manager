@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label>Title:</label><br>
        <input type="text" name="title"><br>
        <label>Content:</label><br>
        <textarea name="content"></textarea><br>
        <label>Creator:</label><br>
        <input type="text" name="creator"><br>
        <label>Tester:</label><br>
        <input type="text" name="tester"><br>
        <label>Assignee:</label><br>
        <input type="text" name="assignee"><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="pause">Pause</option>
            <option value="in_progress">In Progress</option>
            <option value="testing">Testing</option>
            <option value="release">Release</option>
        </select><br>
        <button type="submit">Create Task</button>
    </form>
@endsection
