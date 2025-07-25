<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();

        return view('permissions.edit', compact('user', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->syncPermissions($request->input('permissions', []));

        return redirect()->back()->with('success', 'Permissions updated.');
    }
    public function accessList()
    {   
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));  
    }
    public function addPermission(Request $request)
    {   
        $new_permission = new Permission;
        $new_permission->name = $request->name;
        $new_permission->guard_name = "web";
        $new_permission->save();
        Alert::success('Success Title', 'Permission Saved');
        return back();
    }
}