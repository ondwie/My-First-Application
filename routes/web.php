<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;


Route::get('/', function() {
    return view('home');
});

Route::resource('jobs', JobController::class);
// Index
// Route::get('/jobs', [JobController::class, 'index']);

// Create Job form
// Route::get('/jobs/create', [JobController::class, 'create']);

// Show Job details
// Route::get('/jobs/{job}', [JobController::class, 'show']);

// Store a New Job
// Route::post('/jobs', [JobController::class, 'store']);

 //Edit a job
// Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);

 //Update a Job
// Route::patch('/jobs/{job}', [JobController::class, 'update']);

//Delete a Job
// Route::delete('/jobs/{job}', [JobController::class, 'destroy']);