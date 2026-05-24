{{-- admin/blog/_form.blade.php --}}
@props(['blog' => null, 'categories', 'tags'])

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    {{-- Main --}}
    <div class="xl:col-span-2 space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $blog?->title) }}" required
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label>
                <textarea name="excerpt" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none resize-none">{{ old('excerpt', $blog?->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content <span class="text-red-500">*</span></label>
                <textarea name="content" id="blog-content" rows="16"
                          class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">{{ old('content', $blog?->content) }}</textarea>
            </div>
        </div>

        @include('admin.partials.seo-fields', ['model' => $blog])
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <select name="blog_category_id" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">
                    <option value="">— Select Category —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('blog_category_id', $blog?->blog_category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Tags</label>
                <div class="flex flex-wrap gap-2 max-h-40 overflow-y-auto">
                    @foreach($tags as $tag)
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               @checked(in_array($tag->id, old('tags', $blog?->tags->pluck('id')->toArray() ?? [])))
                               class="text-teal-600 rounded">
                        <span class="text-sm text-gray-700">{{ $tag->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
                <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600 w-full">
                @if($blog?->featured_image)
                <img src="{{ asset($blog->featured_image) }}" alt="" class="mt-2 w-full h-32 object-cover rounded-lg">
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Publish Date</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', $blog?->published_at?->format('Y-m-d\TH:i')) }}"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">
            </div>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1"
                           @checked(old('is_published', $blog?->is_published)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1"
                           @checked(old('is_featured', $blog?->is_featured)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save Post</button>
            <a href="{{ route('admin.blogs.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </div>
</div>
