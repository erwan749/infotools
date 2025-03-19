@extends('commercial.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Éditer un commercial</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commercial.index') }}"><i class='fa fa-arrow-left'></i> Retour</a>
            </div>
        </div>
    </div>

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

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Nom :</strong>
                <input type="text" name="Name" value="{{ $commercial->user->name }}" class="form-control" placeholder="Nom">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Rôle :</strong>
                <select name="role" class="form-control">
                    <option value="Commercial" {{ $commercial->user->role == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="manager" {{ $commercial->user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Email :</strong>
                <input type="email" name="email" value="{{ $commercial->user->email }}" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Mot de passe :</strong>
                <input type="password" name="mdp1" class="form-control" placeholder="Mot de passe">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Retaper mot de passe :</strong>
                <input type="password" name="mdp2" class="form-control" placeholder="Retapez le mot de passe">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Code Postal :</strong>
                <input type="text" name="CP" value="{{ $commercial->cpCom }}" class="form-control" placeholder="Code Postal">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Ville :</strong>
                <input type="text" name="Ville" value="{{ $commercial->villeCom }}" class="form-control" placeholder="Ville">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Adresse :</strong>
                <input type="text" name="Adresse" value="{{ $commercial->rueCom }}" class="form-control" placeholder="Adresse">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Téléphone :</strong>
                <input type="text" name="Tel" value="{{ $commercial->telCom }}" class="form-control" placeholder="Numéro de téléphone">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
        </div>
    </form>
@endsection
