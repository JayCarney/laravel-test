@extends('layouts.bootstrap')

@section('content')
    @if(isset($articles))
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">{{ isset($heading)? $heading : 'All articles' }}</div>
          <!-- Table -->
          <table class="table">
          <tr><th>Title</th><th>Author</th>
          @if(Auth::check())
          <th></th>
          @endif
          </tr>
        @foreach($articles as $article)
            <tr>
            <td>{{ HTML::linkAction('ArticlesController@show', $article->title,array($article->id)) }}</td>
            <td>{{{ $article->user->name }}}</td>
            @if(Auth::check())
            <td>
                <!-- Small button group -->
                <div class="btn-group">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>{{ HTML::linkAction('ArticlesController@show', 'View', array($article->id)) }}</li>
                    <li>{{ HTML::linkAction('ArticlesController@edit', 'Edit', array($article->id)) }}</li>
                    @if(Auth::user()->is_super)
                    <li>{{ HTML::linkAction('ArticlesController@publish', 'Publish', array($article->id)) }}</li>
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