@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> Afficher les données de l'employé</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('employees.index') }}"> Retour</a>

        </div>

    </div>

</div>



<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>le nom complet:</strong>

            {{ $employee->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {{ $employee->email }}

        </div>

    </div>

    {{-- <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Roles:</strong>

            @if(!empty($employee->getRoleNames()))

                @foreach($employee->getRoleNames() as $v)

                    <label class="">{{ $v }}</label>

                @endforeach

            @endif

        </div>

    </div> --}}

</div>

@endsection
