@extends('produits.layout')

@section('content')
    <div class="form-header">
        <h2>Ajouter un nouveau produit</h2>
        <a class="btn btn-primary" href="{{ route('produits.index') }}">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

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

    <form method="POST" action="{{ url('produits') }}" enctype="multipart/form-data" class="client-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="nomProd">Nom du produit</label>
                <input type="text" name="nomProd" class="form-control" placeholder="Produit X">
                @error('nomProd') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="typeProd">Type de produit</label>
                <input type="text" name="typeProd" class="form-control" placeholder="Type A">
                @error('typeProd') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="prixProd">Prix du produit</label>
                <input type="number" name="prixProd" class="form-control" placeholder="100">
                @error('prixProd') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="descProd">Description du produit</label>
                <textarea name="descProd" class="form-control" placeholder="Description détaillée du produit"></textarea>
                @error('descProd') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter
            </button>
        </div>
    </form>
@endsection
