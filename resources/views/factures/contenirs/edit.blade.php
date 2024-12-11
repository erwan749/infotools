@extends('factures.contenirs.layout')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier un produit dans la facture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factures.show', $idFact) }}"><i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <form method="POST" action="{{ route('contenirs.update', ['idFact' => $contenir->idFact, 'idProd' => $contenir->idProd]) }}">
                    @csrf
                    @method('PUT')


                    <!-- ID de la facture en champ caché -->
                    <input type="hidden" name="idFact" value="{{ $idFact }}">

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
                        <div class="col-md-6 mb-3">
                            <h4>Produit</h4>
                            <div class="form-group">
                                <strong>Nom du produit :</strong>
                                <select name="idProd" class="form-control">
                                    <option value="">Sélectionner un produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}" 
                                                @if ($produit->id == $contenir->idProd) selected @endif>
                                            {{ $produit->nomProd }} ({{ $produit->prixProd }} €)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <strong>Quantité :</strong>
                                <input type="number" name="Qte" class="form-control" value="{{ $contenir->Qte }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                            <a class="btn btn-danger" href="{{ route('factures.show', $idFact) }}">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
