@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/result')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection


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