@extends('layouts.bootstrap')

@section('content')
  {{ isset($content)? $content : '' }}
@endsection