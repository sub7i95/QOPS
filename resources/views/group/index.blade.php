@extends('layouts.app')
@section('content')

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
        
    <table id="" class="table table-striped table-bordered table-hover dataTable" >
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
                <td> <a class="btn btn btn-circle btn-xs dark btn-outline" href="/groups/{{$group->id}}/edit"> <i class="icon-pencil"></i> Edit </a> </td>
                <td> {{ $group->id }} </td>
                <td> {{ $group->name }} </td>
                <td> {{ $group->parent }} </td>
                <td> {{ $group->active==1 ? 'Active' : "Inactive"}} </td>
            </tr>
        @endforeach
    </table>
    {{ $groups->links() }}  

    </div>
</div>
<!-- END PAGE BASE CONTENT -->


@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection