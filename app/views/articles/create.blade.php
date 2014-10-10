@extends('layouts.bootstrap')

@section('content')
  {{ Form::open(['route'=>'articles.store']) }}
        <div>
           {{ Form::text('title',isset($title)?$title:null, ['placeholder'=>'Article Title','class'=>'form-control']) }}
        </div>
        <div>
            {{ Form::textarea('content',isset($content)?$content:null,['class'=>'summernote']) }}

        </div>
        {{ Form::submit('Save Article', ['class'=>'btn btn-lg btn-primary btn-block']) }}
  {{ Form::close() }}
@endsection