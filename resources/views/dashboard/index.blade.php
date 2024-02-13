@extends('layouts.app')
@section('content')
@include('dashboard.header')
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-filter  me-2"></i> Filter
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <form name="" method="post" action="{{ url("dashbaord") }}">
            @csrf
            <div class="row mb-2">
                <div class="col-md-3">
                    <label>Module</label>
                    <select class="form-select" name="module">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Requester</label>
                    <select class="form-select" name="requester">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Group</label>
                    <select class="form-select" name="group">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label></label>
                    <button class="btn btn-primary w-100"><i class="fa-solid fa-filter  me-2"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-ticket me-2"></i> Dashbaord
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
</script>
@endsection
