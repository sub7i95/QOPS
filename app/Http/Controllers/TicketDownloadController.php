<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Group;
use App\Models\TicketItem;

class TicketDownloadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request )
    {
        return view('ticket.download');
    }


    public function download( )
    {

        $input = \Request::all();
        $report = request('report');
        $date_from = request('date_from');
        $date_to = request('date_to');
        $service = request('service');
        $group = request('group');
        $analyst = request('analyst');
        $requester = request('requester');
        $user = request('user');
        
        
        if( $report=='summary' )
        {
            $this->downloadSummary( $input );
        }

        if( $report=='details' )
        {
            $this->downloadDetails( $input );
        }

        return true;
    }



    public function downloadDetails( $input )
    {

        ini_set('memory_limit', '512M');
        
        $records =  TicketItem::select(
            'tickets_items.ref_number', 
            'tickets_items.*',
            'ticket.requester', 
            'ticket.reported_by', 
            'ticket.service',
            'ticket.group as group_evaluated',  
            'ticket.resolver_group',
            'ticket.audit_end_date', 
            'survey.name as survey', 
            'survey_area.name as area',
            'ticket.closed_date',
            'tickets_items.location as ticket_location',
            'tickets_items.weight as ticket_weight',
            'tickets_items.name as line_name'
        )
        ->leftJoin('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
        ->leftJoin('survey', 'tickets_items.survey_id', '=', 'survey.id')
        ->leftJoin('survey_area', 'tickets_items.area_id', '=', 'survey_area.id')
        ->where( 'ticket.status', 3 )
        ->where( $input['date_field'] , '>=',  $input['date_from']  )
        ->where( $input['date_field'] , '<=',  $input['date_to']  )
        ->when( request()->service, function($q){
            $q->whereIn( "service", request()->service ); 
        })  
        ->when( request()->group, function($q){
            $q->whereIn( "ticket.group", request()->group ); 
        })  
        ->when( request()->customer, function($q){
            $q->whereIn( "customer", request()->customer ); 
        })  
        ->when( request()->requester, function($q){
            $q->whereIn( "ticket.requester", request()->requester ); 
        })  
        ->when( request()->user, function($q){
            $q->where( "ticket.user_id", request()->user ); 
        })      
        ->get();

        if( $records->isEmpty() ) 
        {
            $data[] = [ 'empty'=>null ];
        }

        foreach ( $records as $record ) 
        {
            if( $record->is_applicable==1 AND $record->score==1 ) $Compliance = 'yes';
            if( $record->is_applicable==1 AND $record->score==0 ) $Compliance = 'no';
            if( $record->is_applicable==0 ) $Compliance = 'na';
            
            if( $record->is_applicable==1 AND ($record->weight * $record->score)==0 ) 
            {
                $score = '0' ;
            }
           
            if( $record->is_applicable==1 AND ($record->weight * $record->score) > 0 )  
            {
                 $score = $record->weight * $record->score ;
            } 

            if( $record->is_applicable==0) 
            {
                $score = '' ;
            }

          $data[] = array(
            "Ref_number"     => $record->ref_number,
            "Group evaluated"=> $record->group_evaluated,
            "Audit date"     => $record->audit_end_date,
            "Service"        => $record->service,
            "Requester"      => $record->requester,
            "Reported_by"    => $record->reported_by,
            "Resolver group" => $record->resolver_group,
            "Group activity" => isset($record->group) ? $record->group : ' ',
            "Analyst"        => isset($record->analyst) ? $record->analyst : ' ',
            "Survey"         => $record->survey,
            "Area"           => $record->area,
            "Requirement"    => $record->line_name,
            "Weight"         => isset($record->weight) ? $record->weight : 1 ,
            "Compliance"     => $Compliance, //$record->score== -1 ? 'na' : $record->score,
            "Score"          => $score , //$record->score!= -1 ? $record->weight * $record->score : 0,
            "Area Weight"    => $record->area_weight,
            "Notes"          => isset($record->notes) ? $record->notes : '',
            "Close Date"     => isset($record->closed_date) ? $record->closed_date : '',
            "Location"       => isset($record->ticket_location) ? $record->ticket_location : ' ',
            //"Score w/Area"=> $record->score!= -1 ? $record->weight * $record->score *  $record->area_weight: 0,
          );
        }    
        
      $this->toExcel($data, 'Details' );
    }


    public function downloadSummary( $input )
    {

//        ini_set('memory_limit', '256M');

        $tickets = \DB::table('v_ticket_score_by_area') 
        ->where( 'status', 3 )       
        ->where( $input['date_field'] , '>=', $input['date_from'] )
        ->where( $input['date_field'] , '<=', $input['date_to'] )
        ->when( request()->service, function($q){
            $q->whereIn( "service", request()->service ); 
        })  
        ->when( request()->group, function($q){
            $q->whereIn( "group", request()->group ); 
        })  
        ->when( request()->customer, function($q){
            $q->whereIn( "customer", request()->customer ); 
        })  
        ->when( request()->requester, function($q){
            $q->whereIn( "requester", request()->requester ); 
        })  
        ->when( request()->user, function($q){
            $q->where( "user_id", request()->user ); 
        })                 
        ->get();

        if( $tickets->isEmpty() ) {
            $data[] = [ "data"=> 'empty' ];
        }

        foreach ($tickets as $ticket) 
        {
          $data[] = array(
            "Ref_number"=> $ticket->ref_number,
            "Group Evaluated" => $ticket->group,
            "Requester"=> $ticket->requester,
            "Reported_by"=> $ticket->reported_by,
            "Resolver Group"=> $ticket->resolver_group,
            "Service"=> $ticket->service,
            "Customer"=> $ticket->customer,
            "Priority"=> $ticket->priority,
            "Audit end date"=> $ticket->audit_end_date,
            "Open score 15%"=> $ticket->score_open > 0 ? (int)$ticket->score_open :  ' 0',
            "Update score 25%"=> $ticket->score_update > 0 ? (int)$ticket->score_update : " 0",
            "Close score 20%"=> $ticket->score_close > 0 ? (int)$ticket->score_close : " 0",
            "Group score 40%"=> $ticket->score_group > 0 ? (int)$ticket->score_group : " 0",
            "Score SSD"=> ( $ticket->score_open + $ticket->score_update + $ticket->score_close + $ticket->score_group ) / 4 ,// (int)$ticket->score,
            "Score"=> $ticket->score  ,// (int)$ticket->score,
            "Coach Name"=> $ticket->coach_name,
            "Coach Date"=> $ticket->coached_date,
            "Auditor"=> $ticket->auditor,
          );
        }    

      $this->toExcel($data, 'Summary' );
    }


    /**
     * Download Analyst Activity
     *
     * @return Response
     */
    public function downloadTicketActivityByAnalyst( $analyst )
    {

        $activities = \DB::table('v_ticket_score_by_area') 
        ->where( 'reported_by',  $analyst  )
        ->where( 'status', \Request::get('status', 3) )
        ->where( 'closed_date', 'like', $_GET['date'].'%' )
        ->get();

        if( ! $activities->isEmpty() ) 
        {
            foreach ($activities as $activity) 
            {
              $data[] = array(
                "Ref_number"=> $activity->ref_number,
                "Requester"=> $activity->requester,
                "Reported_by"=> $activity->reported_by,
                "Service"=> $activity->service,
                "Audit date"=> $activity->audit_end_date,
                "Score"=> (int)$activity->score,
                "Open score 15%"=> (int)$activity->score_open,
                "Update score 25%"=> (int)$activity->score_update,
                "Close score 20%"=> (int)$activity->score_close,
                "Group score 40%"=> (int)$activity->score_group,
              );
            }    
        }  

      $this->toExcel($data, 'Activities-' );

    }



    /**
     * Download Groups by Date
     *
     * @return Response
     */
    public function downloadTicketItemsByGroup( Request $request, $group )
    {
        $date = $request->date;

        $records =  TicketItem::select(
            'tickets_items.ref_number', 
            'ticket.requester', 
            'ticket.reported_by', 
            'tickets_items.*', 
            'tickets_items.*', 
            'ticket.service', 
            'ticket.audit_end_date', 
            'survey.name as survey', 
            'survey_area.name as area'
        )
        ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
        ->join('survey', 'tickets_items.survey_id', '=', 'survey.id')
        ->join('survey_area', 'tickets_items.area_id', '=', 'survey_area.id')
        ->where('ticket.closed_date', 'LIKE', $date.'%' )
        ->where('ticket.requester', $group )
        ->get();

        if( $records->isEmpty() ) 
        {
            $data[] = [ 'empty'=>null ];
        }

        foreach ( $records as $record ) 
        {
            if( $record->is_applicable==1 AND $record->score==1 ) $Compliance = 'yes';
            if( $record->is_applicable==1 AND $record->score==0 ) $Compliance = 'no';
            if( $record->is_applicable==0 ) $Compliance = 'na';
            
            if( $record->is_applicable==1 AND ($record->weight * $record->score)==0 ) 
            {
                $score = '0' ;
            }
           
            if( $record->is_applicable==1 AND ($record->weight * $record->score) > 0 )  
            {
                 $score = $record->weight * $record->score ;
            } 

            if( $record->is_applicable==0) 
            {
                $score = '' ;
            }


          $data[] = array(
            "Ref_number"=> $record->ref_number,
            "Audit date"=> $record->audit_end_date,
            "Service"   => $record->service,
            "Requester" => $record->requester,
            "Reported_by"=> $record->reported_by,
            "Group"     => $record->group,
            "Analyst"   => $record->analyst,
            "Survey"    => $record->survey,
            "Area"      => $record->area,
            "Requirement"=> $record->name,
            "Weight"    => $record->weight,
            "Compliance"=> $Compliance, //$record->score== -1 ? 'na' : $record->score,
            "Score"     => $score , //$record->score!= -1 ? $record->weight * $record->score : 0,
            "Area Weight"=> $record->area_weight,
            //"Score w/Area"=> $record->score!= -1 ? $record->weight * $record->score *  $record->area_weight: 0,
          );
        }    
        
      $this->toExcelZeroFormat($data, 'Requirements-Group-'.$group.'-'.$date );
    }



    /**
     * Download Groups by Date
     *
     * @return Response
     */
    public function downloadTicketItemsByAnalyst( Request $request, $name )
    {
        $date = $request->date;

        $records =  TicketItem::select(
            'tickets_items.ref_number', 
            'ticket.requester', 
            'ticket.reported_by', 
            'tickets_items.*', 
            'tickets_items.*', 
            'ticket.service', 
            'ticket.audit_end_date', 
            'survey.name as survey', 
            'survey_area.name as area'
        )
        ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
        ->join('survey', 'tickets_items.survey_id', '=', 'survey.id')
        ->join('survey_area', 'tickets_items.area_id', '=', 'survey_area.id')
        ->where('ticket.closed_date', 'LIKE', $date.'%' )
        ->where('tickets_items.analyst', $name )
        ->get();

        if( $records->isEmpty() ) 
        {
            $data[] = [ 'empty'=>null ];
        }

        foreach ( $records as $record ) 
        {
            if( $record->is_applicable==1 AND $record->score==1 ) $Compliance = 'yes';
            if( $record->is_applicable==1 AND $record->score==0 ) $Compliance = 'no';
            if( $record->is_applicable==0 ) $Compliance = 'na';

            if( $record->is_applicable==1 AND ($record->weight * $record->score)==0 ) 
            {
                $score = '0' ;
            }
           
            if( $record->is_applicable==1 AND ($record->weight * $record->score) > 0 )  
            {
                 $score = $record->weight * $record->score ;
            } 

            if( $record->is_applicable==0) 
            {
                $score = '' ;
            }

          $data[] = array(
            "Ref_number"=> $record->ref_number,
            "Audit date"=> $record->audit_end_date,
            "Service"   => $record->service,
            "Requester" => $record->requester,
            "Reported_by"=> $record->reported_by,
            "Group"     => $record->group,
            "Analyst"   => $record->analyst,
            "Survey"    => $record->survey,
            "Area"      => $record->area,
            "Requirement"=> $record->name,
            "Weight"    => $record->weight,
            "Compliance"=> $Compliance, //$record->score== -1 ? 'na' : $record->score,
            "Score"     => $score , //$record->score!= -1 ? $record->weight * $record->score : 0,
            "Area Weight"=> $record->area_weight,
            //"Score w/Area"=> $record->score!= -1 ? $record->weight * $record->score *  $record->area_weight: 0,
          );
        }    

      $this->toExcelZeroFormat($data, 'Requirements-Analyst-'.$name );
    }



    private function toExcel($data, $FileName='Export' ) 
    {
        $filename = $FileName. ".xls";     
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $this->ExportFiles($data);
    }

    private function ExportFiles($records) {
    $heading = false;
    if(!empty($records))
        foreach($records as $row) {
            if(!$heading) {
              // display field/column names as a first row
              echo implode("\t", array_keys($row)) . "\n";
              $heading = true;
            }
        echo implode("\t", array_values($row)) . "\n";
        }
    exit;
    }

}
