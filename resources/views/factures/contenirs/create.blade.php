@extends('factures.contenirs.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un produit à la facture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factures.show', $facture_id) }}"><i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('contenirs.store') }}">
        @csrf

        <input type="hidden" name="idFact" value="{{ $facture_id }}">

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
                <strong>Produit :</strong>
                <select name="idProd" class="form-control">
                    <option value="">Sélectionner un produit</option>
                    @foreach ($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->nomProd }} ({{ $produit->prixProd }} €)</option>
                    @endforeach
                </select>
                @error('idProd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Quantité :</strong>
                <input type="number" class="form-control" name="Qte" min="1" required>
                @error('Qte')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4" style="margin-top: 20px">
                <button type="submit" class="btn btn-success">Ajouter le produit</button>
            </div>
        </div>
    </form>
@endsection
