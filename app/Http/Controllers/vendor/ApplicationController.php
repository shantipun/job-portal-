<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Show all applications for vendor's jobs
   public function index()
{
    // Get the logged-in vendor's user ID
    $vendorId = Auth::id(); // if vendor logs in as User with role='vendor'

    // Get all jobs posted by this vendor with their applications
    $jobs = Job::where('employer_id', $vendorId)
               ->with('applications.user') // eager load applicants
               ->get();

    return view('vendor.application', compact('jobs'));
}

    // Optional: view single application details
    public function show($id)
{
    $application = Application::with('user', 'job')->findOrFail($id);

    // Ensure the logged-in vendor owns the job
    if ($application->job->employer_id != Auth::guard('vendor')->id()) {
        abort(403, 'Unauthorized access to this application.');
    }

    return view('vendor.application-detail', compact('application'));
}
public function update(Request $request, $id)
    {
        // Find the application
        $application = Application::findOrFail($id);

        // Update status
        $application->status = $request->status;
        $application->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Application status updated.');
    }


}
