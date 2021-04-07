@extends("admins.teacher.layout")

@section("add")
    <a href="{{url("admins/teacher/my-course/course/$offeredCourse->id")}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection

@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{url("admins/teacher/my-course")}}">
                <i class="fa fa-pencil"></i> <span>My Courses</span>
            </a>
        </li>
        <li>
            <a href="{{url("admins/teacher/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Add Student
    </h1>

    @if (\Session::has('err'))

        <br/>

        <p style="color:red">
            {{ '*'.Session::get('err') }}
        </p>
    @endif

@endsection


@section("tr1")
    <form action="{{url("admins/teacher/my-course/course")}}" method="post">
        @csrf
        <div class="box-body">

            <input type="hidden" name="offered_courses_id" value={{$offeredCourse->id}}>

            <div class="form-group">
                <label for="course_code">Course Code</label>
                <input type="text" class="form-control" id="course_code" value="{{$allCourse}}" readonly>
            </div>

            <div class="form-group">
                <label for="prog_code">Program</label>
                <input type="text" class="form-control" id="prog_code" value="{{$program}}" readonly>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" value="{{$offeredCourse->year}}" readonly>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" class="form-control" id="semester" value="{{$offeredCourse->semester}}" readonly>
            </div>

            <div class="form-group">
                <label for="stu_id">Student ID</label>
                <input type="text" name="stu_id" class="form-control" id="stu_id" value="{{old("stu_id")}}">

                @if($errors->has('stu_id')) <p
                        style="color:red;"> @foreach( $errors->get('stu_id') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="att_days">Total Classes Attended</label>
                <input type="number" name="att_days" class="form-control" id="att_days" value="{{old("att_days")}}">

                @if($errors->has('att_days')) <p
                        style="color:red;"> @foreach( $errors->get('att_days') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="ct">CT Evaluation Type</label>
                <input type="text" name="ct" class="form-control" id="ct" value="{{$offeredCourse->ct}}" readonly>
            </div>

            <input type="hidden" name="total_classes" value={{$offeredCourse->total_classes}}>
            <input type="hidden" name="att_marks" value={{$offeredCourse->att_marks}}>

            <div class="form-group">
                <label for="ct1_obtained">CT-01 Marks</label>
                <input type="number" name="ct1_obtained" class="form-control" id="ct1_obtained"
                       value="{{old("ct1_obtained")}}">

                @if($errors->has('ct1_obtained')) <p
                        style="color:red;"> @foreach( $errors->get('ct1_obtained') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" name="ct1_marks" value={{$offeredCourse->ct1_marks}}>

            <div class="form-group">
                <label for="ct2_obtained">CT-02 Marks</label>
                <input type="number" name="ct2_obtained" class="form-control" id="ct2_obtained"
                       value="{{old("ct2_obtained")}}">

                @if($errors->has('ct2_obtained')) <p
                        style="color:red;"> @foreach( $errors->get('ct2_obtained') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" name="ct2_marks" value={{$offeredCourse->ct2_marks}}>

            <div class="form-group">
                <label for="ct3_obtained">CT-03 Marks</label>
                <input type="number" name="ct3_obtained" class="form-control" id="ct3_obtained"
                       value="{{old("ct3_obtained")}}">

                @if($errors->has('ct3_obtained')) <p
                        style="color:red;"> @foreach( $errors->get('ct3_obtained') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" name="ct3_marks" value={{$offeredCourse->ct3_marks}}>

            <input type="hidden" name="ct_marks" value={{$offeredCourse->ct_marks}}>

            <div class="form-group">
                <label for="mid_obtained">Mid-Term Marks</label>
                <input type="number" name="mid_obtained" class="form-control" id="mid_obtained"
                       value="{{old("mid_obtained")}}">

                @if($errors->has('mid_obtained')) <p
                        style="color:red;"> @foreach( $errors->get('mid_obtained') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" name="mid_marks" value={{$offeredCourse->mid_marks}}>

            <div class="form-group">
                <label for="final_obtained">Final Marks</label>
                <input type="number" name="final_obtained" class="form-control" id="final_obtained"
                       value="{{old("final_obtained")}}">

                @if($errors->has('final_obtained')) <p
                        style="color:red;"> @foreach( $errors->get('final_obtained') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" name="final_marks" value={{$offeredCourse->final_marks}}>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection