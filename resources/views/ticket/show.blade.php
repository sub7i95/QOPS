@extends('layouts.app')
@section('content')
@include('ticket.header')
<form class="form" role="form" action="{{ url("tickets/{$ticket->id}") }}" method="post">
    @csrf
    <input type="hidden" name="id" id="id" value="0">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 align-middle d-flex align-items-center">
                    <i class="fa-solid fa-ticket me-2"></i> Ticket Ref #<b>{{ $ticket->ref_number}}</b>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @include('ticket.form.buttons')
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('ticket.template.details')
            @include('ticket.template.scc')
            @include('ticket.template.results')
            
        </div>
        <div class="card-footer">
            @include('ticket.form.buttons')
        </div>
    </div>
</form>
@include('ticket.modal.start')
@include('ticket.modal.activity')
@include('ticket.modal.delete')
@include('ticket.modal.finish')
@include('ticket.modal.coached')
@endsection
@section('scripts')
<script type="text/javascript">
var options = {
    url: function(phrase) {
        return api + "/qusers?phrase=" + phrase + "&format=json";
    },
    getValue: "name"
};
$(".input-get-name").easyAutocomplete(options);


$('.btn-delete-ticket-id').on('click', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete?')) {
        $.post($(this).data("url"))
            .done(function(response) {
                window.location = "/tickets/delete";
            });
        return false;
    }
});

</script>
@endsection
