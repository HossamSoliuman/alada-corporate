{{-- admin/industries/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Industry')
@section('content')
<div class="mb-6"><a href="{{ route('admin.industries.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.industries.store') }}" enctype="multipart/form-data">@csrf @include('admin.industries._form')</form>
@endsection
