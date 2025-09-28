<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use SweetAlert2\Laravel\Swal;

Route::get('/', function () {
    return view('home');
});

// Jobs list
Route::get('/jobs', function () {
    return view('jobs.index', [
        'jobs' => Job::with(['employer', 'tags'])->latest()->paginate(5)
    ]);
});

// Create Job form
Route::get('/jobs/create', function () {
    return view('jobs.create', [
        'employers' => Employer::all(),
        'tags' => Tag::all()
    ]);
});

// Show Job details
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', [
        'job' => $job
    ]);
});

// Store a New Job
    Route::post('/jobs', function () {

        request()->validate([

         'title' => ['required', 'min:3'],
         'salary' => ['required'],
         'employer_id' => ['required'],
         'tags' => ['required']
        ], [
            'employer_id.required' => "The employer field is required."

        ]);

       $job = Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => request('employer_id'),
    ],);

      $job->tags()->attach(array_values(request('tags')));

      Swal::success([
    'title' => 'Job successfully created!',
    ]);


    return redirect('/jobs');

    });

    //Edit a job
    Route::get('/jobs/{job}/edit', function(Job $job) {
        return view('jobs.edit', [
            'job' => $job,
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    });

    //Update a Job
    Route::patch('/jobs/{job}', function(Job $job) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
        'employer_id' => ['required'],
        'tags' => ['required']
    ], [
        'employer_id.required' => "The employer field is required."
    ]);

    // update existing record instead of creating new
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => request('employer_id'),
    ]);

    // sync tags (instead of attach, to avoid duplicates)
    $job->tags()->sync(request('tags'));

    Swal::success([
        'title' => 'Job successfully updated!',
    ]);

    return redirect('/jobs');
});

//Delete a Job
Route::delete('/jobs/{job}', function(Job $job) {

    $job->delete();

    Swal::info([
    'title' => 'Job successfully deleted!',
    ]);

    return redirect('/jobs');

});