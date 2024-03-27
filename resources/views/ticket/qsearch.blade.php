@extends('layouts.app')
@section('content')
@include('ticket.header')
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Quick Search
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="table-tickets" class="table dt table-borderless table-hover  table-striped table-hover " data-order='[[2,"asc"]]'>
            <thead>
                <tr>
                    <th></th>
                    <th> ID </th>
                    <th> Service </th>
                    <th> Requester </th>
                    <th> Resolver Group </th>
                    <th> Reported by </th>
                    <th> Priority </th>
                    <th> Status </th>
                    <th> Score </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $tickets as $ticket)

                    <!-- -->
                    @if( $ticket->status > 1 )
                    <?php 
                        $areas = App\Models\TicketArea::where('ref_number', $ticket->ref_number )
                        ->orderBy('position')
                        ->get()
                    ?>
                        <?php 
                        $totalScore = 0; 
                        $totalWeight =0;
                        ?>
                        @foreach( $areas as $area )
                        <?php 

                            $item = App\Models\TicketItem::select( 
                                DB::raw(" IFNULL( Sum(`tickets_items`.`weight` * 1 ) ,0)  AS full_score "  ),
                                DB::raw(" IFNULL( Sum(`tickets_items`.`weight` * `tickets_items`.`score`) ,0)  AS score "  ),
                                DB::raw(" IFNULL( Sum(`tickets_items`.`weight` ) ,0)  AS weight "  )            )
                                ->where('ref_number', $ticket->ref_number )
                                ->where('area_id', $area->area_id )
                                ->where('is_applicable', 1) //only the Yes/No activities
                                ->first() ;
                        
                            $totalWeight = $totalWeight + $item->weight; 
                            $totalScore = $totalScore + $item->score; 
                            //$score = number_format(($totalScore / $totalWeight) * 100);
                            $score = ($totalWeight > 0) ? number_format(($totalScore / $totalWeight) * 100) : 'n/a';

                            ?>
                                @endforeach
                    @endif
                    @if ($ticket->status ==1)
                    <?php
                    $score = 0
                    ?>
                    @endif
                    <!-- -->

                <tr>
                    <td><a href="/tickets/{{ $ticket->id }}/show" class=""><i class="icon-eye"></i> View</a></td>
                    <td> {{ $ticket->ref_number }} </td>
                    <td> {{ $ticket->service }} </td>
                    <td> {{ $ticket->requester }} </td>
                    <td> {{ $ticket->resolver_group }} </td>
                    <td> {{ $ticket->reported_by }} </td>
                    <td> {{ $ticket->priority }} </td>
                    <td> {{ $ticket->status_name }} </td>
                    <td>
                        @if ($score == 'n/a')
                            n/a
                        @else
                            {{ $score }}%
                        @endif
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
<script type="text/javascript">
var table = $('#table-tickets'); //main user table

table.dataTable({
    "lengthMenu": [
        [50, 100, -1],
        [50, 100, "All"]
    ],
    "pageLength": 50,
    "iDisplayLength": 50,
    "cache": true,
});

</script>
@endsection
