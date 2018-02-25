<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\User;

class RegistrationsController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }
    
    public function store()
    {
        // TODO: Sanitation, Validation
        
        // Validate the form
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::create([
            'name' => request('name'), 
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        
        auth()->login($user);
        
        return redirect()->home();
    }
}
