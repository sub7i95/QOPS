@extends('layouts.app')
@section('content')
@include('ticket.header')
<style>
    .suggestions-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
        position: absolute;
        z-index: 1000;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .suggestions-list li {
        padding: 10px;
        cursor: pointer;
    }
    .suggestions-list li:hover {
        background-color: #f0f0f0;
    }
</style>
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

<script>
//autocomplete
document.addEventListener('DOMContentLoaded', function() {
    // Attach keyup event listener to all elements with class 'getName'
    document.querySelectorAll('.getName').forEach(function(input) {
        input.addEventListener('keyup', function() {
            var query = this.value;
            var _this = this; // Capture the input element for use in success callback
            
            if (query != '') {
                // Perform AJAX request using Fetch API
                fetch("{{ url('/analysts/qsearch') }}?name=" + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    var suggestions = '';
                    data.forEach(function(value) {
                        suggestions += '<li class="list-group-item">' + value.name + '</li>';
                    });
                    
                    // Find the closest parent 'tr' and then the '.suggestions-list' within it
                    var suggestionsList = _this.closest('tr').querySelector('.suggestions-list');
                    suggestionsList.innerHTML = suggestions;

                    // Add click event listener to each suggestion item
                    suggestionsList.querySelectorAll('li').forEach(function(item) {
                        item.addEventListener('click', function() {
                            // On click, set input value to the clicked suggestion and clear the list
                            _this.value = this.innerText;
                            suggestionsList.innerHTML = ''; // Clear suggestions
                        });
                    });
                })
                .catch(error => console.error('Error fetching names:', error));
            }
        });
    });
});
</script>



@endsection
