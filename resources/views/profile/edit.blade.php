@extends('layouts.app')
@section('content')
<h1 class="mt-5">Profile</h1>
@if (\Session::has('message'))
<div class="alert alert-success py-2 text-center my-2" role="alert">
    <span class="font-weight-bold">{!! \Session::get('message') !!}</span>
</div>
@endif
@if( $errors->any() )
<div class="alert   alert-danger rounded py-2  my-2 ">
    <ul class="list-unstyled m-0 p-2">
        @foreach ($errors->all() as $error)
        <li class="font-weight-bold unlisted">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-user me-2"></i> Profile / Edit 
    </div>    
    <div class="card-body">
        <form name="" id="" class="form form-horizontal " role="form" action="{{ url('profile') }}" method="post">
            {!! csrf_field() !!}
            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="first_name">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="first_name" name="first_name" required="" value="{{ auth()->user()->first_name }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="last_name" name="last_name" required="" value="{{ auth()->user()->last_name }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="email" name="email" required="" value="{{ auth()->user()->email }}" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <i class="fa-solid fa-user me-2"></i> Profile / Password 
    </div>       
    <div class="card-body">
        <form name="" id="" class="form form-horizontal " role="form" action="{{ url('/profile/password') }}" method="post">
            {!! csrf_field() !!}
            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="first_name">Password </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="" name="password" required="" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="" name="password_confirmation" required="" value="" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//

</script>
@endsection
