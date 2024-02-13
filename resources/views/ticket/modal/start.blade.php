<div class="modal fade" id="modal-start" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form" role="form" method="post" action="{{ url("tickets/{$ticket->id}/begin") }}">.
            @csrf
            <input type="hidden" name="_method" id="_method" value="POST">
            <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Start Assessment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="control-label" for="name">Survey:</label>
                    <select name="survey_id" id="survey_id" class="form-control" required>
                        <option value="">-select survey-</option>
                        @foreach( $surveys as $survey )
                        <option value="{{$survey->id}}">{{$survey->name}}</option>
                        @endforeach
                    </select>
                    <span class="showError alert-danger"></span>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Start</button>
                </div>
            </div>
        </form>
    </div>
</div>
