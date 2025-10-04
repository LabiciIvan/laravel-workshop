<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller {

    public function index() {
        $jobs = Job::with('employer')->latest()->paginate(5);

        return view('jobs.jobs', ['jobs' => $jobs]);
    }

    public function show(int $id) {
        $job = Job::with('employer')->findOrFail($id);
        return view('jobs.show', ['job' => $job]);
    }

    public function store(Request $request) {
        $data = [
            'title'         => $request->input('name'),
            'salary'        => $request->input('salary'),
            'employer_id'   => $request->input('employer')
        ];

        $tags = [1, 2];

        $job = Job::create($data);

        $job->tags()->attach($tags);

        return view('jobs.show', ['job' => $job]);
    }

    public function create() {
        $employers = Employer::select(['id', 'name'])->get();
        return view('jobs.create', ['employers' => $employers]);
    }

}
