@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des projets</h1>

    <a href="{{ route('projets.create') }}" class="btn btn-primary mb-3">Ajouter un projet</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Nom</th>
                <th>Delais</th>
                <th>Budget</th>
                <th>Statut</th>
                <th>Description</th>
                <th>Créer par</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projets as $projet)
                <tr>
                    <td>{{ $projet->id }}</td>
                    <td>{{ $projet->code_projet }}</td>
                    <td>{{ $projet->nom_projet }}</td>
                    <td>{{ $projet->delais_projet }}</td>
                    <td>{{ $projet->budget }}</td>
                    <td>{{ $projet->statut }}</td>
                    <td>{{ $projet->description }}</td>
                     <td>{{ $projet->user->name }}</td>
                    <td>
                        <!-- Dropdown menu ⋮ -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $projet->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $projet->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('projets.edit', $projet->id) }}">Modifier</a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" type="button"
                                        onclick="if(confirm('Voulez-vous vraiment supprimer ce projet ?')){ document.getElementById('deleteForm{{ $projet->id }}').submit(); }">
                                        Supprimer
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Formulaire caché pour la suppression -->
                        <form id="deleteForm{{ $projet->id }}" action="{{ route('projets.destroy', $projet->id) }}" method="POST" style="display:none;">
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