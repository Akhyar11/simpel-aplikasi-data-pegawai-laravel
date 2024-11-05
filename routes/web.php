<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/detail/{employee}', [EmployeeController::class, 'detail'])->name('employees.detail');
Route::get('/employees/data', [EmployeeController::class, 'getData'])->name('employees.data');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// API Routes
Route::get('/api/employees', [EmployeeController::class, 'apiList']);


