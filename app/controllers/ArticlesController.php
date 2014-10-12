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
        $imageMimeTypes = ['image/jpg','image/jpeg','image/png','image/gif'];
        $image = null;
        if(Input::hasFile('image') && in_array(Input::file('image')->getMimeType(),$imageMimeTypes)) {
            Input::file('image')->move(public_path() . '/uploads/' . Auth::user()->id, Input::file('image')->getClientOriginalName());
            $image = '/uploads/' . Auth::user()->id . '/' . Input::file('image')->getClientOriginalName();
        }
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
            if(!is_null($image)){
                $article->image = $image;
            }
            $article->title = Input::get('title');
            $article->content = Input::get('content');
            $article->save();
            $tagIds = array();
            if(Input::get('tags')){
                $tags = Input::get('tags');
                $tags = explode(',', $tags);
                foreach($tags as $tag){
                    $tagObj = Tag::firstOrCreate(['tag'=>$tag]);
                    $tagIds[] = $tagObj->id;
                }
            }
            //update stored tags for article
            $article->tags()->sync($tagIds);

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
        if(is_null($article)){
            return Redirect::route('articles.index')->with('error', 'Article not found');
        }
        if(!$article->published){
            if(!Auth::check() || !($article->user->id == Auth::user()->id)){
                return Redirect::route('articles.index')->with('warning', 'Article not published');
            }
        }
        return View::make('articles.show',compact('article'));
    }

    public function edit($id){
        $article = Article::find($id);
        $tags = array();
        foreach($article->tags as $tag){
            $tags[] = $tag->tag;
        }

        return View::make('articles.create',['title'=>$article->title, 'tags' => implode(', ',$tags), 'content'=>$article->content, 'id'=>$article->id]);
    }

    public function author($id){
        if(Auth::check() && (Auth::user()->id == $id || Auth::user()->is_super)){
            $articles = Article::where('author_id', '=', $id)->get();
        } else {
            $articles = Article::where('author_id', '=', $id)->where('published', '=', true)->get();
        }
        $user = User::find($id);
        return View::make('articles.index', ['articles'=>$articles, 'heading'=>'Articles by '.$user->name]);
    }

    public function tag($id){
        $tag = Tag::find($id);
        $articles = $tag->articles;
        return View::make('articles.index', ['articles'=>$articles, 'heading'=>'Articles tagged as "'.$tag->tag.'"']);
    }

    public function search(){
        $term = Input::get('q');
        $keywords = explode(' ',$term);
        $query = Article::query();
        if(!(Auth::check() && Auth::user()->is_super)) {
            //not a super user
            $query->where('published', '=', true);
        }
        foreach($keywords as $keyword){
            $query->where('title','like','%'.$keyword.'%');
        }
        $articles = $query->get();

        return View::make('articles.index', ['heading'=>'Search results for "'.$term.'"','q'=>$term,'articles' => $articles]);
    }
}
