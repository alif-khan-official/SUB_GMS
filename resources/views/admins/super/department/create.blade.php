@extends("admins.super.layout")

@section("add")
    <a href="{{url('admins/super/department')}}">
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
        <li class="active">
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
        Add Department
    </h1>
@endsection


@section("tr1")
    <form action="{{url('admins/super/department')}}" method="post">
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label for="department_code">Department Code</label>
                <input type="text" name="department_code" class="form-control" id="department_code"
                       value="{{old("department_code")}}">

                @if($errors->has('department_code')) <p
                        style="color:red;"> @foreach( $errors->get('department_code') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="dept_name">Department Name</label>
                <input type="text" name="dept_name" class="form-control" id="dept_name" value="{{old("dept_name")}}">

                @if($errors->has('dept_name')) <p
                        style="color:red;"> @foreach( $errors->get('dept_name') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection