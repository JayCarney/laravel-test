<?php

class SessionsController extends BaseController {

    public function create(){
        if(Auth::check()){
            return 'you are already logged in';
        } else {
            return View::make('sessions.create');
        }
    }

    public function store(){
        if(Auth::attempt(Input::only('email', 'password'))){
            return Redirect::route('articles.author',array(Auth::user()->id));
        } else {
            return Redirect::to('login');
        }
    }

    public function destroy(){
        Auth::logout();
        return Redirect::to('login');
    }
}
