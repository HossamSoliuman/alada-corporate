{{-- admin/partials/seo-fields.blade.php --}}
@props(['model' => null])
@php $seo = $model?->seo; @endphp

<div class="bg-white rounded-xl border border-gray-200 p-6">
    <h3 class="font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">🔍 SEO Settings</h3>
    <div class="grid grid-cols-1 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $seo?->meta_title) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none"
                   placeholder="Page title for search engines (50-60 chars)">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description</label>
            <textarea name="meta_description" rows="3"
                      class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none resize-none"
                      placeholder="Description for search results (150-160 chars)">{{ old('meta_description', $seo?->meta_description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Keywords</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $seo?->meta_keywords) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none"
                   placeholder="keyword1, keyword2, keyword3">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">OG Image URL</label>
            <input type="text" name="og_image" value="{{ old('og_image', $seo?->og_image) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none"
                   placeholder="Social share image path or URL">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Robots</label>
            <select name="robots" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">
                <option value="index,follow" @selected(old('robots', $seo?->robots ?? 'index,follow') === 'index,follow')>index, follow</option>
                <option value="noindex,follow" @selected(old('robots', $seo?->robots) === 'noindex,follow')>noindex, follow</option>
                <option value="index,nofollow" @selected(old('robots', $seo?->robots) === 'index,nofollow')>index, nofollow</option>
                <option value="noindex,nofollow" @selected(old('robots', $seo?->robots) === 'noindex,nofollow')>noindex, nofollow</option>
            </select>
        </div>
    </div>
</div>
