    <form name="form-ticket-create" id="form-ticket-create" class="form form-horizontal ajax-form-ticket-create" role="form" action="/tickets/createandstart"  method="post">
    <input type="hidden" name="_method" id="_method" value="POST">
    <input type="hidden" name="ticket_id" id="ticket_id" value="" >
    

      
          <button type="submit" class="btn btn-primary  " data-loading-text="Loading..."> Start Assessment </button>
      

      
          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Survey :</label>
            <div class="col-sm-8">
              <?php $Surveys = App\Survey::where('active', 1)->orderBy('name')->get() ?>
                <select name="survey_id" id="survey_id" required class="form-control">
                  <option value="">-select-</option>
                  @foreach( $Surveys as $Survey )
                  <option value="{{$Survey->id}}">{{$Survey->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Evaluated Group :</label>
            <div class="col-sm-8">
              <?php $Groups = App\Group::where('active', 1)->whereIn('parent',[ 'SCC','SSD'])->orderBy('name')->get() ?>
                <select name="group" id="group" required class="form-control">
                  <option value="">-select group-</option>
                  @foreach( $Groups as $Group )
                  <option value="{{$Group->name}}">{{$Group->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Location :</label>
            <div class="col-sm-8">
                <select name="location" id="location"  class="form-control">
                  <option value="">N/A</option>
                  <option value="SIN">SIN</option>
                  <option value="YUL">YUL</option>
                  <option value="OTHER">Other</option>
                </select>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Incident Owning Group :</label>
            <div class="col-sm-8">
              <?php $Groups = App\Group::where('active', 1)->orderBy('name')->get() ?>
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
            <label  class="col-sm-3 control-label" for="name">Resolver Group:</label>
            <div class="col-sm-8">
              <?php $Groups = App\Group::where('active', 1)->orderBy('name')->get() ?>
                <select name="resolver_group" id="group" required class="form-control  ">
                  <option value="">-select group-</option>
                  @foreach( $Groups as $Group )
                  <option value="{{$Group->name}}">{{$Group->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>



          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Service:</label>
            <div class="col-sm-8">

              <?php $services = App\Service::select('name')->where('active',1)->orderBy('name')->get() ?>
                <select name="service" id="service" required class="form-control select22">
                  <option value="">-select service-</option>
                  @foreach( $services as $service )
                  <option value="{{$service->name}}">{{$service->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Priority:</label>
            <div class="col-sm-8">
                <select name="priority" id="priority"  class="form-control">
                  <option value="">-select priority-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
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
            <label  class="col-sm-3 control-label" for="name">Finish/Close date:</label>
            <div class="col-sm-8">
              <input type="text" name="closed_date" class="form-control date" format="YYYY-MM-DD" placeholder="YYYY-MM-DD" required>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-3 control-label" for="name">Id/Ref #:</label>
            <div class="col-sm-8">
              <input type="text" name="ref_number" class="form-control"  >
            </div>
          </div>
          <span class="showError alert-danger"></span>          

    </form>
