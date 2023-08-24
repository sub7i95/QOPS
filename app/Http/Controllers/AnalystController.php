<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyst;

class AnalystController extends Controller
{
    public function index()
    {
        return view('analyst.index')->with('analysts', Analyst::orderBy('name')->simplePaginate());
    }

    public function edit(string $id)
    {
        $analyst = Analyst::find($id);

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
        $analyst->email = $request->email;
        $analyst->group = $request->group;
        $analyst->active = $request->active;
        $analyst->save();

        return redirect("/analysts/".$analyst->id."/edit"); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 201); 
    }

    public function update(Request $request, string $id)
    {
        $request->validate( [
            'name'=> 'required|max:255',
            'location' => 'required|max:255',
            'email'    => 'required|email|max:255',         
            ]);

        $analyst = Analyst::find($id);
        $analyst->name = $request->name;
        $analyst->location = $request->location;
        $analyst->email = $request->email;
        $analyst->active = $request->active;
        $analyst->save();

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }
}