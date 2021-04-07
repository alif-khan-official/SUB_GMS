@extends("admins.super.layout")

@section("add")
    <a href="{{url('admins/super/result')}}">
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
        <li class="active">
            <a href="{{url("admins/super/result")}}">
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