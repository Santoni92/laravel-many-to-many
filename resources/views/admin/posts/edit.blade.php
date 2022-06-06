@extends('layouts.dashboard')

@section('content')
    <!--ci stampa la lista degli errori-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

        <!--la select per selezionare la categoria-->
        <div>
            <label for="category_id">Categoria:</label>
            <select name="category_id">
                <option value="">Scegli categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    <!--selected serve per segnalare la option selezionata-->
                @endforeach
            </select>
            @error('category_id')
                {{ $message }}
            @enderror
        </div>

        <div>
            @foreach ($tags as $tag)
                <label for="tags[]">{{ $tag->name }}</label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ $post->tags->contains($tag) ? 'checked' : '' }}>
            @endforeach
            @error($tags)
                {{ $message }}
            @enderror
        </div>

        <button type="submit">Modifica il post</button>

        <a href="{{ route('admin.posts.index') }}">Torna alla visualizzazione di tutti i post presenti</a>
    </form>
@endsection
