<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

use App\Models\Analyst;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //return view('analyst.index')->with('analysts', Analyst::orderBy('name')->simplePaginate());

        //return view('group.index')->with('groups', Group::all())->simplePaginate();

        return view('group.index')
        ->with('groups', Group::orderBy('name')->get())
        //->simplePaginate())
        ;
    }

 
    public function create()
    {
        return view('group.create');
    }

 
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

 
    public function show(Group $group)
    {
        //
    }

 
    public function edit(string $id)
    {
        $group = Group::find( $id );
        return view('group.edit')->with('group', $group);
    }

 
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

 
    public function destroy(Group $group)
    {
        //
    }

    public function getAnalysts( $name )
    {
        return Analyst::select('name')->where('group', $name)->distinct()->orderBy('name')->get();

    }

}
