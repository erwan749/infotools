@extends('produits.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Éditer un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}"><i class='fa fa-arrow-left'></i> Retour</a>
            </div>
        </div>
    </div>

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

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Nom du produit :</strong>
                <input type="text" name="nomProd" value="{{ $produit->nomProd }}" class="form-control" placeholder="Nom du produit">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Type de produit :</strong>
                <input type="text" name="typeProd" value="{{ $produit->typeProd }}" class="form-control" placeholder="Type de produit">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Prix :</strong>
                <input type="number" name="prixProd" value="{{ $produit->prixProd }}" class="form-control" placeholder="Prix du produit">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Description :</strong>
                <textarea name="descProd" class="form-control" placeholder="Description du produit">{{ $produit->descProd }}</textarea>
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
