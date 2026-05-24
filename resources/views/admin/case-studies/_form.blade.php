{{-- admin/case-studies/_form.blade.php --}}
@props(['caseStudy' => null, 'categories', 'industries'])
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $caseStudy?->title) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Challenge <span class="text-red-500">*</span></label>
                <textarea name="challenge" rows="5" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">{{ old('challenge', $caseStudy?->challenge) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Solution <span class="text-red-500">*</span></label>
                <textarea name="solution" rows="8" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">{{ old('solution', $caseStudy?->solution) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Result <span class="text-red-500">*</span></label>
                <textarea name="result" rows="5" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">{{ old('result', $caseStudy?->result) }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">CTA Title</label><input type="text" name="cta_title" value="{{ old('cta_title', $caseStudy?->cta_title) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">CTA Link</label><input type="url" name="cta_link" value="{{ old('cta_link', $caseStudy?->cta_link) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">CTA Text</label><input type="text" name="cta_text" value="{{ old('cta_text', $caseStudy?->cta_text) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
            </div>
        </div>
        @include('admin.partials.seo-fields', ['model' => $caseStudy])
    </div>
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <select name="case_study_category_id" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    <option value="">— Select —</option>
                    @foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old('case_study_category_id', $caseStudy?->case_study_category_id) == $cat->id)>{{ $cat->name }}</option>@endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Industry</label>
                <select name="industry_id" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    <option value="">— Select —</option>
                    @foreach($industries as $ind)<option value="{{ $ind->id }}" @selected(old('industry_id', $caseStudy?->industry_id) == $ind->id)>{{ $ind->name }}</option>@endforeach
                </select>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Client Name</label><input type="text" name="client_name" value="{{ old('client_name', $caseStudy?->client_name) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image{{ $caseStudy ? '' : ' *' }}</label>
                <input type="file" name="featured_image" accept="image/*" {{ $caseStudy ? '' : 'required' }} class="text-sm text-gray-600 w-full">
                @if($caseStudy?->featured_image)<img src="{{ asset($caseStudy->featured_image) }}" class="mt-2 w-full h-32 object-cover rounded-lg">@endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gallery (multiple)</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="text-sm text-gray-600 w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">PDF Download</label>
                <input type="file" name="pdf_file" accept=".pdf" class="text-sm text-gray-600 w-full">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Order</label><input type="number" name="order" value="{{ old('order', $caseStudy?->order ?? 0) }}" min="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
            <div class="flex gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $caseStudy?->is_published)) class="text-teal-600 rounded"><span class="text-sm font-medium text-gray-700">Published</span></label>
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $caseStudy?->is_featured)) class="text-teal-600 rounded"><span class="text-sm font-medium text-gray-700">Featured</span></label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 text-sm">Save</button>
            <a href="{{ route('admin.case-studies.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Cancel</a>
        </div>
    </div>
</div>
