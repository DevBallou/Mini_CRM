@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Modifier l'administrateur</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('admins.index') }}"> Retour</a>

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



{!! Form::model($user, ['method' => 'PATCH','route' => ['admins.update', $user->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

            <strong>Nom complet:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nom complet','class' => 'form-control')) !!}

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

            <strong>Mot de passe:</strong>
            {!! Form::password('password', array('placeholder' => 'Mot de passe','class' => 'form-control')) !!}

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

            <strong>Confirmer le mot de passe:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirmer le mot de passe','class' => 'form-control')) !!}

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>

</div>

{!! Form::close() !!}


@endsection
