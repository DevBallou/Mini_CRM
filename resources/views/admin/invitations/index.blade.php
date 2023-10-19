@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="pull-left">
                <h2>Les invitations</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('invitations.create') }}">Commencer à envoyer l'invitation à l'employé</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
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
                        <td>{{ $employee->email }}</td>
                        <td>
                            {{ $employee->societe->title }}
                        </td>
                        <td>
                            @if ($employee->invitation)
                                {{ $employee->invitation->status }}
                            @else
                                Invitation n'est pas encore confirmé.
                            @endif
                        </td>
                        <td>
                            @if ($employee->invitation)
                                @if (!$employee->invitation->confirme)
                                    {!! Form::open(['method' => 'PATCH','route' => ['invitations.update', $employee->email],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Confirmer', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                @endif
                            @else
                                {!! Form::open(['method' => 'DELETE','route' => ['invitations.destroy', $employee->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Annuler l\'invitation', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">Aucun résultat trouvé</td>
                </tr>
            @endif

        </tbody>

    </table>

    {!! $data->render() !!}

@endsection
