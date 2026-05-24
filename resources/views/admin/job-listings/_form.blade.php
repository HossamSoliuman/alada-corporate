{{-- admin/job-listings/_form.blade.php --}}
@props(['jobListing' => null])
<div class="max-w-2xl space-y-5">
    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Position Name <span class="text-red-500">*</span></label>
            <input type="text" name="position_name" value="{{ old('position_name', $jobListing?->position_name) }}" required
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Location <span class="text-red-500">*</span></label>
            <input type="text" name="location" value="{{ old('location', $jobListing?->location) }}" required
                   placeholder="e.g. Dubai, UAE"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Employment Type <span class="text-red-500">*</span></label>
            <select name="employment_type" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                <option value="full-time" @selected(old('employment_type', $jobListing?->employment_type ?? 'full-time') === 'full-time')>Full-time</option>
                <option value="part-time" @selected(old('employment_type', $jobListing?->employment_type) === 'part-time')>Part-time</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Display Order</label>
            <input type="number" name="order" value="{{ old('order', $jobListing?->order ?? 0) }}" min="0"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div class="flex items-center gap-2 pt-1">
            <input type="checkbox" name="is_active" value="1" id="is_active"
                   @checked(old('is_active', $jobListing?->is_active ?? true))
                   class="text-teal-600 rounded">
            <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
        </div>
    </div>
    <div class="flex gap-3">
        <button type="submit" class="bg-teal-600 text-white py-2.5 px-6 rounded-lg font-semibold hover:bg-teal-700 text-sm">Save</button>
        <a href="{{ route('admin.job-listings.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Cancel</a>
    </div>
</div>
