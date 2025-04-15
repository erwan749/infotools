@extends('commercial.layout')

@section('content')
    <div class="container-fluid">
        <!-- En-tête avec le titre et le bouton d'ajout -->
        <div class="form-header d-flex justify-content-between align-items-center mb-3 w-100">
            <h2>Liste des commerciaux</h2>
            <a class="btn btn-success" href="{{ route('commercial.create') }}">
                <i class="fas fa-plus-circle"></i> Ajouter un commercial
            </a>
        </div>

        <!-- Affichage des messages de succès -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Table des commerciaux -->
        <div class="table-responsive">
            <table class="table table-bordered w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $commercial)
                        <tr>
                            <td>{{ $commercial->id }}</td>
                            <td>{{ $commercial->name }}</td>
                            <td>{{ $commercial->email }}</td>
                            <td>{{ $commercial->role }}</td>
                            <td>
                                <a class="btn btn-info btn-action" href="{{ route('commercial.show', $commercial->id) }}">
                                    <i class="fas fa-eye"></i> Détails
                                </a>

                                <a class="btn btn-primary btn-action" href="{{ route('commercial.edit', $commercial->id) }}">
                                    <i class="fas fa-edit"></i> Éditer
                                </a>

                                <form action="{{ route('commercial.destroy', $commercial->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
