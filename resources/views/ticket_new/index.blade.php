@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-users me-2"></i> Tickets
            </div>
            <div class="col-md-6 d-flex justify-content-end">

            </div>
        </div>
    </div>    
  <div class="card-body">
    <!-- BEGIN CONTENT PAGE -->
    <div class="row ">
        <div class="col-md-12">    
            <table id="table-tickets" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]' >
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
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//
</script>
@endsection