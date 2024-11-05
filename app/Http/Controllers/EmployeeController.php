<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }

    public function detail($id){
        $employee = Employee::findOrFail($id);
        return view('employees.detail', compact('employee'));   
    }

    public function getData()
    {
        $employees = Employee::query();

        return DataTables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('employees.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('photos/',  $filename);
            $data['photo'] = $filename;
        }

        Employee::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully'
        ]);
    }

    // API endpoint for employee list
    public function apiList()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->validated();

        // Update foto jika ada file baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($employee->photo) {
                Storage::delete('public/photos/' . $employee->photo);
            }

            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('photos/',  $filename);
            $data['photo'] = $filename;
        }

        $employee->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Hapus foto jika ada
        if ($employee->photo) {
            Storage::delete('public/photos/' . $employee->photo);
        }

        $employee->delete();

        return view("employees.index");
    }
}