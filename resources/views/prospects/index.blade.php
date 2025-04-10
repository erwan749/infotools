@extends('prospects.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des Prospects</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif


<div class='Tableau'>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Telephone</th>
            <th width="255px">Actions <div class="pull-right"><a class="btn btn-success" href="{{ route('prospects.create') }}"><i class='fa fa-plus-circle'></i> Ajouter un produit</a></div></th>        </tr>    
        @foreach($prospects as $prospect)
        <tr>
            <td>{{ $prospect['id'] }}</td>
            <td>{{ $prospect['NomProspects'] }}</td>
            <td>{{ $prospect['PrenomProspects'] }}</td>
            <td>{{ $prospect['telProspects'] }}</td>
            <td>
            <form action="{{ route('prospects.destroy',$prospect->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('prospects.show',$prospect->id) }}">Détails</a>
                        @if(auth()->user()->role == 'manager')

                        <a class="btn btn-primary" href="{{ route('prospects.edit',$prospect->id) }}">Editer</a>
                        @endif 

                        @csrf
                        @method('DELETE')
                        @if(auth()->user()->role == 'manager')

                        <button type="submit" class="btn btn-danger">Supprimer</button>
                        @endif 

            </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection