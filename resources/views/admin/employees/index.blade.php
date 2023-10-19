@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="pull-left">
                <h2>Gestion des Employés</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('employees.index') }}" method="get" class="mb-2">
        <div class="row">
           <div class="col-md-5 form-group">
               <label for=""></label>
               <input type="text" name="name" class="form-control" value="{{ $request->name }}" placeholder="Saisissez le nom de l'employé">
            </div>
            <div class="col-md-2 form-group mt-4">
               <input type="submit" class="btn btn-primary" value="Rechercher">
            </div>
        </div>
   </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Société</th>
                <th>Status de l'invitation</th>
                <th width="280px">Action</th>
            </tr>
        </thead>

        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->adresse }}</td>
                        <td>{{ $employee->telephone }}</td>
                        <td>{{ $employee->date_naissance }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            {{ $employee->invitation->societe->title }}
                        </td>
                        <td>
                            @if ($employee->invitation)
                                {{ $employee->invitation->status }}
                            @else
                                Invitation n'est pas encore confirmé.
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Afficher</a>
                            {{-- <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Modifier</a> --}}
                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['employees.destroy', $employee->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!} --}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">Aucun résultat trouvé</td>
                </tr>
            @endif

        </tbody>

    </table>

    {!! $data->render() !!}

@endsection
