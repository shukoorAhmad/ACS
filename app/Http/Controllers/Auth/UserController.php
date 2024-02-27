<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Auth\System;
use App\Models\Auth\UserSystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list')->only('index');
        $this->middleware('permission:user-create')->only('store');
        $this->middleware('permission:user-edit')->only('update');
        $this->middleware('permission:user-destroy')->only('destroy');
    }

    protected function index(Request $request)
    {
        $raw['systems'] = System::get(['id', 'name_' . get_locale() . ' as name']);
        function get_systems($id)
        {
            $data = UserSystem::join('systems', 'systems.id', 'user_systems.system_id')
                ->where('user_systems.user_id', $id)->get();
            $values = '';
            $name = 'name_' . get_locale();
            foreach ($data as $item) {
                $values .= '<span class="badge bg-primary ml-1 mr-1 mt-1 text-white"> ' . $item->$name . '</span>';
            }
            return $values;
        }

        function get_roles($id)
        {
            $data = db::table('model_has_roles')
                ->join('roles', 'model_has_roles.role_id', 'roles.id')->where('model_has_roles.model_id', $id)
                ->select(['roles.name as role'])
                ->get();
            $values = '';
            foreach ($data as $key => $item) {
                $values .= '<span class="badge bg-primary ml-1 mr-1 mt-1 text-white"> ' . $item->role . '</span>';
            }
            return $values;
        }

        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('systems', function ($data) {
                    return get_systems($data->id);
                })
                ->addColumn('roles', function ($data) {
                    return get_roles($data->id);
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    if (can('user-edit'))
                        $btn .= "<a class='edit_btn mr-4 ml-4' style='cursor: pointer;' action='" . route("system-details") . "' record_id='" . $data->id . "' username='" . $data->username . "' name='" . $data->name . "' email='" . $data->email . "'><i class='btn  btn-sm btn-outline-info btn-circle flaticon-edit-1'></i></a>";
                    if (can('user-destroy'))
                        $btn .= "<a class='destroy_btn ml-3' style='cursor: pointer;' record_id='" . $data->id . "'><i class='btn btn-sm btn-outline-danger btn-circle flaticon-delete'></i></a>";
                    return $btn;
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.index', $raw);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'system_id' => 'required',
            'roles' => 'required',
        ], [
            'username.required' => trans('words.Required_', ['name' => trans('words.Username')]),
            'username.unique' => trans('words.Duplicate Entry'),
            'name.required' => trans('words.Required_', ['name' => trans('words.Name')]),
            'email.required' => trans('words.Required_', ['name' => trans('words.Email')]),
            'email.email' => trans('words.Email Format'),
            'email.unique' => trans('words.Duplicate Entry'),
            'password.required' => trans('words.Required_', ['name' => trans('words.Password')]),
            'password.min' => trans('words.Min Password 6 Characters'),
            'password.confirmed' => trans('words.Password Confirmation'),
            'system_id.required' => trans('words.Required_', ['name' => trans('words.System')]),
            'roles.required' => trans('words.Required_', ['name' => trans('words.Role')]),
        ]);

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        DB::beginTransaction();

        try {
            $user = new User();

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_by = uid();
            $user->save();

            foreach ($request->system_id as $key => $value) {
                UserSystem::create([
                    'user_id' => $user->id,
                    'system_id' => $request->system_id[$key]
                ]);
            }
            $user->assignRole($request->roles);
            DB::commit();
            // all good
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            session()->flash('warning', trans('words.Please Try Again'));
            return false;
        }
    }

    protected function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $request->id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => $request->password != '' ? 'required|confirmed|min:6' : '',
        ], [
            'username.required' => trans('words.Required_', ['name' => trans('words.Username')]),
            'username.unique' => trans('words.Duplicate Entry'),
            'name.required' => trans('words.Required_', ['name' => trans('words.Name')]),
            'email.required' => trans('words.Required_', ['name' => trans('words.Email')]),
            'email.email' => trans('words.Email Format'),
            'email.unique' => trans('words.Duplicate Entry'),
            'password.required' => trans('words.Required_', ['name' => trans('words.Password')]),
            'password.min' => trans('words.Min Password 6 Characters'),
            'password.confirmed' => trans('words.Password Confirmation'),
        ]);

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        DB::beginTransaction();

        try {
            $user = User::findOrFail($request->id);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }
            $user->updated_by = uid();
            $user->update();

            UserSystem::where('user_id', $user->id)->delete();
            foreach ($request->system_id as $key => $value) {
                UserSystem::create([
                    'user_id' => $user->id,
                    'system_id' => $request->system_id[$key]
                ]);
            }

            foreach ($user->roles as $key => $value) {
                $user->removeRole($value->name);
            }

            $user->assignRole($request->roles);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            session()->flash('warning', trans('words.Please Try Again'));
            return false;
        }
    }

    protected function destroy($id)
    {
        User::findOrFail($id)->delete();
        return true;
    }

    protected function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|between:8,30|confirmed',
        ]);

        $user = User::findOrFail(uid());
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password),
                'updated_by' => uid(),
            ])->save();
            return redirect()->back()->with('success', trans('words.Successfully Edited'));
        } else {
            return redirect()->back()->with('wrong_pwd', trans('words.Wrong Password'));
        }
    }

    protected function changeUserImage(Request $request)
    {
        if ($request->has('profile_avatar')) {
            $user = User::findOrFail(auth()->id());
            $img =  Storage::disk('user_images')->put(date('Y') . '/' . date('m'), $request->file('profile_avatar'));
            $user->image = $img;
            $user->updated_by = uid();
            $user->update();
            return true;
        } else {
            return false;
        }
    }
}
