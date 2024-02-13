<div class="d-flex justify-content-end align-items-center gap-2">
    @if( $ticket->status==1 )
    <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-start" > Start Assessment <i class="icon-check"></i>
    </a>
    @endif
    @if( $ticket->status==2 OR $ticket->status==3 )
    <button type="submit" class="btn btn-primary" data-loading-text="Please wait...">Save Changes</button>
    @endif
    @if( $ticket->status==2 )
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-finish"> Finish </button>
    @endif
    @if( $ticket->status==3 AND $ticket->coached==0 )
    <button type="button" class="btn btn-success btn-ticket-coached" data-bs-toggle="modal" data-bs-target="#modal-coached"> Coaching Provided </button>
    @endif
    @if( $ticket->status==300 AND $ticket->is_audited==0 )
    <button type="button" class="btn btn-standard btn-start-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}"> Start Audit </button>
    @endif
    @if( $ticket->status==300 AND $ticket->is_audited==1 )
    <button type="submit" class="btn btn-primary " data-loading-text="Loading...">Save Changes</button>
    <button type="button" class="btn btn-success  btn-end-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}" data-compliant="1"> <i class="fa fa-thumbs-up"></i> Compliant</button>
    <button type="button" class="btn btn-danger btn-end-compliance" data-loading-text="Loading..." data-id="{{$ticket->id}}" data-compliant="0"><i class="fa fa-thumbs-down"></i> Noncompliant</button>
    @endif
    @if(Auth::user()->role_id==1)
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete"> Delete </button>
    @endif
</div>

 