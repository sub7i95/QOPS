<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit() //route binding
    { 
        return view('profile.edit');
    }

    public function update(Request $request)
    {

        $request->validate( [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255' ], //'unique:users'
        ]);

        $user = User::find(  auth()->user()->id  );
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        //$user->email = request('email');
        $user->save();

       return redirect()->back()->with('message', 'Information saved successfully');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find( auth()->user()->id );
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('message', 'Information saved successfully');
    }
}
