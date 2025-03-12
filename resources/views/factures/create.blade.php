@extends('factures.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'une Facture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factures.index') }}"><i class='fa fa-arrow-left'></i> Retour</a>
            </div>
        </div>
    </div>

    <!-- Affichage des messages d'erreur ou de succès -->
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Erreur :</strong> {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <strong>Succès :</strong> {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('factures.store') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Il y a des soucis dans votre formulaire.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Date de la Facture :</strong>
                <input type="date" class="form-control" name="DateFact">
                @error('DateFact')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Client :</strong>
                <select name="idClient" class="form-control">
                    <option value="">Sélectionner un client</option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->prospect ? $client->prospect->NomProspects : 'Nom inconnu' }} 
                        {{ $client->prospect ? $client->prospect->PrenomProspects : 'Prénom inconnu' }}
                    </option>
                    @endforeach
                </select>
                @error('idClient')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4" style="margin-top: 20px">
                <button type="submit" class="btn btn-success">Ajouter la facture</button>
            </div>
        </div>
    </form>
@endsection
