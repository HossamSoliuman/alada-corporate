{{-- admin/job-listings/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Job Listing')
@section('content')
<div class="mb-6"><a href="{{ route('admin.job-listings.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.job-listings.store') }}">
    @csrf
    @include('admin.job-listings._form')
</form>
@endsection
