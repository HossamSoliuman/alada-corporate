@extends('layouts.admin')
@section('title', 'Team Members')
@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Team Members</h2>
    <span class="text-sm text-gray-500">{{ $members->count() }} member(s)</span>
</div>

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
@endif

{{-- Add Member --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Add Team Member</h3>
    <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Role / Title <span class="text-red-500">*</span></label>
                <input type="text" name="role" value="{{ old('role') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Photo</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2">
                @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-end">
                <button type="submit"
                        class="w-full bg-teal-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">
                    Add Member
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Members Grid --}}
@if($members->count())
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @foreach($members as $member)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        {{-- Photo --}}
        <div class="aspect-[4/3] bg-gray-100 overflow-hidden flex items-center justify-center">
            @if($member->photo)
            <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}"
                 class="w-full h-full object-cover">
            @else
            <div class="flex flex-col items-center gap-2 text-gray-300">
                <x-icon name="user-circle" class="w-16 h-16"/>
                <span class="text-xs">No photo</span>
            </div>
            @endif
        </div>

        {{-- Info + Edit --}}
        <div class="p-4">
            <p class="text-xs font-semibold text-teal-600 uppercase tracking-widest mb-0.5">{{ $member->role }}</p>
            <p class="font-semibold text-gray-900 mb-3">{{ $member->name }}</p>

            <form method="POST" action="{{ route('admin.team-members.update', $member->id) }}"
                  enctype="multipart/form-data" class="space-y-2">
                @csrf @method('PUT')
                <input type="text" name="name" value="{{ $member->name }}" required placeholder="Name"
                       class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                <input type="text" name="role" value="{{ $member->role }}" required placeholder="Role"
                       class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                <div class="flex gap-1.5">
                    <input type="number" name="order" value="{{ $member->order }}" min="0" placeholder="Order"
                           class="w-20 px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                    <input type="file" name="photo" accept="image/*"
                           class="flex-1 text-xs text-gray-600 border border-gray-300 rounded-md px-2 py-1.5">
                </div>
                <button type="submit"
                        class="w-full text-xs bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-700 font-medium py-1.5 rounded-md transition-colors">
                    Save Changes
                </button>
            </form>

            <form method="POST" action="{{ route('admin.team-members.destroy', $member->id) }}"
                  onsubmit="return confirm('Delete {{ $member->name }}?')" class="mt-2">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full text-xs text-red-500 hover:text-red-700 font-medium py-1 hover:bg-red-50 rounded-md transition-colors">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-20 bg-white rounded-xl border border-gray-200">
    <p class="text-gray-400 text-sm">No team members yet. Add one above.</p>
</div>
@endif

@endsection
