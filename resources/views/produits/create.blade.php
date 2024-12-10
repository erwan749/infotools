@extends('produits.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}"><i class='fa fa-plus-circle'></i> Retour</a>
            </div>
        </div>
    </div>

    <form method="post" action="{{ url('produits') }}" enctype="multipart/form-data">
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
                <strong>Type de produit : </strong>
                <input type="text" class="form-control" name="typeProd" value="{{ old('typeProd') }}">
                @error('typeProd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Prix du produit : </strong>
                <input type="number" class="form-control" name="prixProd" value="{{ old('prixProd') }}">
                @error('prixProd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Nom du produit : </strong>
                <input type="text" class="form-control" name="nomProd" value="{{ old('nomProd') }}">
                @error('nomProd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Description du produit : </strong>
                <textarea class="form-control" name="descProd" rows="4">{{ old('descProd') }}</textarea>
                @error('descProd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4" style="margin-top:20px">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </form>
@endsection
