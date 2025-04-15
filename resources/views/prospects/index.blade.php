@extends('prospects.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestion des Prospects</h2>
        <a class="btn btn-success" href="{{ route('prospects.create') }}">
            <i class="fas fa-plus-circle"></i> Ajouter un prospect
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

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prospects as $prospect)
                    <tr>
                        <td>{{ $prospect->id }}</td>
                        <td>{{ $prospect->NomProspects }}</td>
                        <td>{{ $prospect->PrenomProspects }}</td>
                        <td>{{ $prospect->telProspects }}</td>
                        <td>
                            <a class="btn btn-info btn-action" href="{{ route('prospects.show', $prospect->id) }}">
                                <i class="fas fa-eye"></i> Détails
                            </a>

                            @if(auth()->user()->role == 'manager')
                                <a class="btn btn-primary btn-action" href="{{ route('prospects.edit', $prospect->id) }}">
                                    <i class="fas fa-edit"></i> Éditer
                                </a>
                                <form action="{{ route('prospects.destroy', $prospect->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
