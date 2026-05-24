{{-- admin/expertise/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit: '.$service->name)
@section('content')
<div class="mb-6"><a href="{{ route('admin.expertise.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.expertise.update', ['expertise' => $service->id]) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.expertise._form', compact('service'))
</form>
@endsection
