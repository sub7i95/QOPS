@extends('layouts.app')
@section('content')
@include('group.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-users me-2"></i> Groups
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-primary btn-user-add" href="/groups/create">
                    <i class="fa-solid fa-plus me-1"></i> Add New
                </a>
            </div>
        </div>
    </div>        
  <div class="card-body">
<!-- BEGIN CONTENT PAGE -->

    
<div class="row ">
    <div class="col-md-12">
        
    <table id="tableGroups" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >

        <thead>
            <tr>
                <th></th>
                <th> ID </th>
                <th> Name </th>
                <th> Parent </th>
                <th> Status </th>
            </tr>
        </thead>
        @foreach($groups as $group)
            <tr>
                <td> <a href="/groups/{{$group->id}}/edit"> Edit </a> </td>
                <td> {{ $group->id }} </td>
                <td> {{ $group->name }} </td>
                <td> {{ $group->parent }} </td>
                <td>
                            @if ($group->active == 1)
                            <span class="badge text-bg-success">Active</span>
                            @else
                            <span class="badge text-bg-danger">Inactive</span>
                            @endif
                </td>
            </tr>
        @endforeach
    </table>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->


@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection