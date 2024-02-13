@extends('layouts.app')
@section('content')
@include('ticket.header')

<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Search
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>    
    <div class="card-body">
        <form name="" method="post" action="{{ url("tickets") }}">
        @csrf
        <div class="row mb-2">
            <div class="col-md-3">
                <label>Status</label>
                <select class="form-select" name="status">
                    <option value="">All</option>
                </select>
            </div>
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
        </div>
        <div class="row">
            <div class="col-m-12">
                <button class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass me-2"></i> Search</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-ticket me-2"></i> Tickets
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="table-tickets" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]'>
            <thead>
                <tr>
                    <th> <input class="form-check-input" type="checkbox" name="select-all" id="selectAll"> </th>
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
                    <td> <input class="form-check-input" type="checkbox" value="{{ $ticket->id }}" name="ref_number"> </td>
                    <td><a href="/tickets/{{ $ticket->id }}/show" class=""><i class="icon-eye"></i> View</a></td>
                    <td> {{ $ticket->ref_number }} </td>
                    <td> {{ $ticket->survey }} </td>
                    <td> {{ $ticket->service }} </td>
                    <td> {{ $ticket->requester }} </td>
                    <td> {{ $ticket->resolver_group }} </td>
                    <td> {{ $ticket->reported_by }} </td>
                    <td> {{ $ticket->priority }} </td>
                    <td class="text-nowrap"> {{ $ticket->closed_date }} </td>
                    <td> {{ $ticket->coached==1 ? 'YES' : "" }} </td>
                    <td><span class="badge text-white text-bg-{{$ticket->status_color}}"> {{ $ticket->status_name }} </span> </td>
                    <td> {{ $ticket->score }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
var table = $('#table-tickets'); //main user tables
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
