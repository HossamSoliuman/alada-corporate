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
        $heroVideo = HeroSlide::first();

        return view('admin.hero-slides.index', compact('heroVideo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:mp4,webm|max:204800',
        ]);

        $existing = HeroSlide::first();
        if ($existing) {
            $this->deleteFile($existing->file_path);
            $existing->delete();
        }

        HeroSlide::create([
            'type'       => 'video',
            'file_path'  => $this->storeFile($request->file('file')),
            'is_active'  => true,
            'sort_order' => 0,
        ]);

        return back()->with('success', 'Hero video updated.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteFile($heroSlide->file_path);
        $heroSlide->delete();

        return back()->with('success', 'Hero video removed.');
    }

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
}
