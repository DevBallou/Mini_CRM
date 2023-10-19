@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-lg-12 mb-2">

        <div class="pull-left">

            <h2>Gestion des Administrateurs</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('admins.create') }}">Créer un Administrateur</a>

        </div>

    </div>

</div>



@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif



<table class="table table-bordered">

 <tr>

   <th>No</th>

   <th>Name</th>

   <th>Email</th>

   <th>Roles</th>

   <th width="280px">Action</th>

 </tr>

 @foreach ($data as $key => $user)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $user->name }}</td>

    <td>{{ $user->email }}</td>

    <td>

      @if(!empty($user->getRoleNames()))

        @foreach($user->getRoleNames() as $v)

           <label class="badge-success">{{ $v }}</label>

        @endforeach

      @endif

    </td>

    <td>

       <a class="btn btn-info" href="{{ route('admins.show',$user->id) }}">Afficher</a>

       <a class="btn btn-primary" href="{{ route('admins.edit',$user->id) }}">Modifier</a>

        {{-- {!! Form::open(['method' => 'DELETE','route' => ['admins.destroy', $user->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!} --}}

    </td>

  </tr>

 @endforeach

</table>



{!! $data->render() !!}


@endsection
