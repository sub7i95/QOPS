@extends('layouts.app')
@section('content')
@include('user.header')
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-users me-2"></i> Users / Create
        </div>
        <div class="card-body">


            <form name="form-user" id="form-user" class="form form-horizontal ajax-form-user" role="form" action="/users/create" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="first_name">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="first name" name="first_name"
                                id="first_name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="last name" name="last_name"
                                id="last_name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="email" name="email" id="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="password" name="password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="role_id">Role</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="role_id" id="role_id">
                                <option value="3">Agent</option>
                                <option value="4">QA Analyst</option>
                                <option value="5">QA Manager</option>
                                <option value="2">Power User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="active">Status</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="active" id="active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <span class="showError alert-danger"></span>

                </div>                
                <div class="row mt-2">
                    <div class="col">
                        <a class="btn btn-secondary" href="/users"><i class="fa-solid fa-chevron-left me-1"></i> Back </a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection
