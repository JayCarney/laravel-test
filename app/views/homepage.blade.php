@extends('layouts.bootstrap')

@section('content')
    <h1>{{{ $title }}}</h1>
    <div class="row">
      @foreach($articles as $article)
      <div class="col-sm-6 col-md-4">
        <h2>{{{ $article->title }}}</h2>
        <p>{{ substr(preg_replace('#<[^>]+>#', ' ',$article->content),0,50) }}...</p>
        {{ HTML::linkRoute('articles.show', 'Read More', array($article->id), ['class'=>'btn btn-primary', 'role'=>'button']) }}
      </div>
      @endforeach
    </div>
@endsection