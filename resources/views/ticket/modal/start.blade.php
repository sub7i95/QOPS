<!-- Forgot Password Modal -->
<div class="modal fade" id="modal-start" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <form name="form-ticket-begin" id="form-ticket-begin" class="form form-horizontal ajax-form-ticket-begin" role="form" action="/tickets/{{ $ticket->id }}/begin" >
    <input type="hidden" name="_method" id="_method" value="POST">
    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}" >
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select Survey </h4>
      </div>             
      <div class="modal-body">

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Survey:</label>
            <div class="col-sm-8">

            <?php $Surveys = App\Survey::where('active', 1)->orderBy('name')->get() ?>

                <select name="survey_id" id="survey_id" required class="form-control">
                  <option value="">-select survey-</option>
                  @foreach( $Surveys as $Survey )
                  <option value="{{$Survey->id}}">{{$Survey->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <span class="showError alert-danger"></span>          
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-link btn-sm btn-circle" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm " data-loading-text="Loading...">Start</button>
      </div>
    </form>
    </div>
  </div>
</div>