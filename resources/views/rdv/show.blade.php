@extends('rdv.layout')

@section('content')
    <div class="form-header">
        <h2>Détails du Rendez-vous</h2>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Informations du Rendez-vous -->
            <div class="col-md-6">
                <h4>Détails du Rendez-vous</h4>
                <div class="form-group">
                    <strong>Date et heure :</strong>
                    <p>{{ $rdvData['DateRdv'] }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informations du Commercial -->
            <div class="col-md-6">
                <h4>Commercial</h4>
                <div class="form-group">
                    <strong>Nom :</strong>
                    <p>{{ $rdvData['commercial']['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informations du Client -->
            <div class="col-md-6">
                <h4>Client</h4>
                <div class="form-group">
                    <strong>Nom :</strong>
                    <p>{{ $rdvData['client']['nom'] }} {{ $rdvData['client']['prenom'] }}</p>
                </div>
                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <p>{{ $rdvData['client']['tel'] }}</p>
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    <p>{{ $rdvData['client']['email'] }}</p>
                </div>
                <div class="form-group">
                    <strong>Adresse :</strong>
                    <p>{{ $rdvData['client']['adresse'] }}</p>
                </div>
                <div class="form-group">
                    <strong>Ville :</strong>
                    <p>{{ $rdvData['client']['ville'] }}</p>
                </div>
            </div>
        </div>

        <!-- Bouton Retour -->
        <div class="form-submit mt-4"style="text-align: left;">
            <a href="{{ route('rdv.index') }}" class="btn btn-primary" >
                <i class="fas fa-arrow-left"></i> Retour à la liste des rendez-vous
            </a>
        </div>
    </div>
@endsection
