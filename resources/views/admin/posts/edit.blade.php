@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
        @csrf

        @method('put')

        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>
        <div>
            <label for="content">Contenuto:</label>
            <textarea name="content">{{ $post->content }}</textarea>
        </div>

        <button type="submit">Modifica il post</button>

        <a href="{{ route('admin.posts.index') }}">Torna alla visualizzazione di tutti i post presenti</a>
    </form>
@endsection
