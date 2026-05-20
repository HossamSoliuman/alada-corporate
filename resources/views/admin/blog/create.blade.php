{{-- admin/blog/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Blog Post')
@section('content')
<div class="mb-6"><a href="{{ route('admin.blogs.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Posts</a></div>
<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.blog._form', compact('categories', 'tags'))
</form>
@endsection
