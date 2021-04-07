@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/my-course')}}">
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
        <li class="active">
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
        Edit Student
    </h1>
@endsection



@section("tr1")
    <form action="{{url("admins/admin/student/$student->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">

            <div class="form-group">
                <label for="stu_id">Student ID</label>
                <input type="text" name="stu_id" class="form-control" id="stu_id"
                       value="{{old("stu_id", $student->stu_id)}}">

                @if($errors->has('stu_id')) <p
                        style="color:red;"> @foreach( $errors->get('stu_id') as $error) {{ $error }} <br/> @endforeach
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
                <label for="batch">Batch</label>
                <input type="number" name="batch" class="form-control" id="batch"
                       value="{{old("batch"), $student->batch}}">

                @if($errors->has('batch')) <p
                        style="color:red;"> @foreach( $errors->get('batch') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection

