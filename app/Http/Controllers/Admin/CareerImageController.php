<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerImageController extends Controller
{
    public function index()
    {
        $images = CareerImage::ordered()->get();

        return view('admin.career-images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|max:4096',
        ]);

        $order = CareerImage::max('order') ?? 0;
        $dir = public_path('career-gallery');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($request->file('images') as $file) {
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
            CareerImage::create(['path' => 'career-gallery/'.$filename, 'order' => ++$order]);
        }

        return back()->with('success', count($request->file('images')).' image(s) uploaded.');
    }

    public function update(Request $request, CareerImage $careerImage)
    {
        $request->validate(['order' => 'required|integer|min:0']);
        $careerImage->update(['order' => $request->order]);

        return back()->with('success', 'Order updated.');
    }

    public function destroy(CareerImage $careerImage)
    {
        $full = public_path($careerImage->path);
        if (file_exists($full)) {
            @unlink($full);
        }
        $careerImage->delete();

        return back()->with('success', 'Image deleted.');
    }
}
