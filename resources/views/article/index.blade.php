@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
   <small> <a href="{{ route('articles.create') }}">Создать сатью</a> </small>

    {{  html()->form('GET', route('articles.index'))->open() }}
        {{  html()->input('text', 'name') }}
        {{  html()->submit('Search') }}
    {{ html()->form()->close() }}

    @foreach ($articles as $article)
    <h2>  <a href="{{ route('articles.show', $article->id) }}">{{$article->name}}</a></h2>
    <small>  <a href="{{ route('articles.edit', $article->id) }}">Редактироваьть</a></small>

    <a href="{{ route('articles.destroy', $article->id) }}" data-method="delete" rel="nofollow"> Удалить </a>

        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
    {{$articles->links()}}
@endsection
