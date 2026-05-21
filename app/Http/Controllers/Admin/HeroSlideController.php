<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->paginate(20);

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:video,image',
            'file' => 'required|file|max:102400',
            'title' => 'nullable|string|max:150',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $this->storeFile($request->file('file'));
        }

        $validated['is_active'] = $request->boolean('is_active');

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'type' => 'required|in:video,image',
            'file' => 'nullable|file|max:102400',
            'title' => 'nullable|string|max:150',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $this->storeFile($request->file('file'), $heroSlide->file_path);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteFile($heroSlide->file_path);
        $heroSlide->delete();

        return back()->with('success', 'Hero slide deleted.');
    }

    /**
     * Move an uploaded file directly into the public directory so it is
     * web-accessible over FTP without needing the storage:link symlink.
     */
    private function storeFile(UploadedFile $file, ?string $oldPath = null): string
    {
        $this->deleteFile($oldPath);

        $filename = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/hero-slides'), $filename);

        return 'uploads/hero-slides/'.$filename;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    public function toggleActive(HeroSlide $heroSlide)
    {
        $heroSlide->update(['is_active' => ! $heroSlide->is_active]);

        return back()->with('success', 'Hero slide status updated.');
    }
}
