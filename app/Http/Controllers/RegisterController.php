<?php

namespace App\Http\Controllers;
use App\Models\User;


class RegisterController extends Controller
{
    public function create()
    {
       return view('register.create');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username'=>'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255'
        ]);

//        $attributes['password'] = md5($attributes['password']);

       $user =  User::create($attributes);
//       ddd($user);

        auth()->login($user);
      return redirect('/')->with('success','Your account has been created');
    }
}
