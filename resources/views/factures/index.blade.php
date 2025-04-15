@extends('factures.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Factures</h2>
        <a class="btn btn-success" href="{{ route('factures.create') }}">
            <i class="fas fa-plus-circle"></i> Ajouter une facture
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de Facture</th>
                <th>Client</th> <!-- Client affiché avec le prospect -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
                <tr>
                    <td>{{ $facture->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($facture->DateFact)->format('d-m-Y') }}</td> <!-- Format de la date -->
                    <td>
                        @if($facture->client->prospect)
                            {{ $facture->client->prospect->NomProspects }} {{ $facture->client->prospect->PrenomProspects }}
                        @else
                            Aucun prospect
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-action" href="{{ route('factures.show', $facture->id) }}">
                            <i class="fas fa-eye"></i> Détails
                        </a>

                        @if(auth()->user()->role == 'manager')
                            <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" style="display:inline;">
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
