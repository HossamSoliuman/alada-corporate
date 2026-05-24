<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::orderBy('order')->paginate(20);

        return view('admin.job-listings.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.job-listings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:full-time,part-time',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        JobListing::create($validated);

        return redirect()->route('admin.job-listings.index')->with('success', 'Job listing created.');
    }

    public function edit(JobListing $jobListing)
    {
        return view('admin.job-listings.edit', compact('jobListing'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:full-time,part-time',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $jobListing->update($validated);

        return redirect()->route('admin.job-listings.index')->with('success', 'Job listing updated.');
    }

    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();

        return back()->with('success', 'Job listing deleted.');
    }
}
