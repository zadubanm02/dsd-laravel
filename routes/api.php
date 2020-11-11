<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/employees', function () {
    return 'Hello';
});

Route::prefix('/v1')->group(function () {
    Route::post('employees', 'App\Http\Controllers\EmployeeController@store');

    Route::get('employees', 'App\Http\Controllers\EmployeeController@show');
    Route::get('employees/{employee_id}', 'App\Http\Controllers\EmployeeController@getEmployeeById');

    Route::patch('employees/{employee_id}', 'App\Http\Controllers\EmployeeController@employeeUpdate');

    Route::delete('employees/{employee_id}', 'App\Http\Controllers\EmployeeController@employeeDestroy');
});

Route::get('/api/users', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
