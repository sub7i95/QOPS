<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketArea;
use App\Models\User;
use App\Models\Group;
use App\Models\Survey;
use App\Models\TicketActivity;


class TicketController extends Controller
{

    public function index( Request $request )
    {

        $service = \Request::get('service');
        $group = \Request::get('q');

        $tickets = Ticket::select()
        ->where( 'status', \Request::get('status', 1) )
        //->where( 'requester',  $request->q  )
        //->whereNull( 'audit_practice_start_date' )
        ->where( function($q) use( $group ) {
         //       $q->where( 'requester',  $group  )
         //       ->orWhere( 'resolver_group',  $group  )  ;
        })  
          ->where( function($q) use($service) {
            if ( $service ) {
            //    $q->where('service' , $service);
            }
          })  
        ->get()->take(50);

        return view('ticket.index')->with('tickets', $tickets);
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
