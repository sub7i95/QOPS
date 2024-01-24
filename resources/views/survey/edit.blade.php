@extends('layouts.app')
@section('content')
@include('survey.header')
<div class="card">
  <div class="card-body">

    <form name="" id="" class="form form-horizontal " role="form" action="/surveys/{{$survey->id}}/edit"  method="post">
    {!! csrf_field() !!}


            <!-- BEGIN CONTENT PAGE -->
            <div class="row ">
                <div class="col-md-8">
                                
                     <div class="form-group">
                        <label  class="col-sm-3 control-label" for="name">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="name" name="name" required="" value="{{ $survey->name}}" />
                            </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="owner">Owner Group</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="owner" id="owner" required="">
                                  <option value="">-select-</option>
                                  <option value="SCC" @if( $survey->parent=="SCC") selected @endif> SCC</option>
                                  <option value="SSD" @if( $survey->parent=="SSD") selected @endif> SSD</option>
                                </select>
                            </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label" for="active">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="active" id="active" required>
                                  <option value="1" @if( $survey->parent=="1") selected @endif> Active</option>
                                  <option value="0" @if( $survey->parent=="0") selected @endif> Inactive</option>
                                </select>
                            </div>
                      </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a class="btn btn-secondary" href="/surveys">< Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
</form>

<div class="row ">
    <div class="col-md-6">
        <span class="caption-subject font-dark bold uppercase"></span> 
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <a class="btn  btn-success  btn-add-surveys-area pull-right" href="javascript:;">
            <i class="icon-plus"></i> Add New Area
        </a>
    </div>


<div class="row ">
  <div class="col-md-12">      

          <div class="portlet-body">

              <?php $totalWeight=0?>
              @foreach( $areas as $area )

                  <div class="row my-4" >    
                      <div class="col-md-6">
                          <i class="icon-layers"></i> <b>{{ $area->name }}</b>
                       </div>
                      <div class="col-md-6  d-flex justify-content-end ">
                          
                              <a class="btn btn-success btn-sm btn-add-item" data-id="{{ $area->id }}"  href="javascript:;">
                                  <i class="icon-plus"></i> Add Question
                              </a>
                              <a class="btn btn-info btn-sm btn-edit-area-id" data-id="{{ $area->id }}" href="{{ url('surveys/'.$survey->id .'/areas/'.$area->id ) }}">
                                  <i class="icon-pencil"></i> Edit
                              </a>
                              <a class="btn btn-danger btn-sm btn-remove-area-id" data-id="{{ $area->id }}" href="javascript:;">
                                  <i class="icon-trash"></i> Remove
                              </a>                                                          
                           
                       </div>
                  </div><!-- close row -->

                      <?php  $items = App\Models\SurveyItem::where('survey_id', $survey->id)->where('area_id', $area->id)->get() ?>
                          <table id="tableSurveyItems" class="table table-striped table-bordered table-hover " >
                          <thead>
                              <tr>
                                  <th class="col-md-1">  </th>
                                  <th class="col-md-1"> ID </th>
                                  <th class="col-md-8"> Name </th>
                                  <th class="col-md-1"> Weight </th>
                              </tr>
                          </thead>
                          <?php $weight=0?>
                          @foreach( $items as $item)
                              <tr>
                                  <td>
                                      <a class="btn btn-info btn-xs  btn-edit-item-id" data-id="{{ $item->id }}" data-survey="{{ $survey->id }}" href="javascript:;"><i class="fa-solid fa-pen-to-square"></i></a>
                                      <a class="btn btn-danger btn-xs  btn-remove-item-id"  data-id="{{ $item->id }}" href="javascript:;"><i class="fa-solid fa-trash"></i></a>
                                  </td>
                                  <td> {{ $item->id }} </td>
                                  <td> {{ $item->name }} </td>
                                  <td> {{ $item->weight }} </td>
                              </tr>       

                          <?php 
                          $weight = $item->weight + $weight;
                          $totalWeight=$item->weight+$totalWeight;
                          ?>               
                          @endforeach 
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td> </td>
                                  <td> <b>{{ $weight }}</b> </td>
                              </tr>                                 
                          </table>
              
              @endforeach                
              <b class="pull-right" style="padding: 20px">100% = {{ $totalWeight }}</b>
              
          </div>
      </div>
      <!-- END SAMPLE FORM PORTLET-->
  </div>
</div>
<!-- END PAGE BASE CONTENT -->

@include('survey.modal.area')
@include('survey.modal.area_item')

@endsection


@section('scripts')
<script type="text/javascript">
//
</script>
@endsection