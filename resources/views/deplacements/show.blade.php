@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des déplacements</h2>

        {{-- Bouton Ajouter global --}}
        <a href="{{ route('deplacements.create') }}" class="btn btn-success mb-3">Créer un déplacement</a>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tableau --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Projet</th>
                    <th>Itinéraire</th>
                    <th>Date départ</th>
                    <th>Date prévue</th>
                    <th>KM départ</th>
                    <th>Carburant initial</th>
                    <th>Motif</th>
                    <th>Frais mission</th>
                    <th>Status</th>
                    <th>Véhicule</th>
                    <th>Employé</th>
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

                        {{-- Dates sécurisées --}}
                        <td>{{ $deplacement->date_depart ? date('d/m/Y H:i', strtotime($deplacement->date_depart)) : '' }}
                        </td>
                        <td>{{ $deplacement->date_prevus ? date('d/m/Y H:i', strtotime($deplacement->date_prevus)) : '' }}
                        </td>

                        <td>{{ $deplacement->km_depart }}</td>
                        <td>{{ $deplacement->carburant_initial }}</td>
                        <td>{{ $deplacement->motif }}</td>
                        <td>{{ number_format($deplacement->frais_mission ?? 0, 2) }} €</td>

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
                                <span class="badge bg-secondary">{{ $deplacement->vehicule->status }}</span>
                            @else
                                <span class="text-muted">Aucun véhicule</span>
                            @endif
                        </td>

                        {{-- Employés --}}
                        <td>
                            @if ($deplacement->employes->count() > 0)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($deplacement->employes as $employe)
                                        <small class="badge bg-info">{{ $employe->nom }} {{ $employe->prenom }}</small>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="d-flex flex-column">

                                {{-- Terminer --}}
                                @if ($deplacement->status == 'En cours' && $deplacement->vehicule && $deplacement->vehicule->status == 'En mission')
                                    <form action="{{ route('deplacements.terminer', $deplacement->id) }}" method="POST"
                                        class="mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"
                                            onclick="return confirm('Voulez-vous vraiment terminer ce déplacement ?')">
                                            Terminer
                                        </button>
                                    </form>
                                @endif

                                {{-- Enregistrer retour --}}
                                @if ($deplacement->status == 'Termine' && !$deplacement->date_retour)
                                    <a href="{{ route('deplacements.enregistrerRetourForm', $deplacement->id) }}"
                                        class="btn btn-sm btn-dark mb-1">Enregistrer retour</a>
                                @endif

                                {{-- Modifier --}}
                                @if ($deplacement->status == 'En cours')
                                    <a href="{{ route('deplacements.edit', $deplacement->id) }}"
                                        class="btn btn-sm btn-primary mb-1">Modifier</a>
                                @endif

                                {{-- Supprimer --}}
                                <form action="{{ route('deplacements.destroy', $deplacement->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-1"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce déplacement ?')">
                                        Supprimer
                                    </button>
                                </form>

                                {{-- Voir --}}
                                <a href="{{ route('deplacements.show', $deplacement->id) }}"
                                    class="btn btn-sm btn-info mt-1">Voir</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $deplacements->links() }}
        </div>
    </div>
@endsection
