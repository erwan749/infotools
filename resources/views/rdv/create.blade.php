@extends('rdv.layout')

@section('content')
    <div class="form-header">
        <h2>Ajouter un rendez-vous</h2>
        <a class="btn btn-primary" href="{{ route('rdv.index') }}">
            <i class="fa fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops !</strong> Il y a des erreurs dans le formulaire :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour ajouter un rendez-vous -->
    <form method="POST" action="{{ route('rdv.store') }}" enctype="multipart/form-data" class="client-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="DateRdv"><strong>Date et heure du rendez-vous :</strong></label>
                <input type="datetime-local" class="form-control" name="DateRdv" id="datetime-picker">
                @error('DateRdv') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="client_id"><strong>Client :</strong></label>
                <select class="form-control" name="client_id">
                    <option value="">Sélectionnez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->prospect->NomProspects }} {{ $client->prospect->PrenomProspects }}
                        </option>
                    @endforeach
                </select>
                @error('client_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Bouton pour ajouter le rendez-vous -->
        <div class="form-submit">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Ajouter le rendez-vous
            </button>
        </div>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const occupiedDates = @json($occupiedDates);

        const dateInput = document.querySelector('input[name="DateRdv"]');

        dateInput.addEventListener('input', function () {
            const selectedDateTime = new Date(this.value);
            const isOccupied = occupiedDates.some(function (range) {
                const start = new Date(range.start);
                const end = new Date(range.end);
                return selectedDateTime >= start && selectedDateTime < end;
            });

            if (isOccupied) {
                alert('Cette plage horaire est déjà occupée.');
                this.value = ''; // Réinitialise la valeur du champ
            }
        });
    });
</script>
