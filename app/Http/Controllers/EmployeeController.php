<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->with(['roles:name','user:name,id,type'])->get();
        return view('admin.users.employees.index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Employee::type();

        $roles = Role::with('permissions:name')->get();

        return view('admin.users.employees.create',['types'=> $types,'roles'=>$roles]);
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

        $validated['password'] = bcrypt($request->password);
        $validated['type'] = 1;
        $validated['is_admin'] = 1;
        //dd($request->all(),$validated);
        $user = User::create($validated);
        $permissions =[];
        if ($request->roles != null){
            foreach ($request->roles as $k => $role){
                foreach ($role as $key => $value){
                    $permissions[] = $value;
                }
            }
        }
        $employee = $user->employee()->create([
            'user_id'   =>$user->id,
            'type'      =>$request->type_employees,
            'status'    =>$request->status_employees,
        ]);

        if ($employee){
            $user->phones()->createMany($request->group_a);
            $user->givePermissionTo($permissions);
        }
        $request->session()->flash('message',__('users.employees.massages.created_successfully'));
        return redirect(route('employees.index'));
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
        $types  = Employee::type();
        $roles  =  Role::with('permissions:name')->get();
        $phones = $employee->user->phones->pluck('number');
        $userPermissions = [];
        if ($employee->user->getAllPermissions() != null){
            foreach ($employee->user->getAllPermissions()->pluck('name') as $k => $value){
                $userPermissions[] = $value;
            }
        }
        return view('admin.users.employees.edit',[
            'employee'          => $employee ,
            'types'             => $types ,
            'roles'             => $roles,
            'userPermissions'   => $userPermissions,
            'phones'            => $phones
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {

        $validated = $request->validated();
        $validated['password'] = bcrypt($request->password);
        $validated['type'] = 1;
        $validated['is_admin'] = 1;
        $employee->user->update($validated);
        $updated = $employee->update([
            'type'      =>  $request->type_employees,
            'status'    =>  $request->status_employees,
        ]);

        if ($updated){
            $permissions =[];
            if ($request->roles != null){
                foreach ($request->roles as $k => $role){
                    foreach ($role as $key => $value){
                        $permissions[] = $value;
                    }
                }
            }
            $employee->user->phones()->delete();
            $employee->user->phones()->createMany($request->group_a);
            $employee->user->syncPermissions($permissions);
        }
        $request->session()->flash('message',__('users.employees.massages.updated_successfully'));
        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee,Request $request)
    {
         $employee->delete();
        //dd($x);
        $request->session()->flash('message',__('users.employees.massages.deleted_successfully'));
        return redirect(route('employees.index'));
    }
}
