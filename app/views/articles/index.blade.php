@extends('layouts.bootstrap')

@section('content')
    @if(isset($articles))
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">{{ isset($heading)? $heading : 'All articles' }}</div>
            <div class="panel-body">
            {{ Form::open(['route'=>'articles.search', 'class'=>'navbar-form navbar-left', 'role'=>'search']) }}
                  <div class="form-group">
                  {{ Form::text('q', isset($q)?$q:null, ['class'=>'form-control', 'placeholder'=>'Search all articles']) }}
                  </div>
                  {{ Form::submit('Search', ['class'=>'btn btn-default']) }}
            {{ Form::close() }}
            </div>
          <!-- Table -->
          <table class="table">
          <tr><th>Title</th><th>Tags</th><th>Image</th><th>Author</th>
          @if(Auth::check() && Auth::user()->is_super)
          <th>Published</th>
          @endif
          @if(Auth::check())
          <th></th>
          @endif
          </tr>
        @foreach($articles as $article)
            <tr>
            <td>{{ HTML::linkAction('ArticlesController@show', $article->title,array($article->id)) }}</td>
            <td>
            @foreach($article->tags as $index => $tag)
                @if($index == count($article->tags) - 1)
                {{ HTML::linkAction('ArticlesController@tag', $tag->tag ,array($tag->id)) }}
                @else
                {{ HTML::linkAction('ArticlesController@tag', $tag->tag,array($tag->id)) }},
                @endif
            @endforeach
            </td>
            <td>
            {{{ $article->image }}}
            </td>
            <td>{{ HTML::linkRoute('articles.author', $article->user->name, array($article->user->id)) }}</td>
            @if(Auth::check() && Auth::user()->is_super)
            <td>
                @if($article->published)
                    Yes
                @else
                    No
                @endif
            </td>
            @endif
            @if(Auth::check())
            <td>
                <!-- Small button group -->
                <div class="btn-group">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>{{ HTML::linkAction('ArticlesController@show', 'View', array($article->id)) }}</li>
                    @if(Auth::check() && (Auth::user()->id == $article->user->id || Auth::user()->is_super))
                    <li>{{ HTML::linkAction('ArticlesController@edit', 'Edit', array($article->id)) }}</li>
                    @endif
                    @if(Auth::check() && Auth::user()->is_super)
                        @if($article->published)
                            <li>{{ HTML::linkAction('ArticlesController@unpublish', 'Unpublish', array($article->id)) }}</li>
                        @else
                            <li>{{ HTML::linkAction('ArticlesController@publish', 'Publish', array($article->id)) }}</li>
                        @endif
                    <li>{{ HTML::linkRoute('articles.delete', 'Delete', array($article->id)) }}</li>
                    @endif
                  </ul>
                </div>
            </td>
            @endif
            </tr>
        @endforeach
        </table>
        </div>
    @endif
@endsection