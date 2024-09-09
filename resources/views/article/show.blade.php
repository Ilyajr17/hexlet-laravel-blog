@extends('layouts.app')

@section('content')
    <h1>{{$article->name}}</h1>
    <div>{{$article->body}}</div>
    <a href="{{ route('articles.comments.index', $article) }}">комментарии</a>

@endsection
