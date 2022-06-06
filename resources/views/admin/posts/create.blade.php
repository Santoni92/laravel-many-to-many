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

    <h1>Crea un nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" placeholder="Inserisci il titolo" value="{{ old('title') }}">
        </div>

        <div>
            <label for="content">Contenuto:</label>
            <textarea name="content"></textarea>
        </div>

        <!--la select per selezionare la categoria-->
        <div>
            <label for="category_id">Categoria:</label>
            <select name="category_id">
                <option value="">Scegli categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
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
            <div>Tags</div>
            @foreach ($tags as $tag)
                <label for="tags[]">{{ $tag->name }}</label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
            @endforeach

            @error('tags[]')
                {{ $message }}
            @enderror
        </div>

        <button type="submit">Salva il post creato</button>

    </form>
@endsection
