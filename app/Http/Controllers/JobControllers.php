<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use App\Models\Application;

class JobControllers extends Controller
{
    // Salaries Page
    public function findSalaries(Request $request)
    {
        $query = Job::where('is_active', 1)
                    ->whereNotNull('salary');

        // Search by title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Search by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by job type (industry)
        if ($request->filled('industry')) {
            $query->where('job_type', $request->industry);
        }

        $jobs = $query->latest()->get();

        return view('find-salaries', compact('jobs'));
    }

    // Job Detail Page
   
  
public function show($id)
{
    $job = Job::findOrFail($id);

    // Related jobs by same company
    $relatedJobs = Job::where('company_name', $job->company_name)
                        ->where('is_active', 1)
                        ->get();

    return view('job-detail', compact('job', 'relatedJobs'));
}

// Apply function
public function apply(Request $request, $id)
{
    $request->validate([
   'cover_letter' => 'required|mimes:pdf,doc,docx|max:2048', // 2MB max
        'resume' => 'required|mimes:pdf|max:2048'
    ]);

    $job = Job::findOrFail($id);

    $resumePath = $request->file('resume')->store('resumes', 'public');
      // Handle Cover Letter upload
    if ($request->hasFile('cover_letter')) {
        $coverLetterPath = $request->file('cover_letter')
            ->store('applications/cover_letters', 'public');
    }

    Application::create([
        'job_id' => $job->id,
        'user_id' => Auth::id(),
 'cover_letter' => $coverLetterPath ?? null,
        'resume' => $resumePath,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Application submitted successfully!');
}
  public function jobHistory()
    {
        $user = Auth::user();

        // Fetch all applications of the logged-in user with related job info
        $applications = Application::with('job')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.job-history', compact('user', 'applications'));
    }
    public function unsave($id)
{
    SavedJob::where('user_id', auth()->id())
        ->where('job_id', $id)
        ->delete();

    return back()->with('success', 'Job removed from saved list');
}

 public function index()
    {
        $jobs = Job::latest()->paginate(2);
        return view('jobs.index', compact('jobs'));
    }
    public function save($id)
{
    $job = Job::findOrFail($id);

    // Check if already saved
    $exists = SavedJob::where('user_id', auth()->id())
                      ->where('job_id', $job->id)
                      ->exists();

    if (!$exists) {
        SavedJob::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);
    }

    return back()->with('success', 'Job saved successfully!');
}
public function store(Request $request, Job $job)
{
    if (now()->gt($job->last_date)) {
        return back()->with('error', 'Application deadline has passed.');
    }

    if (auth()->user()->role !== 'user') {
        abort(403);
    }

    // save application logic
}


}
