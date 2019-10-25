<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissions\PermissionsCollection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new PermissionsCollection(Permission::all()), 200);
    }



    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->key = $request->key;
        $permission->type = $request->type;
        $permission->save();
        if ($permission->id) {
            return response()->json($permission, 201);
        }else{
            return response()->json('Something went wrong', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return response()->json($permission, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission = $permission->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(nll, 204);
    }


    public function permission_by_group() {
            $permissions =Permission::all();
            $parrent=[];
            foreach ($permissions as $perm) {
                if(!array_key_exists($perm['type'],$parrent)){ // checking if key not exist in array
                    $parrent[$perm['type']]=[];               
                }
                $parrent[$perm['type']][]=$perm;
            }
            if ($permissions) {
                return response()->json($parrent, 200);
            }else{
                return response()->json(null,204);
            }
    }

    public function permission_by_role(Role $role) {
        $permissions = $role->permissions->toArray();
        $permissions = array_column($permissions, 'id');
        return response()->json($permissions, 200);
    }

}
