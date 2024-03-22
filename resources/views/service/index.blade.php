@extends('layouts.app')
@section('content')
@include('service.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-book-open-reader me-2"></i> Modules
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-primary btn-sm" href="/services/create">
                    <i class="fa-solid fa-plus me-1"></i>  Create
                </a>
            </div>
        </div>
    </div>        
  <div class="card-body">

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