<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.index')->with('services', Service::orderBy('name')->simplePaginate());

    }

    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $service = new Service;
        $service->name = request('name');
        $service->active = request('active');
        $service->save();
        return redirect('/services/'.$service->id.'/edit');

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }

    public function show( $id )
    {
      //  return $id;
        $service = Service::find( $id );
        return view('service.edit')->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate( [
            'name'=> 'required|max:255',  
            ]);

        $service = Service::find( $id );
        $service->name = request('name');
        $service->active = request('active');
        $service->save();

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }

}
