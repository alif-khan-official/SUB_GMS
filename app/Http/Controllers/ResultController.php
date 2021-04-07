<?php

namespace App\Http\Controllers;

use App\Department;
use App\OfferedCourse;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function courses()
    {
        return view('admins.teacher.result.courses')
            ->with('offeredCourses', OfferedCourse::
            select('offered_courses.*', 'all_courses.course_code', 'programs.prog_code')
                ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
                ->join("programs", "programs.id", "offered_courses.program_id")
                ->where('user_id', Auth::user()->id)
                ->where('status', 'disabled')
                ->orderBy('year', 'desc')->paginate(10));
    }

    public function students(OfferedCourse $offeredCourse)
    {
        $course_code = OfferedCourse::
        select('all_courses.course_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->where('all_courses.id', $offeredCourse->all_course_id)
            ->value('course_code');

        $results = Result::
        where('offered_courses_id', $offeredCourse->id)
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.teacher.result.students', compact('offeredCourse', 'course_code', 'results'));
    }

    public function adminCourses()
    {
        $courses = OfferedCourse::
        select('all_courses.course_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->join("departments", "departments.id", "offered_courses.department_id")
            ->where("departments.id", Auth::user()->department_id)
            ->orderBy('all_courses.created_at', 'desc')->distinct()->get();

        $years = OfferedCourse::
        select('offered_courses.year')
            ->join("departments", "departments.id", "offered_courses.department_id")
            ->where("departments.id", Auth::user()->department_id)
            ->orderBy('offered_courses.created_at', 'desc')->distinct()->get();

        $semesters = OfferedCourse::
        select('offered_courses.semester')
            ->join("departments", "departments.id", "offered_courses.department_id")
            ->where("departments.id", Auth::user()->department_id)
            ->orderBy('offered_courses.created_at', 'desc')->distinct()->get();

        $offeredCourses = OfferedCourse::
        select('offered_courses.*', 'all_courses.course_code', 'programs.prog_code', 'departments.department_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->join("departments", "departments.id", "offered_courses.department_id")
            ->join("programs", "programs.id", "offered_courses.program_id")
            ->where("departments.id", Auth::user()->department_id)
            ->where('status', 'disabled')
            ->orderBy('year', 'desc')->paginate(10);

        return view('admins.admin.result.courses', compact('courses', 'years', 'semesters', 'offeredCourses'));
    }

    public function adminFilteredCourses(Request $request)
    {
        return view('admins.admin.result.filtered_courses')
            ->with('offeredCourses', OfferedCourse::
            select('offered_courses.*', 'all_courses.course_code', 'programs.prog_code', 'departments.department_code')
                ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
                ->join("departments", "departments.id", "offered_courses.department_id")
                ->join("programs", "programs.id", "offered_courses.program_id")
                ->where("departments.id", Auth::user()->department_id)
                ->where('course_code', $request->course_code)
                ->where('year', $request->year)
                ->where('semester', $request->semester)
                ->where('status', 'disabled')
                ->orderBy('year', 'desc')->paginate(10));
    }

    public function adminStudents(OfferedCourse $offeredCourse)
    {
        $course_code = OfferedCourse::
        select('all_courses.course_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->where('all_courses.id', $offeredCourse->all_course_id)
            ->value('course_code');

        $results = Result::
        where('offered_courses_id', $offeredCourse->id)
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.admin.result.students', compact('offeredCourse', 'course_code', 'results'));
    }

    public function superCourses()
    {
        $departments = Department::select('department_code')
            ->orderBy('department_code')->get();
        $years = OfferedCourse::select('year')
            ->orderBy('created_at', 'desc')->distinct()->get();
        $semesters = OfferedCourse::select('semester')
            ->orderBy('created_at', 'desc')->distinct()->get();
        $offeredCourses = OfferedCourse::
        select('offered_courses.*', 'all_courses.course_code', 'programs.prog_code', 'departments.department_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->join("departments", "departments.id", "offered_courses.department_id")
            ->join("programs", "programs.id", "offered_courses.program_id")
            ->where('status', 'disabled')
            ->orderBy('year', 'desc')->paginate(10);

        return view('admins.super.result.courses', compact('departments', 'years', 'semesters', 'offeredCourses'));
    }

    public function superFilteredCourses(Request $request)
    {
        return view('admins.super.result.filtered_courses')
            ->with('offeredCourses', OfferedCourse::
            select('offered_courses.*', 'all_courses.course_code', 'programs.prog_code', 'departments.department_code')
                ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
                ->join("departments", "departments.id", "offered_courses.department_id")
                ->join("programs", "programs.id", "offered_courses.program_id")
                ->where('department_code', $request->department_code)
                ->where('year', $request->year)
                ->where('semester', $request->semester)
                ->where('status', 'disabled')
                ->orderBy('year', 'desc')->paginate(10));
    }

    public function superStudents(OfferedCourse $offeredCourse)
    {
        $course_code = OfferedCourse::
        select('all_courses.course_code')
            ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
            ->where('all_courses.id', $offeredCourse->all_course_id)
            ->value('course_code');

        $results = Result::
        where('offered_courses_id', $offeredCourse->id)
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.super.result.students', compact('offeredCourse', 'course_code', 'results'));
    }
}
