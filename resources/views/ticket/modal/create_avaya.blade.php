<!-- Forgot Password Modal -->
<div class="modal fade" id="modal-ticket-create-avaya" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <form name="form-ticket-create" id="form-ticket-create" class="form form-horizontal ajax-form-ticket-create" role="form" action="/tickets/createandstart"  method="post">
    <input type="hidden" name="_method" id="_method" value="POST">
    <input type="hidden" name="ticket_id" id="ticket_id" value="" >
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Start Assessment</h4>
      </div>             
      <div class="modal-body">

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Name:</label>
            <div class="col-sm-8">
              <?php $Surveys = App\Survey::where('id', 2)->orderBy('name')->get() ?>
                <select name="survey_id" id="survey_id" required class="form-control">
                  @foreach( $Surveys as $Survey )
                  <option value="{{$Survey->id}}">{{$Survey->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Requester :</label>
            <div class="col-sm-8">
              <?php $Groups = App\Group::where('active', 1)->where('parent', 'SSD')->orderBy('name')->get() ?>
                <select name="requester" id="group" required class="form-control get-analyst-name">
                  <option value="">-select group-</option>
                  @foreach( $Groups as $Group )
                  <option value="{{$Group->name}}">{{$Group->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Analyst Name:</label>
            <div class="col-sm-8">
                <select name="analyst_name" id="ticket-analyst-name"  class="form-control ticket-analyst-name" required>
                  <option value="">-select analyst-</option>
                </select>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Service:</label>
            <div class="col-sm-8">

              <?php $services = App\Service::select('name')->where('name','AVAYA')->orderBy('name')->get() ?>
                <select name="service" id="service" required class="form-control select22">
                  @foreach( $services as $service )
                  <option value="{{$service->name}}">{{$service->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>



          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Start/Open date:</label>
            <div class="col-sm-8">
            <input type="text" name="open_date" class="form-control date" format="YYYY-MM-DD" placeholder="YYYY-MM-DD" required>
            </div>
          </div>



          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Id/Ref #:</label>
            <div class="col-sm-8">
              <input type="text" name="ref_number" class="form-control"  >
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