<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketItem extends Model
{
    use HasFactory;

    protected $table = 'tickets_items';


    static public function count( $kpi , $date, $survey, $area, $item , $group=null , $analyst=null )
    {

        
        if( $kpi=='ytdc')
        {
            $ytdcCount =  TicketItem::select( \DB::raw('count(tickets_items.id) as total') )
            ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
            ->where('score', 1)
            ->where('is_applicable', 1)
            //->where('ticket.audit_end_date','LIKE',date('Y').'%' )            
             ->where('ticket.closed_date','LIKE',date('Y').'%' )            
            ->where( function($q) use($analyst) 
            {
                if( isset($analyst) ) 
                {
                    $q->where('tickets_items.analyst', $analyst );
                }
            })
            //->where('tickets_items.group', $group ) //$item )
            ->where('ticket.group', $group ) //$item )
            ->where('name', $item ) //$item )
            ->first();
            return $ytdcCount->total ? $ytdcCount->total : null ;
        }

        if( $kpi=='ytdm')
        {
            $ytdcCount =  TicketItem::select( \DB::raw('count(tickets_items.id) as total') )
            ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
            ->where('score', 0)
            ->where('is_applicable', 1)
            ->where('ticket.closed_date','LIKE',date('Y').'%' )
            //->where('ticket.audit_end_date','LIKE',date('Y').'%' )
            ->where( function($q) use($analyst) 
            {
                if( isset($analyst) ) 
                {
                    $q->where('tickets_items.analyst', $analyst );
                }
     
            })
            //->where('tickets_items.group', $group ) //$item )
            ->where('ticket.group', $group ) //$item )
            ->where('name', $item ) //$item )
            ->first();
            return $ytdcCount->total ? $ytdcCount->total : null ;
        }

        if( $kpi=='mtdc')
        {
            $ytdcCount =  TicketItem::select( \DB::raw('count(tickets_items.id) as total') )
            ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
            ->where('score', 1)
            ->where('is_applicable', 1)
            //->where('ticket.audit_end_date','LIKE',$date.'%' )
            ->where('ticket.closed_date','LIKE',$date.'%' )
            ->where( function($q) use($analyst) 
            {
                if( isset($analyst) ) 
                {
                    $q->where('tickets_items.analyst', $analyst );
                }
            })
            //->where('tickets_items.group', $group ) //$item )
            ->where('ticket.group', $group ) //$item )
            ->where('name', $item ) //$item )
            ->first();
            return $ytdcCount->total ? $ytdcCount->total : null ;
        }


        if( $kpi=='mtdm')
        {
            $ytdcCount =  TicketItem::select( \DB::raw('count(tickets_items.id) as total') )
            ->join( 'ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
            ->where( 'score', 0)
            ->where( 'is_applicable', 1)
            //->where('ticket.audit_end_date','LIKE',$date.'%' )
            ->where( 'ticket.closed_date','LIKE',$date.'%' )
            //->where('tickets_items.analyst', $analyst ) //$item )
            ->where( function($q) use($analyst) 
            {
                if( isset($analyst) ) 
                {
                    $q->where('tickets_items.analyst', $analyst );
                }
            })
            ->where('ticket.group', $group ) //$item )
            ->where('name', $item ) //$item )
            ->first();
            return $ytdcCount->total ? $ytdcCount->total : null ;
        }


    }//end method


}
