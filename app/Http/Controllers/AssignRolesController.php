<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class  AssignRolesController extends Controller
{
  
    public function index(){
        $authenticUser=Auth::user();
        $roles = Role::all();
        $permissions=Permission::all();
        $users=User::with('roles')->get();
        // dd($users);
        return view("admin.assignPermissions",compact("roles","permissions","users","authenticUser"));

    }

    public function assignPermissions(Request $request){
        $user=Auth::user();
        collect($request->permissions)
            ->each(function ($permissionData, $roleId) {
                $role = Role::findById($roleId);
                collect($permissionData)->each(function ($action, $permissionId) use ($role) {
                    $permission = Permission::findById($permissionId);
    
                    if ($action === 'enabled') {
                        $role->givePermissionTo($permission);
                    } elseif ($action === 'disabled') {
                        $role->revokePermissionTo($permission);
                    }
                });
            });
        return redirect()->back()->with('success','Permissions have been assigned to role');
    }
    
    public function assignRoles(Request $request)
{
    // dd($request->all());
   
    $rolesData = collect($request->roles);

    $rolesData->map(function ($roleData, $userId) {
        // Find the user by ID
        $user = User::find($userId);
        
        // Check if the user exists
        if ($user) {
       
            collect($roleData)->map(function ($action, $roleId) use ($user) {
              
                $role = Role::findById($roleId);
                
                if ($role) {
                    if ($action === 'enabled') {
                        $user->assignRole($role);
                    } elseif ($action === 'disabled') {
                        $user->removeRole($role);
                    }
                }
            });
        }
    });
    return redirect()->back()->with('success','Role Assigned Successfully');
}
    
}
