<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Retrieve all activity logs
        $activityLogs = Activity::all();

        return inertia('ActivityLogs', [
            'logs' => $activityLogs,
        ]);
    }
}
