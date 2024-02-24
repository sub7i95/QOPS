<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';

    protected $fillable = [
        'parent',
        'name',
    ];



    public static function ssdGroups()
    {
        return Group::where('active', 1)->where('parent','SSD')->orderBy('name')->pluck('name');
    }


    public static function scc()
    {
        return Group::where('active', 1)->where('parent','SCC')->orderBy('name')->pluck('name');
    }

    public static function ssd()
    {
        return Group::where('active', 1)->where('parent','SSD')->orderBy('name')->pluck('name');
    }



    public static function score( $group=null, $date=null, $survey=null )
    {

        $r = TicketItem::select(
            \DB::RAW(" 
                
                FORMAT(IFNULL(((
                    SUM(( `tickets_items`.`weight` * `tickets_items`.`score` * tickets_items.area_weight )) 
                    / 
                    SUM( `tickets_items`.`weight` * tickets_items.area_weight  )) * 100), 0), 0) AS 'score' 
            ")
        )
        ->join('ticket', 'tickets_items.ref_number', '=', 'ticket.ref_number')
        ->where('ticket.status',3)
        ->where('tickets_items.is_applicable',1)
        //->where('ticket.audit_end_date','LIKE' ,$date.'%')
        ->where('ticket.closed_date','LIKE' ,$date.'%')
        ->where( function($q)  use($survey)
        {
            if( $survey ) 
            {
                $q->whereIn('ticket.survey_id' , $survey );          
            }
        })            
        ->where('ticket.group', $group)
        ->where('tickets_items.group', $group)
        ->first();
        
        return $r->score;
    }


    public static function completed( $group=null, $date=null, $survey=null )
    {
        $r = Ticket::select(
            \DB::RAW(" count( ticket.group ) AS 'count' ")
        )
        ->where('ticket.status',3)
        //->where('ticket.audit_end_date','LIKE' ,$date.'%')
        ->where('ticket.closed_date','LIKE' ,$date.'%')
        ->where( function($q)  use($survey)
        {
            if( $survey ) 
            {
                $q->whereIn('ticket.survey_id' , $survey );          
            }
        })            
        ->where('ticket.group', $group)
        ->first();
        
        return $r->count;
    }
    
}
