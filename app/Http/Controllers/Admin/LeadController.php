<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with('service')->latest();

        if ($request->filled('type')) {
            $query->where('form_type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('search')) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$request->search}%")
                                      ->orWhere('email', 'like', "%{$request->search}%"));
        }

        $leads = $query->paginate(20)->withQueryString();
        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        $lead->markAsRead();
        $lead->load('service');
        return view('admin.leads.show', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,qualified,converted,archived',
            'notes'  => 'nullable|string|max:2000',
        ]);
        $lead->update($request->only('status', 'notes'));
        return back()->with('success', 'Lead updated.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted.');
    }

    public function export(Request $request)
    {
        $query = Lead::with('service');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $leads = $query->latest()->get();

        $filename = 'leads_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename={$filename}"];

        $callback = function () use ($leads) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Type', 'Name', 'Email', 'Phone', 'Company', 'Service', 'Subject', 'Message', 'Status', 'Date']);
            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id, $lead->form_type, $lead->name, $lead->email,
                    $lead->phone, $lead->company, $lead->service?->name ?? '',
                    $lead->subject, $lead->message, $lead->status,
                    $lead->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

// ──────────────────────────────────────────────────────────────
// SettingController (Admin)
// ──────────────────────────────────────────────────────────────
