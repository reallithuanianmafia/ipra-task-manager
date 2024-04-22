@extends('layouts.app')

@section('content')
    <h1>Add Comment</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <label>Content:</label><br>
        <textarea name="content"></textarea><br>
        <input type="hidden" name="commentable_id" value="{{ $commentable_id }}">
        <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
        <button type="submit">Add Comment</button>
    </form>
@endsection
