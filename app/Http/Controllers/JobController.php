<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;

class JobController extends Controller {

    public function index() {
        $jobs = Job::with('employer')->latest()->paginate(5);

        return view('jobs.jobs', ['jobs' => $jobs]);
    }

    public function show(int $id) {
        $job = Job::with('employer')->findOrFail($id);
        return view('jobs.show', ['job' => $job]);
    }

    public function store(JobStoreRequest $request) {
        $mapped = $request->mappedAttributes();

        $tags = [1, 2];

        $job = Job::create($mapped);

        $job->tags()->attach($tags);

        return redirect()->route('jobs.show', ['id' => $job->id]);
    }

    public function create() {
        $tags = Tag::select(['id', 'name'])->get();

        $employers = Employer::select(['id', 'name'])->get();

        return view('jobs.create', ['employers' => $employers, 'tags' => $tags]);
    }

    public function edit(string $id) {
        $job = Job::with('employer', 'tags')->where('id', $id)->first();

        $jobTagIds = $job->tags->pluck('id');

        $tags = Tag::whereNotIn('id', $jobTagIds)->get();

        return view('jobs.edit', ['job' => $job, 'availableTags' => $tags]);
    }

}
