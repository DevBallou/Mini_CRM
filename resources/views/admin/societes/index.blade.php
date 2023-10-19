@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="pull-left">
                <h2>Gestion des Societes</h2>
            </div>

            <div class="pull-right">
                @can('societe-create')
                    <a href="{{ route('societes.create') }}" class="btn btn-success">Créer une société</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('societes.index') }}" method="get" class="mb-2">
        <div class="row">
           <div class="col-md-5 form-group">
               <label for=""></label>
               <input type="text" name="title" class="form-control" value="{{ $request->title }}" placeholder="Saisissez le nom de la société">
            </div>
            <div class="col-md-2 form-group mt-4">
               <input type="submit" class="btn btn-primary" value="Rechercher">
            </div>
        </div>
   </form>

    <table class="table table-bordered">
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Pays</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($societes as $key => $societe)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $societe->title }}</td>
                <td>{{ $societe->adresse }}</td>
                <td>{{ $societe->ville }}</td>
                <td>{{ $societe->pays }}</td>
                <td>
                    {{-- <a href="{{ route('societes.show', $societe->id) }}" class="btn btn-info">Afficher</a> --}}
                    <a href="{{ route('societes.edit', $societe->id) }}" class="btn btn-primary">Modifier</a>
                    @if (!$societe->invitation)
                        @can('societe-delete')
                            {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['societes.destroy', $societe->id],
                                    'style' => 'display:inline'
                                ])
                            !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    @endif

                </td>
            </tr>
        @endforeach
    </table>

@endsection
