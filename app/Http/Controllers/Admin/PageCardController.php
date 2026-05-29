<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageCard;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PageCardController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function store(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = [
            'page_id' => $page->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => (int) PageCard::where('page_id', $page->id)->max('order') + 1,
        ];

        if ($request->hasFile('image')) {
            $paths = $this->imageService->upload($request->file('image'), 'public', 'page-cards');
            $data['image'] = $paths['medium'];
        }

        PageCard::create($data);

        return back()->with('success', 'Card added.');
    }

    public function update(Request $request, PageCard $pageCard)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'],
        ];

        if ($request->hasFile('image')) {
            if ($pageCard->image) {
                $this->imageService->delete($pageCard->image);
            }
            $paths = $this->imageService->upload($request->file('image'), 'public', 'page-cards');
            $data['image'] = $paths['medium'];
        }

        $pageCard->update($data);

        return back()->with('success', 'Card updated.');
    }

    public function destroy(PageCard $pageCard)
    {
        if ($pageCard->image) {
            $this->imageService->delete($pageCard->image);
        }
        $pageCard->delete();

        return back()->with('success', 'Card deleted.');
    }
}
