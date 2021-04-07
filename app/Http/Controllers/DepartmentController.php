<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.super.department.list')
            ->with('departments', Department::
            orderBy('department_code')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.super.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'department_code' => 'required|unique:departments,department_code|max:100',
            'dept_name' => 'required|unique:departments,dept_name|max:255',
        ], [
            'department_code.required' => '*The Department Code field is required.',
            'department_code.unique' => '*Entered Department Code already exists.',
            'department_code.max' => '*The Department Code may not be greater than 100 characters.',
            'dept_name.required' => '*The Department Name field is required.',
            'dept_name.unique' => '*Entered Department Name already exists.',
            'dept_name.max' => '*The Department Name may not be greater than 255 characters.',
        ]);

        Department::create($request->all());

        return redirect('admins/super/department');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admins/super/department/edit')
            ->with("department", $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'department_code' => "required|max:100|unique:departments,department_code,$department->id",
            'dept_name' => "required|max:255|unique:departments,dept_name,$department->id",
        ], [
            'department_code.required' => '*The Department Code field is required.',
            'department_code.unique' => '*Entered Department Code already exists.',
            'department_code.max' => '*The Department Code may not be greater than 100 characters.',
            'dept_name.required' => '*The Department Name field is required.',
            'dept_name.unique' => '*Entered Department Name already exists.',
            'dept_name.max' => '*The Department Name may not be greater than 255 characters.',
        ]);

        $department->update($request->all());
        return redirect("admins/super/department");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect('admins/super/department');
    }
}
