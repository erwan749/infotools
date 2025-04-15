@extends('produits.layout')

@section('content')
    <div class="container mt-4">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Éditer un produit</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('produits.index') }}">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Form to update product -->
        <form action="{{ route('produits.update', $produit->id) }}" method="POST">
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
                    <label><strong>Nom du produit :</strong></label>
                    <input type="text" name="nomProd" value="{{ old('nomProd', $produit->nomProd) }}" class="form-control" placeholder="Nom du produit">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Type de produit :</strong></label>
                    <input type="text" name="typeProd" value="{{ old('typeProd', $produit->typeProd) }}" class="form-control" placeholder="Type de produit">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Prix :</strong></label>
                    <input type="number" name="prixProd" value="{{ old('prixProd', $produit->prixProd) }}" class="form-control" placeholder="Prix du produit">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Description :</strong></label>
                    <textarea name="descProd" class="form-control" placeholder="Description du produit">{{ old('descProd', $produit->descProd) }}</textarea>
                </div>
            </div>

            <div class="row mb-3" style="margin-top: 20px;">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
@endsection
