@extends('layouts.dashboard')

@section('content')
    <h2>
        Crea nuovo post
    </h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.store')}}" method="post">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" placeholder="Titolo articolo" name="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="category_id">Categoria:</label>
            <select class="form-select form-select-sm" id="category_id" name="category_id">
                <option value="">Nessuna</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
              </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Testo</label>
            <textarea class="form-control" id="content" placeholder="Scrvi il testo..." name="content" rows="5">{{ old('content') }}</textarea>
        </div>

        <input type="submit" value="salva post">

    </form>
@endsection