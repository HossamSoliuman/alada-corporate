{{-- admin/pages/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Page: '.$page->title)
@section('content')
<div class="mb-6"><a href="{{ route('admin.pages.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Pages</a></div>

<form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                @endif
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                    <p class="text-xs text-gray-500 mb-1.5">Plain text. Each blank line starts a new paragraph.</p>
                    <textarea name="content" id="page-content" rows="20"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('content', $page->content) }}</textarea>
                </div>
                @endif
            </div>

            @if($page->slug === 'careers')
            @php $sec = $page->sections ?? []; @endphp

            {{-- Hero --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Hero Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[hero_heading]"
                           value="{{ old('sections.hero_heading', $sec['hero_heading'] ?? '') }}"
                           placeholder="People. Development. Future."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                    <textarea name="sections[hero_tagline]" rows="2"
                              placeholder="Work with talented people, collaborate on impactful projects..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.hero_tagline', $sec['hero_tagline'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Intro --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Intro Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Label (above heading)</label>
                    <input type="text" name="sections[intro_label]"
                           value="{{ old('sections.intro_label', $sec['intro_label'] ?? '') }}"
                           placeholder="Join our team"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[intro_heading]"
                           value="{{ old('sections.intro_heading', $sec['intro_heading'] ?? '') }}"
                           placeholder="Powered by People. Driven by Growth."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1</label>
                    <textarea name="sections[intro_body_1]" rows="4"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_1', $sec['intro_body_1'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2</label>
                    <textarea name="sections[intro_body_2]" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_2', $sec['intro_body_2'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 3</label>
                    <textarea name="sections[intro_body_3]" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_3', $sec['intro_body_3'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Job openings --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Job Openings Section</h3>
                <p class="text-xs text-gray-500">Job listings are managed via <a href="{{ route('admin.job-listings.index') }}" class="text-teal-600 hover:underline">Job Listings</a> in the sidebar.</p>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[jobs_heading]"
                           value="{{ old('sections.jobs_heading', $sec['jobs_heading'] ?? '') }}"
                           placeholder="Freshers. Professionals. Specialists."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subheading</label>
                    <textarea name="sections[jobs_subheading]" rows="2"
                              placeholder="Alada is expanding — join us in shaping the future..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.jobs_subheading', $sec['jobs_subheading'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Why Alada --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Why Alada Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[why_heading]"
                           value="{{ old('sections.why_heading', $sec['why_heading'] ?? '') }}"
                           placeholder="Why work with us?"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subheading</label>
                    <textarea name="sections[why_subheading]" rows="2"
                              placeholder="Be part of an environment where your skills are nurtured..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.why_subheading', $sec['why_subheading'] ?? '') }}</textarea>
                </div>
            </div>

            @endif

            @include('admin.partials.seo-fields', ['model' => $page])
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->is_published)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600 w-full">
                    @if($page->featured_image)
                    <img src="{{ asset($page->featured_image) }}" class="mt-2 w-full h-32 object-cover rounded-lg">
                    @endif
                </div>
                @endif
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save Page</button>
                <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection
