@extends('clients.layout')

@section('content')
    <div class="container mt-4">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Éditer un client</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clients.index') }}">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Form to update client -->
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Il y a des erreurs dans votre formulaire.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Nom :</strong></label>
                    <input type="text" name="Nom" value="{{ old('Nom', $client->prospect->NomProspects) }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Prénom :</strong></label>
                    <input type="text" name="Prenom" value="{{ old('Prenom', $client->prospect->PrenomProspects) }}" class="form-control" placeholder="Prénom">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Email :</strong></label>
                    <input type="email" name="Email" value="{{ old('Email', $client->prospect->EmailProspects) }}" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Téléphone :</strong></label>
                    <input type="text" name="Telephone" value="{{ old('Telephone', $client->prospect->telProspects) }}" class="form-control" placeholder="Numéro de téléphone">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Code Postal :</strong></label>
                    <input type="text" name="CP" value="{{ old('CP', $client->CPClient) }}" class="form-control" placeholder="Code Postal">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Ville :</strong></label>
                    <input type="text" name="Ville" value="{{ old('Ville', $client->VilleClient) }}" class="form-control" placeholder="Ville">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Adresse :</strong></label>
                    <input type="text" name="Adresse" value="{{ old('Adresse', $client->AdresseClient) }}" class="form-control" placeholder="Adresse">
                </div>
            </div>

            <div class="row mb-3"style="
    margin-top: 20px;>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
@endsection
