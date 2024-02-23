<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Imports\TicketsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Group;

class TicketUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( Request $request )
    {
        return view('ticket.upload');
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:csv,txt', // Specify 'txt' if CSVs can have .txt extension
        ]);

        $file = $validated['file'];

        // Open the file for reading
        if (!$handle = fopen($file->getRealPath(), 'r')) {
            return redirect('/tickets/upload?error')
                ->with('message', 'Failed to open the file.');
        }

        // Use a transaction to ensure data integrity
        \DB::beginTransaction();

        $rowsImported = 0; // Initialize a counter for successfully imported rows

        try {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Convert each field from ISO-8859-1 to UTF-8; adjust the source encoding as necessary
                $row = array_map(function($value) {
                    return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
                }, $row);

                // Check for ticket existence more efficiently
                if (Ticket::where('ref_number', $row[1])->exists()) {
                    continue; // Skip this iteration if ticket exists
                }

                // Populate the new ticket
                $ticket = new Ticket([
                    'requester'         => $row[0],
                    'group'             => $row[0], //this is new. Was added because of the SCC
                    'ref_number'        => $row[1],
                    'open_date'         => str_replace(' ','-', $row[2]), // $row[2]; 
                    'closed_date'       => str_replace(' ','-', $row[3]), // $row[3]; 
                    'service'           => $row[4],
                    'priority'          => $row[5],
                    'sla_breached'      => $row[6],
                    'customer'          => $row[7],
                    'location'          => $row[8],
                    'reporting_method'  => $row[9],
                    'resolver_group'    => $row[10],
                    'resolution_code'   => $row[11],
                    'cause_code'        => $row[12],
                    'responsible_party' => $row[13],
                    'reported_by'       => $row[14],
                    'closed_by'         => $row[15],
                ]);
                $ticket->save();
                $rowsImported++; // Increment the counter for each successful import
           
            }

            \DB::commit(); // Commit the transaction

            fclose($handle); // Always close the file handler

            return redirect()->back()->with('message', "File imported successfully. {$rowsImported} rows imported." );

        } catch (\Exception $e) {
            \DB::rollBack(); // Roll back the transaction in case of error

            return redirect('/tickets/upload?error')
                ->with('message', 'An error occurred during import: ' . $e->getMessage());
        }
    }



}
