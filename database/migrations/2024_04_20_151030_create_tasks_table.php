<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('creator')->constrained('users');
            $table->foreignId('tester')->constrained('users');
            $table->foreignId('assignee')->constrained('users');
            $table->enum('status', ['pause', 'in_progress', 'testing', 'release']);
            $table->enum('type', ['task', 'bug'])->default('task');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
