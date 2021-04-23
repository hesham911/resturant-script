<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->get();
        return view('admin.users.employees.index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        Employee::create($validated);
        $request->session()->flash('success',__('employees.massages.created_successfully'));
        return redirect(route('admin.users.employees.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Employee $employee)
    {
        return view('admin.users.employees.view',['employee'   => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Employee $employee)
    {
        return view('admin.users.employees.edit',['employee'   => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        $employee->update($validated);
        $request->session()->flash('success',__('employees.massages.update_successfully'));
        return redirect(route('admin.users.employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee,EmployeeRequest $request)
    {
        $employee->delete();
        $request->session()->flash('message',__('employees.massages.deleted_successfully'));
        return redirect(route('admin.users.employees.index'));
    }
}
