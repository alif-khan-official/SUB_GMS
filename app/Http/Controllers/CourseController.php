<?php

namespace App\Http\Controllers;

use App\OfferedCourse;
use App\Program;
use App\AllCourse;
use App\Result;
use App\Rules\AttendanceError;
use App\Rules\AttendanceError01;
use App\Rules\AttendanceError02;
use App\Rules\CT01Error01;
use App\Rules\CT01Error02;
use App\Rules\CT02Error00;
use App\Rules\CT02Error01;
use App\Rules\CT02Error02;
use App\Rules\CT03Error00;
use App\Rules\CT03Error01;
use App\Rules\CT03Error02;
use App\Rules\CTError;
use App\Rules\FinalError;
use App\Rules\FinalError02;
use App\Rules\MidError;
use App\Rules\MidError02;
use App\Rules\TotalError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(OfferedCourse $offeredCourse)
    {
        $allCourse = AllCourse::where('id', $offeredCourse->all_course_id)->value('course_code');
        $results = Result::where('offered_courses_id', $offeredCourse->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.teacher.my-course.course.list', compact('offeredCourse', 'allCourse', 'results'));
    }

    public function create(OfferedCourse $offeredCourse)
    {
        $allCourse = AllCourse::where('id', $offeredCourse->all_course_id)->value('course_code');
        $program = Program::where('id', $offeredCourse->program_id)->value('prog_code');

        return view('admins.teacher.my-course.course.create', compact('offeredCourse', 'allCourse', 'program'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'stu_id' => "required|unique:results,stu_id,NULL,id,offered_courses_id," . $request->offered_courses_id,
            'att_days' => ['nullable', 'min:0', 'integer', new AttendanceError, new AttendanceError01, new AttendanceError02],
            'ct1_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT01Error01, new CT01Error02],
            'ct2_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT02Error00, new CT02Error01, new CT02Error02],
            'ct3_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT03Error00, new CT03Error01, new CT03Error02],
            'mid_obtained' => ['nullable', 'numeric', 'min:0', new MidError, new MidError02],
            'final_obtained' => ['nullable', 'numeric', 'min:0', new FinalError, new FinalError02],
        ], [
            'stu_id.required' => '*The Student ID field is required.',
            'stu_id.unique' => '*Entered Student ID already exists.',
            'att_days.integer' => '*Number of Attended Classes must be an integer.',
            'att_days.min' => '*Number of Attended Classes must be at least 0.',
            'ct1_obtained.min' => '*CT-01 Obtained Marks must be at least 0.',
            'ct2_obtained.min' => '*CT-02 Obtained Marks must be at least 0.',
            'ct3_obtained.min' => '*CT-03 Obtained Marks must be at least 0.',
            'mid_obtained.min' => '*Mid-Term Obtained Marks must be at least 0.',
            'final_obtained.min' => '*Final Obtained Marks must be at least 0.',
        ]);

//----- ATTENDANCE -----//
        $att_marks = $request->att_marks;
        $total_classes = $request->total_classes;
        $att_days = $request->att_days;

        if ($att_days == null || $total_classes == null || $att_marks == null) {
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
        $ct_marks = $request->ct_marks;
        $ct_weighted = $request->ct_weighted;
        $ct1_marks = $request->ct1_marks;
        $ct2_marks = $request->ct2_marks;
        $ct3_marks = $request->ct3_marks;
        $ct1_obtained = $request->ct1_obtained;
        $ct2_obtained = $request->ct2_obtained;
        $ct3_obtained = $request->ct3_obtained;
        $ct1_weighted = $request->ct1_weighted;
        $ct2_weighted = $request->ct2_weighted;
        $ct3_weighted = $request->ct3_weighted;

        if ($ct_marks == null || $ct1_marks == null || $ct2_marks == null || $ct1_obtained == null || $ct2_obtained == null) {
            $ct_weighted = null;
        } else {
            $ct1_weighted = ($ct_marks * $ct1_obtained) / $ct1_marks;
            $ct2_weighted = ($ct_marks * $ct2_obtained) / $ct2_marks;

            if ($request->ct == "Best One") {
                if ($ct3_obtained == null) {
                    $ct_weighted = max($ct1_weighted, $ct2_weighted);
                }
                else {
                    $ct3_weighted = ($ct_marks * $ct3_obtained) / $ct3_marks;
                    $ct_weighted = max($ct1_weighted, $ct2_weighted, $ct3_weighted);
                }
            } elseif ($request->ct == "Best Two(Average)") {
                if ($ct3_obtained == null) {
                    $ct_weighted = ($ct1_weighted + $ct2_weighted) / 2;
                }
                else {
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
        $mid_obtained = $request->mid_obtained;

//----- FINAL -----//

        $final_obtained = $request->final_obtained;

//----- TOTAL -----//
        if ($att_weighted == null || $ct_weighted == null || $mid_obtained == null || $final_obtained == null) {
            //----- TOTAL: WARNING -----//
            $total_weighted = null;
            $letter_grade = null;
        }
        else {
            $total_marks = $request->att_marks + $request->ct_marks + $request->mid_marks + $request->final_marks;
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

        try {
            Result::create([
                'offered_courses_id' => $request->offered_courses_id,
                'att_days' => $request->att_days,
                'ct1_obtained' => $request->ct1_obtained,
                'ct2_obtained' => $request->ct2_obtained,
                'ct3_obtained' => $request->ct3_obtained,
                'mid_obtained' => $request->mid_obtained,
                'final_obtained' => $request->final_obtained,
                'ct' => $request->ct,
                'att_weighted' => $att_weighted,
                'ct1_weighted' => $ct1_weighted,
                'ct2_weighted' => $ct2_weighted,
                'ct3_weighted' => $ct3_weighted,
                'ct_weighted' => $ct_weighted,
                'total_weighted' => $total_weighted,
                'letter_grade' => $letter_grade,
                'stu_id' => $request->stu_id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect("admins/teacher/my-course/course/$request->offered_courses_id/create")->with('err', 'Entered Student ID is Invalid.');
        }

        return redirect("admins/teacher/my-course/course/$request->offered_courses_id");
    }

    public function edit(Result $result)
    {
        $all_course_id = OfferedCourse::where('id', $result->offered_courses_id)->value('all_course_id');
        $course_code = AllCourse::where('id', $all_course_id)->value('course_code');
        $program_id = OfferedCourse::where('id', $result->offered_courses_id)->value('program_id');
        $prog_code = Program::where('id', $program_id)->value('prog_code');
        $offeredCourses = OfferedCourse::where('id', $result->offered_courses_id)->get();

        return view('admins/teacher/my-course/course/edit', compact('result', 'offeredCourses', 'course_code', 'prog_code'));
    }

    public function update(Request $request, Result $result)
    {
        $this->validate($request, [
            'stu_id' => "required|unique:results,stu_id,$result->id,id,offered_courses_id," . $request->offered_courses_id,
            'att_days' => ['nullable', 'min:0', 'integer', new AttendanceError, new AttendanceError01, new AttendanceError02],
            'ct1_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT01Error01, new CT01Error02],
            'ct2_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT02Error00, new CT02Error01, new CT02Error02],
            'ct3_obtained' => ['nullable', 'numeric', 'min:0', new CTError, new CT03Error00, new CT03Error01, new CT03Error02],
            'mid_obtained' => ['nullable', 'numeric', 'min:0', new MidError, new MidError02],
            'final_obtained' => ['nullable', 'numeric', 'min:0', new FinalError, new FinalError02],
        ], [
            'stu_id.required' => '*The Student ID field is required.',
            'stu_id.unique' => '*Entered Student ID already exists.',
            'att_days.integer' => '*Number of Attended Classes must be an integer.',
            'att_days.min' => '*Number of Attended Classes must be at least 0.',
            'ct1_obtained.min' => '*CT-01 Obtained Marks must be at least 0.',
            'ct2_obtained.min' => '*CT-02 Obtained Marks must be at least 0.',
            'ct3_obtained.min' => '*CT-03 Obtained Marks must be at least 0.',
            'mid_obtained.min' => '*Mid-Term Obtained Marks must be at least 0.',
            'final_obtained.min' => '*Final Obtained Marks must be at least 0.
            *Final Obtained Marks must be at least 0.',
        ]);

//----- ATTENDANCE -----//
        $att_marks = $request->att_marks;
        $total_classes = $request->total_classes;
        $att_days = $request->att_days;

        if ($att_days == null || $total_classes == null || $att_marks == null) {
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
        $ct_marks = $request->ct_marks;
        $ct_weighted = $request->ct_marks;
        $ct1_marks = $request->ct1_marks;
        $ct2_marks = $request->ct2_marks;
        $ct3_marks = $request->ct3_marks;
        $ct1_obtained = $request->ct1_obtained;
        $ct2_obtained = $request->ct2_obtained;
        $ct3_obtained = $request->ct3_obtained;
        $ct1_weighted = $request->ct1_weighted;
        $ct2_weighted = $request->ct2_weighted;
        $ct3_weighted = $request->ct3_weighted;

        if ($ct_marks == null || $ct1_marks == null || $ct2_marks == null || $ct1_obtained == null || $ct2_obtained == null) {
            $ct_weighted = null;
        } else {
            $ct1_weighted = ($ct_marks * $ct1_obtained) / $ct1_marks;
            $ct2_weighted = ($ct_marks * $ct2_obtained) / $ct2_marks;

            if ($request->ct == "Best One") {
                if ($ct3_obtained == null) {
                    $ct_weighted = max($ct1_weighted, $ct2_weighted);
                } else {
                    $ct3_weighted = ($ct_marks * $ct3_obtained) / $ct3_marks;
                    $ct_weighted = max($ct1_weighted, $ct2_weighted, $ct3_weighted);
                }
            } elseif ($request->ct == "Best Two(Average)") {
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
        $mid_obtained = $request->mid_obtained;

//----- FINAL -----//
        $final_obtained = $request->final_obtained;

//----- TOTAL -----//
        if ($att_weighted == null || $ct_weighted == null || $mid_obtained == null || $final_obtained == null) {
            $total_weighted = null;
            $letter_grade = null;
        } else {
            $total_marks = $request->att_marks + $request->ct_marks + $request->mid_marks + $request->final_marks;
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

        try {
            $result->update([
                'offered_courses_id' => $request->offered_courses_id,
                'tea_id' => $request->tea_id,
                'att_days' => $request->att_days,
                'ct1_obtained' => $request->ct1_obtained,
                'ct2_obtained' => $request->ct2_obtained,
                'ct3_obtained' => $request->ct3_obtained,
                'mid_obtained' => $request->mid_obtained,
                'final_obtained' => $request->final_obtained,
                'ct' => $request->ct,
                'att_weighted' => $att_weighted,
                'ct1_weighted' => $ct1_weighted,
                'ct2_weighted' => $ct2_weighted,
                'ct3_weighted' => $ct3_weighted,
                'ct_weighted' => $ct_weighted,
                'total_weighted' => $total_weighted,
                'letter_grade' => $letter_grade,
                'stu_id' => $request->stu_id,
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect("admins/teacher/my-course/course/$request->offered_courses_id/edit")->with('err', 'Entered Student ID is Invalid.');
        }

        return redirect("admins/teacher/my-course/course/$request->offered_courses_id");
    }


    public function excel_import(OfferedCourse $offeredCourse)
    {
        require_once __DIR__ . '/../../../public/PHPExcel/Classes/PHPExcel.php';

        $excel = \PHPExcel_IOFactory::load($_FILES['uploadfile']['tmp_name']);

        $excel->setActiveSheetIndex(0);

        $row = 2;   // data starts from 2nd row. first row has header

        while ($excel->getActiveSheet()->getCell('A' . $row)->getValue() != "") {  // until a column is found empty

            $stu_id = $excel->getActiveSheet()->getCell('A' . $row)->getValue();
            $att_days = $excel->getActiveSheet()->getCell('B' . $row)->getValue();
            $ct1_obtained = $excel->getActiveSheet()->getCell('C' . $row)->getValue();
            $ct2_obtained = $excel->getActiveSheet()->getCell('D' . $row)->getValue();
            $ct3_obtained = $excel->getActiveSheet()->getCell('E' . $row)->getValue();
            $mid_obtained = $excel->getActiveSheet()->getCell('F' . $row)->getValue();
            $final_obtained = $excel->getActiveSheet()->getCell('G' . $row)->getValue();

            try {
                Result::create([
                    'offered_courses_id' => $offeredCourse->id,
                    'stu_id' => $stu_id,
                    'att_days' => $att_days,
                    'ct1_obtained' => $ct1_obtained,
                    'ct2_obtained' => $ct2_obtained,
                    'ct3_obtained' => $ct3_obtained,
                    'mid_obtained' => $mid_obtained,
                    'final_obtained' => $final_obtained,
                    'ct' => $offeredCourse->ct,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {

                return redirect("admins/teacher/my-course/course/$offeredCourse->id")->with('err', 'One or more Student ID(s) is/are Invalid.');
            }
            $row++;
        }

        return redirect("admins/teacher/my-course/course/$offeredCourse->id");
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect("admins/teacher/my-course/course/$result->offered_courses_id");
    }
}