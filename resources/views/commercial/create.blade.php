@extends('commercial.layout')

@section('content')
    <div class="form-header">
        <h2>Ajout d'un commercial</h2>
        <a class="btn btn-primary" href="{{ route('commercial.index') }}">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops !</strong> Il y a des erreurs dans votre formulaire :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('commercial') }}" enctype="multipart/form-data" class="commercial-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="Name">Nom et Prénom</label>
                <input type="text" name="Name" class="form-control" placeholder="Nom Prénom">
                @error('Name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <select name="role" class="form-control" id="role">
                    <option value="Commercial">Commercial</option>
                    <option value="manager">Manager</option>
                </select>
                @error('role') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="commercial@example.com">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mdp1">Mot de passe</label>
                <input type="password" name="mdp1" class="form-control" placeholder="••••••••">
                @error('mdp1') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mdp1_confirmation">Retaper mot de passe</label>
                <input type="password" name="mdp1_confirmation" class="form-control" placeholder="••••••••">
                @error('mdp1_confirmation') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="CP">Code Postal</label>
                <input type="text" name="CP" class="form-control" placeholder="75001">
                @error('CP') <span class="error">{{ $message }}</span> @enderror
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
                <label for="Tel">Téléphone</label>
                <input type="text" name="Tel" class="form-control" placeholder="0601020304">
                @error('Tel') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter
            </button>
        </div>
    </form>
@endsection
