<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use SweetAlert2\Laravel\Swal;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() {
        return view('jobs.index', [
        'jobs' => Job::with(['employer', 'tags'])->latest()->paginate(5)
    ]);
    }

    public function create() {
        return view('jobs.create', [
        'employers' => Employer::all(),
        'tags' => Tag::all()
    ]);

    }

    public function show(Job $job) {
        return view('jobs.show', [
        'job' => $job
    ]);
    }

    public function store() {

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


    }

    public function edit(Job $job) {

        return view('jobs.edit', [
            'job' => $job,
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);

    }

    public function update(Job $job) {

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

    }

    public function destroy(Job $job) {

         $job->delete();

    Swal::info([
    'title' => 'Job successfully deleted!',
    ]);

    return redirect('/jobs');


    }
}
