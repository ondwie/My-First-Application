<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
Route::get('/', function () {
return view('home');
});
Route::get('/jobs', function () {
return view('jobs', [
'jobs' => \App\Models\Job::with('employer', 'tags')->paginate(5)
]);
});
Route::get('/jobs/{job}', function (Job $job) {
return view('job', [
'job' => $job
]);
});
