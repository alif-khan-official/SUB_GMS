@extends("admins.admin.layout")

@section("add")
    <a href="{{url("admins/admin/teacher/create")}}">
        <button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Teacher</button>
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
        Manage Teachers
    </h1>
@endsection


@section("tr1")
    <tr>
        <th>TEACHER ID</th>
        <th>DEPARTMENT CODE</th>
        <th style="width: 40px; border:none !important;">OPTIONS</th>
        <th style="width: 40px; border:none !important;"></th>
    </tr>
@endsection


@section("tr2")
    @foreach($teachers as $teacher)
        <tr>
            <td>{{$teacher->users_id}}</td>
            <td>{{$teacher->department_code}}</td>
            <td>
                <a href="{{url("admins/admin/teacher/$teacher->id/edit")}}">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                    </button>
                </a>
            </td>
            <td>
                <form action="{{url("admins/admin/teacher/$teacher->id")}}" method="post"
                      onsubmit="return confirm('Are you sure to delete this record?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
@endsection

@section("pagination")

    {{$teachers->links()}}

@endsection