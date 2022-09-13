@extends('layouts.dashboard')

@section('content')
    <h1>
        Lista Post
    </h1>

    @if ($show_deleted_message === 'yes')

        <div class="alert alert-primary" role="alert">
            Articolo cancellato con successo.
        </div>
        
    @endif
    
    <div class="row row-cols-3">

        @foreach ($posts as $post)
            {{-- INIZIO COL --}}
            <div class="col">
                {{-- INIZIO CARD --}}
                    <div class="card mt-2">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                        <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary">Di più</a>
                        </div>
                </div>
                {{-- FINE CARD --}}
            </div>
            {{-- FINE COL --}}
        @endforeach

    </div>
@endsection