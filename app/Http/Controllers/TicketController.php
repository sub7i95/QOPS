<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Analyst;
use App\Models\User;
use App\Models\Group;
use App\Models\Ticket;
use App\Models\TicketArea;
use App\Models\TicketActivity;
use App\Models\TicketStatus;
use App\Models\TicketSurvey;
use App\Models\TicketItem;
use App\Models\Service;
use App\Models\Survey;
use App\Models\SurveyArea;
use App\Models\SurveyItem;

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
        ->take(500)
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

    public function create( $id )
    {
        return view('ticket.create')->with('id', $id);
    }

    public function postCreateSurvey( Request $request, $ticket_id )
    {

        $Ticket = Ticket::find( $ticket_id );
        $Ticket->status = 2; //in porcess
        $Ticket->user_id = \Auth::user()->id; //in porcess
        $Ticket->audit_start_date = date('Y-m-d');
        $Ticket->survey_id = $request->survey_id;
        $Ticket->save();

        //record tickets vs surveys history
        $TicketSurvey = new TicketSurvey;
        $TicketSurvey->ticket_id = $request->ticket_id;
        $TicketSurvey->ref_number = $Ticket->ref_number;
        $TicketSurvey->survey_id = $request->survey_id;
        $TicketSurvey->created_by = \Auth::user()->id;
        $TicketSurvey->save();

        //record tickets vs areas history
        $SurveyAreas = SurveyArea::where('survey_id', $request->survey_id)->get();
        foreach($SurveyAreas as $SurveyArea)
        {
            $TicketArea = new TicketArea;
            $TicketArea->ticket_id = $request->ticket_id;
            $TicketArea->ref_number = $Ticket->ref_number;
            $TicketArea->area_id = $SurveyArea->id;
            $TicketArea->name = $SurveyArea->name;
            $TicketArea->position = $SurveyArea->position;
            $TicketArea->weight = $SurveyArea->weight;
            $TicketArea->created_by = \Auth::user()->id;
            $TicketArea->save();
        }

        //record items or activites
        //$SurveyItems = SurveyItem::where('survey_id', $request->survey_id )->where('active', 1)->get();
        //record items or activites
        $SurveyItems = SurveyItem::select('surveys_items.*', 'survey_area.weight as area_weight')
        ->where('surveys_items.survey_id', $request->survey_id )
        ->join('survey_area', 'surveys_items.area_id', '=', 'survey_area.id')
        ->where('surveys_items.active', 1)
        ->get();        
        foreach($SurveyItems as $SurveyItem)
        {
            $TicketItem = new TicketItem;
            $TicketItem->ticket_id = $request->ticket_id;
            $TicketItem->ref_number = $Ticket->ref_number;
            $TicketItem->survey_id = $request->survey_id;
            $TicketItem->area_id = $SurveyItem->area_id;
            $TicketItem->item_id = $SurveyItem->id;
            $TicketItem->area_weight = $SurveyItem->area_weight;
            $TicketItem->name = $SurveyItem->name;

            //if Opening Activity get Opened by
            if( $TicketItem->area_id==1)
            {
                $TicketItem->analyst = $Ticket->reported_by;    
            }
            
            //if Closing Activity get Opened by
            if( $TicketItem->area_id==3)
            {
                $TicketItem->analyst = $Ticket->closed_by;    
            }

            $TicketItem->weight = $SurveyItem->weight;
            $TicketItem->score      = -1;
            $TicketItem->is_applicable    = 0; // this is to set all import actiites to not applicable
            $TicketItem->created_by = \Auth::user()->id;
            $TicketItem->save();
        }
 
         return response( [ 
            'ok'    => true, 
            //'data'  => $Survey 
        ] , 200);
    }

    public function createAndStartSurvey( Request $request )
    {

        $v = \Validator::make( $request->all() , [
            //'group'  => 'required',
            'survey_id'  => 'required',
            'ref_number'  => 'unique:tickets_items',
            ]);
        
        if( $v->fails() )
        {   
            return response( $v->errors() ,422); 
        }

        if( ! $request->ref_number ) {
            $request->ref_number = Str::random(10);
        }

        $Ticket = new Ticket;
        $Ticket->ref_number = $request->ref_number; //in porcess
        $Ticket->survey_id = $request->survey_id;
        $Ticket->group = $request->group ? $request->group : $request->requester;
        $Ticket->requester = $request->requester;
        $Ticket->resolver_group = $request->resolver_group ? $request->resolver_group : $request->group;
        $Ticket->reported_by = $request->analyst_name;
        $Ticket->service = $request->service;
        $Ticket->priority = $request->priority ? $request->priority : null;
        $Ticket->open_date = $request->open_date;
        $Ticket->closed_date = $request->closed_date ? $request->closed_date : $request->open_date;
        $Ticket->status = 2; //in porcess
        $Ticket->user_id = \Auth::user()->id; //in porcess
        $Ticket->audit_start_date = date('Y-m-d');
        $Ticket->save();

        //record tickets vs surveys history
        $TicketSurvey = new TicketSurvey;
        $TicketSurvey->ref_number = $Ticket->ref_number;
        $TicketSurvey->survey_id = $request->survey_id;
        $TicketSurvey->created_by = \Auth::user()->id;
        $TicketSurvey->save();

        //record tickets vs areas history
        $SurveyAreas = SurveyArea::where('survey_id', $request->survey_id)->get();
        foreach($SurveyAreas as $SurveyArea)
        {
            $TicketArea = new TicketArea;
            $TicketArea->ref_number = $Ticket->ref_number;
            $TicketArea->area_id = $SurveyArea->id;
            $TicketArea->name = $SurveyArea->name;
            $TicketArea->position = $SurveyArea->position;
            $TicketArea->weight = $SurveyArea->weight;
            $TicketArea->created_by = \Auth::user()->id;
            $TicketArea->save();
        }

        //record items or activites
        $SurveyItems = SurveyItem::select('surveys_items.*', 'survey_area.weight as area_weight')
        ->where('surveys_items.survey_id', $request->survey_id )
        ->join('survey_area', 'surveys_items.area_id', '=', 'survey_area.id')
        ->where('surveys_items.active', 1)
        ->get();
        
        foreach($SurveyItems as $SurveyItem)
        {
            $TicketItem = new TicketItem;
            $TicketItem->ref_number = $Ticket->ref_number;
            $TicketItem->survey_id = $request->survey_id;
            $TicketItem->survey_id = $request->survey_id;
            $TicketItem->area_id = $SurveyItem->area_id;
            $TicketItem->item_id = $SurveyItem->id;
            $TicketItem->area_weight = $SurveyItem->area_weight;
            $TicketItem->name = $SurveyItem->name;
            $TicketItem->weight = $SurveyItem->weight;

            if( $TicketItem->survey_id==1 OR $TicketItem->survey_id ==2)
            {
                $TicketItem->group = $request->requester;
            } else {
                $TicketItem->group = $request->group;
            }
           
            if( $TicketItem->survey_id==1 OR $TicketItem->survey_id ==2){
                $TicketItem->analyst = $request->analyst_name; //remove this for SCC 
            }

            $TicketItem->score      = -1;
            $TicketItem->location     = $request->location ? $request->location : null ; 
            $TicketItem->is_applicable    = 0; // this is to set all import actiites to not applicable
            $TicketItem->created_by = \Auth::user()->id;
            $TicketItem->save();
        }
 
        return redirect("tickets/{$Ticket->id}/show");
    }


    public function show( Ticket $ticket )
    {

        $users = User::where('active',1 )->orderBy('first_name')->get();
        
        $sccGroups = Group::where('active', 1)->orderBy('name')->get();
        
        $score = Ticket::select() //_vtickets
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
