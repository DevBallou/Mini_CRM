@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Créer une nouvelle société</h2>
            </div>

            <div class="pull-right">
                <a href="{{ route('societes.index') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups!</strong> Quelque chose s'est mal passé. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('societes.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="title" placeholder="Nom" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Adresse:</strong>
                    <textarea name="adresse" placeholder="Adresse" cols="30" rows="2" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ville</strong>
                    {!! Form::select(
                        'ville',
                        [
                            'Casablanca' => 'Casablanca',
                            'Mohammadia' => 'Mohammadia',
                            'Rabat' => 'Rabat',
                            'Kenitra' => 'Kenitra'
                        ],
                        null,
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Selectionnez Ville',
                        ]
                    ) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pays</strong>
                    {!! Form::select(
                        'pays',
                        ['Maroc' => 'Maroc'],
                        null,
                        ['class' => 'form-control', 'placeholder' => 'Selectionnez Pays']
                    ) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection
