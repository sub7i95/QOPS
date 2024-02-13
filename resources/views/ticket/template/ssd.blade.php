<!-- BEGIN CONTENT PAGE -->
<div class="row ">
    <div class="col-md-12">
        <?php $areas = App\Models\TicketArea::where('ref_number', $ticket->ref_number )->orderBy('position')->get() ?>
        @foreach( $areas as $area )
        <div class="row" style="padding-left:10px; ">
            <div class="col-md-6">
                <h4 class="uppercase">{{ $area->name }} </h4>
            </div>
            <div class="col-md-6  ">
                <div class="pull-right ">
                    @if( $ticket->status==2 )
                    <button class="btn btn-info btn-sm btn-clone-area" type="button" data-id="{{ $ticket->id }}" data-area-id="{{ $area->area_id }}"> Add More</button>
                    @endif
                </div>
            </div>
        </div><!-- close row -->
        <?php  $items = App\Models\TicketItem::select()
                                ->where('ref_number', $ticket->ref_number )
                                ->where('area_id', $area->area_id )->get() 
                        ?>
        <table class="table table-bordered table-hover table-condensed " style="background-color: #fff; border: 5px solid #fff">
            <thead>
                <tr>
                    <th class="col-md-3"> Requirements </th>
                    <th class="col-md-1"> Compliance </th>
                    <th class="col-md-2"> Responsible </th>
                    <th class="col-md-3"> Notes </th>
                    @if( $ticket->status==3 AND $ticket->is_audited==1)
                    <th class="col-md-3"> Notes Manager</th>
                    @endif
                </tr>
            </thead>
            @foreach( $items as $item )
            <input type="hidden" name="group[]" value="{{ $item->group }}">
            <tr>
                <td> {{ $item->name }} <input type="hidden" name="item_id[]" value="{{ $item->id }}"> </td>
                <td>
                    <select name="score[]" id="score" class="form-select form-select-sm input-sm">
                        <option value="-1" <?php if( $item->score==-1 ) echo 'selected' ?> >N/A</option>
                        <option value="0" <?php if( $item->score==0 ) echo 'selected' ?> >No</option>
                        <option value="1" <?php if( $item->score==1 ) echo 'selected' ?> >Yes</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control input-sm input-get-name" data-item-id="{{ $item->id }}" placeholder="enter name" name="analyst[]" value="{{ $item->analyst }}" style="width: 200px;" />
                </td>
                <td>
                    <input type="text" class="form-control input-sm" placeholder="enter notes" name="notes[]" value="{{ $item->notes }}" width="100" />
                </td>
                @if( $ticket->status==3 AND $ticket->is_audited==1)
                <td>
                    <input type="text" class="form-control input-sm" placeholder="enter notes" name="notes_manager[]" value="{{ $item->notes_manager }}" />
                </td>
                @endif
            </tr>
            @endforeach
        </table>
        @endforeach
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
