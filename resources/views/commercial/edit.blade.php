@extends('commercial.layout')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3"style="margin-bottom:20px;">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Éditer un commercial</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('commercial.index') }}">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Formulaire pour la mise à jour du commercial -->
        <form action="{{ route('commercial.update', $commercial->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Il y a des erreurs dans votre formulaire.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Nom -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Nom :</strong></label>
                    <input type="text" name="Name" value="{{ old('Name', $commercial->user->name) }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <!-- Rôle -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Rôle :</strong></label>
                    <select name="role" class="form-control">
                        <option value="Commercial" {{ $commercial->user->role == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="manager" {{ $commercial->user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                    </select>
                </div>
            </div>

            <!-- Email -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Email :</strong></label>
                    <input type="email" name="email" value="{{ old('email', $commercial->user->email) }}" class="form-control" placeholder="Email">
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Mot de passe :</strong></label>
                    <input type="password" name="mdp1" class="form-control" placeholder="Mot de passe">
                </div>
            </div>

            <!-- Retaper le mot de passe -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Retaper mot de passe :</strong></label>
                    <input type="password" name="mdp2" class="form-control" placeholder="Retapez le mot de passe">
                </div>
            </div>

            <!-- Code Postal -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Code Postal :</strong></label>
                    <input type="text" name="CP" value="{{ old('CP', $commercial->cpCom) }}" class="form-control" placeholder="Code Postal">
                </div>
            </div>

            <!-- Ville -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Ville :</strong></label>
                    <input type="text" name="Ville" value="{{ old('Ville', $commercial->villeCom) }}" class="form-control" placeholder="Ville">
                </div>
            </div>

            <!-- Adresse -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Adresse :</strong></label>
                    <input type="text" name="Adresse" value="{{ old('Adresse', $commercial->rueCom) }}" class="form-control" placeholder="Adresse">
                </div>
            </div>

            <!-- Téléphone -->
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Téléphone :</strong></label>
                    <input type="text" name="Tel" value="{{ old('Tel', $commercial->telCom) }}" class="form-control" placeholder="Numéro de téléphone">
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="row mb-3" style="margin-top:20px;">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
@endsection
