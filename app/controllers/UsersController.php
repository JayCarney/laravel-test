<?php

class UsersController extends BaseController {

    public function create(){
        if(Auth::check()){
            return View::make('basic', ['warning'=>'You\'re already signed in']);
        } else {
            return View::make('users.create');
        }
    }

    public function store(){
        if(Input::get('password') != Input::get('password_confirm')){
            return View::make('basic',['content'=>'Passwords did not match']);
        }
        $rules = [
            'email'=>'required|email|unique:users',
            'name'=>'required',
            'password'=>'required'
        ];

        $validator = Validator::make(Input::only('email','name','password'), $rules);

        if($validator->fails()){
            return View::make('users.create',['errors'=>$validator]);
        } else {
            $user = new User();
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::to('login')->with('flash','Account created, please sign in');
        }

    }

    public function destroy(){

    }
}
