@extends('produits.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Détails du produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Product Information -->
            <div class="col-md-6">
                <h4>Détails du produit</h4>
                <div class="form-group">
                    <strong>Nom du produit :</strong>
                    <p>{{ $produit->nomProd ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Type de produit :</strong>
                    <p>{{ $produit->typeProd ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Prix :</strong>
                    <p>{{ $produit->prixProd ?? 'N/A' }} €</p>
                </div>
                <div class="form-group">
                    <strong>Description :</strong>
                    <p>{{ $produit->descProd ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('produits.index') }}" class="btn btn-primary">Retour à la liste des produits</a>
            </div>
        </div>
    </div>
@endsection
