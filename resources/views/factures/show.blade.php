@extends('factures.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Détails de la Facture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factures.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Prospect Information  -->
            <div class="col-md-6">
                <h4>Détails du client</h4>
                <div class="form-group">
                    <strong>Nom :</strong>
                    <p>{{ $prospect->NomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Prénom :</strong>
                    <p>{{ $prospect->PrenomProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <p>{{ $prospect->telProspects ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    <p>{{ $prospect->EmailProspects ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Facture Information -->
            <div class="col-md-6">
                <h4>Détails de la Facture</h4>
                <div class="form-group">
                    <strong>ID de la Facture :</strong>
                    <p>{{ $facture->id }}</p>
                </div>
                <div class="form-group">
                    <strong>Date de la Facture :</strong>
                    <p>{{ $facture->DateFact }}</p>
                </div>
                <div class="form-group">
                    <strong>ID Client :</strong>
                    <p>{{ $facture->idClient }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Code Postal :</strong>
                    <p>{{ $client->CPClient }}</p>
                </div>
                <div class="form-group">
                    <strong>Ville :</strong>
                    <p>{{ $client->VilleClient }}</p>
                </div>
                <div class="form-group">
                    <strong>Adresse :</strong>
                    <p>{{ $client->AdresseClient }}</p>
                </div>
            </div>
        </div>
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
        <!-- Products Information -->
        <div class="row">
            <div class="col-md-12">
                <h4>Détails des Produits</h4>
                @if($facture->contenirs->isEmpty())
                    <p>Aucun produit associé à cette facture.</p>
                    <div class="pull-right"><a class="btn btn-success" href="{{ route('contenir.create', ['facture_id' => $facture->id]) }}"><i class='fa fa-plus-circle'></i> Ajouter un produit</a></div>                    
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom du Produit</th>
                                <th>Description</th>
                                <th>Quantité</th>
                                <th class="prix-unitaire">Prix Unitaire</th>  <!-- Ajout de la classe pour Prix Unitaire -->
                                <th>Total</th>
                                <th width="255px">Actions 
                                    <div class="pull-right">
                                        <a class="btn btn-success" href="{{ route('contenir.create', ['facture_id' => $facture->id]) }}"><i class='fa fa-plus-circle'></i> Ajouter un produit</a>
                                    </div>
                                </th>
                            </tr>    
                        </thead>
                        <tbody>
                            @php
                                $total = 0; // Initialisation du total
                            @endphp

                            @foreach($facture->contenirs as $contenir)
                                @php
                                    $produitTotal = $contenir->Qte * ($contenir->produit->prixProd ?? 0);
                                    $total += $produitTotal; // Ajouter au total
                                @endphp
                                <tr>
                                    <td>{{ $contenir->produit->nomProd ?? 'N/A' }}</td>
                                    <td>{{ $contenir->produit->descProd ?? 'N/A' }}</td>
                                    <td>{{ $contenir->Qte }}</td>
                                    <td class="prix-unitaire">{{ $contenir->produit->prixProd ?? 'N/A' }} €</td>  <!-- Ajout de la classe pour Prix Unitaire -->
                                    <td>{{ $produitTotal }} €</td>
                                    <td>
                                        <form method="POST" action="{{ route('contenir.destroy', ['facture_id' => $facture->id, 'produit_id' => $contenir->produit->id]) }}" style="display: inline;">
                                            <a class="btn btn-info" href="{{ route('produits.show',  $contenir->idProd) }}">Détails</a>
                                            @if(auth()->user()->role == 'manager')
                                            <a class="btn btn-primary" href="{{ route('factures.contenirs.edit', ['idFact' => $contenir->idFact, 'idProd' => $contenir->idProd]) }}">Editer</a>
                                            
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                Supprimer
                                            </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Row for Total -->
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total</strong></td>
                                <td class="total-column"><strong>{{ $total }} €</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('factures.index') }}" class="btn btn-primary">Retour à la liste des factures</a>
            </div>
        </div>
    </div>

    <style>
        /* Custom style for the Total column */
        .total-column {
            width: 200px; /* Ajustez la largeur du total comme nécessaire */
        }

        /* Custom style for the Price column */
        .prix-unitaire {
            width: 150px; /* Ajustez la largeur du prix unitaire */
        }
    </style>
@endsection
