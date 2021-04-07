@extends("admins.admin.layout")

@section("add")
    <a href="{{url("admins/admin/offered-course/create")}}">
        <button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Offer Course</button>
    </a>
@endsection


@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{url("admins/admin/all-course")}}">
                <i class="fa fa-book"></i> <span>All Courses</span>
            </a>
        </li>
        <li class="active">
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
        <li>
            <a href="{{url("admins/admin/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Manage Courses
    </h1>
@endsection


@section("tr1")
    <tr>
        <th>COURSE CODE</th>
        <th>COURSE TYPE</th>
        <th>OFFERED TO</th>
        <th>DEPARTMENT CODE</th>
        <th>PROGRAM CODE</th>
        <th>YEAR</th>
        <th>SEMESTER</th>
        <th style="width: 40px; border:none !important;">OPTIONS</th>
        <th style="width: 40px; border:none !important;"></th>
    </tr>
@endsection


@section("tr2")
    @foreach($offeredCourses as $offeredCourse)
        <tr>
            <td>{{$offeredCourse->course_code}}</td>
            <td>{{$offeredCourse->course_type}}</td>
            <td>{{$offeredCourse->users_id}}</td>
            <td>{{$offeredCourse->department_code}}</td>
            <td>{{$offeredCourse->prog_code}}</td>
            <td>{{$offeredCourse->year}}</td>
            <td>{{$offeredCourse->semester}}</td>
            <td>
                <a href="{{url("admins/admin/offered-course/$offeredCourse->id/edit")}}">
                    <button {{$offeredCourse->status}} class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                         aria-hidden="true"></i> Edit
                    </button>
                </a>
            </td>
            <td>
                <form action="{{url("admins/admin/offered-course/$offeredCourse->id")}}" method="post"
                      onsubmit="return confirm('Are you sure to delete this record?')">
                    @csrf
                    @method('DELETE')
                    <button {{$offeredCourse->status}} class="btn btn-danger btn-sm"><i class="fa fa-trash-o"
                                                                                        aria-hidden="true"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
@endsection

@section("pagination")

    {{$offeredCourses->links()}}

@endsection