@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Déplacements</h1>
    <a href="{{ route('deplacements.create') }}" class="btn btn-success mb-3">Créer un Déplacement</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Date départ</th>
                <th>Statut</th>
                <th>Utilisateur</th>
                <th>Véhicule</th>
                <th>Projet</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deplacements as $dep)
                <tr>
                    <td>{{ $dep->id }}</td>
                    <td>{{ $dep->code_deplacement }}</td>
                    <td>{{ $dep->date_depart }}</td>
                    <td>{{ $dep->statut }}</td>
                    <td>{{ $dep->user->name ?? '' }}</td>
                    <td>{{ $dep->vehicule->name ?? '' }}</td>
                    <td>{{ $dep->projet->name ?? '' }}</td>
                    <td>
                        
                        <!-- Dropdown menu ⋮ -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $dep->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $dep->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('deplacements.show', $dep->id) }}">Voir</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('deplacements.edit', $dep->id) }}">Modifier</a>
                                </li>
                                <li>
                                    <form action="{{ route('deplacements.destroy', $dep->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Confirmer la suppression ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $deplacements->links() }}
</div>
@endsection