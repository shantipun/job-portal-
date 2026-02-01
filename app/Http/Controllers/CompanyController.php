<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use App\Models\Job;

class CompanyController extends Controller
{
    public function index()
    {
        // Return your company review Blade
        return view('company-review'); // resources/views/company-review.blade.php
    }
    

public function search(Request $request)
{
    $searchTerm = $request->input('search');

    // Fetch all categories
    $categories = Category::orderBy('name', 'asc')->get();

    // Fetch companies with jobs count
    $popularCompanies = Company::withCount('jobs')
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        })
        ->orderBy('jobs_count', 'desc')
        ->paginate(6);

    return view('company-search', compact('categories', 'popularCompanies'));
}
public function jobs($id)
{
    $company = Company::with('jobs')->findOrFail($id);
    return view('company-jobs', compact('company'));
}
}
