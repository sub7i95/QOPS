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

class TicketController extends Controller
{

    public function index( Request $request )
    {


        $tickets = Ticket::select()
        ->when( request()->status, function($query)  {
            $query->where( 'status',   request()->status  );
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
        ->with(['survey'])
        ->take(100)
        ->get()
        ;

      //  \Log::debug( $tickets->toSql(), $tickets->getBindings() );

        return view('ticket.index')
        ->with('tickets', $tickets )
        ->with('groups', Group::distinct()->where('active',1)->orderBy('name')->get() )
        ->with('services', Service::distinct()->where('active',1)->orderBy('name')->get()  )
        ->with('request_status', request()->status ?? null )
        ->with('request_group', request()->group ?? null )
        ->with('request_requester', request()->requester ?? null )
        ->with('request_service', request()->service ?? null )
        ->with('request_from', request()->from ?? null )
        ->with('request_to', request()->to ?? null )
        ->with('request_date_field', request()->date_field ?? null )
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
