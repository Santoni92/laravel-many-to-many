@extends('layouts.dashboard')

@section('content')
    <h1>Tutti i Posts</h1>
    <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>

    <table>
        <thead>
            <tr>
                <td>Titolo</td>
                <td>Slug</td>
                <td>Categoria</td>
                <td>Tags</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            <span>{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td><a href="{{ route('admin.posts.show', $post->id) }}">Visualizza dettaglio del post</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
