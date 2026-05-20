<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user->update(array_filter([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : null,
            'is_admin' => $request->boolean('is_admin'),
        ]));

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Cannot delete your own account.');
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
