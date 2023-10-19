@extends('layouts.admin')



@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Commencer à envoyer l'invitation à l'employé</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Oups!</strong> Il y avait des problèmes avec votre avis.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'employees.store','method'=>'POST')) !!}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Nom complet de l'employé:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Saisissez Le nom de l\'employé','class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Email de l'employé:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Saisissiez Email de l\'employé','class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Mot de passe:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Confirmer le mot de passe:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Joindre à la société :</strong>
                    {!! Form::select('societe_id', $societes, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Sélectionnez Société',
                    ]) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
            </div>
        </div>

    {!! Form::close() !!}


@endsection
