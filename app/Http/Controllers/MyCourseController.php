<?php

namespace App\Http\Controllers;

use App\OfferedCourse;
use App\AllCourse;
use App\Department;
use App\Program;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    public function index()
    {
        return view('admins.teacher.my-course.list')
            ->with('offeredCourses', OfferedCourse::
            select('offered_courses.*', 'all_courses.course_code', 'all_courses.course_type', 'programs.prog_code', 'departments.department_code')
                ->join("all_courses", "all_courses.id", "offered_courses.all_course_id")
                ->join("departments", "departments.id", "offered_courses.department_id")
                ->join("programs", "programs.id", "offered_courses.program_id")
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')->paginate(10));


    }

    public function edit(OfferedCourse $offeredCourse)
    {
        $allCourse = AllCourse::where('id', $offeredCourse->all_course_id)->value('course_code');
        $department = Department::where('id', $offeredCourse->department_id)->value('department_code');
        $program = Program::where('id', $offeredCourse->program_id)->value('prog_code');

        return view('admins/teacher/my-course/edit', compact('offeredCourse', 'allCourse', 'department', 'program'));
    }

    public function update(Request $request, OfferedCourse $offeredCourse)
    {
        $this->validate($request, [
            'total_classes' => 'nullable|integer|min:1',
            'att_marks' => 'nullable|integer|min:1|max:100',
            'ct1_marks' => 'nullable|integer|min:1|max:100',
            'ct2_marks' => 'nullable|integer|min:1|max:100',
            'ct3_marks' => 'nullable|integer|min:1|max:100',
            'ct_marks' => 'nullable|integer|min:1|max:100',
            'mid_marks' => 'nullable|integer|min:1|max:100',
            'final_marks' => 'nullable|integer|min:1|max:100',
            'total_marks' => 'nullable|integer|max:100',
        ], [
            'total_classes.integer' => '*Number of Total Classes must be an integer.',
            'total_classes.min' => '*Number of Total Classes must be at least 1.',
            'att_marks.integer' => '*Attendance Marks must be an integer.',
            'att_marks.min' => '*Attendance Marks must be at least 1.',
            'att_marks.max' => '*Attendance Marks may not be greater than 100.',
            'ct1_marks.integer' => '*CT-01 Marks must be an integer.',
            'ct1_marks.min' => '*CT-01 Marks must be at least 1.',
            'ct1_marks.max' => '*CT-01 Marks may not be greater than 100.',
            'ct2_marks.integer' => '*CT-02 Marks must be an integer.',
            'ct2_marks.min' => '*CT-02 Marks must be at least 1.',
            'ct2_marks.max' => '*CT-02 Marks may not be greater than 100.',
            'ct3_marks.integer' => '*CT-03 Marks must be an integer.',
            'ct3_marks.min' => '*CT-03 Marks must be at least 1.',
            'ct3_marks.max' => '*CT-03 Marks may not be greater than 100.',
            'ct_marks.integer' => '*CT Marks must be an integer.',
            'ct_marks.min' => '*CT Marks must be at least 1.',
            'ct_marks.max' => '*CT Marks may not be greater than 100.',
            'mid_marks.integer' => '*Mid-Term Marks must be an integer.',
            'mid_marks.min' => '*Mid-Term Marks must be at least 1.',
            'mid_marks.max' => '*Mid-Term Marks may not be greater than 100.',
            'final_marks.integer' => '*Final Marks must be an integer.',
            'final_marks.min' => '*Final Marks must be at least 1.',
            'final_marks.max' => '*Final Marks may not be greater than 100.',
            'total_marks.integer' => '*Total Marks must be an integer.',
            'total_marks.max' => '*Total of Attendance Marks, CT Marks, Mid-Term Marks, and Final Marks may not be greater than 100.',
        ]);

        $offeredCourse->update($request->all());

        return redirect("admins/teacher/my-course");
    }

    public function lab_edit(OfferedCourse $offeredCourse)
    {
        $allCourse = AllCourse::where('id', $offeredCourse->all_course_id)->value('course_code');
        $department = Department::where('id', $offeredCourse->department_id)->value('department_code');
        $program = Program::where('id', $offeredCourse->program_id)->value('prog_code');

        return view('admins/teacher/my-course/lab_edit', compact('offeredCourse', 'allCourse', 'department', 'program'));
    }

    public function lab_update(Request $request, OfferedCourse $offeredCourse)
    {
        $this->validate($request, [
            'total_classes' => 'nullable|integer|min:1',
            'att_marks' => 'nullable|integer|min:1|max:100',
            'ct_marks' => 'nullable|integer|min:1|max:100',
            'mid_marks' => 'nullable|integer|min:1|max:100',
            'final_marks' => 'nullable|integer|min:1|max:100',
            'total_marks' => 'nullable|integer|max:100',
        ], [
            'total_classes.integer' => '*Number of Total Classes must be an integer.',
            'total_classes.min' => '*Number of Total Classes must be at least 1.',
            'att_marks.integer' => '*Attendance Marks must be an integer.',
            'att_marks.min' => '*Attendance Marks must be at least 1.',
            'att_marks.max' => '*Attendance Marks may not be greater than 100.',
            'ct_marks.integer' => '*Lab Performance Marks must be an integer.',
            'ct_marks.min' => '*Lab Performance Marks must be at least 1.',
            'ct_marks.max' => '*Lab Performance Marks may not be greater than 100.',
            'mid_marks.integer' => '*Mid-Term Marks must be an integer.',
            'mid_marks.min' => '*Mid-Term Marks must be at least 1.',
            'mid_marks.max' => '*Mid-Term Marks may not be greater than 100.',
            'final_marks.integer' => '*Final Marks must be an integer.',
            'final_marks.min' => '*Final Marks must be at least 1.',
            'final_marks.max' => '*Final Marks may not be greater than 100.',
            'total_marks.integer' => '*Total Marks must be an integer.',
            'total_marks.max' => '*Total of Attendance Marks, Lab Performance Marks, Mid-Term Marks, and Final Marks may not be greater than 100.',
        ]);

        $offeredCourse->update($request->all());
        return redirect("admins/teacher/my-course");
    }

    public function refresh(OfferedCourse $offeredCourse)
    {
        $courses = Result::where('offered_courses_id', $offeredCourse->id)->get();

        foreach ($courses as $course) {
//----- ATTENDANCE -----//
            $att_marks = $offeredCourse->att_marks;
            $total_classes = $offeredCourse->total_classes;
            $att_days = $course->att_days;

            if ($att_days == null || $total_classes == null || $att_marks == null ||
                $att_days < 0 || $att_days > $total_classes) {
                $att_weighted = null;
            } else {
                $att_obtained = (100 * $att_days) / $total_classes;
                if ($att_obtained >= 90) {
                    $att_weighted = 100 * ($att_marks / 100);
                } else {
                    $att_weighted = round($att_obtained * ($att_marks / 100));
                }
            }
//----- CT -----//
            $ct_marks = $offeredCourse->ct_marks;
            $ct_weighted = $offeredCourse->ct_weighted;
            $ct1_marks = $offeredCourse->ct1_marks;
            $ct2_marks = $offeredCourse->ct2_marks;
            $ct3_marks = $offeredCourse->ct3_marks;
            $ct1_obtained = $course->ct1_obtained;
            $ct2_obtained = $course->ct2_obtained;
            $ct3_obtained = $course->ct3_obtained;
            $ct1_weighted = $offeredCourse->ct1_weighted;
            $ct2_weighted = $offeredCourse->ct2_weighted;
            $ct3_weighted = $offeredCourse->ct3_weighted;

            if ($ct_marks == null || $ct1_marks == null || $ct2_marks == null || $ct1_obtained == null || $ct2_obtained == null ||
                $ct1_obtained < 0 || $ct2_obtained < 0 || $ct3_obtained < 0 || $ct1_obtained > $ct1_marks || $ct2_obtained > $ct2_marks ||
                $ct3_obtained > $ct3_marks) {
                $ct_weighted = null;
            } else {
                $ct1_weighted = ($ct_marks * $ct1_obtained) / $ct1_marks;
                $ct2_weighted = ($ct_marks * $ct2_obtained) / $ct2_marks;

                if ($offeredCourse->ct == "Best One") {
                    if ($ct3_obtained == null || $ct3_marks == null) {
                        $ct_weighted = max($ct1_weighted, $ct2_weighted);
                    } else {
                        $ct3_weighted = ($ct_marks * $ct3_obtained) / $ct3_marks;
                        $ct_weighted = max($ct1_weighted, $ct2_weighted, $ct3_weighted);
                    }
                } elseif ($offeredCourse->ct == "Best Two(Average)") {
                    if ($ct3_obtained == null) {
                        $ct_weighted = ($ct1_weighted + $ct2_weighted) / 2;
                    } else {
                        $ct3_weighted = ($ct_marks * $ct3_obtained) / $ct3_marks;
                        if ($ct1_weighted == max($ct1_weighted, $ct2_weighted, $ct3_weighted)) {
                            $ct_weighted = ($ct1_weighted + max($ct2_weighted, $ct3_weighted)) / 2;
                        } elseif ($ct2_weighted == max($ct1_weighted, $ct2_weighted, $ct3_weighted)) {
                            $ct_weighted = ($ct2_weighted + max($ct1_weighted, $ct3_weighted)) / 2;
                        } elseif ($ct3_weighted == max($ct1_weighted, $ct2_weighted, $ct3_weighted)) {
                            $ct_weighted = ($ct3_weighted + max($ct1_weighted, $ct2_weighted)) / 2;
                        }
                    }
                } else {
                    if ($ct1_obtained == null || $ct2_obtained == null || $ct3_obtained == null) {
                        $ct_weighted = null;
                    } else {
                        $ct3_weighted = ($ct_marks * $ct3_obtained) / $ct3_marks;
                        $ct_weighted = ($ct1_weighted + $ct2_weighted + $ct3_weighted) / 3;
                    }
                }
            }
//----- MID-TERM -----//
            if ($course->mid_obtained < 0 || $course->mid_obtained > $offeredCourse->mid_marks) {
                $mid_obtained = null;
            } else {
                $mid_obtained = $course->mid_obtained;
            }
//----- FINAL -----//
            if ($course->final_obtained < 0 || $course->final_obtained > $offeredCourse->final_marks) {
                $final_obtained = null;
            } else {
                $final_obtained = $course->final_obtained;
            }
//----- TOTAL -----//
            if ($att_weighted == null || $ct_weighted == null || $mid_obtained == null || $final_obtained == null) {
                $total_weighted = null;
                $letter_grade = null;
            } else {
                $total_marks = $offeredCourse->att_marks + $offeredCourse->ct_marks + $offeredCourse->mid_marks + $offeredCourse->final_marks;
                $total_obtained = $att_weighted + $ct_weighted + $mid_obtained + $final_obtained;
                $total_weighted = ($total_obtained * 100) / $total_marks;

                if ($total_weighted >= 80) {
                    $letter_grade = 'A+';
                } elseif ($total_weighted >= 75) {
                    $letter_grade = 'A';
                } elseif ($total_weighted >= 70) {
                    $letter_grade = 'A-';
                } elseif ($total_weighted >= 65) {
                    $letter_grade = 'B+';
                } elseif ($total_weighted >= 60) {
                    $letter_grade = 'B';
                } elseif ($total_weighted >= 55) {
                    $letter_grade = 'B-';
                } elseif ($total_weighted >= 50) {
                    $letter_grade = 'C+';
                } elseif ($total_weighted >= 45) {
                    $letter_grade = 'C';
                } elseif ($total_weighted >= 40) {
                    $letter_grade = 'D';
                } else {
                    $letter_grade = 'F';
                }
            }

            \DB::table('results')->where('id', $course->id)->update([
                'att_weighted' => $att_weighted,
                'ct1_weighted' => $ct1_weighted,
                'ct2_weighted' => $ct2_weighted,
                'ct3_weighted' => $ct3_weighted,
                'ct_weighted' => $ct_weighted,
                'mid_obtained' => $mid_obtained,
                'final_obtained' => $final_obtained,
                'total_weighted' => $total_weighted,
                'letter_grade' => $letter_grade,
            ]);


        }

        return redirect()->back()->with('success', 'Course Recalculated Successfully.');
    }

    public function lab_refresh(OfferedCourse $offeredCourse)
    {
        $courses = Result::where('offered_courses_id', $offeredCourse->id)->get();

        foreach ($courses as $course) {
//----- ATTENDANCE -----//
            $att_marks = $offeredCourse->att_marks;
            $total_classes = $offeredCourse->total_classes;
            $att_days = $course->att_days;

            if ($att_days == null || $total_classes == null || $att_marks == null ||
                $att_days < 0 || $att_days > $total_classes) {
                $att_weighted = null;
            } else {
                $att_obtained = (100 * $att_days) / $total_classes;
                if ($att_obtained >= 90) {
                    $att_weighted = 100 * ($att_marks / 100);
                } else {
                    $att_weighted = round($att_obtained * ($att_marks / 100));
                }
            }
//----- CT -----//
            if ($course->ct_weighted < 0 || $course->ct_weighted > $offeredCourse->ct_marks) {
                $ct_weighted = null;
            } else {
                $ct_weighted = $course->ct_weighted;
            }
//----- MID-TERM -----//
            if ($course->mid_obtained < 0 || $course->mid_obtained > $offeredCourse->mid_marks) {
                $mid_obtained = null;
            } else {
                $mid_obtained = $course->mid_obtained;
            }
//----- FINAL -----//
            if ($course->final_obtained < 0 || $course->final_obtained > $offeredCourse->final_marks) {
                $final_obtained = null;
            } else {
                $final_obtained = $course->final_obtained;
            }
//----- TOTAL -----//
            if ($att_weighted == null || $ct_weighted == null || $mid_obtained == null || $final_obtained == null) {
                $total_weighted = null;
                $letter_grade = null;
            } else {
                $total_marks = $offeredCourse->att_marks + $offeredCourse->ct_marks + $offeredCourse->mid_marks + $offeredCourse->final_marks;
                $total_obtained = $att_weighted + $ct_weighted + $mid_obtained + $final_obtained;
                $total_weighted = ($total_obtained * 100) / $total_marks;

                if ($total_weighted >= 80) {
                    $letter_grade = 'A+';
                } elseif ($total_weighted >= 75) {
                    $letter_grade = 'A';
                } elseif ($total_weighted >= 70) {
                    $letter_grade = 'A-';
                } elseif ($total_weighted >= 65) {
                    $letter_grade = 'B+';
                } elseif ($total_weighted >= 60) {
                    $letter_grade = 'B';
                } elseif ($total_weighted >= 55) {
                    $letter_grade = 'B-';
                } elseif ($total_weighted >= 50) {
                    $letter_grade = 'C+';
                } elseif ($total_weighted >= 45) {
                    $letter_grade = 'C';
                } elseif ($total_weighted >= 40) {
                    $letter_grade = 'D';
                } else {
                    $letter_grade = 'F';
                }
            }

            \DB::table('results')->where('id', $course->id)->update([
                'att_weighted' => $att_weighted,
                'ct_weighted' => $ct_weighted,
                'mid_obtained' => $mid_obtained,
                'final_obtained' => $final_obtained,
                'total_weighted' => $total_weighted,
                'letter_grade' => $letter_grade,
            ]);


        }
        return redirect()->back()->with('success', 'Course Recalculated Successfully.');
    }
}
