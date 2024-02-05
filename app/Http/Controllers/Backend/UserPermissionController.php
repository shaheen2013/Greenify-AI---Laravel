<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Validator;
use Exception;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserPermissionController extends Controller
{
    private string $path;

    public function __construct()
    {
        $this->path = 'backend.pages.permissions';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })->rawColumns(['name'])
                ->addColumn('action', function ($row) {
                    return view('backend.pages.permissions.btn', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data = array();
        $data['permissions'] = Permission::get();
        return view($this->path . '.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 403], 200);
        }
        try {
            $role = Permission::create(['name' => strtolower(trim($request->name))]);
            return response()->json(['message' => 'Permissions Created', 'status' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'status' => 500], 500);
        }
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
    public function update(Request $request, Permission $permission)
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
