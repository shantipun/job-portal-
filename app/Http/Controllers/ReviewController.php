<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Job;

class ReviewController extends Controller
{
    // Default page showing all popular companies
    public function index()
    {
        // Fetch all categories (industries)
        $categories = Category::orderBy('name')->get();

        // Popular companies (paginate instead of take)
        $popularCompanies = Job::select('company_name', DB::raw('count(*) as jobs_count'))
            ->groupBy('company_name')
            ->orderByDesc('jobs_count')
            ->paginate(3); // Show 9 companies per page
            $companies = Job::where('category_id', $request->category)
    ->select('company_name', 'company_id')
    ->distinct()
    ->get();

        return view('company-search', compact('categories', 'popularCompanies'));
    }

    // Search page (company name or job title)
    public function search(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Job::query();

        // Filter by search input
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('company_name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Get filtered companies with pagination
        $popularCompanies = $query->select('company_name', DB::raw('count(*) as jobs_count'))
                                  ->groupBy('company_name')
                                  ->orderByDesc('jobs_count')
                                  ->paginate(9) // 9 per page
                                  ->withQueryString(); // Keep filters in pagination links

        return view('company-search', compact('categories', 'popularCompanies'));
    }
}
