<!-- BEGIN CONTENT PAGE -->
<div class="row ">
    <div class="col-md-12">
        @foreach( $areas as $area )
        <div class="row" style="padding-left:10px; ">
            <div class="col-md-9">
                <h4 class="uppercase">{{ $area->name }} </h4>
            </div>
            <div class="col-md-3  ">
                <div class="pull-right ">
                    @if( $area->area_id==2)
                    <button class="btn btn-info btn-sm btn-clone-area" type="button" data-id="{{ $ticket->id }}" data-area-id="{{ $area->area_id }}"> Add More</button>
                    @endif
                </div>
            </div>
        </div><!-- close row -->
        <?php  
            $items = App\Models\TicketItem::select()
            ->where('ref_number', $ticket->ref_number )
            ->where('area_id', $area->area_id )->get() 
        ?>
        <table class="table table-bordered table-hover table-condensed " style="background-color: #fff; border: 5px solid #fff">
            <thead>
                <tr>
                    <th class="col-md-3"> Requirements </th>
                    <th class="col-md-1"> Compliance </th>
                    <th class="col-md-1"> Location </th>
                    <th class="col-md-2"> Group </th>
                    <th class="col-md-2"> Responsible </th>
                    <th class="col-md-3"> Notes </th>
                </tr>
            </thead>
            @foreach( $items as $item )
            <tr>
                <td> {{ $item->name }} <input type="hidden" name="item_id[]" value="{{ $item->id }}"> </td>
                <td>
                    <select name="score[]" id="score" class="form-select  ">
                        <option value="-1" <?php if( $item->score==-1 ) echo 'selected' ?> >N/A</option>
                        <option value="0" <?php if( $item->score==0 ) echo 'selected' ?> >No</option>
                        <option value="1" <?php if( $item->score==1 ) echo 'selected' ?> >Yes</option>
                        <option value="0.5" <?php if( $item->score==0.5 ) echo 'selected' ?> >Partial</option>
                    </select>
                </td>
                <td>
                    <select name="location[]" id="location" class="form-select ">
                        <option value="">-N/A-</option>
                        <option value="SIN" <?php if( $item->location=="SIN" ) echo 'selected' ?> >SIN</option>
                        <option value="YUL" <?php if( $item->location=="YUL" ) echo 'selected' ?> >YUL</option>
                        <option value="OTHER" <?php if( $item->location=="OTHER" ) echo 'selected' ?> >Other</option>
                    </select>
                </td>
                <td>
                    <select name="group[]" id="group" class="form-select ">
                        <option value="">-select-</option>
                        @foreach( $sccGroups as $group )
                        <option value="{{$group->name}}" <?php if( $item->group== $group->name ) echo 'selected' ?> > {{ $group->name }} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control input-sm input-get-name getName w-100" data-item-id="{{ $item->id }}" placeholder="enter name" name="analyst[]" value="{{ $item->analyst }}"  />
                    <ul class="suggestions-list"></ul>
                </td>
                <td>
                    <input type="text" class="form-control input-sm" placeholder="enter notes" name="notes[]" value="{{ $item->notes }}" width="100" />
                </td>
            </tr>
            @endforeach
        </table>
        @endforeach
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
