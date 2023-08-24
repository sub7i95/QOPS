@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">        
            <div class="actions pull-right">
                <a class="btn btn-success btn-user-add" href="/analysts/create">
                    <i class="icon-plus"></i> Add New
                </a>
            </div>
        </div>
    </div>            
    <br>
    <div class="row ">
        <div class="col-md-12">    
            <table id="tableUsers" class="table table-striped table-bordered table-hover table-checkable order-column" >
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
                        <td>@if ($analyst->active == 1)
                            Active
                            @else
                            Inactive
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </Tbody>
            </table>  
            {{ $analysts->links() }}  
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