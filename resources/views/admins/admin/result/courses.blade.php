@extends("admins.admin.layout")

@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{url("admins/admin/all-course")}}">
                <i class="fa fa-book"></i> <span>All Courses</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/admin/offered-course")}}">
                <i class="fa fa-pencil"></i> <span>Offered Courses</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/admin/teacher")}}">
                <i class="fa fa-user"></i> <span>Teachers</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/admin/student")}}">
                <i class="fa fa-users"></i> <span>Students</span>
            </a>
        </li>
        <li class="active">
            <a href="{{url("admins/admin/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Results
    </h1>
@endsection

@section("Filter")

    <form action="{{url("admins/admin/result/filtered")}}" method="get">

        <div class="box-body">

            <div class="row">

                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <select name="course_code" class="form-control" id="course_code">
                            @foreach($courses as $course)
                                <option value="{{$course->course_code}}">{{$course->course_code}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('course_code')) <p
                                style="color:red;"> @foreach( $errors->get('course_code') as $error) {{ $error }}
                            <br/> @endforeach </p> @endif
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select name="year" class="form-control" id="year">
                            @foreach($years as $year)
                                <option value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('year')) <p
                                style="color:red;"> @foreach( $errors->get('year') as $error) {{ $error }}
                            <br/> @endforeach </p> @endif
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" class="form-control" id="semester">
                            @foreach($semesters as $semester)
                                <option value="{{$semester->semester}}">{{$semester->semester}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('semester')) <p
                                style="color:red;"> @foreach( $errors->get('semester') as $error) {{ $error }}
                            <br/> @endforeach </p> @endif
                    </div>
                </div>

                <div class="col-xs-12">
                    <div style="float: right;">

                        <button type="submit" class="btn btn-primary">Filter</button>

                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection


@section("tr1")
    <tr>
        <th>COURSE CODE</th>
        <th>DEPARTMENT CODE</th>
        <th>PROGRAM CODE</th>
        <th>YEAR</th>
        <th>SEMESTER</th>
    </tr>
@endsection


@section("tr2")
    @foreach($offeredCourses as $offeredCourse)
        <tr>
            <td><a href="{{url("admins/admin/result/$offeredCourse->id")}}">{{$offeredCourse->course_code}}</a></td>
            <td>{{$offeredCourse->department_code}}</td>
            <td>{{$offeredCourse->prog_code}}</td>
            <td>{{$offeredCourse->year}}</td>
            <td>{{$offeredCourse->semester}}</td>
        </tr>
    @endforeach

@endsection

@section("pagination")

    {{$offeredCourses->links()}}

@endsection