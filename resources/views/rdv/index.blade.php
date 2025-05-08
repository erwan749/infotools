@extends('rdv.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestion des rendez-vous</h2>
        <a class="btn btn-success" href="{{ route('rdv.create') }}">
            <i class="fa fa-plus-circle"></i> Ajouter un rendez-vous
        </a>
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
                <th>Date rendez-vous</th>
                <th>Commercial</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>    
        </thead>
        <tbody>
            @foreach($rdvData as $rendezVous)
                <tr>
                    <td>{{ $rendezVous['DateRdv'] }}</td>
                    <td>{{ $rendezVous['commercial']['name'] }}</td>
                    <td>{{ $rendezVous['client']['nom'] }} {{ $rendezVous['client']['prenom'] }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('rdv.show', $rendezVous['id']) }}">
                            <i class="fas fa-eye"></i> Détails
                        </a>
                        <a class="btn btn-primary" href="{{ route('rdv.edit', $rendezVous['id']) }}">
                            <i class="fas fa-edit"></i> Éditer
                        </a>
                        <form action="{{ route('rdv.destroy', $rendezVous['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
