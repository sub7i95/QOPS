@extends('layouts.app')
@section('content')
@include('survey.header')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-puzzle-piece me-2"></i> Survey Area Edit
            </div>
        </div>
    </div>        
  <div class="card-body">


 



        <form class="form " action="{{ URL::to('surveys') }}/{{ $sid}}/areas/{{ $area->id }}" method="post" >
         {{ csrf_field() }}

                <div class="row">
                  <div class="col-md-8">
                    
                        <label class="control-label" for="name"> Name </label>
                        <input  type="text" name="name" placeholder="Enter Name" required class="form-control" value="{{ $area->name }}">
                    
                </div>
                  <div class="col-md-2">
                        
                        <label class="control-label" for="name"> Position </label>
                        <input  type="text" name="position" placeholder="Enter position" required class="form-control" value="{{ $area->position }}">
                        
                    </div>
                </div><!-- / col-md-6-->

  

                </div>
                <div class="row mt-2">
                <div class="col">
                <a class="btn btn-secondary" href="javascript:history.back();"><i class="fa-solid fa-chevron-left me-1"></i> Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>

</div>
<!-- END PAGE BASE CONTENT -->



@endsection

@section('scripts')
<script type="text/javascript">




</script>
@endsection