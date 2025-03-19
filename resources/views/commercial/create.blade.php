@extends('commercial.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un commercial</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commercial.index') }}"><i class='fa fa-plus-circle'></i> Retour</a>
            </div>
        </div>
    </div>


      <form method="post" action="{{url('commercial')}}" enctype="multipart/form-data">
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

<div class="row" style="
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
">
<div class="form-group col-md-4">
    <strong>Nom et Prénom : </strong>
    <input type="text" class="form-control" name="Name">
    @error('Name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Rôle : </strong>
    <select name="role" class="form-control" id="role">
        <option value="Commercial">Commercial</option>
        <option value="manager">Manager</option>
    </select>
    @error('role')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Email : </strong>
    <input type="email" class="form-control" name="email">
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Mot de passe : </strong>
    <input type="password" class="form-control" name="mdp1">
    @error('mdp1')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Retaper mot de passe : </strong>
    <input type="password" class="form-control" name="mdp1_confirmation">
    @error('mdp2')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Code Postal : </strong>
    <input type="text" class="form-control" name="CP">
    @error('CP')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Ville : </strong>
    <input type="text" class="form-control" name="Ville">
    @error('Ville')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Adresse : </strong>
    <input type="text" class="form-control" name="Adresse">
    @error('Adresse')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4">
    <strong>Téléphone : </strong>
    <input type="text" class="form-control" name="Tel">
    @error('Tel')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-4" style="margin-top:20px">
    <button type="submit" class="btn btn-success">Ajouter</button>
</div>
</form>
</div>

@endsection