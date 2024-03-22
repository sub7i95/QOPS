@extends('layouts.app')
@section('content')
@include('group.header')
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-users me-2"></i> Groups / Edit
    </div>
    <div class="card-body">
        <form name="" id="" class="form form-horizontal " role="form" action="{{ url("groups/{$group->id}/edit") }}" method="post">
            {!! csrf_field() !!}
            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Group Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="group name" name="name" required="" value="{{ $group->name}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Parent</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="parent" id="parent" required="">
                                <option value="">-select-</option>
                                <option value="SCC" @if( $group->parent=="SCC") selected @endif> SCC</option>
                                <option value="SSD" @if( $group->parent=="SSD") selected @endif> SSD</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">Parent</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="active" id="active" required>
                                <option value="1" @if( $group->parent=="1") selected @endif> Active</option>
                                <option value="0" @if( $group->parent=="0") selected @endif> Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a class="btn btn-secondary" href="{{ url('groups') }}"><i class="fa-solid fa-chevron-left "></i> Back</a>
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
