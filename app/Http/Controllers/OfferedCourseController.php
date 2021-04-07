<?php

namespace App\Http\Controllers;

use App\AllCourse;
use App\OfferedCourse;
use App\Program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferedCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.admin.offered-course.list')
            ->with('offeredCourses', OfferedCourse::
            select('offered_courses.*', 'users.users_id', 'departments.department_code', 'all_courses.course_code', 'all_courses.course_type', 'programs.prog_code')
                ->join("users", "users.id", "offered_courses.user_id")
                ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
                ->join("departments", "departments.id", "offered_courses.department_id")
                ->join("programs", "programs.id", "offered_courses.program_id")
                ->where('offered_courses.department_id', Auth::user()->department_id)
                ->orderBy('created_at', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCourses = AllCourse::where('department_id', Auth::user()->department_id)->get();
        $programs = Program::where('department_id', Auth::user()->department_id)->get();
        $teachers = User::where('role', 'teacher')->where('department_id', Auth::user()->department_id)->get();

        return view('admins.admin.offered-course.create', compact('allCourses', 'programs', 'teachers'));

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
            'all_course_id' => 'required',
            'user_id' => 'required',
            'program_id' => 'required',
            'year' => 'required|integer',
            'semester' => 'required|max:100'
        ], [
            'all_course_id.required' => '*The Course Code field is required.',
            'user_id.required' => '*The Teacher ID field is required.',
            'program_id.required' => '*The Program Code field is required.',
            'year.required' => '*The Year field is required.',
            'year.integer' => '*Year must be an integer.',
            'semester.required' => '*The Semester field is required.',
            'semester.max' => '*Semester may not be greater than 100 characters.',
        ]);


        $data = $request->all();
        $data['department_id'] = Auth::user()->department_id;

        OfferedCourse::create($data);

        return redirect('admins/admin/offered-course');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\OfferedCourse $offeredCourse
     * @return \Illuminate\Http\Response
     */
    public function show(OfferedCourse $offeredCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\OfferedCourse $offeredCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferedCourse $offeredCourse)
    {
        $allCourses = AllCourse::where('department_id', Auth::user()->department_id)->get();
        $programs = Program::where('department_id', Auth::user()->department_id)->get();
        $teachers = User::where('role', 'teacher')->where('department_id', Auth::user()->department_id)->get();

        return view('admins/admin/offered-course/edit', compact('offeredCourse', 'allCourses', 'programs', 'teachers'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\OfferedCourse $offeredCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferedCourse $offeredCourse)
    {
        $this->validate($request, [
            'all_course_id' => 'required',
            'user_id' => 'required',
            'program_id' => 'required',
            'year' => 'required|integer',
            'semester' => 'required|max:100'
        ], [
            'all_course_id.required' => '*The Course Code field is required.',
            'user_id.required' => '*The Teacher ID field is required.',
            'program_id.required' => '*The Program Code field is required.',
            'year.required' => '*The Year field is required.',
            'year.integer' => '*Year must be an integer.',
            'semester.required' => '*The Semester field is required.',
            'semester.max' => '*Semester may not be greater than 100 characters.',
        ]);
        $offeredCourse->update($request->all());
        return redirect("admins/admin/offered-course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OfferedCourse $offeredCourse
     * @return \Illuminate\Http\Response
     */

    public function destroy(OfferedCourse $offeredCourse)
    {
        $offeredCourse->delete();
        return redirect('admins/admin/offered-course');
    }

    public function changeStatus(OfferedCourse $offeredCourse)
    {
        $status = "";

        $offeredCourse->update([
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Course Status Changed Successfully.');
    }

    public function finalize(OfferedCourse $offeredCourse)
    {
        $status = "disabled";

        $offeredCourse->update([
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Course Finalized Successfully.');
    }
}