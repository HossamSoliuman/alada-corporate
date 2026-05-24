<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        foreach ($request->file('images') as $file) {
            $path = $file->store('career-gallery', 'public');
            CareerImage::create(['path' => $path, 'order' => ++$order]);
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
        Storage::disk('public')->delete($careerImage->path);
        $careerImage->delete();

        return back()->with('success', 'Image deleted.');
    }
}
