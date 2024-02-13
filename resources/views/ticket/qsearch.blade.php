@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Quick Search
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="table-tickets" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]'>
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
                    <td> {{ $ticket->service }} </td>
                    <td> {{ $ticket->requester }} </td>
                    <td> {{ $ticket->resolver_group }} </td>
                    <td> {{ $ticket->reported_by }} </td>
                    <td> {{ $ticket->priority }} </td>
                    <td> {{ $ticket->status_name }} </td>
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
var table = $('#table-tickets'); //main user table

table.dataTable({
    "lengthMenu": [
        [50, 100, -1],
        [50, 100, "All"]
    ],
    "pageLength": 50,
    "iDisplayLength": 50,
    "cache": true,
});

</script>
@endsection
