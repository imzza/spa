<?php

namespace App\Http\Controllers;

use App\Models\Role as CustomRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RolesResource;
use App\Http\Requests\AddRoleRequest;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role as Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request) {
        // if ($request->user()->cannot('roles')) {return response()->json(null,403); }
        
       return response()->json(Role::with('permissions')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'rolename' => 'required',
            'roledescription' => 'required'
            ],
            [
               'name.required' => 'Please enter a role name',
              'name.unique' => 'This role already exists',
              'rolename.required' => 'Please enter a role display name',
              'roledescription.required' => 'Please enter a role description'
            ]
        );

        
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->rolename = $request->rolename;
        // $role->role_descrip = $request->roledescription;
        $role->save();
        if ($role->id) {
            return response()->json($role,201);
        }else{
            return response()->json('Something went wrong', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        // $dbrole =  Role::find($role)->first();
        $role = new RolesResource($role);
        if ($role) {
            return response()->json($role,200);
        }else{
            return response()->json(['message' => 'Record Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'rolename' => 'required',
            'role_descrip' => 'required'
            ],
            [
               'name.required' => 'Please enter a role name',
              'name.unique' => 'This role already exists',
              'rolename.required' => 'Please enter a role display name',
              'role_descrip.required' => 'Please enter a role description'
            ]
        );

        
        // $role = Role::findOrFail($role);

        $role->name = $request->name;
        $role->rolename = $request->rolename;
        $role->role_descrip = $request->role_descrip;
        $role->save();
        
        if ($role->id) {
            return response()->json(new RolesResource($role), 200);
        }else{
            return response()->json('Something went wrong', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role) {
            $delete = $role->delete($role);
            if ($delete) {
                return response()->json(null, 204);
            }else{
                return response()->json(['message' => 'Something went wrong'], 200);
            }
        }else{
            return response()->json(['message' => 'Record Not Found'], 404);
        }
    }

    public function roles_assign_permissions(Request $request) {
        $role = Role::find($request->id);
        $assign  = $role->syncPermissions($request->permissions);
        if ($assign) {
            return response()->json(['message' => "Permissions assigned."],200);
        } else {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
        
    }
}
