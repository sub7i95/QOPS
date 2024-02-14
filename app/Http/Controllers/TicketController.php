<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketArea;
use App\Models\User;
use App\Models\Group;
use App\Models\Survey;
use App\Models\TicketActivity;
use App\Models\TicketStatus;
use App\Models\Service;
use App\Models\Analyst;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( Request $request )
    {


        $tickets = Ticket::select('ticket.*')
        ->when( request()->status, function($query)  {
            $query->where( 'ticket.status',   request()->status  );
        })  
        ->when( request()->group, function($query) {
                $query->where( 'requester',  request()->group  )
                ->orWhere( 'resolver_group',  request()->group )  ;
        })  
        ->when( request()->service, function($query) {
                $query->where( 'service',  request()->service  );
        })  
        ->when( request()->requester, function($query) {
                $query->where( 'requester',  request()->requester  );
        })   
        ->when( request()->user_id, function($query) {
                $query->where( 'user_id',  request()->user_id  );
        }) 
        ->when( request()->open_date_from, function($query) {
                $query->whereDate( 'open_date', '>=' , request()->open_date_from  );
        })    
        ->when( request()->open_date_to, function($query) {
                $query->whereDate( 'open_date', '<=' , request()->open_date_to  );
        })   
        ->when( request()->closed_date_from, function($query) {
                $query->whereDate( 'closed_date', '>=' , request()->closed_date_from  );
        })    
        ->when( request()->closed_date_to, function($query) {
                $query->whereDate( 'closed_date', '<=' , request()->closed_date_to  );
        })   
        ->when( request()->audit_start_date_from, function($query) {
                $query->whereDate( 'audit_start_date', '>=' , request()->audit_start_date_from  );
        })    
        ->when( request()->audit_start_date_to, function($query) {
                $query->whereDate( 'audit_start_date', '<=' , request()->audit_start_date_to  );
        })  
        ->when( request()->audit_end_date_from, function($query) {
                $query->whereDate( 'audit_end_date', '>=' , request()->audit_end_date_from  );
        })    
        ->when( request()->audit_end_date_to, function($query) {
                $query->whereDate( 'audit_end_date', '<=' , request()->audit_end_date_to  );
        })     
        ->when( request()->analyst, function($query) {
                $query->join('tickets_items', 'ticket.id','=','tickets_items.ticket_id')
                ->where( 'tickets_items.analyst',  request()->analyst  );
        })   
                         
        ->with(['survey'])
        ->distinct()
        ->take(100)
        ->get()
        ;

      //  \Log::debug( $tickets->toSql(), $tickets->getBindings() );

        return view('ticket.index')
        ->with('tickets', $tickets )
        ->with('groups', Group::distinct()->where('active',1)->orderBy('name')->get() )
        ->with('services', Service::distinct()->where('active',1)->orderBy('name')->get()  )
        ->with('users', User::distinct()->where('active',1)->orderBy('first_name')->get()  )
        ->with('analysts', Analyst::distinct()->where('active',1)->orderBy('name')->get()  )
        ->with('request_status', request()->status ?? null )
        ->with('request_group', request()->group ?? null )
        ->with('request_requester', request()->requester ?? null )
        ->with('request_service', request()->service ?? null )
        ->with('request_user', request()->user_id ?? null )
        ->with('request_analyst', request()->analyst ?? null )
        ->with('open_date_from', request()->open_date_from ?? null )
        ->with('open_date_to', request()->open_date_to ?? null )
        ->with('closed_date_from', request()->closed_date_from ?? null )
        ->with('closed_date_to', request()->closed_date_to ?? null )
        ->with('audit_start_date_from', request()->audit_start_date_from ?? null )
        ->with('audit_start_date_to', request()->audit_start_date_to ?? null )
        ->with('audit_end_date_from', request()->audit_end_date_from ?? null )
        ->with('audit_end_date_to', request()->audit_end_date_to ?? null )
        ;
    }




    public function show( Ticket $ticket )
    {

        $users = User::where('active',1 )->orderBy('first_name')->get();
        
        $sccGroups = Group::where('active', 1)->orderBy('name')->get();
        
        $score = Ticket::select() //_vtickets
        //->select(  'score' ,'score_ssd'  )
        ->where('id', $ticket->id)
        ->first() ;   

        return view('ticket.show')
        ->with('users', $users )
        ->with('ticket', $ticket )
        ->with('sccGroups', $sccGroups)
        ->with('areas',  TicketArea::where('ticket_id', $ticket->id )->orderBy('position')->get()  )  
        ->with('surveys',  Survey::where('active', 1)->orderBy('name')->get() )  
        ->with('activities',  TicketActivity::where('ticket_id', $ticket->id )->get() )  
        ->with('score', $score)
        ;
    }




    public function qsearch( Request $request  )
    {
        request()->validate([
            'q'=>'required'
        ]);

        $tickets = Ticket::select() 
        ->where( 'ref_number',  $request->q  )
        ->whereIn( 'status', [1, 2, 3, 4] )
        ->get();
      
        return view('ticket.qsearch')->with('tickets', $tickets);
    }


    public function destroy( Ticket $ticket  )
    {
        $ticket->delete();
        return redirect('tickets');
    }


}
