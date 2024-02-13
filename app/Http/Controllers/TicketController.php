<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Group;

class TicketController extends Controller
{

    public function index(Request $request )
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




    public function show( $id )
    {
        
        $users = User::where('active',1 )->orderBy('first_name')->get();
        
        $sccGroups = Group::where('active', 1)->orderBy('name')->get();
        
        $score =\DB::table('tickets') //_vtickets
                ->select(  'score' ,'score_ssd'  )
                ->where('id', $id)
                ->orWhere('ref_number', $id)
                ->first() ;   

        $ticket = Ticket::select(
                'ticket.*', 
                'users.first_name', 
                'users.last_name',
                'survey.name as survey',
                'survey.owner as survey_owner',
                'survey.owner'
            )
            ->leftJoin( 'users', 'ticket.user_id', '=', 'users.id')
            ->leftJoin( 'survey', 'ticket.survey_id', '=', 'survey.id')
            ->where('ticket.id', $id)
            ->orWhere('ref_number', $id)
            ->orderBy('ticket.id', 'DESC')
            ->first();

        return view('ticket.show')
        ->with('users', $users )
        ->with('ticket', $ticket )
        ->with('sccGroups', $sccGroups)
        ->with('score', $score)
        ;
    }



}
