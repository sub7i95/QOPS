@if( $ticket->status > 1 )
<?php 
    $areas = App\Models\TicketArea::where('ref_number', $ticket->ref_number )
    ->orderBy('position')
    ->get()
?>
<table class="table table-bordered  " style="background-color: #f9f9f9; border: 1px solid #ccc">
    <thead>
        <tr>
            <th class="col-md-4"> Area </th>
            <th class="col-md-4"> Compliance/Score</th>
        </tr>
    </thead>
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

        ?>
    <tr>
        <td> {{ $area->name }} </td>
        <td> @if($item->full_score>0) {{ number_format(( $item->score / $item->full_score) *100 ) }}% @else n/a @endif</td>
    </tr>
    @endforeach
    <tfooter>
        <tr>
            <th class="col-md-4"> Total </th>
            <th class="col-md-4">
                @if($totalScore>0)
                <B> {{ $score->score }}%</B>
                @endif
            </th>
        </tr>
        <tfooter>
</table>
@endif
