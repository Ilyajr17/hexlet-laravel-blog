@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
   <small> <a href="{{ route('articles.create') }}">Создать сатью</a> </small>

    {{  html()->form('GET', route('articles.index'))->open() }}
        {{  html()->input('text', 'name') }}
        {{  html()->submit('Search') }}
    {{ html()->form()->close() }}

    {{-- <a href="{{ route('articles.report') }}" class="btn btn-success">Скачать отчет в Excel</a> --}}
    {{-- <h2>  <a href="{{ route('articles.report', $articles) }}">sdad</a></h2> --}}

    {{  html()->form('GET', route('articles.report'))->open() }}
    {{-- Название статьи передано из экшена --}}
    {{-- {{  html()->input('text', 'name', $name) }} --}}
    {{  html()->submit('Скачать отчет в Excel') }}
{{ html()->form()->close() }}

    @foreach ($articles as $article)
    <h2>  <a href="{{ route('articles.show', $article->id) }}">{{$article->name}}</a></h2>
    <small>  <a href="{{ route('articles.edit', $article->id) }}">Редактироваьть</a></small>

    {{-- <a href="{{ route('articles.destroy', $article->id) }}" data-method="delete" rel="nofollow"> Удалить </a> --}}
    <a class="link-danger" href="{{ route('articles.destroy', $article) }}" data-method="delete" rel="nofollow"
                data-confirm="Are you sure?">Delete</a>

        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
    {{$articles->links()}}
@endsection
