@extends('factures.layout')

@section('content')
    <div class="form-header">
        <h2>Ajout d'une Facture</h2>
        <a class="btn btn-primary" href="{{ route('factures.index') }}">
            <i class='fa fa-arrow-left'></i> Retour à la liste
        </a>
    </div>

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

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops !</strong> Il y a des erreurs dans le formulaire :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('factures.store') }}" class="client-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="DateFact">Date de la Facture</label>
                <input type="date" name="DateFact" class="form-control" placeholder="Sélectionnez une date">
                @error('DateFact') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="idClient">Client</label>
                <select name="idClient" class="form-control">
                    <option value="">Sélectionner un client</option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->prospect ? $client->prospect->NomProspects : 'Nom inconnu' }} 
                        {{ $client->prospect ? $client->prospect->PrenomProspects : 'Prénom inconnu' }}
                    </option>
                    @endforeach
                </select>
                @error('idClient') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter la facture
            </button>
        </div>
    </form>
@endsection
