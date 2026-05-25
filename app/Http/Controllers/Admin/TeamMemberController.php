<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::ordered()->get();

        return view('admin.team-members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'photo' => 'nullable|image|max:4096',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'order' => TeamMember::max('order') + 1,
        ];

        if ($request->hasFile('photo')) {
            $dir = public_path('team-members');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('photo');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['photo'] = 'team-members/'.$filename;
        }

        TeamMember::create($data);

        return back()->with('success', 'Team member added.');
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'order' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:4096',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'order' => $request->order,
        ];

        if ($request->hasFile('photo')) {
            if ($teamMember->photo && file_exists(public_path($teamMember->photo))) {
                @unlink(public_path($teamMember->photo));
            }
            $dir = public_path('team-members');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('photo');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['photo'] = 'team-members/'.$filename;
        }

        $teamMember->update($data);

        return back()->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo && file_exists(public_path($teamMember->photo))) {
            @unlink(public_path($teamMember->photo));
        }
        $teamMember->delete();

        return back()->with('success', 'Team member deleted.');
    }
}
