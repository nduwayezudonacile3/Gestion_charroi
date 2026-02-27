@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Affectations</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('deplacementemployes.create') }}" class="btn btn-success mb-3">
        Ajouter Affectation
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Déplacement</th>
                <th>Date création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deplacementemployes as $item)
            <tr>
                <td>{{ $item->employe->nom }} {{ $item->employe->prenom }}</td>
                <td>{{ $item->deplacement->titre ?? 'Déplacement '.$item->deplacement->id }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('deplacementemployes.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('deplacementemployes.destroy', $item->id) }}"
                        method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Confirmer la suppression ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $deplacementemployes->links() }}
</div>
@endsection