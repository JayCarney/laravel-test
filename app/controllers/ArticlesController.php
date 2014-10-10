<?php

class ArticlesController extends BaseController {

    public function create(){

        if(Auth::check()){
            return View::make('articles.create');
        } else {
            return Redirect::to('login')->with('error','You must be logged in first');
        }
    }

    public function store(){
        if(!Auth::check()){
            return Redirect::to('signin')->with('error','You must be signed in the create an article');
        }
        $rules = [
            'title'=>'required',
            'content'=>'required'
        ];

        $validator = Validator::make(Input::only('title','content'), $rules);

        if($validator->fails()){
            return Redirect::route('articles.create',['errors'=>$validator]);
        } else {
            $article = new Article();
            $article->title = Input::get('title');
            $article->content = Input::get('content');
            $article->author_id = Auth::id();
            $article->save();
            return Redirect::route('articles.create')->with('info','Article added successfully');
        }
    }

    public function destroy(){

    }
}
