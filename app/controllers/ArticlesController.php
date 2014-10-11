<?php

class ArticlesController extends BaseController {
    public function index(){
        if(Auth::check() && Auth::user()->is_super){
            $articles = Article::all();
        } else {
            $articles = Article::where('published', '=', true)->get();
        }
        return View::make('articles.index', ['articles'=>$articles]);
    }
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
            if(Input::get('id')){
                //existing article
                $article = Article::find(Input::get('id'));
                $message = 'Article updated successfully';
            } else {
                //new article
                $article = new Article();
                $article->author_id = Auth::id();
                $message = 'Article added successfully';

            }
            $article->title = Input::get('title');
            $article->content = Input::get('content');
            $article->save();
            return Redirect::route('articles.author', array(Auth::user()->id))->with('info',$message);
        }
    }

    public function destroy($id){
        $article = Article::find($id);
        $article->delete();

        return Redirect::route('articles.index')->with('info','Article removed');
    }

    public function publish($id){
        if(!Auth::check()){
            return Redirect::route('articles.index')->with('error','You must be a super-user to publish articles');
        }
        $article = Article::find($id);
        $article->published = true;
        $article->save();
        return Redirect::route('articles.index')->with('info','Article published');
    }

    public function unpublish($id){
        if(!Auth::check()){
            return Redirect::route('articles.index')->with('error','You must be a super-user to unpublish articles');
        }
        $article = Article::find($id);
        $article->published = false;
        $article->save();
        return Redirect::route('articles.index')->with('info','Article unpublished');
    }

    public function show($id){
        $article = Article::find($id);
        return View::make('basic',['content'=>'<h1>'.$article->title.'</h1><p>Author: '.$article->user->name.'</p>'.$article->content]);
    }

    public function edit($id){
        $article = Article::find($id);

        return View::make('articles.create',['title'=>$article->title, 'content'=>$article->content, 'id'=>$article->id]);
    }

    public function author($id){
        $articles = Article::where('author_id', '=', $id)->get();
        $user = User::find($id);
        return View::make('articles.index', ['articles'=>$articles, 'heading'=>'Articles by '.$user->name]);
    }
}
