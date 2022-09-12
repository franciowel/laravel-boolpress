@extends('layouts.dashboard')

@section('content')
    <h2>
        Crea nuovo post
    </h2>

    <form action="{{ route('admin.posts.store')}}" method="post">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" placeholder="Titolo articolo" name="title">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Testo</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>

        <input type="submit" value="salva post">

    </form>
@endsection