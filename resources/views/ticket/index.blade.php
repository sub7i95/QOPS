@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card mb-4">
    <div class="card-body">
        <form name="" method="get" action="{{ url("tickets") }}">
            <div class="row mb-2">
                <div class="col">
                    <label>Status</label>
                    <select class="form-select" name="status">
                        <option value="">All</option>
                        <option value="1" @if($request_status==1) selected @endif>New</option>
                        <option value="2" @if($request_status==2) selected @endif>In Process</option>
                        <option value="3" @if($request_status==3) selected @endif>Completed</option>
                        <option value="4" @if($request_status==4) selected @endif>Canceled</option>
                    </select>
                </div>
                <div class="col">
                    <label>Module</label>
                    <select class="form-select" name="service">
                        <option value="">All</option>
                        @foreach($services as $service)
                        <option value="{{ $service->name }}" @if($service->name==$request_service) selected @endif >{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Requester</label>
                    <select class="form-select select2" name="requester">
                        <option value="">All</option>
                        @foreach($groups as $group)
                        <option value="{{ $group->name }}" @if($group->name==$request_requester) selected @endif>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Group</label>
                    <select class="form-select select2" name="group">
                        <option value="">All</option>
                        @foreach($groups as $group)
                        <option value="{{ $group->name }}" @if($group->name==$request_group) selected @endif>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label>Open Date From</label>
                    <input type="date" name="open_date_from" class="form-control" value="{{ $open_date_from }}">
                </div>
                <div class="col">
                    <label>Open Date To</label>
                    <input type="date" name="open_date_to" class="form-control" value="{{ $open_date_to }}">
                </div>
                <div class="col">
                    <label>Close Date From</label>
                    <input type="date" name="closed_date_from" class="form-control" value="{{ $closed_date_from }}">
                </div>
                <div class="col">
                    <label>Close Date To</label>
                    <input type="date" name="closed_date_to" class="form-control" value="{{ $closed_date_to }}">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label>Audit Start Date From</label>
                    <input type="date" name="audit_start_date_from" class="form-control" value="{{ $audit_start_date_from }}">
                </div>
                <div class="col">
                    <label>Audit Start Date To</label>
                    <input type="date" name="audit_start_date_to" class="form-control" value="{{ $audit_start_date_to }}">
                </div>
                <div class="col">
                    <label>Audit End Date From</label>
                    <input type="date" name="audit_end_date_from" class="form-control" value="{{ $audit_end_date_from }}">
                </div>
                <div class="col">
                    <label>Audit End Date To</label>
                    <input type="date" name="audit_end_date_to" class="form-control" value="{{ $audit_end_date_to }}">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <label>Analyst</label>
                    <select class="form-select select2" name="analyst">
                        <option value="">All</option>
                        @foreach($analysts as $analyst)
                        <option value="{{ $analyst->name }}" @if($analyst->name==$request_analyst) selected @endif >{{ $analyst->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Auditor</label>
                    <select class="form-select select2" name="user_id">
                        <option value="">All</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id==$request_user) selected @endif >{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
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
                    <!-- <th> <input class="form-check-input" type="checkbox" name="select-all" id="selectAll"> </th> -->
                    <th></th>
                    <th> ID </th>
                    <th> Survey </th>
                    <th> Module </th>
                    <th> Requester </th>
                    <th> Resolver Group </th>
                   <!--  <th> Reported by </th> -->
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
                   <!--  <td> <input class="form-check-input" type="checkbox" value="{{ $ticket->id }}" name="ref_number"> </td> -->
                    <td><a href="/tickets/{{ $ticket->id }}/show" class=""><i class="icon-eye"></i> View</a></td>
                    <td> {{ $ticket->ref_number }} </td>
                    <td> {{ $ticket->survey->name ?? null }} </td>
                    <td> {{ $ticket->service }} </td>
                    <td> {{ $ticket->requester }} </td>
                    <td> {{ $ticket->resolver_group }} </td>
                   <!--  <td> {{ $ticket->reported_by }} </td> -->
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
$('#selectAll').click(function(event) {
    if (this.checked) {
        $(':checkbox').prop('checked', true);
    } else {
        $(':checkbox').prop('checked', false);
    }
});
</script>
@endsection
