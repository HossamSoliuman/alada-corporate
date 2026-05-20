{{-- admin/case-studies/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Case Study')
@section('content')
<div class="mb-6"><a href="{{ route('admin.case-studies.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.case-studies.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.case-studies._form', compact('categories', 'industries'))
</form>
@endsection
