<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('users.*', 'roles.name as role')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->simplePaginate();

        return view('user.index')
        ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6',            
            ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->active = $request->active;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect("/users/".$user->id."/edit"); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('user.edit')
        ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate( [
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            //'email'     => 'required|email|max:255',         
            ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->active = $request->active;
        //$user->password = $request->password ? bcrypt($request->password) : $user->password ;
        $user->save();

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
    public function destroy(string $id)
    {
        //
    }
}
