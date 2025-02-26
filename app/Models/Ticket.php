<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';

    protected $fillable = [
        'requester' ,
        'group' , // Assuming this is correct
        'ref_number' ,
        'open_date',
        'closed_date',
        'service' ,
        'priority'   ,
        'sla_breached'  ,
        'customer',
        'location',
        'reporting_method',
        'resolver_group' ,
        'resolution_code',
        'cause_code' ,
        'responsible_party',
        'reported_by' ,
        'closed_by' ,
        'audit_start_date',
        'audit_end_date'
    ];
    
    public function getStatusNameAttribute()
    {
        $statusNames = [
            0 => 'Draft',
            1 => 'New',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Canceled',
            // Add more status codes and names as needed
        ];

        // Return the status name based on the ticket's status code
        // or 'Unknown' if the status code is not defined
        return $statusNames[$this->status] ?? 'Draft';
    }

    public function getStatusColorAttribute()
    {
        $statusNames = [
            0 => 'secondary',
            1 => 'primary',
            2 => 'success',
            3 => 'dark',
            4 => 'danger',
            // Add more status codes and names as needed
        ];

        // Return the status name based on the ticket's status code
        // or 'Unknown' if the status code is not defined
        return $statusNames[$this->status] ?? 'primary';
    }


    public function survey()
    {
        return $this->belongsTo( Survey::class, 'survey_id' );
    }

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id' );
    }


    public function coach()
    {
        return $this->belongsTo( User::class, 'coached_by' );
    }


    

    public static  function countStatus($group, $status)
    {

        $Ticket = Ticket::where('requester', $group)->where('status', $status)->get();

        return $Ticket->count();
    }


    public static  function scores($group)
    {
            switch( $group )
            {
                case 'SSD-AMM' : $q = [ 'SSD-AMM-GSL','SSD-CLOUD','SSD-AMM-SV', 'SSD-MOBILITY', 'SSD-DSC' ] ;  break;
                case 'SSD-BOM' : $q = [ 'SSD-BOM','PSD-BOM' ]; break;
                case 'SSD-DEL' : $q = [ 'SSD-DEL','PSD-DEL' ]; break;
                case 'SSD-FRA' : $q = [ 'SSD-FRA' ]; break;
                case 'SSD-MOW' : $q = [ 'SSD-MOW' ]; break;
                case 'SSD-SJO' : $q = [ 'SSD-SJO','PSD-SJO' ]; break;
                default: [ 'SSD-AMM-GSL','SSD-CLOUD','SSD-AMM-SV', 'SSD-MOBILITY' , 'SSD-BOM','PSD-BOM' , 'SSD-DEL','PSD-DEL' , 'SSD-FRA' , 'SSD-MOW' , 'SSD-SJO','PSD-SJO' , 'SSD-DSC' ] ;  break;
            }

            $Ticket = Ticket::select( 
                \DB::raw(' 
                        Format(
                            IfNull((
                            (
                                Sum(  `qops`.`tickets_items`.`weight` *  `qops`.`tickets_items`.`score` ) 
                                / 
                                Sum(  `qops`.`tickets_items`.`weight` )
                            ) 
                            *  100), 0), 2) 
                    AS `score`') 
            )
            ->join('tickets_items', 'ticket.ref_number', '=', 'tickets_items.ref_number')
            ->whereIn('requester', $q)
            ->where('ticket.status', 3)
            ->get();

        return $Ticket->count();
    }


    public static  function surveyScore( $id , $date )
    {

        return 0;

    }
}
