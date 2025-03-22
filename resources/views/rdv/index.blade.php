@extends('rdv.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des rendez-vous</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<div class='Tableau'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date rendez-vous</th>
                <th>Commercial</th>
                <th>Client</th>
                <th width="255px">Actions
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('rdv.create') }}">
                            <i class='fa fa-plus-circle'></i> Ajouter un rendez-vous
                        </a>
                    </div>
                </th>
            </tr>    
        </thead>
        <tbody>
            @foreach($rdvData as $rendezVous)
            <tr>
                <td>{{ $rendezVous['DateRdv'] }}</td>
                <td>{{ $rendezVous['commercial']['name'] }}</td>
                <td>{{ $rendezVous['client']['nom'] }} {{ $rendezVous['client']['prenom'] }}</td>
                <td>
                    <form action="{{ route('rdv.destroy', $rendezVous['id']) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('rdv.show', $rendezVous['id']) }}">Détails</a>
                        <a class="btn btn-primary" href="{{ route('rdv.edit', $rendezVous['id']) }}">Éditer</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
