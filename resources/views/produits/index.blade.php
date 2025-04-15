@extends('produits.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestion des produits</h2>
        <a class="btn btn-success" href="{{ route('produits.create') }}">
            <i class="fas fa-plus-circle"></i> Ajouter un produit
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <p>Il y a {{ $produits->count() }} produits.</p>

    <div class='Tableau'>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Produit</th>
                    <th>Type Produit</th>
                    <th>Prix Produit</th>
                    <th>Nom Produit</th>
                    <th>Description Produit</th>
                    <th width="255px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit['id'] }}</td>
                        <td>{{ $produit['typeProd'] }}</td>
                        <td>{{ $produit['prixProd'] }} €</td>
                        <td>{{ $produit['nomProd'] }}</td>
                        <td>{{ $produit['descProd'] }}</td>
                        <td>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display: inline;">
                                <a class="btn btn-info btn-action" href="{{ route('produits.show', $produit->id) }}">
                                    <i class="fas fa-eye"></i> Détails
                                </a>

                                @if(auth()->user()->role == 'manager')
                                    <a class="btn btn-primary btn-action" href="{{ route('produits.edit', $produit->id) }}">
                                        <i class="fas fa-edit"></i> Éditer
                                    </a>
                                @endif

                                @csrf
                                @method('DELETE')

                                @if(auth()->user()->role == 'manager')
                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
