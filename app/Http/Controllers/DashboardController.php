<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Group;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->status   = 3 ; // completed
        $this->year     = date('Y') ;
        $this->month    = \Request::get('date' , date('m') );
        $this->today    = \Request::get('date' , date('Y-m-d') );
        $this->date     = \Request::get('date' , date('Y-m') );
        $this->service  = \Request::get('service');
        $this->customer = \Request::get('customer');
        $this->group    = \Request::get('group');
        $this->survey_id    = \Request::get('survey_id');
        $this->requester= \Request::get('group');
        $this->requesters = Group::ssdGroups();
        $this->analyst  = \Request::get('analyst_name');        
    }

    public function index(Request $request )
    {
        $completedYTD = DB::table('v_ticket_score_by_area')
            ->where('status', $this->status ) 
            ->whereYear('closed_date', $this->year ) 
            ->when(request()->input('service'), function ($query) {
                $query->where('service', request()->input('service'));
            })
            ->when(request()->input('analyst'), function ($query) {
                $query->where('requester', request()->input('analyst'));
            })
            ->when($this->group, function ($query) {
                $query->where('requester', $this->group);
            }, function ($query) {
                $query->whereIn('requester', Group::ssd());
            })
            ->count('ref_number');

        $completedMTD = DB::table('v_ticket_score_by_area')
            ->where('status', $this->status ) 
            ->whereYear('closed_date', $this->year ) 
            ->whereMonth('closed_date',  $this->month )
            ->when(request()->input('service'), function ($query) {
                $query->where('service', request()->input('service'));
            })
            ->when(request()->input('analyst'), function ($query) {
                $query->where('requester', request()->input('analyst'));
            })
            ->when($this->group, function ($query) {
                $query->where('requester', $this->group);
            }, function ($query) {
                $query->whereIn('requester', Group::ssd());
            })
            ->count('ref_number');


        $scoreYTD = DB::table('v_ticket_score_by_area')
          //  ->selectRaw('IFNULL(FORMAT(AVG(score), 0), 0) AS score')
            ->where('status', $this->status) // Ensure $this->status is correctly set
            ->whereYear('closed_date', $this->year) // Ensure $this->year is correctly set
            ->when(request()->input('service'), function ($query) {
                $query->where('service', request()->input('service'));
            })
            ->when(request()->input('analyst'), function ($query) {
                $query->where('requester', request()->input('analyst'));
            })   
            ->when($this->group, function ($query) {
                $query->where('requester', $this->group);
            }, function ($query) {
                $query->whereIn('requester', Group::ssd());
            })
            ->avg('score');
   
        $scoreMTD = DB::table('v_ticket_score_by_area')
           // ->selectRaw('IFNULL(FORMAT(AVG(score), 0), 0) AS score')
            ->where('status', $this->status) // Assuming $this->status is a valid status code
            ->whereYear('closed_date', $this->year ) 
            ->whereMonth('closed_date', $this->month )
            ->when(request()->input('service'), function ($query) {
                $query->where('service', request()->input('service'));
            })
            ->when(request()->input('analyst'), function ($query) {
                $query->where('requester', request()->input('analyst'));
            })
            ->when($this->group, function ($query) {
                $query->where('requester', $this->group);
            }, function ($query) {
                $query->whereIn('requester', Group::ssd());
            })
            ->avg('score');
            //->first();


      return view('dashboard.index')
      ->with('date', $this->date )
      ->with('completed_mtd', $completedMTD )
      ->with('completed_ytd', $completedYTD )
      ->with('score_ytd', $scoreYTD )
      ->with('score_mtd', $scoreMTD )
      ->with('ssdGroups', $this->requesters )
      ->with('service_name', $this->service )
      ->with('customer_name', $this->customer )
      ->with('group_name', $this->group )
      ->with('analyst_name', $this->analyst )
      ;        

    }



}
