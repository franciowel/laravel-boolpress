@extends('layouts.dashboard')

@section('content')
    <div>
        <h1>
            ADMIN PANEL
        </h1>

        <div>
            Welcome {{$user->name}}
        </div>

        <div>
            La tua e-mail: {{$user->email}}
        </div>

        @if ($user->userInfo)
            <div>
                Numero di telefono: {{$user->userInfo->telephone}}
            </div>

            <div>
                Il tuo indirizzo: {{$user->userInfo->address}}
            </div>
        @endif

    </div>
@endsection