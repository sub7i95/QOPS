<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketArea;
use App\Models\TicketSurvey;
use App\Models\TicketActivity;
use App\Models\TicketItem;
use App\Models\User;
use App\Models\Group;
use App\Models\Survey;
use App\Models\SurveyArea;
use App\Models\SurveyItem;

class TicketSurveyController extends Controller
{

    public function store( Request $request, $ticket_id )
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
 
        return redirect()->back();
    }



    public function update( Request $request, Ticket $ticket )
    {

        $data = $request->item_id;
        $rows = count($data);
        for($i = 0; $i <= $rows-1 ; $i++) 
        {
            $TicketItem = TicketItem::find( $data[$i] ) ;
            $TicketItem->score = $request->score[$i] ?? null ;
            $TicketItem->is_applicable = $request->score[$i]==-1 ? 0 : 1;
            $TicketItem->notes = $request->notes[$i] ?? null ;
            $TicketItem->notes_manager = $request->notes_manager[$i] ?? null ;
            $TicketItem->analyst = $request->analyst[$i] ?? null ;
            $TicketItem->location = $request->location[$i] ?? null ;
            $TicketItem->group = $request->group[$i] ?? null  ;
            $TicketItem->save();
        }

        return redirect("/tickets/{$ticket->id}/show")->with('message', 'Successfully updated');
    }

}