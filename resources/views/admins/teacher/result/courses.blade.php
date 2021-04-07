@extends("admins.teacher.layout")

@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{url("admins/teacher/my-course")}}">
                <i class="fa fa-book"></i> <span>My Courses</span>
            </a>
        </li>
        <li class="active">
            <a href="{{url("admins/teacher/result")}}">
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
        <th>PROGRAM CODE</th>
        <th>YEAR</th>
        <th>SEMESTER</th>
    </tr>
@endsection


@section("tr2")
    @foreach($offeredCourses as $offeredCourse)
        <tr>
            <td><a href="{{url("admins/teacher/result/$offeredCourse->id")}}">{{$offeredCourse->course_code}}</a></td>
            <td>{{$offeredCourse->prog_code}}</td>
            <td>{{$offeredCourse->year}}</td>
            <td>{{$offeredCourse->semester}}</td>
        </tr>
    @endforeach
@endsection

@section("pagination")

    {{$offeredCourses->links()}}

@endsection


