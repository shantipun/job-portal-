<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Carbon\Carbon;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Start base query: only active jobs
        $query = Job::where('is_active', 1);

        // Filter by search input (job title or company)
if ($request->filled('search')) {
    $search = trim(strtolower($request->search));

    $query->where(function ($q) use ($search) {
        $q->whereRaw('LOWER(TRIM(title)) LIKE ?', ["%{$search}%"])
          ->orWhereRaw('LOWER(TRIM(company_name)) LIKE ?', ["%{$search}%"])
          ->orWhereRaw('LOWER(TRIM(job_type)) LIKE ?', ["%{$search}%"]);
    });
}



        // Filter by location
        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where('location', 'like', "%{$location}%");
        }

        // Get results (latest first)
        $jobs = $query->orderBy('created_at', 'desc')->paginate(4);
        $blogs = Blog::orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

     // 🔥 Hot Jobs (Urgent)
    $hotJobs = Job::where('is_active', 1)
        ->where('job_type', 'urgent')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // ⭐ Top Jobs (Full Time)
    $topJobs = Job::where('is_active', 1)
        ->whereIn('job_type', ['full', 'full-time'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();


        return view('home', compact('jobs','blogs','hotJobs', 'topJobs'));
    }
}
