<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Image;
use DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'first_name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required'
        ]);
        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(240, 300);
            $upload_path = 'backend/employee';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->phone = $request->phone;
            $employee->photo = $image_url;
            $employee->save();
        } else {
            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->phone = $request->phone;
            $employee->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['salary'] = $request->salary;
        $data['joining_date'] = $request->joining_date;
        $data['phone'] = $request->phone;
        $image = $request->newPhoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($image)->resize(240, 300);
            $upload_path = 'backend/employee';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('employees')->where('id', $id)->first();
                $image_path = $img->photo;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                // $done = unlink($image_path);
                $user = DB::table('employees')->where('id', $id)->update($data);
            }
        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('employees')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $image = $employee->photo;
        if ($image) {
            unlink($image);
            Employee::find($id)->delete();
        } else {
            Employee::find($id)->delete();
        }
    }
}
