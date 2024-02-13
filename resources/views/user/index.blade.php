@extends('layouts.app')
@section('content')
@include('user.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-users me-2"></i> Users
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-primary btn-user-add" href="/users/create">
                    <i class="fa-solid fa-plus me-1"></i> New
                </a>
            </div>
        </div>
    </div>    
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">    
            <table id="tableUsers" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >
            <thead>
                <tr>
                    <th></th>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th> Status </th>
                </tr>
            </thead>
                <Tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td><a href="/users/{{$user->id}}/edit">Edit</a></td>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            @if ($user->active == 1)
                            <span class="badge text-bg-success">Active</span>
                            @else
                            <span class="badge text-bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </Tbody>
            </table>  
            
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//
</script>
@endsection