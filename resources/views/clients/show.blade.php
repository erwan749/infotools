@extends('clients.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Détails du client</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Retour</a>
            </div>
        </div>
    </div>



@section('content')
    <div class="container">
        <div class="row">
            <!-- Client Information -->
            <div class="col-md-6">
                <h4>Client Details</h4>
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
                    <p>{{ $client->AdresseClient }}</p>
                </div>
                <div class="form-group">
                    <strong>Ville :</strong>
                    <p>{{ $client->VilleClient }}</p>
                </div>
                <div class="form-group">
                    <strong>Code Postal :</strong>
                    <p>{{ $client->CPClient }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('clients.index') }}" class="btn btn-primary">Back to Clients List</a>
            </div>
        </div>
    </div>
@endsection