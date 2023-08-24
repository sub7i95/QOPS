@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">        
            <div class="actions pull-right">
                <a class="btn btn-success btn-user-add" href="/users/create">
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
                        <td>@if ($user->active == 1)
                            Active
                            @else
                            Inactive
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </Tbody>
            </table>  
            {{ $users->links() }}  
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