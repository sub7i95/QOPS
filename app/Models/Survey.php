<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';



    public function areas()
    {
        return $this->hasMany( SurveyArea::class , 'survey_id' );
    }

}
 