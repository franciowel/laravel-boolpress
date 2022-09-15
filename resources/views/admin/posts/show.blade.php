@extends('layouts.dashboard')

@section('content')
    <h1>{{$post->title}}</h1>
    <div>
        Creato il : {{ $post->created_at->format('l, d F Y') }}
    </div>

    <div class="mt-1">
        Aggiornato il : {{ $post->updated_at->format('l, d F Y') }}
    </div>

    @if ($created_days_ago > 0)
        <div class="mt-1">
            creato {{ $created_days_ago }} giorn{{ $created_days_ago > 1 ? 'i' : 'o' }} fa
        </div>
        @else
        <div>creato oggi</div>
    @endif

    <div class="mt-1">
        Slug : {{ $post->slug }}
    </div>

    <div class="mt-1">
        Categoria : {{ $post->category ? $post->category->name : 'nessuna' }}
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