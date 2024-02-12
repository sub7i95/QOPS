@extends('layouts.app')
@section('content')
<form class="form form-horizontal ajax-form-items" role="form" action="/tickets/{{$ticket->id}}" method="post" >
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="id" id="id" value="0" >
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
        <h4>Ref# {{ $ticket->ref_number}}  <small></small>
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
@include('ticket.form.buttons')   
</div>
<!-- END PAGE HEAD-->
<Br>
@include('ticket.template.details')
@include('ticket.template.scc')
@include('ticket.template.results')
@include('ticket.form.buttons')   
</form>        
@include('ticket.modal.start')
@include('ticket.modal.activity')
@endsection
@section('scripts')
<script type="text/javascript">
var options = {
    url: function(phrase) 
    {
        return api+"/qusers?phrase=" + phrase + "&format=json";
    },
    getValue: "name"
};
$(".input-get-name").easyAutocomplete(options);


$('.btn-delete-ticket-id').on('click', function(e) 
{
    e.preventDefault();   
    if( confirm('Are you sure you want to delete?\nNO undo possible! ') ) 
    {
        $.post( $(this).data("url") )
        .done(function( response ) {
            window.location = "/tickets/delete";
      });
      return false;
    }
});

</script>
@endsection