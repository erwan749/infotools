@extends('clients.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des clients</h2>
        <a class="btn btn-success" href="{{ route('clients.create') }}">
            <i class="fas fa-plus-circle"></i> Ajouter un client
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>CP</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->prospect->NomProspects ?? 'Aucun' }}</td>
                <td>{{ $client->prospect->PrenomProspects ?? 'Aucun' }}</td>
                <td>{{ $client->prospect->telProspects ?? 'Aucun' }}</td>
                <td>{{ $client->prospect->EmailProspects ?? 'Aucun' }}</td>
                <td>{{ $client->CPClient }}</td>
                <td>{{ $client->VilleClient }}</td>
                <td>{{ $client->AdresseClient }}</td>
                <td>
                    <a class="btn btn-info btn-action" href="{{ route('clients.show', $client->id) }}">
                        <i class="fas fa-eye"></i> Détails
                    </a>

                    @if(auth()->user()->role == 'manager')
                        <a class="btn btn-primary btn-action" href="{{ route('clients.edit', $client->id) }}">
                            <i class="fas fa-edit"></i> Éditer
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
