@extends('prospects.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Prospect Information -->
            <div class="col-md-6">
                <h2>Détails du Prospect</h2>
                <div class="form-group">
                    <strong>Nom du prospect :</strong>
                    <p>{{ $prospect->NomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Prénom du prospect :</strong>
                    <p>{{ $prospect->PrenomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <p>{{ $prospect->telProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    <p>{{ $prospect->EmailProspects ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('prospects.index') }}" class="btn btn-primary">Retour à la liste des prospects</a>
            </div>
        </div>
    </div>
@endsection
