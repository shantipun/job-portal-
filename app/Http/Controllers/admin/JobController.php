<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.job', compact('jobs')); // folder: admin/jobs/index.blade.php
    }

    // Show create form
    public function create()
    {
        return view('admin.jobs.create'); // folder: admin/jobs/create.blade.php
    }

    // Store a new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'description' => 'required',
            'last_date' => 'required|date',
            'salary' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);

      Job::create($request->all() + [
    'is_active' => $request->input('is_active', 1),
    'employer_id' => null,
 // admin job placeholder
]);

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');
    }

    // Show edit form
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job')); // folder: admin/jobs/edit.blade.php
    }

    // Update job
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'description' => 'required',
            'last_date' => 'required|date',
            'salary' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    // Delete job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }

    // Toggle active/inactive
    public function toggleStatus(Job $job)
    {
        $job->is_active = !$job->is_active;
        $job->save();
        return redirect()->back()->with('success', 'Job status updated.');
    }
}
