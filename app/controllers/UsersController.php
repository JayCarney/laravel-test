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
            $total_users = count(User::all());
            $user = new User();
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            if($total_users == 0){
                $user->is_super = true;
            }
            $user->save();
            return Redirect::to('login')->with('info','Account created, please sign in');
        }

    }

    public function index(){
        $users = User::all();
        return View::make('users.index',compact('users'));
    }

    public function destroy(){

    }
    public function grant_super($id){
        if(Auth::check() && Auth::user()->is_super){
            $user = User::find($id);
            $user->is_super = true;
            $user->save();
            return Redirect::route('users.index')->with('info', 'Escalated user privileges granted');
        }
        return Redirect::route('users.index')->with('error', 'You must me a publisher to modify user privileges');
    }
    public function revoke_super($id){
        if(Auth::check() && Auth::user()->id == $id){
            return Redirect::route('users.index')->with('error', 'You can not modify your own privileges');
        }
        if(Auth::check() && Auth::user()->is_super){
            $user = User::find($id);
            $user->is_super = false;
            $user->save();
            return Redirect::route('users.index')->with('info', 'Escalated user privileges revoked');
        }
        return Redirect::route('users.index')->with('error', 'You must me a publisher to modify user privileges');
    }
}
