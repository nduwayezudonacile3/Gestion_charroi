@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des utilisateurs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Créer un utilisateur</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Username</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->statut }}</td>
                <td>
                    <!-- Dropdown menu ⋮ -->
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $user->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">Modifier</a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" type="button"
                                        onclick="if(confirm('Voulez-vous vraiment supprimer ce user ?')){ document.getElementById('deleteForm{{ $user->id }}').submit(); }">
                                        Supprimer
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Formulaire caché pour la suppression -->
                        <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:none;">
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