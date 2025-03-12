@extends('factures.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des factures</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de Facture</th>
                <th>Client</th> <!-- Client affiché avec le prospect -->
                <th width="255px">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('factures.create') }}">
                            <i class='fa fa-plus-circle'></i> Ajouter une facture
                        </a>
                    </div>
                </th>    
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
                <tr>
                    <td>{{ $facture->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($facture->DateFact)->format('d-m-Y') }}</td> <!-- Format de la date -->
                    <td>
                        @if($facture->client->prospect)
                            {{ $facture->client->prospect->NomProspects }} {{ $facture->client->prospect->PrenomProspects }}
                        @else
                            Aucun prospect
                        @endif
                    </td> <!-- Afficher le prospect -->
                    <td>
                        <form action="{{ route('factures.destroy', $facture->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('factures.show', $facture->id) }}">Détails</a>

                            @csrf
                            @method('DELETE')
                            @if(auth()->user()->role == 'manager')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            @endif

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
