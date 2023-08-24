<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('analyst.index')->with('analysts', Analyst::orderBy('name')->simplePaginate());

        //return view('group.index')->with('groups', Group::all())->simplePaginate();

        return view('group.index')->with('groups', Group::orderBy('name')->simplePaginate());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $group = new Group;
        $group->name = request('name');
        $group->parent = request('parent');
        $group->active = request('active');
        $group->save();
        return redirect('/groups/'.$group->id.'/edit');

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group = Group::find( $id );
        return view('group.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $group = Group::find( $id );
        $group->name = request('name');
        $group->parent = request('parent');
        $group->active = request('active');
        $group->save();
        //return redirect('/groups/'.$group->id.'/edit');

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
