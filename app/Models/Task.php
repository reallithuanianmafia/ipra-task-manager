<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Task extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'title', 'content', 'creator', 'tester', 'assignee', 'status', 'type'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeBugs($query)
    {
        return $query->where('type', 'bug');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee');
    }
}
