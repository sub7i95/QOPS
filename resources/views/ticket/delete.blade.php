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
        <h1>Tickets > Delete <small></small></h1>
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
    <!-- END PAGE TOOLBAR -->
</div>
<!-- END PAGE HEAD-->
<form class="forms form-horizontal ajax-form-delete" method="post" action="/tickets/search" >
{{ csrf_field() }}

    <div class="row">
        <div class="col-md-4">
           <h2> Ticket has been deleted</h2>
        </div>
    </div>



    </div>
</div>

</div>
</div>
</form>  

<!-- END PAGE BASE CONTENT -->


@endsection

@section('scripts')
<script type="text/javascript">
//
$().submit()
</script>
@endsection