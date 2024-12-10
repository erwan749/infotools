@extends('produits.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des produits</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<p>Il y a {{ $produits->count() }} produits.</p>

<div class='Tableau'>
    <table class="table table-bordered">
        <tr>
            <th>No Produit</th>
            <th>Type Produit</th>
            <th>Prix Prod</th>
            <th>Nom Produit</th>
            <th>Description Produit</th>
            <th width="255px">Actions <div class="pull-right"><a class="btn btn-success" href="{{ route('produits.create') }}"><i class='fa fa-plus-circle'></i> Ajouter un produit</a></div></th>        </tr>    
        @foreach($produits as $produit)
        <tr>
            <td>{{ $produit['id'] }}</td>
            <td>{{ $produit['typeProd'] }}</td>
            <td>{{ $produit['prixProd'] }}</td>
            <td>{{ $produit['nomProd'] }}</td>
            <td>{{ $produit['descProd'] }}</td>
            <td>
            <form action="{{ route('produits.destroy',$produit->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('produits.show',$produit->id) }}">Détails</a>
                        <a class="btn btn-primary" href="{{ route('produits.edit',$produit->id) }}">Editer</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection