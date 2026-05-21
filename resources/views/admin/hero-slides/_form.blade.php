{{-- admin/hero-slides/_form.blade.php --}}
@props(['slide' => null])
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Type <span class="text-red-500">*</span></label>
                <select name="type" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    <option value="">Select type...</option>
                    <option value="video" @selected(old('type', $slide?->type) === 'video')>Video</option>
                    <option value="image" @selected(old('type', $slide?->type) === 'image')>Image</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    File <span class="text-red-500">*</span>
                    <span class="text-xs text-gray-500">(Video: MP4, WebM | Image: JPG, PNG, WebP)</span>
                </label>
                <input type="file" name="file" accept="video/*,image/*" class="text-sm text-gray-600 w-full">
                @if($slide?->file_path)
                <div class="mt-2 text-xs text-gray-600">
                    @if($slide->type === 'video')
                    <p>Current: <code class="bg-gray-100 px-2 py-1 rounded">{{ basename($slide->file_path) }}</code></p>
                    @else
                    <img src="{{ $slide->url }}" class="w-full h-32 object-cover rounded-lg">
                    @endif
                </div>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title (optional)</label>
                <input type="text" name="title" value="{{ old('title', $slide?->title) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., Main hero, Summer 2026">
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Display Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $slide?->sort_order ?? 0) }}" min="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="flex items-center gap-2 cursor-pointer pt-2">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $slide?->is_active ?? true)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save</button>
            <a href="{{ route('admin.hero-slides.index') }}" class="flex-1 text-center bg-gray-200 text-gray-700 py-2.5 px-5 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-sm">Cancel</a>
        </div>
    </div>
</div>
