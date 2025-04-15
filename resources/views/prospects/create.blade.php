@extends('prospects.layout')

@section('content')
    <div class="form-header">
        <h2>Ajout d'un prospect</h2>
        <a class="btn btn-primary" href="{{ route('prospects.index') }}">
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

    <form method="POST" action="{{ route('prospects.store') }}" enctype="multipart/form-data" class="client-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="NomProspects">Nom du prospect</label>
                <input type="text" class="form-control" name="NomProspects" value="{{ old('NomProspects') }}" placeholder="Dupont">
                @error('NomProspects') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="PrenomProspects">Prénom du prospect</label>
                <input type="text" class="form-control" name="PrenomProspects" value="{{ old('PrenomProspects') }}" placeholder="Jean">
                @error('PrenomProspects') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="telProspects">Téléphone</label>
                <input type="text" class="form-control" name="telProspects" value="{{ old('telProspects') }}" placeholder="0601020304">
                @error('telProspects') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="EmailProspects">Email</label>
                <input type="email" class="form-control" name="EmailProspects" value="{{ old('EmailProspects') }}" placeholder="prospect@example.com">
                @error('EmailProspects') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mdpProspect">Mot de passe</label>
                <input type="password" class="form-control" name="mdpProspect" placeholder="••••••••">
                @error('mdpProspect') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mdpProspect_confirmation">Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="mdpProspect_confirmation" placeholder="••••••••">
                @error('mdpProspect_confirmation') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter le prospect
            </button>
        </div>
    </form>
@endsection
