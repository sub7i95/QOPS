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
        <h1>Tickets > Search & Download <small></small></h1>
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

<div class="row ">
    <div class="col-md-12">
        <table id="table-tickets" class="table table-striped table-bordered table-hover table-checkable order-column" >
            <thead>
                <tr>
                    <th></th>
                    <th> ID </th>
                    <th> Service </th>
                    <th> Requester </th>
                    <th> Resolver Group </th>
                    <th> Reported by </th>
                    <th> Priority </th>
                    <th> Status </th>
                    <th> Score </th>
                </tr>
            </thead>
            <tbody>
            @foreach( $tickets as $ticket)
                <tr>
                    <td><a href="/tickets/{{ $ticket->ref_number }}" class="btn btn-circle btn-xs dark btn-outline"><i class="icon-eye"></i> View</a></td>
                    <td> {{ $ticket->ref_number }} </td>
                    <td> {{ $ticket->service }}  </td>
                    <td> {{ $ticket->requester }}  </td>
                    <td> {{ $ticket->resolver_group }}  </td>
                    <td> {{ $ticket->reported_by }}  </td>
                    <td> {{ $ticket->priority }}  </td>
                    <td> {{ $ticket->status_name }}  </td>
                    <td> {{ $ticket->score }}  </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
<script type="text/javascript">

    var table = $('#table-tickets'); //main user table

    table.dataTable({
    "lengthMenu"    : [ [  50, 100, -1], [  50, 100, "All"] ],
    "pageLength"    : 50,
    "iDisplayLength": 50,
    "cache"         : true,     
    });


</script>
@endsection