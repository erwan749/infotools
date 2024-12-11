@extends('rdv.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un rendez-vous</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rdv.index') }}"><i class='fa fa-plus-circle'></i> Retour</a>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('rdv.store') }}" enctype="multipart/form-data">
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
                <strong>Date du rendez-vous : </strong>
                <input type="date" class="form-control" name="DateRdv">
                @error('DateRdv')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Commercial : </strong>
                <select class="form-control" name="commercial_id">
                    <option value="">Sélectionnez un commercial</option>
                    @foreach ($commercials as $commercial)
                        <option value="{{ $commercial->id }}">
                            {{ $commercial->user->name }}
                        </option>
                    @endforeach
                </select>
                @error('commercial_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Client : </strong>
                <select class="form-control" name="client_id">
                    <option value="">Sélectionnez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->prospect->NomProspects }} {{ $client->prospect->PrenomProspects }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4" style="margin-top:20px">
                <button type="submit" class="btn btn-success">Ajouter le rendez-vous</button>
            </div>
        </div>
    </form>
@endsection
