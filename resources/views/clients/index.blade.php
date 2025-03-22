@extends('clients.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des client</h2>
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
            <th>Nom</th>
            <th>Prenom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>CP</th>
            <th>Ville</th>
            <th>adresse</th>
            <th width="255px">Actions <div class="pull-right"><a class="btn btn-success" href="{{ route('clients.create') }}"><i class='fa fa-plus-circle'></i> Ajouter un client</a></div></th>
        </tr>
        @foreach($clients as $client)
            <tr>
                <td>{{$client['id']}}</td>
                <td>{{ $client->prospect ? $client->prospect->NomProspects : 'Aucun prospect' }}</td>
                <td>{{ $client->prospect ? $client->prospect->PrenomProspects : 'Aucun prospect' }}</td>
                <td>{{ $client->prospect ? $client->prospect->telProspects : 'Aucun prospect' }}</td>
                <td>{{ $client->prospect ? $client->prospect->EmailProspects : 'Aucun prospect' }}</td>
                <td>{{$client['CPClient']}}</td>
                <td>{{$client['VilleClient']}}</td>
                <td>{{$client['AdresseClient']}}</td>      
                <td>
                    <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Détails</a>
                        @if(auth()->user()->role == 'manager')

                        <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Editer</a>
                        @endif 
    
                        @csrf
                        @method('DELETE')
                        @if(auth()->user()->role == 'manager')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                        @endif 
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
