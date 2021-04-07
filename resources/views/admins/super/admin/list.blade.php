@extends("admins.super.layout")

@section("add")
    <a href="{{url("admins/super/admin/create")}}">
        <button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Admin</button>
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
        Manage Admins
    </h1>
@endsection


@section("tr1")
    <tr>
        <th>ADMIN ID</th>
        <th>DEPARTMENT CODE</th>
        <th style="width: 40px; border:none !important;">OPTIONS</th>
        <th style="width: 40px; border:none !important;"></th>
    </tr>
@endsection


@section("tr2")
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->users_id}}</td>
            <td>{{$admin->department_code}}</td>
            <td>
                <a href="{{url("admins/super/admin/$admin->id/edit")}}">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                    </button>
                </a>
            </td>
            <td>
                <form action="{{url("admins/super/admin/$admin->id")}}" method="post"
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

    {{$admins->links()}}

@endsection