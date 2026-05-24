{{-- admin/expertise/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Expertise')
@section('content')
<div class="mb-6"><a href="{{ route('admin.expertise.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.expertise.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.expertise._form')
</form>
@endsection
