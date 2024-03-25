<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\SurveyArea;
use App\Models\SurveyItem;

class SurveyItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make( $request->all() , [
            'name'=> 'required|max:255',
            ]);
        
        if( $v->fails() )
        {   
            return response( $v->errors() ,422); 
        }

        $SurveyItem = new SurveyItem;
        $SurveyItem->name = $request->name;
        $SurveyItem->area_id = $request->area_id;
        $SurveyItem->survey_id = $request->survey_id;
        $SurveyItem->weight = $request->weight;
        $SurveyItem->created_by = \Auth::user()->id;
        $SurveyItem->save();

        return response( [ 
            'ok'    => true, 
            'data'  => $SurveyItem 
        ] , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid, $id)
    {
        return SurveyItem::find( $id );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = SurveyArea::where('survey_id', $id)->get();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sid, $id)
    {
        $item = SurveyItem::find( $id );

        $item->name = $request->name;
        $item->weight = $request->weight;
        //$item->active = $request->active;
        $item->save();

        return response( [ 
            'ok'    => true,  
        ] , 203);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SurveyItem::find($id);
        $item->delete();

        return response( [ 
            'ok'    => true,  
        ] , 203);

    }
    
}
