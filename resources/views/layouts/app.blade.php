<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management App</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ route('bugs.index') }}">Bugs</a></li>
            <!-- Add links for other sections -->
        </ul>
    </nav>

    <div>
        @yield('content')
    </div>
</body>
</html>
