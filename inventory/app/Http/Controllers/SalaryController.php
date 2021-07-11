<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id)
    {

        // $validation = $request->validate([
        //     'salary_month' => 'required'

        // // ]);
        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month', $month)
            ->first();
        if ($check) {
            return response()->json('Salary Already Paid');
        } else {
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            DB::table('salaries')->insert($data);
        }
    }

    public function allSalary()
    {

        $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')
            ->get();
        return response()->json($salary);
    }
    public function viewSalary($id)
    {
        $month = $id;
        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.first_name', 'salaries.*')
            ->where('salaries.salary_month', $month)
            ->get();
        return response()->json($view);
    }
    public function editSalary($id)
    {
        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.first_name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();
        return response()->json($view);
    }

    public function updateSalary(Request $request, $id)
    {

        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['salary_month'] = $request->salary_month;
        $data['amount'] = $request->amount;
        $user = DB::table('salaries')->where('id', $id)->update($data);
    }


    //stock update function use
    public function updateStock(Request $request, $id)
    {

        $data = array();
        $data['product_quantity'] = $request->product_quantity;
        $user = DB::table('products')->where('id', $id)->update($data);
    }
}
