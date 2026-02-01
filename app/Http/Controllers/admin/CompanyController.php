<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('category')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.companies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
                'website' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);

        $logo_path = null;
        if ($request->hasFile('logo')) {
            $logo_path = $request->file('logo')->store('companies', 'public');
        }

        Company::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
             'website' => $request->website,
            'logo' => $logo_path,
            'location' => $request->location,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('companies.index')->with('success', 'Company added successfully!');
    }

    // --------------------
    // Edit
    // --------------------
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $categories = Category::all();
        return view('admin.companies.edit', compact('company', 'categories'));
    }

    // --------------------
    // Update
    // --------------------
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);

        // Logo replacement
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $logo_path = $request->file('logo')->store('companies', 'public');
            $company->logo = $logo_path;
        }

        // Update other fields
        $company->name = $request->name;
        $company->slug = Str::slug($request->name);
        $company->category_id = $request->category_id;
        $company->location = $request->location;
          $company->website = $request->website;
        $company->status = $request->status ?? 'active';
        $company->save();

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    // --------------------
    // Destroy
    // --------------------
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Delete logo from storage
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}
