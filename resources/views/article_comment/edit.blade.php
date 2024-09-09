@extends('layouts.app')

@section('content')
    <h1>{{$article->name}}</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- BEGIN (write your solution here) --}}
    {{ html()->modelForm($comment, 'PATCH')->route('articles.comments.update', [$article, $comment])->open() }}
        {{ html()->textarea('content') }}
        <br>
        {{ html()->submit('Update') }}
    {{ html()->closeModelForm() }}
    {{-- END --}}
@endsection
