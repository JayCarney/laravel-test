@extends('layouts.bootstrap')

@section('content')
  {{ Form::open(['route'=>'articles.store', 'files'=>true]) }}
        <div>
           {{ Form::text('title',isset($title)?$title:null, ['placeholder'=>'Article Title','class'=>'form-control']) }}
        </div>
        <div>
           {{ Form::text('tags',isset($tags)?$tags:null, ['placeholder'=>'Tags (separated by ",")','class'=>'form-control']) }}
        </div>
        <div class="file-input">
           {{ Form::file('image',null, ['placeholder'=>isset($file)?'Replace Image':'Image upload','class'=>'form-control']) }}
        </div>
        <div>
            {{ Form::textarea('content',isset($content)?$content:null,['class'=>'summernote']) }}
        </div>
        @if(isset($id))
        {{ Form::hidden('id',$id) }}
        @endif
        {{ Form::submit('Save Article', ['class'=>'btn btn-lg btn-primary btn-block']) }}
  {{ Form::close() }}
@endsection