{{-- admin/industries/_form.blade.php --}}
@props(['industry' => null])
<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5 max-w-2xl">
    <div class="grid grid-cols-2 gap-5">
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $industry?->name) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Icon</label>
            <input type="text" name="icon" value="{{ old('icon', $industry?->icon) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500" placeholder="🏭">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Order</label>
            <input type="number" name="order" value="{{ old('order', $industry?->order ?? 0) }}" min="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('description', $industry?->description) }}</textarea>
        </div>
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
            <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600">
            @if($industry?->featured_image)
            <img src="{{ asset($industry->featured_image) }}" class="mt-2 h-24 rounded-lg object-cover">
            @endif
        </div>
        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $industry?->is_active ?? true)) class="text-teal-600 rounded">
                <span class="text-sm font-medium text-gray-700">Active</span>
            </label>
        </div>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-teal-600 text-white py-2.5 px-6 rounded-lg font-semibold hover:bg-teal-700 text-sm">Save</button>
        <a href="{{ route('admin.industries.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Cancel</a>
    </div>
</div>
