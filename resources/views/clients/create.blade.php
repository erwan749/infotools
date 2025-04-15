@extends('clients.layout')

@section('content')
    <div class="form-header">
        <h2>Ajouter un nouveau client</h2>
        <a class="btn btn-primary" href="{{ route('clients.index') }}">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops !</strong> Il y a des erreurs dans le formulaire :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('clients') }}" enctype="multipart/form-data" class="client-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="Nom">Nom</label>
                <input type="text" name="Nom" class="form-control" placeholder="Dupont">
                @error('Nom') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Prenom">Prénom</label>
                <input type="text" name="Prenom" class="form-control" placeholder="Jean">
                @error('Prenom') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Ville">Ville</label>
                <input type="text" name="Ville" class="form-control" placeholder="Paris">
                @error('Ville') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Adresse">Adresse</label>
                <input type="text" name="Adresse" class="form-control" placeholder="12 rue de la paix">
                @error('Adresse') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="CP">Code Postal</label>
                <input type="text" name="CP" class="form-control" placeholder="75001">
                @error('CP') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="Email" class="form-control" placeholder="client@example.com">
                @error('Email') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Telephone">Téléphone</label>
                <input type="text" name="Telephone" class="form-control" placeholder="0601020304">
                @error('Telephone') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="psw">Mot de passe</label>
                <input type="password" name="psw" class="form-control" placeholder="••••••••">
                @error('psw') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter
            </button>
        </div>
    </form>
@endsection
