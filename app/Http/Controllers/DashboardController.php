<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
 use App\Models\Job;
 use App\Models\Application;
 use App\Models\SavedJob;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

 
public function index()
{
    $user = Auth::user();

    // Count applied jobs
    $appliedCount = Application::where('user_id', $user->id)->count();

    // Count saved jobs
    $savedCount = SavedJob::where('user_id', $user->id)->count();

    // Get the list of applications
    $applications = Application::where('user_id', $user->id)
                               ->with('job') // eager load the related job
                               ->latest()
                               ->get();

    return view('user.dashboard', compact('user', 'appliedCount', 'savedCount', 'applications'));
}
 public function jobHistory()
{
    $userId = auth()->id();

    // Fetch all applications for this user, including job info
    $applications = \App\Models\Application::with('job') // assuming relation exists
                        ->where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('user.job-history', compact('applications'));
}

     public function savedJobs()
    {
        $savedJobs = SavedJob::with('job')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.saved-jobs', compact('savedJobs'));
    }
    

}
