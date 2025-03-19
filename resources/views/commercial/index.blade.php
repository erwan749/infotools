@extends('commercial.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des commerciaux</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nom prenom</th>
            <th>Email</th>
            <th width="255px">Actions
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('commercial.create') }}"><i class='fa fa-plus-circle'></i> Ajouter un commercial</a>
                </div>
            </th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{$user['id']}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('commercial.destroy', $user->id) }}" method="POST" id="deleteForm{{ $user->id }}">
                        <a class="btn btn-info" href="{{ route('commercial.show', $user->id) }}">Détails</a>
                        <a class="btn btn-primary" href="{{ route('commercial.edit', $user->id) }}">Editer</a>

                        @csrf
                        @method('DELETE')

                        <!-- Bouton de suppression -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                            Supprimer
                        </button>
                    </form>

                    <!-- Modal de confirmation -->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirmer la suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" id="confirmDelete{{ $user->id }}">Confirmer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        // Soumettre le formulaire de suppression quand l'utilisateur confirme
        @foreach($users as $user)
            document.getElementById('confirmDelete{{ $user->id }}').addEventListener('click', function () {
                document.getElementById('deleteForm{{ $user->id }}').submit();
            });
        @endforeach
    </script>
@endsection
