@extends('factures.contenirs.layout')

@section('content')
    <div class="form-header">
        <h2>Ajouter un produit à la facture</h2>
        <a class="btn btn-primary" href="{{ route('factures.show', $facture_id) }}">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Gestion des erreurs -->
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

    <!-- Formulaire pour ajouter un produit à la facture -->
    <form method="POST" action="{{ route('contenirs.store') }}" class="client-form">
        @csrf
        <input type="hidden" name="idFact" value="{{ $facture_id }}">

        <div class="form-grid">
            <!-- Sélection du produit -->
            <div class="form-group">
                <label for="idProd"><strong>Produit :</strong></label>
                <select name="idProd" class="form-control">
                    <option value="">Sélectionner un produit</option>
                    @foreach ($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->nomProd }} ({{ $produit->prixProd }} €)</option>
                    @endforeach
                </select>
                @error('idProd') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Quantité -->
            <div class="form-group">
                <label for="Qte"><strong>Quantité :</strong></label>
                <input type="number" name="Qte" class="form-control" min="1" required>
                @error('Qte') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Bouton d'ajout -->
        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter le produit
            </button>
        </div>
    </form>
@endsection
