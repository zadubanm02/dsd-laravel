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
        $position = $request->input('postion');
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
