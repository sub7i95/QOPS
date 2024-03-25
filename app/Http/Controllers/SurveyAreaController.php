<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\SurveyArea;
use App\Models\SurveyItem;

class SurveyAreaController extends Controller
{
    //

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

        $SurveyArea = new SurveyArea;
        $SurveyArea->name = $request->name;
        $SurveyArea->survey_id = $request->survey_id;
        $SurveyArea->created_by = \Auth::user()->id;
       // $SurveyArea->active = $request->active;
        $SurveyArea->save();

        return response( [ 
            'ok'    => true, 
            'data'  => $SurveyArea 
        ] , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sid, $aid)
    {
        //$areas = SurveyArea::where('survey_id', $id)->get();
        return view('survey.edit_area')
        ->with('area', SurveyArea::find($aid) )
        ->with('sid', $sid)
        ;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($sid, $aid)
    {
        
        $area = SurveyArea::findOrFail( $aid );
        $area->name = request()->name;
        $area->position = request()->position;
        $area->save();

        return redirect('/surveys/'.$area->survey_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete area
        SurveyArea::find($id)->delete();
        //delete children
        SurveyItem::where('area_id', $id)->delete();

        return response( [ 
            'ok'    => true,  
        ] , 203);

    }
}
