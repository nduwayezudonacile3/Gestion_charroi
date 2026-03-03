@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des déplacements</h2>

        {{-- Bouton pour créer un déplacement --}}
        <div class="d-flex mb-3">
            <a href="{{ route('deplacements.create') }}" class="btn btn-success me-2">Créer un déplacement</a>
        </div>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tableau --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Projet</th>
                        <th>Date départ</th>
                        <th>Status</th>
                        <th>Véhicule</th>
                        <th>Employé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deplacements as $deplacement)
                        <tr>
                            <td>
                                <strong>{{ $deplacement->code_deplacement }}</strong>
                            </td>
                            <td>{{ $deplacement->projet->nom_projet ?? 'N/A' }}</td>
                            <td>{{ $deplacement->date_depart ? date('d/m/Y H:i', strtotime($deplacement->date_depart)) : '' }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if ($deplacement->status == 'Termine')
                                    <span class="badge bg-success">{{ $deplacement->status }}</span>
                                @elseif($deplacement->status == 'En cours')
                                    <span class="badge bg-warning text-dark">{{ $deplacement->status }}</span>
                                @else
                                    <span class="badge bg-info">{{ $deplacement->status }}</span>
                                @endif
                            </td>

                            {{-- Véhicule --}}
                            <td>
                                @if ($deplacement->vehicule)
                                    {{ $deplacement->vehicule->immatriculation }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Employés --}}
                            <td>
                                @if ($deplacement->employes->count() > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($deplacement->employes as $employe)
                                            <small class="badge bg-info">{{ $employe->nom }}
                                                {{ $employe->prenom }}</small>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">Non assigné</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    @if ($deplacement->status)
                                        <a href="{{ route('deplacements.terminer', $deplacement->id) }}"
                                            class="btn btn-primary" title="Terminer la mission">
                                            <i class="bi bi-check-circle"></i>
                                        </a>
                                        <a href="{{ route('deplacements.edit', $deplacement->id) }}" class="btn btn-info"
                                            title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('deplacements.show', $deplacement->id) }}" class="btn btn-secondary"
                                        title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('deplacements.destroy', $deplacement->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce déplacement ?')"
                                            title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $deplacements->links() }}
        </div>
    </div>
@endsection
