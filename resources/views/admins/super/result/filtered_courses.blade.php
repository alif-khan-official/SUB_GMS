@extends("admins.super.layout")

@section("add")
    <a href="{{url('admins/super/result')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection



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
                <a href="{{url("admins/super/result/filtered/status/$offeredCourse->id")}}">
                    @if($offeredCourse->status == 'disabled')
                        <button class="btn btn-warning btn-sm"
                                onclick="return confirm('Do you really want to change the Status of this Course?')"><i
                                    class="fa fa-unlock" aria-hidden="true"></i> Change Status
                        </button>
                    @else
                        <button disabled class="btn btn-warning btn-sm"
                                onclick="return confirm('Do you really want to change the Status of this Course?')"><i
                                    class="fa fa-unlock" aria-hidden="true"></i> Change Status
                        </button>
                    @endif
                </a>
            </td>
        </tr>
    @endforeach
@endsection

@section("pagination")

    {{$offeredCourses->links()}}

@endsection