{{-- admin/users/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Users</h2>
    <a href="{{ route('admin.users.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New User</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b"><tr>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Role</th>
            <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 {{ $user->is_admin ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }} rounded-full">{{ $user->is_admin ? 'Admin' : 'Editor' }}</span></td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-xs text-teal-600 font-medium">Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete user?')">
                            @csrf @method('DELETE') <button type="submit" class="text-xs text-red-500 font-medium">Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">No users.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $users->links() }}</div>
@endsection
