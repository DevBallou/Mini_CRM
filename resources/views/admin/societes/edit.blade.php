@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier la société</h2>
            </div>

            <div class="pull-right">
                <a href="{{ route('societes.index') }}" class="btn btn-primary"> Retour</a>
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

    <form action="{{ route('societes.update', $societe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Nom:</strong>
                    <input type="text" name="title" value="{{ $societe->title }}" placeholder="le nom de la société" class="form-control">

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Adresse:</strong>
                    <input type="text" name="adresse" value="{{ $societe->adresse }}" placeholder="Adresse" class="form-control">

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ville</strong>
                    <select name="ville" value="{{ $societe->ville }}" id="" class="form-control">
                        <option value="{{ $societe->ville }}">{{ $societe->ville }}</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Mohammadia">Mohammadia</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Kenitra">Kenitra</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pays</strong>
                    <select name="pays" value="{{ $societe->pays }}" id="" class="form-control">
                        <option value="{{ $societe->pays }}">{{ $societe->pays }}</option>
                        <option value="Maroc">Maroc</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection
