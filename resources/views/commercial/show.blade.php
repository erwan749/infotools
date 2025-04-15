@extends('commercial.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Détails du Commercial -->
            <div class="col-md-6">
                <h2>Détails du Commercial</h2>
                
                <!-- Nom et Prénom -->
                <div class="form-group">
                    <strong>Nom et Prénom :</strong>
                    <p>{{ $user->name }}</p>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <strong>Email :</strong>
                    <p>{{ $user->email }}</p>
                </div>

                @if ($commercial)
                    <!-- Code Postal -->
                    <div class="form-group">
                        <strong>Code Postal :</strong>
                        <p>{{ $commercial->cpCom }}</p>
                    </div>

                    <!-- Ville -->
                    <div class="form-group">
                        <strong>Ville :</strong>
                        <p>{{ $commercial->villeCom }}</p>
                    </div>

                    <!-- Rue -->
                    <div class="form-group">
                        <strong>Rue :</strong>
                        <p>{{ $commercial->rueCom }}</p>
                    </div>

                    <!-- Téléphone -->
                    <div class="form-group">
                        <strong>Téléphone :</strong>
                        <p>{{ $commercial->telCom }}</p>
                    </div>
                @else
                    <p>Aucun commercial associé à cet utilisateur.</p>
                @endif
            </div>
        </div>

        <!-- Retour à la liste des commerciaux -->
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('commercial.index') }}" class="btn btn-primary">Retour à la liste des commerciaux</a>
            </div>
        </div>
    </div>
@endsection
