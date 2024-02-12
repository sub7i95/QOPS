@extends('layouts.app')

@section('content')

<!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <!-- BEGIN PAGE BREADCRUMB  -->
    <!--
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="./">Home</a> / 
        </li>
        <li>
            <span class="active">User</span>
        </li>
    </ul>
    -->
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Tickets <small></small></h1>
    </div>
    <!-- END PAGE TITLE -->
    <!-- BEGIN PAGE TOOLBAR 
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    <!-- END PAGE TOOLBAR -->
</div>
<!-- END PAGE HEAD-->






<!-- BEGIN CONTENT PAGE -->
<div class="row ">
    <div class="col-md-12">
        

               
               <?php if( isset($_GET['done']) ) { ?>
                    <div class="alert alert-success">
                      <strong>Done!</strong> Tickets have been uploaded.
                    </div>
               <?php } ?>
                


                <div class="row">
                    <div class="col-md-6">
                        <b><p>Please upload a CSV file</p></b>
                    </div>
                    <div class="col-md-6">
                        <b><p>Column Order: </p></b>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-6">      

                    <form id="fileupload" action="/upload/tickets" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group"> 
                            <input type="file" name="file" id="file" required class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group"> 
                            <button type="submit" class="btn blue start" id="btnUpload"> <i class="fa fa-upload"></i>  <span id="uploadImageBtnMsg">Upload Tickets</span> </button>
                          </div>
                        </div>
                      </div>
                    </form>               
                    </div>

                    <div class="col-md-6">                      
                        <p>
                        Requester, 
                        Incident Reference Number, 
                        Open Date (YYYY MM DD), 
                        Affected Service, 
                        Priority, 
                        Incident SLA Successful, 
                        End User Organization, 
                        Location, 
                        Reporting Method, 
                        Group, 
                        Resolution Code, 
                        Symptom, 
                        Responsible Party, 
                        Reported By
                        </p>
                    </div>
                    

                </div>    
            </div>
            
            <hr>
            <!--
            <div class="row">
                    <div class="col-md-6">      

                    <form id="fileupload" action="/upload/activities" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group"> 
                            <input type="file" name="file" id="file" required class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group"> 
                            <button type="submit" class="btn blue start" id="btnUpload"> <i class="fa fa-upload"></i>  <span id="uploadImageBtnMsg">Upload Activities</span> </button>
                          </div>
                        </div>
                      </div>
                    </form>               
                    </div>

                    <div class="col-md-6">                      
                        <p>
                        Incident Reference Number,
                        Group Name,
                        Analyst,
                        Activity Type,
                        User Description,
                        Time Spent
                        </p>
                    </div>
                    

                </div>    
            </div>
-->
        </div><!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->


@endsection

@section('scripts')
<script type="text/javascript">
//
</script>
@endsection