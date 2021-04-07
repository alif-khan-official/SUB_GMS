@extends("admins.super.layout")

@section("add")
    <a href="{{url('admins/super/admin')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection


@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
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
        <li>
            <a href="{{url("admins/super/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Edit Admin
    </h1>
@endsection


@section("tr1")
    <form action="{{url("admins/super/admin/$admin->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">

            <div class="form-group">
                <label for="users_id">Admin ID</label>
                <input type="text" name="users_id" class="form-control" id="users_id"
                       value="{{old("users_id", $admin->users_id)}}">

                @if($errors->has('users_id')) <p
                        style="color:red;"> @foreach( $errors->get('users_id') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="password">Admin Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       value="{{old($admin->password)}}">

                @if($errors->has('password')) <p
                        style="color:red;"> @foreach( $errors->get('password') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="department_id">Department Code</label>
                <select name="department_id" class="form-control" id="department_id">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->department_code}}</option>
                    @endforeach
                </select>

                @if($errors->has('department_id')) <p
                        style="color:red;"> @foreach( $errors->get('department_id') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection