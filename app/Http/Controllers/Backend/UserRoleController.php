<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $path;
    public function __construct()
    {
        $this->path='backend.pages.user_roles';
    }

    public function index()
    {
        $data['roles'] = Role::withCount(['users', 'permissions'])->get();
        return view($this->path.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=array();
        $data['permissions']=Permission::get();
        return view($this->path.'.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', Toastr::error($validator->errors(), 'Validation Error'));
        }
        $role = Role::create(['name' => strtolower(trim($request->name))]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success',Toastr::success("Role Save Successfully", 'Role'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=array();
        $data['role'] = Role::findOrFail($id);
        $data['permissions'] = Permission::get();
        $data['permitted']= Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();
        return view($this->path.'.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($id),
            ],
            'permissions' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', Toastr::error($validator->errors(), 'Validation Error'));
        }

        $role = Role::find($id);
        $role->name = strtolower(trim($request->name));
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success',Toastr::success("Role Updated Successfully", 'Role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success',Toastr::success("Role Deleted Successfully", 'Role'));
    }
}
