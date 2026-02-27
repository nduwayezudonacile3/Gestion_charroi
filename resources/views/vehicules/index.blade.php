@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des véhicules</h2>
    <a href="{{ route('vehicules.create') }}" class="btn btn-success mb-3">Ajouter un véhicule</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Immatriculation</th>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Statut</th>
                <th>Année</th>
                <th>Creer Par</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicules as $vehicule)
            <tr>
                <td>{{ $vehicule->id }}</td>
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->categorie }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->status }}</td>
                <td>{{ $vehicule->annee_fabrication }}</td>
                <td>{{ $vehicule->user->name }}</td>
                <td>
                     <!-- Dropdown menu ⋮ -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $vehicule->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $vehicule->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('vehicules.edit', $vehicule->id) }}">Modifier</a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" type="button"
                                        onclick="if(confirm('Voulez-vous vraiment supprimer ce vehicule ?')){ document.getElementById('deleteForm{{ $vehicule->id }}').submit(); }">
                                        Supprimer
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Formulaire caché pour la suppression -->
                        <form id="deleteForm{{ $vehicule->id }}" action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" style="display:none;">
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