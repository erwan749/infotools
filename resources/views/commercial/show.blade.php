@extends('commercial.layout')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Détails de l'utilisateur</h4>
            <div class="form-group">
                <strong>Nom et Prénom :</strong>
                <p>{{ $user->name }}</p>
            </div>

            <div class="form-group">
                <strong>Email :</strong>
                <p>{{ $user->email }}</p>
</div>
            @if ($commercial)
                <div class="form-group">
                    <strong>Code Postal :</strong>
                    <p>{{ $commercial->cpCom }}</p>
                </div>

                <div class="form-group">
                    <strong>Ville :</strong>
                    <p>{{ $commercial->villeCom }}</p>
                </div>

                <div class="form-group">
                    <strong>Rue :</strong>
                    <p>{{ $commercial->rueCom }}</p>
                </div>

                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <p>{{ $commercial->telCom }}</p>
                </div>
            @else
                <p>Aucun commercial associé à cet utilisateur.</p>
            @endif
        </div>
    </div>
@endsection
