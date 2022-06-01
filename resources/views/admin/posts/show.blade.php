@extends('layouts.dashboard')

@section('content')
    {{ $post->title }}
    {{ $post->content }}
    <a href="{{ route('admin.posts.edit', $post->id) }}">Modifica post</a>

    <!--form per l'eleiminazione di un post-->
    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('delete')

        <button type="submit">Cancella post</button>
    </form>

    <a href="{{ route('admin.posts.index') }}">Torna alla visualizzazione di tutti i post presenti</a>
@endsection
