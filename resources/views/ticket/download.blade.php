@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-ticket me-2"></i> Tickets Search & Download
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- END PAGE HEAD-->
        <form class="forms form-horizontal" method="post" action="{{ url('tickets/search') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="date_from" class="col-md-2 control-label"> Report </label>
                        <select class="form-control " name="report" id="report" required="">
                            <option value="">- select report -</option>
                            <option value="summary">Summary</option>
                            <option value="details">Detail</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="date_from" class="col-md-2 control-label"> Date Field </label>
                        <select class="form-control " name="date_field" id="date_from" required="">
                            <option value="">- select date field -</option>
                            <option value="audit_end_date">audit_end_date</option>
                            <option value="open_date">open_date</option>
                            <option value="closed_date">closed_date</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="date_from" class="col-md-2 control-label"> Date From </label>
                        <select class="form-control " name="date_from" id="date_from" required="">
                            <option value="">- select date -</option>
                            <?php  $dates = App\Models\Dates::where('active',1)->get(); ?>
                            @foreach( $dates as $d)
                            <option value="{{$d->yymm}}-01">{{$d->yymm}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="date_from" class="col-md-2 control-label"> Date To </label>
                        <select class="form-control " name="date_to" id="date_to" required="">
                            <option value="">- select date -</option>
                            <?php  $dates = App\Models\Dates::where('active',1)->get(); ?>
                            @foreach( $dates as $d)
                            <option value="{{$d->yymm}}-31">{{$d->yymm}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="group">Requester </label>
                        <?php $requesters = App\Models\Group::where('active', 1)->whereIn('parent', ['SSD', 'SCC'] )->orderBy('name')->get() ?>
                        <select name="requester[]" id="group" class="form-control  get-analyst-name" multiple="" size="7">
                            @foreach( $requesters as $requester )
                            <option value="{{$requester->name}}">{{$requester->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="group">Group </label>
                        <?php $Groups = App\Models\Group::where('active', 1)->whereIn('parent', ['SSD', 'SCC'] )->orderBy('name')->get() ?>
                        <select name="group[]" id="group" class="form-control  get-analyst-name" multiple="" size="7" required="">
                            @foreach( $Groups as $Group )
                            <option value="{{$Group->name}}">{{$Group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="service" class="col-md-2 control-label"> Services </label>
                        <select class="form-control " name="service[]" id="service" required="" multiple="" size="7">
                            <?php $services = App\Models\Service::select('name')->where('active',1)->orderBy('name')->get() ?>
                            @foreach($services as $service )
                            <option value="{{ $service->name }}" selected="">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="service" class="col-md-2 control-label"> Customer </label>
                        <select class="form-control " name="customer" id="service">
                            <?php $customers = App\Models\Ticket::select('customer')->whereNotNull('customer')->orderBy('customer')->groupBy('customer')->get() ?>
                            <option value="">- select -</option>
                            @foreach($customers as $customer )
                            <option value="{{ $customer->customer }}">{{ $customer->customer }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="service" class="col-md-2 control-label"> Auditor </label>
                        <select class="form-control " name="user" id="user">
                            <?php $users = App\Models\User::select('*')->orderBy('first_name')->get() ?>
                            <option value="">- select -</option>
                            @foreach($users as $user )
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <button class="btn btn-primary w-100" type="submit" data-loading-text="Please wait...">Download Report</button>
                    <button class="btn btn-link  w-100" type="reset" data-loading-text="Please wait...">Reset</button>
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
