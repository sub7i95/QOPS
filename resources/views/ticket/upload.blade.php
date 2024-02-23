@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-ticket me-2"></i> Tickets Upload
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        <b>
                            <p>Select CSV file and Upload</p>
                        </b>
                    </div>
                    <div class="col-md-6">
                        <b>
                            <p>Columns Order: </p>
                        </b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <form action="{{ url('/tickets/upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="file" required class="form-control">
                            <button type="submit" class="btn btn-primary mt-2" id="btnUpload"> <i class="fa fa-upload"></i> <span id="uploadImageBtnMsg">Upload Tickets</span> </button>
                        </form>

                    </div>
                    <div class="col-md-6">
                        <p>
                            Requester, <Br>
                            Incident Reference Number,<Br>
                            Open Date (YYYY MM DD),<Br>
                            Affected Service,<Br>
                            Priority,<Br>
                            Incident SLA Successful,<Br>
                            End User Organization,<Br>
                            Location,<Br>
                            Reporting Method,<Br>
                            Group,<Br>
                            Resolution Code,<Br>
                            Symptom,<Br>
                            Responsible Party,<Br>
                            Reported By
                        </p>
                    </div>
                </div>
            </div>
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
