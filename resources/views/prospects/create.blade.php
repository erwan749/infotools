@extends('prospects.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un prospect</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('prospects.index') }}"><i class='fa fa-plus-circle'></i> Retour</a>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('prospects.store') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Il y a des soucis dans votre formulaire.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Nom du prospect :</strong>
                <input type="text" class="form-control" name="NomProspects" value="{{ old('NomProspects') }}">
                @error('NomProspects')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Prénom du prospect :</strong>
                <input type="text" class="form-control" name="PrenomProspects" value="{{ old('PrenomProspects') }}">
                @error('PrenomProspects')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Téléphone :</strong>
                <input type="text" class="form-control" name="telProspects" value="{{ old('telProspects') }}">
                @error('telProspects')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Email :</strong>
                <input type="email" class="form-control" name="EmailProspects" value="{{ old('EmailProspects') }}">
                @error('EmailProspects')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Mot de passe :</strong>
                <input type="password" class="form-control" name="mdpProspect">
                @error('mdpProspect')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Confirmer le mot de passe :</strong>
                <input type="password" class="form-control" name="mdpProspect_confirmation">
                @error('mdpProspect_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4" style="margin-top:20px">
                <button type="submit" class="btn btn-success">Ajouter le prospect</button>
            </div>
        </div>
    </form>
@endsection
