@extends("admins.teacher.layout")

@section("add")

    <div class="form-group">
        <a href="{{url("/sample/Lab.xlsx")}}">
            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download" aria-hidden="true"></i>
                Download Sample Excel File
            </button>
        </a>
    </div>

    <form action="{{url("admins/teacher/my-course/lab_course/$offeredCourse->id")}}" enctype="multipart/form-data"
          method="post">
        @csrf
        <div class="form-group">
            <label for="file">Import From Excel File (.xls/ .xlsx)</label>
            <input type="file" name="uploadfile" class="form-control" id="file" required>
        </div>

        <button {{$offeredCourse->status}} type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"
                                                                                           aria-hidden="true"></i>
            Import
        </button>
    </form>


    <br/>
    <br/>

    <a href="{{url("admins/teacher/my-course/lab_course/$offeredCourse->id/create")}}">
        <button {{$offeredCourse->status}} class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
            Add Student
        </button>
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
        {{$allCourse}}
    </h1>

    @if (\Session::has('err'))

        <br/>

        <p style="color:red">
            {{ '*'.Session::get('err') }}
        </p>
    @endif
@endsection


@section("tr1")
    <tr>
        <th>STUDENT ID</th>
        <th>TOTAL CLASSES</th>
        <th>ATTENDANCE MARK</th>
        <th>LAB PERFORMANCE MARK</th>
        <th>MID-TERM MARK</th>
        <th>FINAL MARK</th>
        <th>TOTAL CLASSES Attended</th>
        <th>LAB PERFORMANCE OBTAINED MARK</th>
        <th>MID-TERM OBTAINED MARK</th>
        <th>FINAL OBTAINED MARK</th>
        <th>LETTER GRADE</th>
        <th style="width: 40px; border:none !important;">OPTIONS</th>
        <th style="width: 40px; border:none !important;"></th>
    </tr>
@endsection


@section("tr2")
    @foreach($results as $result)
        <tr>
            <td>{{$result->stu_id}}</td>
            <td>{{$offeredCourse->total_classes}}</td>
            <td>{{$offeredCourse->att_marks}}</td>
            <td>{{$offeredCourse->ct_marks}}</td>
            <td>{{$offeredCourse->mid_marks}}</td>
            <td>{{$offeredCourse->final_marks}}</td>
            <td>{{$result->att_days}}</td>
            <td>{{$result->ct_weighted}}</td>
            <td>{{$result->mid_obtained}}</td>
            <td>{{$result->final_obtained}}</td>
            <td>{{$result->letter_grade}}</td>
            <td>
                <a href="{{url("admins/teacher/my-course/lab_course/$result->id/edit")}}">
                    <button {{$offeredCourse->status}} id="edit" class="btn btn-primary btn-sm"><i
                                class="fa fa-pencil-square-o"
                                aria-hidden="true"></i> Edit
                    </button>
                </a>
            </td>
            <td>
                <form action="{{url("admins/teacher/my-course/lab_course/$result->id")}}" method="post"
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

    {{$results->links()}}

@endsection