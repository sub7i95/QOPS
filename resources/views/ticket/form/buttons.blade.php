<div class="row">
<div class="col-md-12">
    <div class="btn-group pull-right">

            <div class="actions">
            @if( $ticket->status==1 )
            <div class="row" style="padding:10px">    
                <div class="col-md-12" align="center">
                    <a class="btn btn-outline sbold btn-start-assessment float-center" 
                        href="javascript:;" 
                        data-toggle="modal" 
                        data-target="#modal-start" 
                        align="center"
                        > Start Assessment <i class="icon-check"></i>
                    </a>
                 </div>
            </div><!-- close row -->
            @endif
                
                @if( $ticket->status==2 OR $ticket->status==3 )
                    <button type="submit" class="btn btn-primary"  data-loading-text="Please wait...">Save Changes</button>
                @endif

                @if( $ticket->status==2  )
                    <button type="button" class="btn btn-success" data-loading-text="Please wait..." id="btn-completed" data-id="{{$ticket->id}}" > Finish </button>
                @endif
                
                @if( $ticket->status==3 AND $ticket->coached==0 )
                    <button type="button" class="btn btn-success btn-ticket-coached" data-loading-text="Loading..." data-id="{{$ticket->id}}" > Coaching Provided </button>
                @endif

                @if( $ticket->status==300 AND $ticket->is_audited==0 )
                    <button type="button" class="btn btn-standard btn-start-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}" > Start Audit </button>
                @endif

                @if( $ticket->status==300 AND $ticket->is_audited==1 )
                    <button type="submit" class="btn btn-primary "  data-loading-text="Loading...">Save Changes</button>
                    <button type="button" class="btn btn-success  btn-end-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}" data-compliant="1"> <i class="fa fa-thumbs-up" ></i> Compliant</button>
                    <button type="button" class="btn btn-danger btn-end-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}" data-compliant="0"><i class="fa fa-thumbs-down"></i> Noncompliant</button>
                @endif


                @if(Auth::user()->role_id==1)
                <button type="button" class="btn btn-danger btn-delete-ticket-id" data-url="/tickets/delete/{{$ticket->ref_number}}" > Delete </button>
                @endif

            </div>

    </div>
</div>    
</div>