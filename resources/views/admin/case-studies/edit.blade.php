{{-- admin/case-studies/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Case Study')
@section('content')
<div class="mb-6"><a href="{{ route('admin.case-studies.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.case-studies.update', $caseStudy->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.case-studies._form', compact('caseStudy', 'categories', 'industries'))
</form>
@endsection
