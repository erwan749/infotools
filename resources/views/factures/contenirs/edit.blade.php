@extends('factures.contenirs.layout')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Modifier un produit dans la facture</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('factures.show', $idFact) }}">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

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

            <!-- Formulaire produit -->
            <div class="client-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="idProd"><strong>Produit :</strong></label>
                        <select name="idProd" class="form-control">
                            <option value="">Sélectionner un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}" 
                                        @if ($produit->id == $contenir->idProd) selected @endif>
                                    {{ $produit->nomProd }} ({{ $produit->prixProd }} €)
                                </option>
                            @endforeach
                        </select>
                        @error('idProd') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Qte"><strong>Quantité :</strong></label>
                        <input type="number" name="Qte" class="form-control" value="{{ $contenir->Qte }}" required>
                        @error('Qte') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-submit">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Sauvegarder
                    </button>
                    <a class="btn btn-danger" href="{{ route('factures.show', $idFact) }}">
                        <i class="fa fa-ban"></i> Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
