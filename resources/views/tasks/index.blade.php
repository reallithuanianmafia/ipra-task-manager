@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->title }}</li>
            <!-- Display other task details here -->
        @endforeach
    </ul>
@endsection
