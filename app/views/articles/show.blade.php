@extends('layouts.bootstrap')

@section('content')
  <h1>{{{ $article->title }}}</h1>
  <p>Published by {{ HTML::linkAction('ArticlesController@author', $article->user->name,array($article->user->id)) }}
  @if(count($article->tags) > 0)
  in
    @foreach($article->tags as $index => $tag)
        @if($index == count($article->tags) - 1)
        {{ HTML::linkAction('ArticlesController@tag', $tag->tag,array($tag->id)) }}
        @else
        {{ HTML::linkAction('ArticlesController@tag', $tag->tag,array($tag->id)) }},
        @endif
    @endforeach
  @endif
  </p>
  {{ $article->content }}
@endsection

@section('class')article
@endsection