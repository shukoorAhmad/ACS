<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Auth\UserSystem;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list')->only('index');
        $this->middleware('permission:role-create')->only('store');
        $this->middleware('permission:role-edit')->only('update');
    }

    protected function index(Request $request)
    {
        $data['roles'] = Role::get();
        $data['systems'] = System::get(['id', 'name_' . get_locale() . ' as name']);
        if ($request->ajax()) {
            $sql = Role::join('systems', 'systems.id', 'roles.system_id')
                ->select('roles.*', 'systems.id as system_id', 'systems.name_' . get_locale() . ' as system_name')->get();
            return Datatables::of($sql)
                ->addIndexColumn()
                ->addColumn('role_permissions', function ($sql) {
                    $bt = "";
                    $permissions = DB::table('role_has_permissions')->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
                        ->where('role_has_permissions.role_id', $sql->id)
                        ->select('permissions.id', 'permissions.name as permission')
                        ->get();
                    foreach ($permissions as $permission) {
                        $bt .= '<span class="badge badge-primary mr-1 mb-1">' . $permission->permission . '</span>';
                    }
                    return $bt;
                })
                ->addColumn('action', function ($sql) {
                    if (can('role-edit'))
                        $btn = "<a class='edit_btn ml-1' style='cursor: pointer;' action='" . route('permission-details', 'edit') . "' record_id='" . $sql->id . "' role_name='" . $sql->name . "' system_id='" . $sql->system_id . "'><i class='btn btn-outline-info btn-circle flaticon-edit-1'></i></a>";
                    return $btn;
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.roles.index', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
            'system_id' => 'required',
            'permissions' => 'required|array|min:1',
        ], [
            'name.required' => trans('words.Required_', ['name' => trans('words.Name')]),
            'name.unique' => trans('words.Unique'),
            'system_id.required' => trans('words.Required_', ['name' => trans('words.System')]),
            'permissions.required' => trans('words.At Least Select One Permission'),
        ]);

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        $role = Role::create(['name' => $request->name, 'system_id' => $request->system_id]);
        $role->syncPermissions($request->permissions);
        return true;
    }

    protected function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($request->id);
            $role->revokePermissionTo($role->permissions);
            $role->syncPermissions($request->permissions);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('warning', trans('words.Please Try Again'));
        }
        return true;
    }

    protected function details(Request $request, $type)
    {
        if ($type == 'details') {
            $data['roles'] = Role::whereIn('system_id', $request->system_id)->get();
            $data['type'] = 'role_details';
        }
        if ($type == 'edit') {
            $data['user_id'] = $request->id;
            $data['roles'] = Role::whereIn('system_id', $request->system_id)->get();
            $data['type'] = 'edit_role_details';
        }
        return view('auth.roles.data', $data);
    }

    #System Routes
    protected function system_details(Request $request)
    {
        function check_user_system($user_id, $system_id)
        {
            $user_system = UserSystem::where('user_id', $user_id)->where('system_id', $system_id)->first();
            if (isset($user_system)) {
                return 'selected';
            }
        }
        $systems = System::get(['id', 'name_' . get_locale() . ' as name']);
        $data = '';
        foreach ($systems as $item) {
            $data .= '<option value="' . $item->id . '" style="direction: ltr !important;" ' . check_user_system($request->id, $item->id) . '>' . $item->name . '</option>';
        }
        return $data;
    }

    #End System Routes
    protected function permission_details(Request $request, $type)
    {
        if ($type == 'store') {
            $data['permission'] = \Illuminate\Support\Facades\DB::table('permissions')
                ->where('system_id', $request->system)->get();
            $data['type'] = $type;
        }
        if (
            $type == 'edit'
        ) {
            $data['permission'] = \Illuminate\Support\Facades\DB::table('permissions')
                ->where('system_id', $request->system)->get();
            $data['type'] = $type;
            $data['role'] = Role::find($request->id);
        }
        return view('auth.roles.data', $data);
    }
}
