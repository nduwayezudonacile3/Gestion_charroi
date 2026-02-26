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
                    <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                    <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection