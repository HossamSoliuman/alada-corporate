{{-- admin/industries/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit: '.$industry->name)
@section('content')
<div class="mb-6"><a href="{{ route('admin.industries.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.industries.update', $industry->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.industries._form', compact('industry'))
</form>
@endsection
