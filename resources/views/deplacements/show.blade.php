@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des déplacements</h2>

        {{-- Bouton Ajouter --}}
        <a href="{{ route('deplacements.create') }}" class="btn btn-success mb-3">Créer un déplacement</a>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tableau des déplacements --}}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Projet</th>
                    <th>Litineraire</th>
                    <th>Date départ</th>
                    <th>Date prevus</th>
                    <th>KM départ</th>
                    <th>Carburant initial</th>
                    <th>Motif</th>
                    <th>Frais mission</th>
                    <th>Status</th>
                    <th>Véhicule</th>
                    <th>Employé(s)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deplacements as $deplacement)
                    <tr>
                        <td>{{ $deplacement->id }}</td>
                        <td>{{ $deplacement->code_deplacement }}</td>
                        <td>{{ $deplacement->projet->nom_projet ?? 'N/A' }}</td>
                        <td>{{ $deplacement->litineraire }}</td>
                        <td>{{ $deplacement->date_depart?->format('d/m/Y H:i') ?? '' }}</td>
                        <td>{{ $deplacement->date_prevus?->format('d/m/Y H:i') ?? '' }}</td>
                        <td>{{ $deplacement->km_depart }}</td>
                        <td>{{ $deplacement->carburant_initial }}</td>
                        <td>{{ $deplacement->motif }}</td>
                        <td>{{ number_format($deplacement->frais_mission ?? 0, 2) }} €</td>

                        {{-- Status --}}
                        <td>
                            @php
                                $statusClasses = [
                                    'Termine' => 'bg-success',
                                    'En cours' => 'bg-warning text-dark',
                                    'Autre' => 'bg-info',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$deplacement->status] ?? 'bg-info' }}">
                                {{ $deplacement->status }}
                            </span>
                        </td>

                        {{-- Véhicule --}}
                        <td>
                            {{ $deplacement->vehicule?->immatriculation ?? 'Aucun véhicule' }}
                            @if ($deplacement->vehicule)
                                <span class="badge bg-secondary">{{ $deplacement->vehicule->status }}</span>
                            @endif
                        </td>

                        {{-- Employés --}}
                        <td>
                            @forelse($deplacement->employes as $employe)
                                <small class="badge bg-info">{{ $employe->nom }} {{ $employe->prenom }}</small>
                            @empty
                                <span class="text-muted">Non assigné</span>
                            @endforelse
                        </td>

                        {{-- Actions --}}
                        <td class="d-flex flex-column gap-1">
                            {{-- Terminer --}}
                            @if ($deplacement->status == 'En cours' && $deplacement->vehicule?->status == 'En mission')
                                <form action="{{ route('deplacements.terminer', $deplacement->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"
                                        onclick="return confirm('Voulez-vous vraiment terminer ce déplacement ?')">
                                        Terminer
                                    </button>
                                </form>
                            @endif

                            {{-- Enregistrer retour --}}
                            @if ($deplacement->status == 'Termine' && !$deplacement->date_retour)
                                <a href="{{ route('deplacements.terminer', $deplacement->id) }}"
                                    class="btn btn-sm btn-dark">Enregistrer retour</a>
                            @endif

                            {{-- Modifier --}}
                            @if ($deplacement->status == 'En cours')
                                <a href="{{ route('deplacements.edit', $deplacement->id) }}"
                                    class="btn btn-sm btn-primary">Modifier</a>
                            @endif

                            {{-- Supprimer --}}
                            <form action="{{ route('deplacements.destroy', $deplacement->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce déplacement ?')">
                                    Supprimer
                                </button>
                            </form>

                            {{-- Voir --}}
                            <a href="{{ route('deplacements.show', $deplacement->id) }}"
                                class="btn btn-sm btn-info">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $deplacements->links() }}
        </div>
    </div>
@endsection
