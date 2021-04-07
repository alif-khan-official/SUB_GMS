@extends("admins.super.layout")



@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{url("admins/super/admin")}}">
                <i class="fa fa-user-circle"></i> <span>Admins</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/super/department")}}">
                <i class="fa fa-university"></i> <span>Departments</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/super/program")}}">
                <i class="fa fa-graduation-cap"></i> <span>Programs</span>
            </a>
        </li>
        <li class="active">
            <a href="{{url("admins/super/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Results
    </h1>

    @if (\Session::has('success'))

        <br/>

        <p style="color:green">
            {{ '*'.Session::get('success') }}
        </p>
    @endif

@endsection

@section("Filter")

    <form action="{{url("admins/super/result/filtered")}}" method="get">

        <div class="box-body">

            <div class="row">

                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="department_code">Department Code</label>
                        <select name="department_code" class="form-control" id="dept_code">
                            @foreach($departments as $department)
                                <option value="{{$department->department_code}}">{{$department->department_code}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('department_code')) <p
                                style="color:red;"> @foreach( $errors->get('department_code') as $error) {{ $error }}
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
        <th style="width: 40px; border:none !important;">OPTION</th>
    </tr>
@endsection


@section("tr2")
    @foreach($offeredCourses as $offeredCourse)
        <tr>
            <td><a href="{{url("admins/super/result/$offeredCourse->id")}}">{{$offeredCourse->course_code}}</a></td>
            <td>{{$offeredCourse->department_code}}</td>
            <td>{{$offeredCourse->prog_code}}</td>
            <td>{{$offeredCourse->year}}</td>
            <td>{{$offeredCourse->semester}}</td>
            <td>
                <a href="{{url("admins/super/result/status/$offeredCourse->id")}}">

                    <button class="btn btn-warning btn-sm"
                            onclick="return confirm('Do you really want to change the Status of this Course?')"><i
                                class="fa fa-unlock" aria-hidden="true"></i> Change Status
                    </button>
                </a>
            </td>
        </tr>
    @endforeach

@endsection

@section("pagination")

    {{$offeredCourses->links()}}

@endsection