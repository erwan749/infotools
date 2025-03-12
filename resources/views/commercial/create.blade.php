@extends('clients.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un client</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"><i class='fa fa-plus-circle'></i> Retour</a>
            </div>
        </div>
    </div>


      <form method="post" action="{{url('clients')}}" enctype="multipart/form-data">
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
      <strong>Nom : </strong>
      <input type="text" class="form-control" name="Nom">
      @error('Nom')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Prenom : </strong>
      <input type="text" class="form-control" name="Prenom">
      @error('Prenom')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Ville : </strong>
      <input type="text" class="form-control" name="Ville">
      @error('Ville')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Adresse : </strong>
      <input type="text" class="form-control" name="Adresse">
      @error('Adresse')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Code Postal : </strong>
      <input type="text" class="form-control" name="CP">
      @error('CP')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Email : </strong>
      <input type="text" class="form-control" name="Email">
      @error('Email')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Telephone : </strong>
      <input type="text" class="form-control" name="Telephone">
      @error('Telephone')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
      <strong>Mot de Passe : </strong>
      <input type="password" class="form-control" name="psw">
      @error('psw')
          <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4" style="margin-top:20px">
      <button type="submit" class="btn btn-success">Ajouter</button>
  </div>
</div></form>
</div>

@endsection