@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Employés</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('employes.create') }}" class="btn btn-success mb-3">
        Ajouter un Employé
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Résidence</th>
                <th>Fonction</th>
                <th>Description</th>
                <th>Creer Par</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employes as $employe)
            <tr>
                <td>{{ $employe->id }}</td>
                <td>{{ $employe->nom }}</td>
                <td>{{ $employe->prenom }}</td>
                <td>{{ $employe->telephone }}</td>
                <td>{{ $employe->residence }}</td>
                <td>{{ $employe->fonction }}</td>
                  <td>{{ $employe->description }}</td>
                <td>{{ $employe->user->name }}</td>
                <td>
                    <!-- Dropdown menu ⋮ -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $employe->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $employe->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('employes.edit', $employe->id) }}">Modifier</a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" type="button"
                                        onclick="if(confirm('Voulez-vous vraiment supprimer cet employe ?')){ document.getElementById('deleteForm{{ $employe->id }}').submit(); }">
                                        Supprimer
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Formulaire caché pour la suppression -->
                        <form id="deleteForm{{ $employe->id }}" action="{{ route('employes.destroy', $employe->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

    