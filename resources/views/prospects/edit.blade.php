@extends('prospects.layout')

@section('content')
    <div class="container mt-4">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Modifier un prospect</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('prospects.index') }}">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Form to update prospect -->
        <form method="POST" action="{{ route('prospects.update', $prospect->id) }}">
            @csrf
            @method('PUT') <!-- Indique que c'est une mise à jour (PUT) -->

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

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Nom du prospect :</strong></label>
                    <input type="text" name="NomProspects" value="{{ old('NomProspects', $prospect->NomProspects) }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Prénom du prospect :</strong></label>
                    <input type="text" name="PrenomProspects" value="{{ old('PrenomProspects', $prospect->PrenomProspects) }}" class="form-control" placeholder="Prénom">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Téléphone :</strong></label>
                    <input type="text" name="telProspects" value="{{ old('telProspects', $prospect->telProspects) }}" class="form-control" placeholder="Numéro de téléphone">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Email :</strong></label>
                    <input type="email" name="EmailProspects" value="{{ old('EmailProspects', $prospect->EmailProspects) }}" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Mot de passe :</strong></label>
                    <input type="password" name="mdpProspect" class="form-control" placeholder="Mot de passe">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label><strong>Confirmer le mot de passe :</strong></label>
                    <input type="password" name="mdpProspect_confirmation" class="form-control" placeholder="Confirmer le mot de passe">
                </div>
            </div>

            <div class="row mb-3" style="margin-top:20px;">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success btn-block">Mettre à jour le prospect</button>
                </div>
            </div>
        </form>
    </div>
@endsection
