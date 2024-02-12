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
        <h1>Tickets <small></small></h1>
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
<!--
<form class="form" action="">
<input type="hidden" name="q" value="<?=$_GET['q']?>">
<input type="hidden" name="status" value="<?=$_GET['status']?>">
    <div class="row">
        <div class="col-md-3">
            <select class="form-control " name="service" id="service">
                <option value="">- any service -</option>
                <?php $services = App\Ticket::select('service')->whereNotNull('service')->groupBy('service')->get() ?>
                @foreach($services as $service )
                    @if( !empty($service->service))
                        <option value="{{ $service->service }}"  >{{ $service->service }}</option>
                    @endif
                @endforeach
            </select>
        </div>        

    </div>
</form>

<Br>
-->
<!-- BEGIN CONTENT PAGE -->

<!--                     
<button class="btn btn-sm btn-danger" type="submit"  data-loading-text="Please wait..."> Delete </button>
-->

<br>
@if(request()->segment(2)=='requester')
<ul class="nav nav-tabs">
  <li <?php if($_GET['status']==1) { echo 'class="active"'; } ?> ><a href="/tickets/requester?q=<?=$_GET['q'] ?>&status=1"> New </a></li>
  <li <?php if($_GET['status']==2) { echo 'class="active"'; } ?> ><a href="/tickets/requester?q=<?=$_GET['q'] ?>&status=2"> In Process </a></li>
  <li <?php if($_GET['status']==3) { echo 'class="active"'; } ?> ><a href="/tickets/requester?q=<?=$_GET['q'] ?>&status=3"> Completed </a></li>
</ul>
@else
<ul class="nav nav-tabs">
  <li <?php if($_GET['status']==1) { echo 'class="active"'; } ?> ><a href="/tickets/ssd?q=<?=$_GET['q'] ?>&status=1"> New </a></li>
  <li <?php if($_GET['status']==2) { echo 'class="active"'; } ?> ><a href="/tickets/ssd?q=<?=$_GET['q'] ?>&status=2"> In Process </a></li>
  <li <?php if($_GET['status']==3) { echo 'class="active"'; } ?> ><a href="/tickets/ssd?q=<?=$_GET['q'] ?>&status=3"> Completed </a></li>
</ul>
@endif

<br>
 
<div class="row ">
    <div class="col-md-12">
        <table id="table-tickets" class="table table-striped table-bordered table-hover table-checkable order-column" >
            <thead>
                <tr>
                    <th> <input class="form-check-input" type="checkbox" name="select-all" id="selectAll"   >  </th>
                    <th></th>
                    <th> ID </th>
                    <th> Survey </th>
                    <th> Module </th>
                    <th> Requester </th>
                    <th> Resolver Group </th>
                    <th> Reported by </th>
                    <th> Priority </th>
                    <th> Closed </th>
                    <th> Coached </th>
                    <th> Status </th>
                    <th> Score </th>
                </tr>
            </thead>
            <tbody>
            @foreach( $tickets as $ticket)
                <tr>
                    <td> <input class="form-check-input" type="checkbox" value="{{ $ticket->ref_number }}" name="ref_number"> </td>
                    <td><a href="/tickets/{{ $ticket->ref_number }}" class="btn btn-primary btn-xs "><i class="icon-eye"></i> View</a></td>
                    <td> {{ $ticket->ref_number }} </td>
                    <td> {{ $ticket->survey }} </td>
                    <td> {{ $ticket->service }}  </td>
                    <td> {{ $ticket->requester }}  </td>
                    <td> {{ $ticket->resolver_group }}  </td>
                    <td> {{ $ticket->reported_by }}  </td>
                    <td> {{ $ticket->priority }}  </td>
                    <td> {{ $ticket->closed_date }}  </td>
                    <td> {{ $ticket->coached==1 ? 'YES' : "" }}  </td>
                    <td> {{ $ticket->status_name }}  </td>
                    <td> {{ $ticket->score }} </td>
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
    var table = $('#table-tickets'); //main user tables
    table.dataTable({
    "lengthMenu"    : [ [  50, 100, -1], [  50, 100, "All"] ],
    "pageLength"    : 50,
    "iDisplayLength": 50,
    "cache"         : true,     
    });
</script>

<script type="text/javascript">
$('#selectAll').click(function(event) {
if (this.checked) {
        $(':checkbox').prop('checked', true);
    } else {
        $(':checkbox').prop('checked', false);
    }
});
</script>
    
@endsection