<?php

namespace App\Http\Controllers;

use App\Program;
use App\Department;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.super.program.list')
            ->with('programs', Program::select('programs.*', 'departments.department_code')
                ->join("departments", "departments.id", "programs.department_id")
                ->orderBy('department_code')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.super.program.create')->with('departments', Department::all());
    }

    /**
     * Store a newly created resource in storage.ode
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'prog_code' => 'required|max:100|unique:programs,prog_code,NULL,id,department_id,' . $request->department_id,
            'prog_name' => 'required|max:255|unique:programs,prog_name,NULL,id,department_id,' . $request->department_id,
            'department_id' => 'required'
        ], [
            'prog_code.required' => '*The Program Code field is required.',
            'prog_code.unique' => '*Entered Program Code already exists.',
            'prog_code.max' => '*The Program Code may not be greater than 100 characters.',
            'prog_name.required' => '*The Program Name field is required.',
            'prog_name.unique' => '*Entered Program Name already exists.',
            'prog_name.max' => '*The Program Name may not be greater than 255 characters.',
            'department_id.required' => '*The Department Code field is required.',
        ]);

        Program::create($request->all());

        return redirect('admins/super/program');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return view('admins/super/program/edit')
            ->with("program", $program)
            ->with('departments', Department::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request, [
            'prog_code' => "required|max:100|unique:programs,prog_code,$program->id,id,department_id," . $request->department_id,
            'prog_name' => "required|max:255|unique:programs,prog_name,$program->id,id,department_id," . $request->department_id,
            'department_id' => 'required'
        ], [
            'prog_code.required' => '*The Program Code field is required.',
            'prog_code.unique' => '*Entered Program Code already exists.',
            'prog_code.max' => '*The Program Code may not be greater than 100 characters.',
            'prog_name.required' => '*The Program Name field is required.',
            'prog_name.unique' => '*Entered Program Name already exists.',
            'prog_name.max' => '*The Program Name may not be greater than 255 characters.',
            'department_id' => '*The Department Code field is required.',
        ]);

        $program->update($request->all());
        return redirect("admins/super/program");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect('admins/super/program');
    }
}
