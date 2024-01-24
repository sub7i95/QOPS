@extends('layouts.app')
@section('content')
@include('service.header')
<div class="card">
  <div class="card-body">

    <form name="" id="" class="form form-horizontal " role="form" action="/services/{{ $service->id}}/edit"  method="post">
    {!! csrf_field() !!}


            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                                
                     <div class="form-group">
                        <label  class="col-sm-3 control-label" for="last_name">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder=" name" name="name" required="" value="{{ $service->name}}" />
                            </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="last_name">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="active" id="active" required>
                                  <option value="1" @if( $service->active=="1") selected @endif> Active</option>
                                  <option value="0" @if( $service->active=="0") selected @endif> Inactive</option>
                                </select>
                            </div>
                      </div>


                </div>
            </div>
            <br>
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