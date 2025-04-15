@extends('clients.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Client Information -->
            <div class="col-md-6">
                <h2>Détails du Client</h2>
                <div class="form-group">
                    <strong>Nom :</strong>
                    <p>{{ $client->prospect->NomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Prénom :</strong>
                    <p>{{ $client->prospect->PrenomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <p>{{ $client->prospect->telProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    <p>{{ $client->prospect->EmailProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Adresse :</strong>
                    <p>{{ $client->AdresseClient ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Ville :</strong>
                    <p>{{ $client->VilleClient ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Code Postal :</strong>
                    <p>{{ $client->CPClient ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('clients.index') }}" class="btn btn-primary">Retour à la liste des clients</a>
            </div>
        </div>
    </div>
@endsection
