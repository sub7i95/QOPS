<!-- Forgot Password Modal -->
<div class="modal fade" id="modal-surveys-item" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog " role="document">
    <div class="modal-content">

    <form name="form-surveys-item" id="form-surveys-item" class="form form-horizontal ajax-form-surveys-item" role="form" action="{{ url('/surveys/'.$survey->id.'/items') }}" >
    {!! csrf_field() !!}
    <input type="hidden" name="_method" id="_method" class="_method" value="POST">
    <input type="hidden" name="id" id="id" value="0" >
    <input type="hidden" name="survey_id" id="survey_id" value="{{ $survey->id}}" >
    <input type="hidden" name="area_id" id="area_id" value="" >
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Survey Item Form </h4>
      </div>             
      <div class="modal-body">
          
          <div class="form-group">
            <label  class="col-sm-2 control-label" for="name">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="name" name="name"  id="item_name" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label" for="name">Weight</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" placeholder="weight" name="weight"  id="item_weight" value="1" required />
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