@extends('layouts.app')
@section('content')
@include('analyst.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-users me-2"></i> Analysts
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-success btn-user-add" href="/analysts/create">
                    <i class="fa-solid fa-plus me-1"></i> New
                </a>
            </div>
        </div>
    </div>   
    <div class="card-body">
 
        <table id="tableUsers" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >
        <thead>
            <tr>
                <th></th>
                <th> ID </th>
                <th> Name </th>
                <th> Email </th>
                <th> Location </th>
                <th> Status </th>
            </tr>
        </thead>
            <Tbody>
                @foreach ($analysts as $analyst)
                <tr>
                    <td><a href="/analysts/{{$analyst->id}}/edit">Edit</a></td>
                    <td>{{$analyst->id}}</td>
                    <td>{{$analyst->name}}</td>
                    <td>{{$analyst->email}}</td>
                    <td>{{$analyst->location}}</td>
                    <td>
                        @if ($analyst->active == 1)
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

@endsection
@section('scripts')
<script type="text/javascript">
//
</script>
@endsection