<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyst;

class AnalystController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function qsearch(Request $request)
    {
        $query = $request->input('name');
        $results = Analyst::where('active',1)
            ->where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->distinct()
            ->get(['name'])
            ->take(10); 
        return response()->json($results);
    }



    public function index()
    {
        $analysts =Analyst::orderBy('name')
        //->simplePaginate() /// removed this to use datatables JS in the html
        ->get();

        return view('analyst.index')
        ->with('analysts', $analysts);
    }


    public function edit(Analyst $analyst)
    {
        return view('analyst.edit')
        ->with('analyst', $analyst);
    }


    public function create()
    {
        return view('analyst.create');
    }


    public function store(Request $request)
    {
        $request->validate( [
            'name'=> 'required|max:255',
            'location' => 'required|max:255',
            'email'     => 'required|email|max:255',
        ]);

        $analyst = new Analyst;
        $analyst->name = $request->name;
        $analyst->location = $request->location;
        $analyst->email = \Str::lower( $request->email );
        $analyst->group = $request->group;
        $analyst->active = $request->active;
        $analyst->save();

        $request->session()->flash('success', 'Information was saved successfully.');
        return redirect("/analysts/{$analyst->id}/edit"); // Redirect back to the form

    }


    public function update(Request $request, Analyst $analyst)
    {
        $request->validate( [
            'name'=> 'required|max:255',
            'location' => 'required|max:255',
            'email'    => 'required|email|max:255',         
        ]);

        $analyst->name = $request->name;
        $analyst->location = $request->location;
        $analyst->email = \Str::lower( $request->email );
        $analyst->active = $request->active;
        $analyst->save();

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

    }


    public function destroy( Analyst $analyst )
    {
        $analyst->destroy();
        return redirect('/analysts');
    }




}