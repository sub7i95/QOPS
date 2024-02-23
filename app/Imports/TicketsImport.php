<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use \Carbon\Carbon;

use App\Models\Ticket;

class TicketsImport implements ToModel , WithProgressBar, WithStartRow, WithValidation // Remove WithHeadingRow if not applicable
{
    use Importable;

    public function __construct()
    {
        // code...
    }

    public function startRow(): int
    {
        return 1;
    }
    
    public function model(array $row)
    {
        return new Ticket([
            'requester'         => $row['requester'],
            'group'             => $row['group'],
            'ref_number'        => $row['ref_number'],
            'open_date'         => str_replace(' ', '-', $row['open_date']),
            'closed_date'       => str_replace(' ', '-', $row['closed_date']),
            'service'           => $row['service'],
            'priority'          => $row['priority'],
            'sla_breached'      => $row['sla_breached'],
            'customer'          => $row['customer'],
            'location'          => $row['location'],
            'reporting_method'  => $row['reporting_method'],
            'resolver_group'    => $row['resolver_group'],
            'resolution_code'   => $row['resolution_code'],
            'cause_code'        => $row['cause_code'],
            'responsible_party' => $row['responsible_party'],
            'reported_by'       => $row['reported_by'],
            'closed_by'         => $row['closed_by'],
        ]);
    }

    public function rules(): array
    {
    /*
        return [
            '0' => 'required|date',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            //'5' => 'required',
           // '2' => 'exists:users,email',
        ];*/
    }


    public function customValidationMessages()
    {
/*        return [
            
            '0' => 'The date value or format is not valid. Please use YYYY-MM-DD',
            '1' => 'Merchant Name is required.',
            '2' => 'Card Holder Name is required.',
            '3' => 'Charge Description is required.',
            '4' => 'Amount is required.',
        ];*/
    }

}
