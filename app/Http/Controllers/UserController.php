<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::select('users.*', 'roles.name as role')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        //->simplePaginate() /// removed this to use datatables JS in the html
        ->get();

        return view('user.index')
        ->with('users', $users);
    }


    public function create()
    {
        return view('user.create');
    }


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
        $user->email = \Str::lower( $request->email );
        $user->role_id = $request->role_id;
        $user->active = $request->active;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect("/users/{$user->id}/edit")->wiht('message', 'Saved');

    }


    public function edit(User $user)
    {
        return view('user.edit')
        ->with( 'user', $user );
    }


    public function update(Request $request, User $user )
    {
        $request->validate( [
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            //'email'     => 'required|email|max:255',         
            ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = \Str::lower( $request->email );
        $user->role_id = $request->role_id;
        $user->active = $request->active;
        //$user->password = $request->password ? bcrypt($request->password) : $user->password ;
        $user->save();

        return redirect()->back()->with('message', 'Information saved successfully'); 
    }


    public function destroy( User $user )
    {
        $user->destroy();
        return redirect('/users');
    }


}
