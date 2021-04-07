@extends('custom_auth.customapp')
@section('title', 'Registration Form')
@section('content')
    <div class="container">
        <div class="panel-heading">Custom Registration</div><hr>
        @if( session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all(':message <br>')) !!}
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{url('admins/super/admin')}}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('dept_code') ? ' has-error' : '' }}">
                <label for="dept_code" class="col-md-4 control-label">dept_code</label>
                <div class="col-md-6">
                    <input id="dept_codee" type="text" class="form-control" name="dept_code" value="{{ old('dept_code') }}" autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('ad_id') ? ' has-error' : '' }}">
                <label for="ad_id" class="col-md-4 control-label">ad_id</label>
                <div class="col-md-6">
                    <input id="ad_id" type="text" class="form-control" name="ad_id" value="{{ old('ad_id') }}" required>
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection