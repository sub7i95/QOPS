@extends('layouts.app')
@section('content')
@include('user.header')
<div class="card">
    <div class="card-header">
        Edit
    </div>
    <div class="card-body">
        <form class="form" method="post">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label" for="first_name">First Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="first name" name="first_name" id="first_name" value="{{$user->first_name}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="last_name">Last Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="last name" name="last_name" id="last_name" value="{{$user->last_name}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="email">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" placeholder="email" name="email" id="email" value="{{$user->email}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="role_id">Role</label>
                <div class="col-sm-8">
                    <select class="form-select" name="role_id" id="role_id">
                        <option value="3" @if ($user->role_id == 3) selected @endif>Agent</option>
                        <option value="4" @if ($user->role_id == 4) selected @endif>QA Analyst</option>
                        <option value="5" @if ($user->role_id == 5) selected @endif>QA Manager</option>
                        <option value="2" @if ($user->role_id == 2) selected @endif>Power User</option>
                        <option value="1" @if ($user->role_id == 1) selected @endif>Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="active">Status</label>
                <div class="col-sm-8">
                    <select class="form-select" name="active" id="active">
                        <option value="1" @if ($user->active == 1) selected @endif>Active</option>
                        <option value="0" @if ($user->active == 0) selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <a class="btn btn-secondary" href="{{ url('users') }}"><i class="fa-solid fa-chevron-left me-1"></i> Back </a>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        Change Password
    </div>
    <div class="card-body">
        <form name="" id="" class="form form-horizontal " role="form" action="{{ url("users/{$user->id}/password") }}" method="post">
            {!! csrf_field() !!}
            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="first_name">Password </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="" name="password" required="" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="" name="password_confirmation" required="" value="" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-2">
                <div class="col">
                    <a class="btn btn-secondary" href="{{ url('users') }}"><i class="fa-solid fa-chevron-left me-1"></i> Back </a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//

</script>
@endsection
