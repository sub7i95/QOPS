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
            <table id="tableModules" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >
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
                    <td> <a href="/services/{{$service->id}}/edit"> Edit </a> </td>
                
                    <td> {{ $service->id }} </td>
                    <td> {{ $service->name }} </td>
                    <td>  </td>
                    <td>
                            @if ($service->active == 1)
                            <span class="badge text-bg-success">Active</span>
                            @else
                            <span class="badge text-bg-danger">Inactive</span>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
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