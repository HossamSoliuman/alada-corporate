{{-- admin/users/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New User')
@section('content')
<div class="mb-6"><a href="{{ route('admin.users.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4 max-w-lg">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label><input type="password" name="password" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label><input type="password" name="password_confirmation" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_admin" value="1" class="text-teal-600 rounded"><span class="text-sm font-medium text-gray-700">Admin Access</span></label>
        <div class="flex gap-3 pt-2"><button type="submit" class="bg-teal-600 text-white py-2.5 px-6 rounded-lg text-sm font-semibold hover:bg-teal-700">Create User</button><a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">Cancel</a></div>
    </div>
</form>
@endsection
