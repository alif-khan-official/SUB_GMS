@extends("admins.teacher.layout")

@section("add")
    <a href="{{url('admins/teacher/my-course')}}">
        <button class="btn btn-primary btn-sm">Back</button>
    </a>
@endsection

@section("sidebar-menu")
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{url("admins/teacher/my-course")}}">
                <i class="fa fa-book"></i> <span>My Courses</span>
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
        Edit Course
    </h1>

    @if($errors->has('total_marks'))

        <br/>

        <p style="color:red">
            @foreach( $errors->get('total_marks') as $error)
                {{ $error }} <br/>
            @endforeach
        </p>
    @endif
@endsection


@section("tr1")
    <form id="thisForm" action="{{url("admins/teacher/my-course/$offeredCourse->id")}}" method="post">
        @csrf
        @method('PATCH')
        <div class="box-body">

            <div class="form-group">
                <label for="all_course_id">Course Code</label>
                <input type="text" class="form-control" id="all_course_id" value="{{$allCourse}}" readonly>
            </div>

            <div class="form-group">
                <label for="department_id">Department Code</label>
                <input type="text" class="form-control" id="department_id" value="{{$department}}" readonly>
            </div>

            <div class="form-group">
                <label for="program_id">Program</label>
                <input type="text" class="form-control" id="program_id" value="{{$program}}" readonly>
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
                <label for="total_classes">Total Classes Taken</label>
                <input type="number" name="total_classes" class="form-control" id="total_classes"
                       value="{{ old("total_classes", $offeredCourse->total_classes)}}">

                @if($errors->has('total_classes')) <p
                        style="color:red;"> @foreach( $errors->get('total_classes') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="att_marks">Attendance Marks</label>
                <input type="number" name="att_marks" class="form-control" id="att_marks"
                       value="{{old("att_marks", $offeredCourse->att_marks)}}">

                @if($errors->has('att_marks')) <p
                        style="color:red;"> @foreach( $errors->get('att_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <label>CT Evaluation Type:</label><br>
            <input type="radio" id="one" name="ct" value="Best One" checked>
            <label for="one">Best One</label><br>
            <input type="radio" id="two" name="ct" value="Best Two(Average)">
            <label for="two">Best Two(Average)</label><br>
            <input type="radio" id="three" name="ct" value="Average of Three">
            <label for="three">Average of Three</label><br><br>

            <div class="form-group">
                <label for="ct1_marks">CT-01 Marks</label>
                <input type="number" name="ct1_marks" class="form-control" id="ct1_marks"
                       value="{{old("ct1_marks", $offeredCourse->ct1_marks)}}">

                @if($errors->has('ct1_marks')) <p
                        style="color:red;"> @foreach( $errors->get('ct1_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="ct2_marks">CT-02 Marks</label>
                <input type="number" name="ct2_marks" class="form-control" id="ct2_marks"
                       value="{{old("ct2_marks", $offeredCourse->ct2_marks)}}">

                @if($errors->has('ct2_marks')) <p
                        style="color:red;"> @foreach( $errors->get('ct2_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="ct3_marks">CT-03 Marks</label>
                <input type="number" name="ct3_marks" class="form-control" id="ct3_marks"
                       value="{{old("ct3_marks", $offeredCourse->ct3_marks)}}">

                @if($errors->has('ct3_marks')) <p
                        style="color:red;"> @foreach( $errors->get('ct3_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="ct_marks">CT Marks</label>
                <input type="number" name="ct_marks" class="form-control" id="ct_marks"
                       value="{{old("ct_marks", $offeredCourse->ct_marks)}}">

                @if($errors->has('ct_marks')) <p
                        style="color:red;"> @foreach( $errors->get('ct_marks') as $error) {{ $error }} <br/> @endforeach
                </p> @endif
            </div>

            <div class="form-group">
                <label for="mid_marks">Mid-Term Marks</label>
                <input type="number" name="mid_marks" class="form-control" id="mid_marks"
                       value="{{old("mid_marks", $offeredCourse->mid_marks)}}">

                @if($errors->has('mid_marks')) <p
                        style="color:red;"> @foreach( $errors->get('mid_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <div class="form-group">
                <label for="final_marks">Final Marks</label>
                <input type="number" name="final_marks" class="form-control" id="final_marks"
                       value="{{old("final_marks", $offeredCourse->final_marks)}}">

                @if($errors->has('final_marks')) <p
                        style="color:red;"> @foreach( $errors->get('final_marks') as $error) {{ $error }}
                    <br/> @endforeach </p> @endif
            </div>

            <input type="hidden" id="total_marks" name="total_marks" value="">

            <script>
                document.getElementById("thisForm").onsubmit = function () {

                    if (!(document.getElementById('att_marks').value) || !(document.getElementById('ct_marks').value) || !(document.getElementById('mid_marks').value) || !(document.getElementById('final_marks').value)) {
                        document.getElementById('total_marks').value = null;
                    } else {

                        document.getElementById('total_marks').value = parseInt(document.getElementById('att_marks').value) + parseInt(document.getElementById('ct_marks').value) + parseInt(document.getElementById('mid_marks').value) + parseInt(document.getElementById('final_marks').value);
                    }
                };
            </script>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

@endsection