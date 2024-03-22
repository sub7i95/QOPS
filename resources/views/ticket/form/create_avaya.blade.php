@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-ticket me-2" aria-hidden="true"></i> Tickets / Create
    </div>
    <div class="card-body">
        <form name="form-ticket-create" id="form-ticket-create" class="form form-horizontal " role="form" action="{{ url('/tickets/createandstart') }}" method="post">
            {!! csrf_field() !!}
            <div class="row ">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Survey:</label>
                        <div class="col-sm-8">
                            <?php $Surveys = App\Models\Survey::where('id', 2)->orderBy('name')->get() ?>
                            <select name="survey_id" id="survey_id" required class="form-control">
                                @foreach( $Surveys as $Survey )
                                <option value="{{$Survey->id}}">{{$Survey->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Incident Owning Group :</label>
                        <div class="col-sm-8">
                            <?php $Groups = App\Models\Group::where('active', 1)->where('parent', 'SSD')->orderBy('name')->get() ?>
                            <select name="requester" id="group" required class="form-select get-analyst-name">
                                <option value="">-select group-</option>
                                @foreach( $Groups as $Group )
                                <option value="{{$Group->name}}">{{$Group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Analyst Name:</label>
                        <div class="col-sm-8">
                            <select name="analyst_name" id="ticket-analyst-name" class="form-select ticket-analyst-name" required>
                                <option value="">-select analyst-</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Service:</label>
                        <div class="col-sm-8">
                            <?php $services = App\Models\Service::select('name')->where('name','AVAYA')->orderBy('name')->get() ?>
                            <select name="service" id="service" required class="form-select select22">
                                @foreach( $services as $service )
                                <option value="{{$service->name}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Start/Open date:</label>
                        <div class="col-sm-8">
                            <input type="date" name="open_date" class="form-control " format="YYYY-MM-DD" placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Id/Ref #:</label>
                        <div class="col-sm-8">
                            <input type="text" name="ref_number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Start Assessment</button>
                </div>
            </div>
            <span class="showError alert-danger"></span>
        </form>
    </div>
</div>
@endsection
