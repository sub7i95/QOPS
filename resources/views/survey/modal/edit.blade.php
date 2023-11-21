<div class="modal fade" id="modal-surveys" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form name="form-survey" id="form-survey" class="form form-horizontal ajax-form-surveys" role="form" action="/surveys" >
    <input type="hidden" name="_method" id="_method" value="POST">
    <input type="hidden" name="id" id="id" value="0" >  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Survey Form </h4>
      </div>             
     

      <div class="modal-body">
  


                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="name"> Name </label>
                        <input  type="text" name="name" placeholder="Enter Name" required class="form-control" value="">
                    </div>
                  </div><!-- / col-md-6-->

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="active"> Owner Group  </label>
                              <select name='owner'  class="form-control  " required  >
                              <option value="SSD"> SSD </option>
                              <option value="SCC"> SCC </option>
                              </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="active"> Status  </label>
                              <select name='active'  class="form-control  " required  >
                              <option value="1"> Active </option>
                              <option value="0" > Inactive </option>
                              </select>
                        </div>
                    </div>

                  </div>
          
      
          
          <span class="showError alert-danger"></span>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-link btn-sm btn-circle" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm " data-loading-text="Loading...">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>