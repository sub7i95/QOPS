@extends('layouts.app')
@section('content')
@include('analyst.header')
<div class="card">
    <div class="card-header">
        Edit Name
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        <form class="form" method="post">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="name" name="name" id="name" value="{{$analyst->name}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" placeholder="email" name="email" id="email" value="{{$analyst->email}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="location">Location</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="location" name="location" id="location" value="{{$analyst->location}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="active">Status</label>
                    <div class="col-sm-8">
                        <select class="form-select" name="active" id="active">
                            <option value="1" @if ($analyst->active == 1) selected @endif>Active</option>
                            <option value="0" @if ($analyst->active == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <a class="btn btn-secondary" href="/analysts"><i class="fa-solid fa-chevron-left me-1"></i> Back </a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection