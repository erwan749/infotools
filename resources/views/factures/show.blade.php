@extends('factures.layout')

@section('content')
    <div class="container mt-5">
        <!-- Header with Title and Back Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Détails de la Facture</h2>
            <a class="btn btn-primary" href="{{ route('factures.index') }}">Retour à la liste des factures</a>
        </div>

        <div class="row mb-4">
            <!-- Client Information in Left Column -->
            <div class="col-md-6 mb-3">
                <h4 class="mb-3">Détails du Client</h4>
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

            <!-- Facture Information in Right Column -->
            <div class="col-md-6 mb-3">
                <h4 class="mb-3">Détails de la Facture</h4>
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

        <div class="row mb-4">
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
                <h4 class="mb-3">Détails des Produits</h4>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success" href="{{ route('contenir.create', ['facture_id' => $facture->id]) }}">
                            <i class="fa fa-plus-circle"></i> Ajouter un produit
                        </a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nom du Produit</th>
                                <th>Description</th>
                                <th>Quantité</th>
                                <th class="text-end">Prix Unitaire</th>
                                <th class="text-end">Total</th>
                                <th class="text-center" style="width: 220px;">Actions</th>
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
                                    <td class="text-end">{{ number_format($contenir->produit->prixProd ?? 0, 2) }} €</td>
                                    <td class="text-end">{{ number_format($produitTotal, 2) }} €</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ route('produits.show', $contenir->idProd) }}">
                                                <i class="fas fa-eye"></i> Détails
                                            </a>
                                            @if(auth()->user()->role == 'manager')
                                                <a class="btn btn-primary" href="{{ route('factures.contenirs.edit', ['idFact' => $contenir->idFact, 'idProd' => $contenir->idProd]) }}">
                                                    <i class="fas fa-edit"></i> Editer
                                                </a>
                                                <form action="{{ route('contenir.destroy', ['facture_id' => $facture->id, 'produit_id' => $contenir->produit->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                        <i class="fas fa-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Row for Total -->
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total</strong></td>
                                <td class="text-end"><strong>{{ number_format($total, 2) }} €</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-4" style="margin-top:20px;">
            <div class="col-md-12 text-center">
                <a href="{{ route('factures.index') }}" class="btn btn-primary">Retour à la liste des factures</a>
            </div>
        </div>
    </div>

    <style>
        @media(max-width:768px){
            .col-md-6{
                width: 100%;
            }
        }
        @media (min-width:769px) {
            .col-md-6{
                width: 50%;
            }
        }
        .row{
            display : flex;
        }
        .btn-group{
            display: flex
;
    flex-wrap: wrap;
    gap : 5px;
        }
        /* Custom styles */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .total-column {
            width: 200px;
        }
        .text-end {
            text-align: right;
        }
        .btn-group a {
            margin-right: 10px;
        }
    </style>
@endsection
