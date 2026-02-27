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
                <td>{{ $employe->nom }}</td>
                <td>{{ $employe->prenom }}</td>
                <td>{{ $employe->telephone }}</td>
                <td>{{ $employe->residence }}</td>
                <td>{{ $employe->fonction }}</td>
                  <td>{{ $employe->description }}</td>
                <td>{{ $employe->user->name }}</td>
                <td>
                    <a href="{{ route('employes.edit', $employe->id) }}" 
                        class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('employes.destroy', $employe->id) }}" 
                        method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Confirmer la suppression ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employes->links() }}
</div>
@endsection