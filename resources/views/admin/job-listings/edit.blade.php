{{-- admin/job-listings/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit: '.$jobListing->position_name)
@section('content')
<div class="mb-6"><a href="{{ route('admin.job-listings.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.job-listings.update', $jobListing->id) }}">
    @csrf @method('PUT')
    @include('admin.job-listings._form', compact('jobListing'))
</form>
@endsection
