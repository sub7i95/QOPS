<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';

    public function getStatusNameAttribute()
    {
        $statusNames = [
            0 => 'Draft',
            1 => 'New',
            2 => 'In Progress',
            3 => 'Closed',
            4 => 'Cancelled',
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

}
