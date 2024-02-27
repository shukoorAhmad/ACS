<?php

namespace App\Http\Controllers\Acs;

use App\Http\Controllers\Controller;
use App\Models\Acs\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employee-list')->only('index');
        $this->middleware('permission:employee-create|employee-edit')->only('store');
        $this->middleware('permission:employee-delete')->only('store');
        $this->middleware('permission:employee-check')->only('store');
    }

    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select(['id', 'name', 'father_name', 'special_id', 'photo', 'created_by']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    return "<img src='" . URL::asset($data->photo) . "' height='30' width='30' />";
                })
                ->addColumn('created_by_details', function ($data) {
                    return $data->created_by_details->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = "";
                    if (can('employee-edit'))
                        $btn .= '<a class="btn btn-outline-primary btn-sm edit_btn" href="#" data-id="' . $row->id . '" name="' . $row->name . '" father_name="' . $row->father_name . '" image="' . URL::asset($row->photo) . '"><span class="fa fa-edit"></span></a>';
                    if (can('employee-delete'))
                        $btn .= '<a class="btn btn-outline-danger btn-sm delete_btn ml-1" href="#" data-id="' . encode_id($row->id) . '"><span class="fa fa-trash"></span></a>';
                    $btn .= '<a class="btn btn-outline-dark btn-sm ml-1" href="' . route('employee-print-card', encode_id($row->id)) . '"><span class="fa fa-print"></span></a>';

                    return $btn;
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('acs.employee.index');
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'father_name' => 'required',
            'img' => $request->employee_id == 0 ? 'required|mimes:png,jpg,jpeg|max:500' : 'mimes:png,jpg,jpeg|max:500',
        ], [
            'name.required' => trans('words.Required_', ['name' => trans('words.Name')]),
            'father_name.required' =>  trans('words.Required_', ['name' => trans('words.Father Name')]),
            'img.required' => trans('words.Required_', ['name' => trans('words.Image')]),
            'img.mimes' => trans('words.Mimes'),
            'img.max' => trans('words.Max'),
        ]);

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $employee = $request->employee_id == 0 ? new Employee() : Employee::findOrFail($request->employee_id);

        if ($request->file('img')) {
            $org_logo = Storage::disk('employee_photos')->put(date('Y') . '/' . date('n'), $request->file('img'));
            $employee->photo = 'storage/employee_photos/' . $org_logo;
        }

        $employee->name = $request->name;
        $employee->father_name = $request->father_name;
        if ($request->employee_id == 0)
            $employee->special_id = setSpecialId(getNextId());
        $employee->expiry_date = date('Y-m-d', strtotime('+1 year'));
        $request->employee_id == 0 ? $employee->created_by = uid() : $employee->updated_by = uid();
        $request->employee_id == 0 ? $employee->save() : $employee->update();

        return true;
    }

    protected function print($id)
    {
        $data['employee'] = employee::findOrFail(decode_id($id));
        return view('acs.employee.print', $data);
    }

    protected function check_index()
    {
        return view('acs.employee.check');
    }

    protected function check($id)
    {
        $data['employee'] = employee::where('special_id', $id)->first();
        return view('acs.employee.search', $data);
    }

    protected function destroy($id)
    {
        employee::findOrFail(decode_id($id))->delete();
        return true;
    }
}
