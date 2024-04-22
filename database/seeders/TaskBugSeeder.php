<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskBugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Implement user authentication',
                'content' => 'Develop user authentication feature using Laravel Passport.',
                'creator' => 1,
                'tester' => 3,
                'assignee' => 4,
                'status' => 'in_progress',
                'type' => 'task'
            ],
            [
                'title' => 'User profile picture not displaying',
                'content' => 'User profile pictures are not showing up on the profile page after upload.',
                'creator' => 4,
                'tester' => 1,
                'assignee' => 3,
                'status' => 'in_progress',
                'type' => 'bug'
            ],
            [
                'title' => 'Fix login page layout issue',
                'content' => 'Adjust the layout of the login page to resolve the display problem on mobile devices.',
                'creator' => 3,
                'tester' => 4,
                'assignee' => 3,
                'status' => 'testing',
                'type' => 'task'
            ],
            [
                'title' => 'Unable to reset password',
                'content' => 'Users are unable to reset their passwords via the "Forgot Password" link.',
                'creator' => 3,
                'tester' => 1,
                'assignee' => 4,
                'status' => 'testing',
                'type' => 'bug'
            ],
            [
                'title' => 'Implement file upload functionality',
                'content' => 'Develop file upload feature to allow users to upload images and documents.',
                'creator' => 4,
                'tester' => 3,
                'assignee' => 4,
                'status' => 'pause',
                'type' => 'task'
            ],
            [
                'title' => 'Broken pagination on search results',
                'content' => 'Pagination links are not working properly on search results page.',
                'creator' => 1,
                'tester' => 3,
                'assignee' => 4,
                'status' => 'pause',
                'type' => 'bug'
            ],
            [
                'title' => 'Create user profile page',
                'content' => 'Design and implement the user profile page with basic user information.',
                'creator' => 3,
                'tester' => 1,
                'assignee' => 3,
                'status' => 'release',
                'type' => 'task'
            ],
            [
                'title' => 'Missing error message on login failure',
                'content' => 'No error message is displayed when login attempt fails due to incorrect credentials.',
                'creator' => 3,
                'tester' => 4,
                'assignee' => 4,
                'status' => 'release',
                'type' => 'bug'
            ],
            [
                'title' => 'Optimize database queries',
                'content' => 'Analyze and optimize database queries to improve application performance.',
                'creator' => 1,
                'tester' => 3,
                'assignee' => 1,
                'status' => 'in_progress',
                'type' => 'task'
            ],
            [
                'title' => 'Incorrect data displayed on dashboard',
                'content' => 'Dashboard is showing outdated or incorrect data to the users.',
                'creator' => 4,
                'tester' => 4,
                'assignee' => 3,
                'status' => 'in_progress',
                'type' => 'bug'
            ]
        ];

        foreach ($data as $taskBugData) {
            Task::create($taskBugData);
        }
    }
}
