<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Group;

class TicketUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request )
    {
        return view('ticket.upload');
    }


}
