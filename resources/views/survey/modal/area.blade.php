<!-- Forgot Password Modal -->
<div class="modal fade" id="modal-surveys-area" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <form name="form-surveys-area" id="form-surveys-area" class="form form-horizontal ajax-form-surveys-area" role="form" action="{{ url('/surveys/'.$survey->id.'/areas') }}" >
    {!! csrf_field() !!}
    <input type="hidden" name="_method" id="_method" value="POST">
    <input type="hidden" name="id" id="id" value="0" >
    <input type="hidden" name="survey_id" id="survey_id" value="{{ $survey->id}}" >
    
    
      <div class="modal-header">
      <button type="button" class="close" aria-label="Close" onclick="window.location.reload();"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Survey Area Form </h4>
      </div>             
      <div class="modal-body">
          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="name" name="name" required="" />
            </div>
          </div>
          <span class="showError alert-danger"></span>
           
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-link btn-sm btn-circle" data-dismiss="modal" onclick="window.location.reload();">Close</button>
          <button type="submit" class="btn btn-primary btn-sm " data-loading-text="Loading...">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>