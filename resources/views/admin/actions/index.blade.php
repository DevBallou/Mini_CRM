@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="pull-left">
                <h2>Historique des actions</h2>
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
                <th>Date d'action</th>
                <th>Descriptif</th>
            </tr>
        </thead>

        <tbody>
            @if ($actions->count())
                @foreach ($actions as $key => $action)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ date('d-m-Y - H:i', strtotime($action->created_at)) }}</td>
                        <td>{{ $action->descriptif }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Aucun résultat trouvé</td>
                </tr>
            @endif
        </tbody>
    </table>

    {!! $actions->render() !!}

@endsection
