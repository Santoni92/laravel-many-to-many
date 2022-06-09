@extends('layouts.dashboard')

@section('content')
    <div>
        <h3>Titolo del post</h3>
        {{ $post->title }}
    </div>
    <div>
        <h3>Contenuto del post</h3>
        {{ $post->content }}
    </div>
    <div>
        <h3>Categoria a cui appartiene il post</h3>
        {{ $post->category->name }}
    </div>
    <div>
        <h3>Tag relativi al post</h3>
        @foreach ($post->tags as $tag)
            <!-- dynamic properties laravel -->
            <span>{{ $tag->name }}</span>
        @endforeach
    </div>

    <div>
        <h3>Cover</h3>
        <img src="{{ asset('storage/' . $post->cover) }}" alt="">
    </div>

    <a href="{{ route('admin.posts.edit', $post->id) }}">Modifica post</a>

    <!--form per l'eliminazione di un post-->
    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('delete')

        <button type="submit">Cancella post</button>
    </form>

    <a href="{{ route('admin.posts.index') }}">Torna alla visualizzazione di tutti i post presenti</a>
@endsection
