{{-- admin/expertise/_form.blade.php --}}
@props(['service' => null])
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $service?->name) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description <span class="text-red-500">*</span></label>
                <textarea name="short_description" rows="2" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('short_description', $service?->short_description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="12" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">{{ old('description', $service?->description) }}</textarea>
            </div>
        </div>
        @include('admin.partials.seo-fields', ['model' => $service])
    </div>
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Icon (emoji or class)</label>
                <input type="text" name="icon" value="{{ old('icon', $service?->icon) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500" placeholder="⚙️ or fa-cog">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
                <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600 w-full">
                @if($service?->featured_image)
                <img src="{{ asset('storage/'.$service->featured_image) }}" class="mt-2 w-full h-32 object-cover rounded-lg">
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Display Order</label>
                <input type="number" name="order" value="{{ old('order', $service?->order ?? 0) }}" min="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="flex gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service?->is_active ?? true)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service?->is_featured)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save</button>
            <a href="{{ route('admin.expertise.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Cancel</a>
        </div>
    </div>
</div>
