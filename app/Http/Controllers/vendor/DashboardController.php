<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;

class DashboardController extends Controller
{public function index()
{
    $vendor = Auth::user();

    if ($vendor->role !== 'vendor') {
        abort(403, 'Unauthorized access');
    }

    $totalJobs = Job::where('employer_id', $vendor->id)->count();

    $totalApplications = Application::whereHas('job', function($query) use ($vendor) {
        $query->where('employer_id', $vendor->id);
    })->count();

    $pendingApplications = Application::whereHas('job', function($query) use ($vendor) {
        $query->where('employer_id', $vendor->id);
    })->where('status', 'pending')->count();

    $jobs = Job::where('employer_id', $vendor->id)
               ->with('company', 'applications.user')
               ->get();

    return view('vendor.dashboard', compact(
        'vendor',
        'totalJobs',
        'totalApplications',
        'pendingApplications',
        'jobs'
    ));
}


}
