<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyArea;

class SurveyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
        
    public function index(Request $request )
    {
        return view('survey.index')->with('surveys', Survey::orderBy('name')->get());
    }

    public function create()
    {
        return view('survey.create');
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $survey = new Survey;
        $survey->name = request('name');
        $survey->active = request('active');
        $survey->owner = request('owner');
        $survey->owner_id = \Auth::user()->id; //in porcess;
        $survey->save();
        return redirect('/surveys/'.$survey->id.'/edit');

        return response( [ 
            'ok'    => true, 
            'data'  => $Survey 
        ] , 200);
    }

    public function edit( Survey $survey ) //route binding
    { 
        //return $survey->areass;

        $areas = SurveyArea::where('survey_id', $survey->id)->get();
        // $surevey->areas; //same as above

        return view('survey.edit')
        ->with('survey', $survey)
        ->with('areas', $areas);
        ;
    }

    public function update(Request $request, string $id)
    {

        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $survey = Survey::find( $id );
        $survey->name = request('name');
        $survey->owner = request('owner');
        $survey->active = request('active');
        $survey->save();
        //return redirect('/groups/'.$group->id.'/edit');

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }

}
