<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks', TaskController::class)->names('api.tasks');
Route::get('tugas', [TaskController::class, 'index'])->name('api.tugas');

Route::get('health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('api.health');
