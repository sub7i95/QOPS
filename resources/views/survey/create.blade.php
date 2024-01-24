@extends('layouts.app')
@section('content')
@include('survey.header')
<div class="card">
  <div class="card-body">

    <form name="" id="" class="form form-horizontal " role="form" action="/surveys/create"  method="post">
    {!! csrf_field() !!}


            <!-- BEGIN CONTENT PAGE -->          
            <div class="row ">
                <div class="col-md-8">
                                
                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="name">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="name" name="name" required="" />
                            </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="owner">Owner Group</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="owner" id="owner" required="">
                                  <option value="SSD">SSD</option>
                                  <option value="SCC">SCC</option>
                                </select>
                            </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="active">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="active" id="active" required>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                            </div>
                      </div>



                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a class="btn btn-secondary" href="/surveys">< Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
</form>

@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection