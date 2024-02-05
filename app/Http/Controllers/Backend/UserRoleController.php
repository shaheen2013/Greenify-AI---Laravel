<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
