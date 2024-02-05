@extends('layouts.app')
@section('content')
@include('group.header')
<div class="card">
  <div class="card-body">
<!-- BEGIN CONTENT PAGE -->
<div class="row ">
    <div class="col-md-12">
        <div class="actions pull-right">
            <a class="btn btn-success btn-group-add" href="/groups/create">
                <i class="icon-plus"></i> Add New
            </a>
        </div>
    </div>
</div>
<br>            
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