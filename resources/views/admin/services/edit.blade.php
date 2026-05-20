{{-- admin/services/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit: '.$service->name)
@section('content')
<div class="mb-6"><a href="{{ route('admin.services.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.services._form', compact('service'))
</form>
@endsection
