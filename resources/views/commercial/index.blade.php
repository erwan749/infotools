@extends('commercial.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des commerciaux</h2>
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
            <th>ID</th>
            <th>Nom prenom</th>
            <th>email</th>
            <th width="255px">Actions <div class="pull-right"><a class="btn btn-success" href="{{ route('clients.create') }}"><i class='fa fa-plus-circle'></i> Ajouter un client</a></div></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user['id']}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('commercial.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('commercial.show',$user->id) }}">Détails</a>
                        <a class="btn btn-primary" href="{{ route('commercial.edit',$user->id) }}">Editer</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
