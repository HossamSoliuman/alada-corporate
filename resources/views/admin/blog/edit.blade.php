{{-- admin/blog/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit: '.$blog->title)
@section('content')
<div class="mb-6"><a href="{{ route('admin.blogs.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Posts</a></div>
<form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.blog._form', compact('blog', 'categories', 'tags'))
</form>
@endsection
