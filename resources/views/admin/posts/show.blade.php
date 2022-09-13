@extends('layouts.dashboard')

@section('content')
    <h1>{{$post->title}}</h1>
    <div>
        Creato il : {{ $post->created_at }}
    </div>

    <div>
        Aggiornato il : {{ $post->updated_at }}
    </div>

    <div>
        Slug : {{ $post->slug }}
    </div>

    <h3 class="mt-3">
        Testo:
    </h3>
    <p>
        {{ $post->content }}
    </p>

    <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.edit', ['post' => $post->id] )}}">Modifica</a>

    <form class="mt-2" action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')

        <input  class="btn btn-danger btn-sm" type="submit" value="Elimina" onClick="return confirm('Sei sicuro di voler eliminare questo articolo?')">
    </form>
@endsection