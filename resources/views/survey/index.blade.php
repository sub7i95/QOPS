@extends('layouts.app')
@section('content')
@include('survey.header')
<div class="card">
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">        
            <div class="actions pull-right">
                <a class="btn btn-success btn-user-add" href="/surveys/create">
                    <i class="icon-plus"></i> Add New
                </a>
            </div>
        </div>
    </div>            
    <br>
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