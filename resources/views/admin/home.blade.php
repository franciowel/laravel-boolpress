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

    </div>
@endsection