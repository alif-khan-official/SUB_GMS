@extends("admins.teacher.layout")

@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{url("admins/teacher/my-course")}}">
                <i class="fa fa-book"></i> <span>My Courses</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/teacher/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection

@section("Manage")
    <h1>
        Manage Courses
    </h1>

    @if (\Session::has('success'))

        <br/>

        <p style="color:green">
            {{ '*'.Session::get('success') }}
        </p>
    @endif
@endsection

@section("tr1")

    <tr>
        <th>COURSE CODE</th>
        <th>DEPARTMENT CODE</th>
        <th>PROGRAM CODE</th>
        <th>YEAR</th>
        <th>SEMESTER</th>
        <th>TOTAL CLASSES</th>
        <th>ATTENDANCE MARK</th>
        <th>CT EVALUATION TYPE</th>
        <th>CT-01 MARK</th>
        <th>CT-02 MARK</th>
        <th>CT-03 MARK</th>
        <th>CT/ LAB PERFORMANCE MARK</th>
        <th>MID-TERM MARK</th>
        <th>FINAL MARK</th>
        <th style="width: 40px; border:none !important;">OPTIONS</th>
        <th style="width: 40px; border:none !important;"></th>
        <th style="width: 40px; border:none !important;"></th>
    </tr>
@endsection

@section("tr2")

    @foreach($offeredCourses as $offeredCourse)

        <tr>

            @if($offeredCourse->course_type == 'Theory')

                <td>
                    <a href="{{url("admins/teacher/my-course/course/$offeredCourse->id")}}">{{$offeredCourse->course_code}}</a>
                </td>
                <td>{{$offeredCourse->department_code}}</td>
                <td>{{$offeredCourse->prog_code}}</td>
                <td>{{$offeredCourse->year}}</td>
                <td>{{$offeredCourse->semester}}</td>
                <td>{{$offeredCourse->total_classes}}</td>
                <td>{{$offeredCourse->att_marks}}</td>
                <td>{{$offeredCourse->ct}}</td>
                <td>{{$offeredCourse->ct1_marks}}</td>
                <td>{{$offeredCourse->ct2_marks}}</td>
                <td>{{$offeredCourse->ct3_marks}}</td>
                <td>{{$offeredCourse->ct_marks}}</td>
                <td>{{$offeredCourse->mid_marks}}</td>
                <td>{{$offeredCourse->final_marks}}</td>
                <td>
                    <a href="{{url("admins/teacher/my-course/$offeredCourse->id/edit")}}">
                        <button {{$offeredCourse->status}} class="btn btn-primary btn-sm"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                        </button>
                    </a>

                </td>

                <td>

                    <a href="{{url("admins/teacher/my-course/$offeredCourse->id/refresh")}}">
                        <button {{$offeredCourse->status}} class="btn btn-success btn-sm"><i class="fa fa-refresh"
                                                                                             aria-hidden="true"></i>
                            Recalculate
                        </button>
                    </a>

                </td>

            @else

                <td>
                    <a href="{{url("admins/teacher/my-course/lab_course/$offeredCourse->id")}}">{{$offeredCourse->course_code}}</a>
                </td>
                <td>{{$offeredCourse->department_code}}</td>
                <td>{{$offeredCourse->prog_code}}</td>
                <td>{{$offeredCourse->year}}</td>
                <td>{{$offeredCourse->semester}}</td>
                <td>{{$offeredCourse->total_classes}}</td>
                <td>{{$offeredCourse->att_marks}}</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>{{$offeredCourse->ct_marks}}</td>
                <td>{{$offeredCourse->mid_marks}}</td>
                <td>{{$offeredCourse->final_marks}}</td>
                <td>
                    <a href="{{url("admins/teacher/my-course-lab/$offeredCourse->id/edit")}}">
                        <button {{$offeredCourse->status}} class="btn btn-primary btn-sm"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                        </button>
                    </a>
                </td>

                <td>

                    <a href="{{url("admins/teacher/my-course-lab/$offeredCourse->id/refresh")}}">
                        <button {{$offeredCourse->status}} class="btn btn-success btn-sm"><i class="fa fa-refresh"
                                                                                             aria-hidden="true"></i>
                            Recalculate
                        </button>
                    </a>

                </td>

            @endif

            <td>
                <a href="{{url("admins/teacher/offered-course/status/$offeredCourse->id")}}">
                    <button {{$offeredCourse->status}}  onclick="return confirm('Are you sure that this Course is Finalized?')"
                            class="btn btn-warning btn-sm"><i class="fa fa-check"
                                                              aria-hidden="true"></i> Finalize
                    </button>
                </a>
            </td>

        </tr>
    @endforeach

@endsection

@section('pagination')

    {{$offeredCourses->links()}}

@endsection