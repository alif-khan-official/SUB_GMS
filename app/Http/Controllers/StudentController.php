<?php

namespace App\Http\Controllers;

use App\Program;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.admin.student.list')
            ->with('students', Student::
            select('students.*', 'programs.prog_code')
                ->join("programs", "programs.id", "students.program_id")
                ->where('students.department_id', Auth::user()->department_id)
                ->orderBy('stu_id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.admin.student.create')
            ->with('programs', Program::where('department_id', Auth::user()->department_id)->get());
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
            'stu_id' => 'required|unique:students|max:100',
            'program_id' => 'required',
            'batch' => 'required|integer|min:1'
        ], [
            'stu_id.required' => '*The Student field is required.',
            'stu_id.unique' => '*Entered Student ID already exists.',
            'stu_id.max' => '*The Student ID may not be greater than 100 characters.',
            'program_id.required' => '*The Program Code field is required.',
            'batch.required' => '*The Batch field is required.',
            'batch.integer' => '*Batch must be an integer.',
            'batch.min' => '*Batch must be at least 1.',
        ]);

        $data = $request->all();
        $data['id'] = DB::table('students')->max('id') + 1;
        $data['department_id'] = Auth::user()->department_id;

        Student::create($data);

        return redirect('admins/admin/student');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('admins/admin/student/edit')
            ->with("student", $student)
            ->with('programs', Program::where('department_id', Auth::user()->department_id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'stu_id' => "required|unique:students,stu_id,$student->id|max:100",
            'program_id' => 'required',
            'batch' => 'required|integer|min:1'
        ], [
            'stu_id.required' => '*The Student ID field is required.',
            'stu_id.unique' => '*Entered Student already exists.',
            'stu_id.max' => '*The Student ID may not be greater than 100 characters.',
            'program_id.required' => '*The Program Code field is required.',
            'batch.required' => '*The Batch field is required.',
            'bacth.integer' => '*Batch must be an integer.',
            'batch.min' => '*Batch must be at least 1.',
        ]);

        $student->update($request->all());
        return redirect("admins/admin/student");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('admins/admin/student');
    }
}
