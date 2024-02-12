@extends('layouts.app')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ __('Change Password') }}</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('update_password') }}">
                    @csrf
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-group mb-10">
                            <label for="oldPasswordInput">Old Password</label> 
                            <input name="old_password" type="password" placeholder="Enter Old Password" class="form-control @if($errors->has('old_password')) is-invalid @endif" id="oldPasswordInput">
                            @if($errors->has('old_password'))
                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-10">
                            <label for="newPasswordInput">New Password</label> 
                            <input name="new_password" type="password" placeholder="Enter New Password" class="form-control @if($errors->has('new_password')) is-invalid @endif" id="newPasswordInput">
                            @if($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-10">
                            <label for="confirmedPasswordInput">Confirm New Password</label> 
                            <input name="new_password_confirmation" type="password" placeholder="Confirm New Password" class="form-control" id="confirmedPasswordInput">
                        </div>
                        <div align="right" class="mt-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .is-invalid {
        border-color: red;
    }
</style>

@endsection