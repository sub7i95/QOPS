@extends('layouts.app')
@section('content')

<!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <!-- BEGIN PAGE BREADCRUMB  -->
    <!--
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="./">Home</a> / 
        </li>
        <li>
            <span class="active">User</span>
        </li>
    </ul>
    -->
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h4>Start Assesment <small> </small>
        </h4>
    </div>
    <!-- END PAGE TITLE -->
    <!-- BEGIN PAGE TOOLBAR 
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
-->

</div>
<!-- END PAGE HEAD-->
<Br>

@if($id==1)
    @include('ticket.form.create_avaya')
@elseif($id==2)
    @include('ticket.form.create_inc_ssd')
@elseif($id==3)
    @include('ticket.form.create_inc_scc')
@else
    @include('ticket.form.default')
@endif


@endsection
@section('scripts')
<script type="text/javascript">
//
</script>
@endsection