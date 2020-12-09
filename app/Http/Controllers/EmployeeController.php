<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $department = $request->input('department');
        $position = $request->input('position');
        $salary = $request->input('salary');

        $data = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'department' => $department,
            'position' => $position,
            'salary' => $salary,
        );

        $employee = Employee::create($data);
        $employee2 = Employee::on('mysql2')->create($data);
        //$employee3 = Employee::on('mysql3')->create($data);

        if ($employee) {
            return response()->json([
                'data' => [
                    'type' => 'employees',
                    'message' => 'Success',
                    'id' => $employee->id,
                    'attributes' => $employee
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'employees',
                'message' => 'Fail'
            ], 400);
        }
    }


    public function show()
    {
        $employees = Employee::get();

        return response()->json([
            'data' => $employees
        ], 200);
    }

    public function employeeUpdate(Request $request, $employee_id)
    {
        $employee = Employee::find($employee_id);
        $employee2 = Employee::on('mysql2')->find($employee_id);
        $employee3 = Employee::on('mysql3')->find($employee_id);

        if ($employee2) {
            $employee2->firstName = $request->input('firstName');
            $employee2->lastName = $request->input('lastName');
            $employee2->email = $request->input('email');
            $employee2->department = $request->input('department');
            $employee2->position = $request->input('position');
            $employee2->salary = $request->input('salary');
            $employee2 = Employee::on('mysql2')->save();
        } else {
        }

        if ($employee3) {
            $employee3->firstName = $request->input('firstName');
            $employee3->lastName = $request->input('lastName');
            $employee3->email = $request->input('email');
            $employee3->department = $request->input('department');
            $employee3->position = $request->input('position');
            $employee3->salary = $request->input('salary');
            $employee3 = Employee::on('mysql3')->save();
        }

        if ($employee) {
            $employee->firstName = $request->input('firstName');
            $employee->lastName = $request->input('lastName');
            $employee->email = $request->input('email');
            $employee->department = $request->input('department');
            $employee->position = $request->input('position');
            $employee->salary = $request->input('salary');


            $employee->save();

            return response()->json([
                'data' => [
                    'type' => 'employees',
                    'message' => 'Update Success',
                    'id' => $employee->id,
                    'attributes' => $employee
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'employees',
                'message' => 'Not Found'
            ], 404);
        }
    }



    public function getEmployeeById($employee_id)
    {
        $employee = Employee::find($employee_id);

        if ($employee) {
            return response()->json([
                'data' => [
                    'type' => 'employee',
                    'message' => 'Success',
                    'attributes' => $employee
                ]
            ], 200);
        } else {
            return response()->json([
                'type' => 'employee',
                'message' => 'Not Found'
            ], 404);
        }
    }

    public function employeeDestroy($employee_id)
    {
        $employee = Employee::find($employee_id);
        $employee2 = Employee::on('mysql2')->find($employee_id);
        $employee3 = Employee::on('mysql3')->find($employee_id);

        if ($employee2) {
            $employee2->delete();
        }

        if ($employee3) {
            $employee3->delete();
        } else {
        }

        if ($employee) {
            $employee->delete();

            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'employees',
                'message' => 'Not Found'
            ], 404);
        }
    }
}
