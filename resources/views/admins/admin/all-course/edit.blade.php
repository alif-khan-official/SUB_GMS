@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/all-course')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection


@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
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
        <li>
            <a href="{{url("admins/admin/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Edit Course
    </h1>
@endsection


@section("tr1")
    <form action="{{url("admins/admin/all-course/$allCourse->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">
            <div class="form-group">
                <label for="course_code">Course Code</label>
                <input type="text" name="course_code" class="form-control" id="course_code"
                       value="{{old("course_code", $allCourse->course_code)}}">

                @if($errors->has('course_code')) <p
                        style="color:red;"> @foreach( $errors->get('course_code') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" name="course_name" class="form-control" id="course_name"
                       value="{{old("course_name", $allCourse->course_name)}}">

                @if($errors->has('course_name')) <p
                        style="color:red;"> @foreach( $errors->get('course_name') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <label>Course Type:</label><br>
            <input type="radio" id="theory" name="course_type" value="Theory" checked>
            <label for="theory">Theory</label><br>
            <input type="radio" id="lab" name="course_type" value="Lab">
            <label for="lab">Lab</label>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection