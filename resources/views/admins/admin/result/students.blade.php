@extends("admins.admin.layout")

@section("add")
    <a href="{{url('admins/admin/result')}}">
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
        <li>
            <a href="{{url("admins/admin/student")}}">
                <i class="fa fa-users"></i> <span>Students</span>
            </a>
        </li>
        <li class="active">
            <a href="{{url("admins/admin/result")}}">
                <i class="fa fa-id-badge"></i> <span>Results</span>
            </a>
        </li>
    </ul>
@endsection


@section("Manage")
    <h1>
        Results({{$course_code}})
    </h1>
@endsection


@section("tr1")
    <tr>
        <th>STUDENT ID</th>
        <th>ATTENDANCE MARK</th>
        <th>CT/ LAB PERFORMANCE MARK</th>
        <th>MID-TERM MARK</th>
        <th>FINAL MARK</th>
        <th>TOTAL MARK(%)</th>
        <th>LETTER GRADE</th>
    </tr>
@endsection

@section("tr2")
    @foreach($results as $result)
        <tr>
            <td>{{$result->stu_id}}</td>
            <td>{{$result->att_weighted}}</td>
            <td>{{$result->ct_weighted}}</td>
            <td>{{$result->mid_obtained}}</td>
            <td>{{$result->final_obtained}}</td>
            <td>{{$result->total_weighted}}</td>
            <td>{{$result->letter_grade}}</td>
        </tr>
    @endforeach

@endsection

@section("pagination")

    {{$results->links()}}

@endsection