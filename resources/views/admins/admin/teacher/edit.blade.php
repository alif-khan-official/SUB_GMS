@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/teacher')}}">
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
        <li class="active">
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
        Edit Teacher
    </h1>
@endsection


@section("tr1")
    <form action="{{url("admins/admin/teacher/$teacher->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">
            <div class="form-group">
                <label for="users_id">Teacher ID</label>
                <input type="text" name="users_id" class="form-control" id="users_id"
                       value="{{old("users_id", $teacher->users_id)}}">

                @if($errors->has('users_id')) <p
                        style="color:red;"> @foreach( $errors->get('users_id') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>
            <div class="form-group">
                <label for="password">Teacher Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       value="{{old($teacher->password)}}">

                @if($errors->has('password')) <p
                        style="color:red;"> @foreach( $errors->get('password') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection