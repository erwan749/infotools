@extends('rdv.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier le Rendez-vous</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rdv.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('rdv.update', $rdv->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                <strong>Date et heure du rendez-vous : </strong>
                <input type="datetime-local" class="form-control" name="DateRdv" value="{{ old('DateRdv', $rdv->DateRdv) }}">
                @error('DateRdv')
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
                        <option value="{{ $client->id }}" {{ $client->id == $rdv->NoClient ? 'selected' : '' }}>
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
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
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
