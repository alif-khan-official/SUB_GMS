@extends('custom_auth.customapp')

@section('content')

    <br><br><br>

    <div class="container">

        <section>
            @if ( session('error'))
                <div style="text-align: center;" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </section>

        <div class="col-md-4 col-md-offset-4" style="margin: auto;">

            <h2 style="text-align: center;">LOGIN HERE</h2><hr>

            <div style="text-align: center;"><img src="{{url("")}}/dist/img/SUB Logo.png" class="user-image" alt="User Image"></div>

            <br>

            <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <label for="exampleInputemail">USER ID</label>
                <input class="form-control" id="exampleInputemail" value="{{ old('users_id') }}" required autofocus name="users_id">
                <br>
                <label for="exampleInputPassword1">PASSWORD</label>
                <input class="form-control" id="exampleInputPassword1" type="password" required autofocus name="password">
                <br><br>
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection