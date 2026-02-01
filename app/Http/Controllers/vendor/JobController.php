<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;

use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Show form to post a new job
  public function postJob()
{
    // Fetch categories
   $companies = Company::orderBy('name')->get();
    $categories = Category::orderBy('name')->get();



    return view('vendor.post-job', compact('companies','categories'));
}

    // Handle storing a new job
    public function storeJob(Request $request)
    {
          $vendor = Auth::guard('vendor')->user();
          
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
      

            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'company_website' => 'nullable|url|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:50',
            'job_type' => 'required|string|max:50',
            'last_date' => 'required|date',
            'is_active' => 'required|boolean', // <- ensures true/false
        ]);

$company = Company::findOrFail($request->company_id);

Job::create([
    'title' => $request->title,
    'description' => $request->description,
    'responsibilities' => $request->responsibilities,
    'requirements' => $request->requirements,
    'employer_id' => Auth::id(),
    'company_id' => $company->id,
    'category_id' => $request->category_id,

     'company_name' => $company->name,  
       'company_website' => $company->website,
    'location' => $request->location,
    'salary' => $request->salary,
    'job_type' => $request->job_type,
    'last_date' => $request->last_date,
    'is_active' => $request->is_active,
]);


        return redirect()->route('vendor.jobs.view')->with('success', 'Job posted successfully!');
    }

    // View all jobs of this vendor
    public function viewJobs()
    {
        $jobs = Job::where('employer_id',Auth::id())->latest()->get();
              

        return view('vendor.view-job', compact('jobs'));
    }

    // Show edit form for a job
public function editJob($id)
{
    $job = Job::where('id', $id)
              ->where('employer_id', Auth::id()) // only jobs posted by logged-in vendor
              ->firstOrFail();

    // Fetch companies and categories for dropdowns
    $companies = Company::orderBy('name')->get();
    $categories = Category::orderBy('name')->get();

    return view('vendor.edit-job', compact('job', 'companies', 'categories'));
}

public function updateJob(Request $request, $id)
{
    $job = Job::where('id', $id)
              ->where('employer_id', Auth::id())
              ->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'responsibilities' => 'nullable|string',
        'requirements' => 'nullable|string',
     'company_id' => 'required|exists:companies,id',
        'category_id' => 'required|exists:categories,id',
        
        'location' => 'required|string|max:255',
        'salary' => 'nullable|string|max:50',
        'job_type' => 'required|string|max:50',
        'last_date' => 'required|date',
        'is_active' => 'required|boolean',
    ]);

    $job->update($request->all());

    return redirect()->route('vendor.jobs.view')->with('success', 'Job updated successfully!');
}


    // Delete a job
    public function destroyJob($id)
    {
        $job = Job::where('id', $id)
                  ->where('employer_id', Auth::guard('vendor')->id())
                  ->firstOrFail();

        $job->delete();

        return redirect()->route('vendor.jobs.view')->with('success', 'Job deleted successfully!');
    }
    public function index()
{
    $jobs = Job::where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->get();

    return view('job-detail', compact('jobs')); // create jobs/index.blade.php
}

public function show($id)
{
    $job = Job::findOrFail($id);

    // Related jobs by same company
    $relatedJobs = Job::where('company_name', $job->company_name)
                        ->where('is_active', 1)
                        ->get();

    return view('job-detail', compact('job', 'relatedJobs'));
}
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
     public function applications()
    {
        // Get the authenticated vendor
        $vendorId = Auth::guard('vendor')->id();

        // Only fetch jobs posted by this vendor
        $jobs = Job::where('employer_id', $vendorId)
                   ->with(['applications.user']) // eager load applications and user who applied
                   ->latest()
                   ->get();

        return view('vendor.applications', compact('jobs'));
    }
    

}
