@extends('clients.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Éditer un client</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"><i class='fa fa-arrow-left'></i> Retour</a>
            </div>
        </div>
    </div>

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

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Nom :</strong>
                <input type="text" name="Nom" value="{{ $client->prospect->NomProspects }}" class="form-control" placeholder="Nom">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Prénom :</strong>
                <input type="text" name="Prenom" value="{{ $client->prospect->PrenomProspects }}" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Email :</strong>
                <input type="email" name="Email" value="{{ $client->prospect->EmailProspects }}" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Téléphone :</strong>
                <input type="text" name="Telephone" value="{{ $client->prospect->telProspects }}" class="form-control" placeholder="Numéro de téléphone">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Code Postal :</strong>
                <input type="text" name="CP" value="{{ $client->CPClient }}" class="form-control" placeholder="Code Postal">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Ville :</strong>
                <input type="text" name="Ville" value="{{ $client->VilleClient }}" class="form-control" placeholder="Ville">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Adresse :</strong>
                <input type="text" name="Adresse" value="{{ $client->AdresseClient }}" class="form-control" placeholder="Adresse">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
        </div>
    </form>
@endsection
