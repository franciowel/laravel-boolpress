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
@endsection