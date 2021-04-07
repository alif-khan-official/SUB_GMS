@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/offered-course')}}">
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
        Edit Course
    </h1>

    <p style="color:red">

        <br/>

        @foreach($errors->all() as $error)
            {{$error}}<br/>
        @endforeach
    </p>
@endsection


@section("tr1")
    <form action="{{url("admins/admin/offered-course/$offeredCourse->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">

            <div class="form-group">
                <label for="all_course_id">Course Code</label>
                <select name="all_course_id" class="form-control" id="all_course_id">
                    @foreach($allCourses as $allCourse)
                        <option value="{{$allCourse->id}}">{{$allCourse->course_code}}</option>
                    @endforeach
                </select>

                @if($errors->has('all_course_id')) <p
                        style="color:red;"> @foreach( $errors->get('all_course_id') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>
            <div class="form-group">
                <label for="user_id">Teacher ID</label>
                <select name="user_id" class="form-control" id="user_id">
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->users_id}}</option>
                    @endforeach
                </select>

                @if($errors->has('user_id')) <p
                        style="color:red;"> @foreach( $errors->get('user_id') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="program_id">Program Code</label>
                <select name="program_id" class="form-control" id="program_id">
                    @foreach($programs as $program)
                        <option value="{{$program->id}}">{{$program->prog_code}}</option>
                    @endforeach
                </select>

                @if($errors->has('program_id')) <p
                        style="color:red;"> @foreach( $errors->get('program_id') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" name="year" class="form-control" id="year"
                       value="{{old("year", $offeredCourse->year)}}">

                @if($errors->has('year')) <p style="color:red;"> @foreach( $errors->get('year') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" id="semester">
                    <option value="Spring">Spring</option>
                    <option value="Summer">Summer</option>
                    <option value="Fall">Fall</option>
                </select>

                @if($errors->has('semester')) <p
                        style="color:red;"> @foreach( $errors->get('semester') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection