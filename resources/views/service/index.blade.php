@extends('layouts.app')
@section('content')
@include('service.header')
<div class="card">
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">        
            <div class="actions pull-right">
                <a class="btn btn-success btn-user-add" href="/services/create">
                    <i class="icon-plus"></i> Add New
                </a>
            </div>
        </div>
    </div>            
    <br>
    <div class="row ">
        <div class="col-md-12">   
 
            
            <table id="" class="table table-striped table-bordered table-hover table-checkable order-column" >
            <thead>
                <tr>
                    <th></th>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Family </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td> <a href="/services/{{$service->id}}/edit" class="btn btn-circle btn-xs dark btn-outline"> <i class="icon-pencil"></i>  Edit </a> </td>
                
                    <td> {{ $service->id }} </td>
                    <td> {{ $service->name }} </td>
                    <td>  </td>
                    <td> {{ $service->active==1 ? 'Active' : "Inactive"}} </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    {{ $services->links() }}  



</div>
</div>

</div>
</div>
<!-- END PAGE BASE CONTENT -->


@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection