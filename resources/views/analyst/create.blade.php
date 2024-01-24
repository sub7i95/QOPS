@extends('layouts.app')
@section('content')
@include('analyst.header')
    <div class="card">
        <div class="card-header">
            Create Analyst
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <form name="form-user" id="form-user" class="form form-horizontal ajax-form-user" role="form" action="/analysts/create" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="name" name="name"
                                id="name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="email" name="email" id="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="group">Group</label>
                        <div class="col-sm-8">
                            <input type="group" class="form-control" placeholder="group" name="group" id="group" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="location">Location</label>
                        <div class="col-sm-8">
                            <input type="location" class="form-control" placeholder="location" name="location" id="location" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="active">Status</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="active" id="active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <span class="showError alert-danger"></span>

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
