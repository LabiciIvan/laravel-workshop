<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        Log::debug($request->input('tags'));

        $tags = [1, 2];

        $job = Job::create($mapped);

        $job->tags()->attach($tags);

        return redirect()->route('jobs.show', ['id' => $job->id]);
    }

    public function create() {
        $tags = Tag::select(['id', 'name'])->get();

        Log::debug($tags);
        $employers = Employer::select(['id', 'name'])->get();

        return view('jobs.create', ['employers' => $employers, 'tags' => $tags]);
    }

}
