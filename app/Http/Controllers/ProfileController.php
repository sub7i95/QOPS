<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{

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

        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }


    
    public function updatePassword(Request $request)
    {

        $request->validate( [
            'password' => [ 'required', 'string', 'min:8', 'confirmed' ], //, 'confirmed' 'required',
        ]);

        $user = User::find( auth()->user()->id );
        $user->password = Hash::make(request('password'));
        $user->save();


        $request->session()->flash('success', 'Information was saved successfully.');

        return redirect()->back(); // Redirect back to the form

        return response( [ 
            'ok'    => true, 
            'data'  => $user 
        ] , 200); 
    }
}
