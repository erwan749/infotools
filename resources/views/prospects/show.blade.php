@extends('prospects.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Détails du prospect</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('prospects.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Prospect Information -->
            <div class="col-md-6">
                <h4>Détails du prospect</h4>
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
    </div>
@endsection

