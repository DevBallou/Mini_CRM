@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes connecté en tant qu’Employé !') }}
                    <br><br><br>
                    <ul class="list-group">
                        <li class="list-group-item">Nom : <strong>{{ $data->name }}</strong></li>
                        <li class="list-group-item">Email : <strong>{{ $data->email }}</strong></li>
                        <li class="list-group-item">Adresse : <strong>{{ $data->adresse }}</strong></li>
                        <li class="list-group-item">Telephone : <strong>{{ $data->telephone }}</strong></li>
                        <li class="list-group-item">Date de naissance : <strong>{{ $data->date_naissance }}</strong></li>
                        <li class="list-group-item">Société : <strong>{{ $data->invitation->societe->title }}</strong></li>
                        <li class="list-group-item">mes Collèges :
                            @foreach ($leur_colleges as $college)
                                <strong> - {{ $college->name }}</strong>
                            @endforeach
                        </li>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('compte.edit', Auth::user()->id) }}">Modifier</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
