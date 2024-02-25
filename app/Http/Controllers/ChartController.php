<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


//Load Models
use App\Models\Ticket;
use App\Models\TicketSurvey;
use App\Models\TicketItem;
use App\Models\SurveyItem;
use App\Models\SurveyArea;
use App\Models\TicketArea;
use App\Models\Group;

class ChartController extends Controller
{


    public function __construct()
    {
      $this->year     = date('Y') ;
      $this->month    = \Request::get('date' , date('Y-m') );
      $this->today    = \Request::get('date' , date('Y-m-d') );
      $this->date     = \Request::get('date' , date('Y-m') );
      $this->service  = \Request::get('service');
      $this->customer = \Request::get('customer');
      $this->group    = \Request::get('group');
      $this->requester= \Request::get('group');
      $this->requesters = Group::ssdGroups();
      $this->analyst  = \Request::get('analyst_name');
      $this->survey_id  = \Request::get('survey_id');
      

      if( \Request::get('parent')=='SSD')
      {
        $this->parent = Group::ssd();
      }else{
        $this->parent = Group::scc();
      }  

      //  $this->middleware('auth');
    }



    public function index(Request $request )
    {
        $date= date('Y-m-');
        
        $compliance = TicketItem::select(  
            \DB::raw("  IFNULL( Sum(`tickets_items`.`weight` * `tickets_items`.`score` ) ,0)  AS score "  )
        )
        ->join('ticket' , 'ticket.id', '=', 'tickets_items.id')
        ->groupBy('requester')
        ->get() ;

        $tickets = Ticket::select( 'requester', \DB::raw("count(ticket.requester) AS requesters ") )
        ->groupBy('requester')
        ->get();

        return \Response::json( [ 
            "legends"   => $tickets->lists('requester') ,
            "set1"      => $tickets->lists('requesters') ,
            "set2"      => $compliance->lists('score') 
            ], 200, [], JSON_NUMERIC_CHECK );
    }



    public function barByGroupByMonth(Request $request)
    {
        $year = $request->input('year', date('Y')); // Default to current year if not provided
        $status = $request->input('status', 3); // Default status to 3 if not provided

        $tickets = \DB::table('v_ticket_score_by_area')
            ->select(
                \DB::raw('IFNULL(COUNT(ref_number), 0) AS completed'),
                \DB::raw('IFNULL(FORMAT(AVG(score), 0), 0) AS score'),
                \DB::raw('MONTH(closed_date) AS month')
            )
            ->where('status', $status)
            ->whereYear('closed_date', $year)
            ->when($request->input('service'), function ($query) use ($request) {
                $query->where('service', $request->input('service'));
            })
            ->when($request->input('group'), function ($query) use ($request) {
                $query->where('requester', $request->input('group'));
            }, function ($query) use ($request) {
                
                if ( $parentGroups = $request->input('parent') ) {
                    $query->whereIn('requester', $parentGroups);
                }
            })
            ->when($request->input('analyst'), function ($query) use ($request) {
                $query->where('requester', $request->input('analyst'));
            })
            ->groupBy(\DB::raw('MONTH(closed_date)'))
            ->orderBy('month')
            ->get();

        return Response::json($tickets, 200, [], JSON_NUMERIC_CHECK);
    }





    public function pieByTeam(Request $request)
    {
        $date = $request->input('date', date('Y')); // Use the 'date' request parameter or default to the current year
        $month = $date . '-%'; // Assuming $date is just the year part, e.g., 2021
        $requester = $request->input('group');
        $service = $request->input('service');
        $parent = $request->input('parent'); // This should be provided in the request

        $tickets = DB::table('v_ticket_score_by_area')
            ->select('requester', DB::raw('IFNULL(COUNT(ref_number), 0) AS completed'))
            ->where('status', 3)
            ->where('closed_date', 'like', $month)
            ->when($service, function ($query) use ($service) {
                $query->where('service', $service);
            })
            ->when($requester, function ($query) use ($requester) {
                $query->where('requester', $requester);
            }, function ($query) use ($parent) {
                if ($parent) {
                    $query->whereIn('requester', (array)$parent);
                }
            })
            ->groupBy('requester')
            ->orderBy('requester')
            ->get();

        return response()->json($tickets);
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function barsByProduct(Request $request )
    {

        if( \Request::get('date') )
        {
          $date = \Request::get('date');
        }else{
          $date = date('Y') ;
        }  

        $requester = \Request::get('group') ;
        $service = \Request::get('service');

        $tickets = \DB::table('v_ticket_score_by_area') 
        ->select('service',
            \DB::RAW(' ifnull(count(ref_number),0)  as completed ') ,
            \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')
        )
        //->whereIn( 'requester', $requester )
        ->where( 'status', 3 )
        ->where( 'closed_date', 'like' , "$this->month-%" )
        ->where( function($q)  {
          if ( $this->service ) {
              $q->where('service' , $this->service);
          }
        })          
        ->where( function($q)  {
          if ( $this->requester ) {
              $q->where('requester' , $this->requester );
          }else{
              //$q->whereIn('requester' , Group::ssdGroups());
              $q->whereIn('requester' , $this->parent );
              
          }
        })
        ->groupBy( \DB::RAW('service') )
        ->orderBy('completed', 'DESC')
        ->get();

      return \Response::json(  $tickets , 200, [], JSON_NUMERIC_CHECK );
       
    }




    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function barsByAnalyst(Request $request )
    {

        if( \Request::get('date') )
        {
          $date = \Request::get('date');
        }else{
          $date = date('Y') ;
        }  

        $requester = \Request::get('group') ;
        $service = \Request::get('service');

        $tickets = \DB::table('v_ticket_score_by_area') 
        ->select('reported_by',
            \DB::RAW(' ifnull(count(ref_number),0)  as completed ') ,
            \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')
        )
        ->where( 'status', 3 )
        ->where( 'closed_date', 'like' , "$this->month-%" )
        ->where( function($q)  {
          if ( $this->service ) {
              $q->where('service' , $this->service);
          }
        })          
        ->where( function($q)  
        {
          if ( $this->requester ) {
              $q->where('requester' , $this->requester );
          }else{
              $q->whereIn('requester' , $this->parent );
              
          }
        })
        ->groupBy( \DB::RAW('reported_by') )
        ->orderBy('reported_by')
        ->get();

      return \Response::json(  $tickets , 200, [], JSON_NUMERIC_CHECK );
       
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function spiderByIncidentArea( )
    {

        $date = $this->month;
        $range = \Request::get('range');
        if( $range=='YTD')
        {
            $date = $this->year;   
        }


      $tickets = \DB::table('v_ticket_score_by_area')
      ->select(
          \DB::RAW(' ifnull(format(avg(score_open),0),0)    as score_open '), 
          \DB::RAW(' ifnull(format(avg(score_update),0),0)  as score_update '), 
          \DB::RAW(' ifnull(format(avg(score_close),0),0)   as score_close '), 
          \DB::RAW(' ifnull(format(avg(score_group),0),0)   as score_group ')
      )
      ->where( 'status', 3 )
      ->where( function($q) use($date) {
        if ( $date )  {
            $q->where('closed_date' , 'like' , "$date-%");
        }
      })
      ->where( function($q) {
        if ( $this->group ) {
            $q->where('requester' , $this->group);
        }
      })
      ->where( function($q) {
        if ( $this->service ) {
            $q->where('service' , $this->service);
        }
      }) 
      ->first() ;

        $resonse = [
          [ 'category' => 'Open', 'score'  => $tickets->score_open ],
          [ 'category' => 'Update', 'score'  => $tickets->score_update ],
          [ 'category' => 'Close', 'score'  => $tickets->score_close ],
          [ 'category' => 'Group', 'score'  => $tickets->score_group ]
        ];

      return \Response::json(  $resonse , 200, [], JSON_NUMERIC_CHECK );
       
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function gauge( )
    {
     

      $scoreYTD = \DB::table('v_ticket_score_by_area')
      ->select(  \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')   )
      ->where( 'status', 3 )
      ->where( 'closed_date', 'like' , "$this->year-%" )
      ->where( function($q)  {
        if ( $this->service ) {
            $q->where('service' , $this->service);
        }
      })  
      ->where( function($q)  {
        if ($this->group) 
        {
          $q->where('requester' , $this->group );
        } else {
          //$q->whereIn( 'requester', Group::ssdGroups() ) ;
          $q->whereIn( 'requester', Group::ssd() ) ;
          
        }
      })
      ->where( function($q)  {
        if ($this->analyst) 
        {
          $q->where('requester' , $this->analyst );
        }
      })
      ->first() ;      

      $scoreMTD = \DB::table('v_ticket_score_by_area')
      ->select(  \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')   )
      ->where( 'status', 3 )
      ->where( 'closed_date', 'like' , "$this->month-%" )
      ->where( function($q)  {
        if ( $this->service ) {
            $q->where('service' , $this->service);
        }
      })  
      ->where( function($q) {
        if ($this->group) 
        {
          $q->where('requester' , $this->group );
        } else {
          //$q->whereIn( 'requester', Group::ssdGroups() )    ;
          $q->whereIn( 'requester', Group::ssd() );
          
        }
      })
      ->where( function($q)  {
        if ($this->analyst) 
        {
          $q->where('requester' , $this->analyst );
        }
      })
      ->first() ;
      
        $resonse = [
            'ytd' => $scoreYTD->score ,
           'mtd' => $scoreMTD->score 
        ];

      return \Response::json(  $resonse , 200, [], JSON_NUMERIC_CHECK );
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function barsBySurvey(Request $request )
    {

        if( \Request::get('date') )
        {
          $date = \Request::get('date');
        }else{
          $date = date('Y') ;
        }  

        //$requester = \Request::get('group') ;
        //$service = \Request::get('service');

        $tickets = \DB::table('v_ticket_score_by_area') 
        ->select('survey',
            \DB::RAW(' ifnull(count(ref_number),0)  as completed ') ,
            \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')
        )
        //->whereIn( 'requester', $requester )
        ->where( 'status', 3 )
        ->where( 'closed_date', 'like' , "$this->month-%" )
        ->where( function($q)  {
          if ( $this->survey_id ) {
              $q->where('survey_id' , $this->survey_id);
          }
        })  
        ->where( function($q)  {
          if ( $this->service ) {
              $q->where('service' , $this->service);
          }
        })          
        ->where( function($q)  {
          if ( $this->requester ) {
              $q->where('requester' , $this->requester );
          }else{
              //$q->whereIn('requester' , Group::ssdGroups() );
              $q->whereIn('requester' , $this->parent );
              
          }
        })
        ->groupBy( \DB::RAW('survey_id') )
        ->orderBy('survey_id')
        ->get();

      return \Response::json(  $tickets , 200, [], JSON_NUMERIC_CHECK );
       
    }









    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function barsByTeamVsScore(Request $request )
    {

        if( \Request::get('date') )
        {
          $date = \Request::get('date');
        }else{
          $date = date('Y') ;
        }  

        //$requester = \Request::get('group') ;
        //$service = \Request::get('service');

        $tickets = \DB::table('v_ticket_score_by_area') 
        ->select('requester',
            \DB::RAW(' ifnull(count(ref_number),0)  as completed ') ,
            \DB::RAW(' ifnull(format(avg(score),0),0)  as score ')
        )
        //->whereIn( 'requester', $requester )
        ->where( 'survey_id','>', 2 )
        ->where( 'status', 3 )
        ->where( 'closed_date', 'like' , "$this->month-%" )
        ->where( function($q)  {
          if ( $this->survey_id ) {
              $q->where('survey_id' , $this->survey_id);
          }
        })  
        ->where( function($q)  {
          if ( $this->service ) {
              $q->where('service' , $this->service);
          }
        })          
        ->where( function($q)  {
          if ( $this->requester ) {
              $q->where('requester' , $this->requester );
          }else{
              //$q->whereIn('requester' , Group::ssdGroups() );
              $q->whereIn('requester' , $this->parent );
              
          }
        })
        ->groupBy( \DB::RAW('requester') )
        ->orderBy('requester')
        ->get();

      return \Response::json(  $tickets , 200, [], JSON_NUMERIC_CHECK );
       
    }






}
