{{-- admin/services/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Service')
@section('content')
<div class="mb-6"><a href="{{ route('admin.services.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.services._form')
</form>
@endsection
