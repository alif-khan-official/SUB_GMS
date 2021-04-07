@extends("admins.super.layout")

@section("add")
    <a href="{{url('admins/super/program')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection


@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">}}
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
        <li class="active">
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
        Edit Program
    </h1>
@endsection


@section("tr1")
    <form action="{{url("admins/super/program/$program->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">
            <div class="form-group">
                <label for="prog_code">Program Code</label>
                <input type="text" name="prog_code" class="form-control" id="prog_code"
                       value="{{old("prog_code", $program->prog_code)}}">

                @if($errors->has('prog_code')) <p
                        style="color:red;"> @foreach( $errors->get('prog_code') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>
            <div class="form-group">
                <label for="prog_name">Program Name</label>
                <input type="text" name="prog_name" class="form-control" id="prog_name"
                       value="{{old("prog_name", $program->prog_name)}}">

                @if($errors->has('prog_name')) <p
                        style="color:red;"> @foreach( $errors->get('prog_name') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
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