<?php

namespace App\Http\Controllers;

use App\AllCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.admin.all-course.list')
            ->with('allCourses', AllCourse::select('all_courses.*', 'departments.department_code')
                ->join("departments", "departments.id", "all_courses.department_id")
                ->where('department_id', Auth::user()->department_id)
                ->orderBy('course_code')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.admin.all-course.create');
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
            'course_code' => 'required|max:100|unique:all_courses,course_code,NULL,id,department_id,' . $request->department_id,
            'course_name' => 'required|max:255|unique:all_courses,course_name,NULL,id,department_id,' . $request->department_id,
        ], [
            'course_code.required' => '*The Course Code field is required.',
            'course_code.unique' => '*Entered Course Code already exists.',
            'course_code.max' => '*The Course Code may not be greater than 100 characters.',
            'course_name.required' => '*The Course Name field is required.',
            'course_name.unique' => '*Entered Course Name already exists.',
            'course_name.max' => '*The Course Name may not be greater than 255 characters.',
        ]);

        $data = $request->all();
        $data['department_id'] = Auth::user()->department_id;

        AllCourse::create($data);

        return redirect('admins/admin/all-course');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AllCourse $allCourse
     * @return \Illuminate\Http\Response
     */
    public function show(AllCourse $allCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AllCourse $allCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(AllCourse $allCourse)
    {
        return view('admins.admin.all-course.edit')->with("allCourse", $allCourse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AllCourse $allCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllCourse $allCourse)
    {
        $this->validate($request, [
            'course_code' => "required|max:100|unique:all_courses,course_code,$allCourse->id,id,department_id," . $request->department_id,
            'course_name' => "required|max:255|unique:all_courses,course_name,$allCourse->id,id,department_id," . $request->department_id,
        ], [
            'course_code.required' => '*The Course Code field is required.',
            'course_code.unique' => '*Entered Course Code already exists.',
            'course_name.required' => '*The Course Name field is required.',
            'course_name.unique' => '*Entered Course Name already exists.',
        ]);

        $allCourse->update($request->all());
        return redirect("admins/admin/all-course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AllCourse $allCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(AllCourse $allCourse)
    {
        $allCourse->delete();
        return redirect('admins/admin/all-course');
    }
}
