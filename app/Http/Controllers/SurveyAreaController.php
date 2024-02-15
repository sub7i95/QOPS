<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyAreaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
}
