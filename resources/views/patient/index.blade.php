@extends('layouts.patient')

@section('content')
    <h1>Articles on Mental Health</h1>
    <ul>
        @foreach($articles as $article)
            <li>
                <h2>{{ $article->title }}</h2>
                <p>{{ $article->body }}</p>
            </li>
        @endforeach
    </ul>
@endsection
