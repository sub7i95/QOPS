@extends('layouts.app')
@section('content')
@include('survey.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-puzzle-piece me-2"></i> Surveys
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-primary btn-user-add" href="/surveys/create">
                    <i class="fa-solid fa-plus me-1"></i> Add New
                </a>
            </div>
        </div>
    </div>        
  <div class="card-body">

    <div class="row ">
        <div class="col-md-12">    
            <table id="tableSurveys" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >
            <thead>
                <tr>
                    <th></th>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Owner </th>
                    <th> Process </th>
                    <th> Status </th>
                </tr>
            </thead>
                <Tbody>
                    @foreach ($surveys as $survey)
                    <tr>
                        <td><a href="/surveys/{{$survey->id}}/edit">Edit</a></td>
                        <td>{{$survey->id}}</td>
                        <td>{{$survey->name}}</td>
                        <td>{{$survey->owner}}</td>
                        <td>{{$survey->process}}</td>
                        <td>
                            @if ($survey->active == 1)
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