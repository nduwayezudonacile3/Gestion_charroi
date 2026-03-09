@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Détails du déplacement</h2>

        <table class="table table-bordered">
            <tr>
                <th>Code</th>
                <td>{{ $deplacement->code_deplacement }}</td>
            </tr>
            <tr>
                <th>Chef mission</th>
                <td>{{ $deplacement->chef_mission }}</td>
            </tr>
            <tr>
                <th>Composantes mission</th>
                <td>{{ $deplacement->composantes_mission }}</td>
            </tr>
            <tr>
                <th>Projet</th>
                <td>{{ $deplacement->projet->nom_projet ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Litineraire</th>
                <td>{{ $deplacement->litineraire }}</td>
            </tr>
            <tr>
                <th>Date départ</th>
                <td>{{ $deplacement->date_depart ? \Carbon\Carbon::parse($deplacement->date_depart)->format('d/m/Y H:i') : '' }}
                </td>
            </tr>
            <tr>
                <th>Date prévue</th>
                <td>{{ $deplacement->date_prevus ? \Carbon\Carbon::parse($deplacement->date_prevus)->format('d/m/Y H:i') : '' }}
                </td>
            </tr>

            <tr>
                <th>KM départ</th>
                <td>{{ $deplacement->km_depart }}</td>
            </tr>
            <tr>
                <th>Carburant initial</th>
                <td>{{ $deplacement->carburant_initial }}</td>
            </tr>
            <tr>
                <th>Motif</th>
                <td>{{ $deplacement->motif }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $deplacement->status }}</td>
            </tr>
            <tr>
                <th>Véhicule</th>
                <td>{{ $deplacement->vehicule?->immatriculation ?? 'Aucun véhicule' }}</td>
            </tr>
            <tr>
                <th>Chauffeurs</th>
                <td>
                    @forelse($deplacement->employes as $employe)
                        <span class="badge bg-info">{{ $employe->nom }} {{ $employe->prenom }}</span>
                    @empty
                        <span class="text-muted">Non assigné</span>
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>Date retour</th>
                <td>{{ $deplacement->date_retour }}
                </td>
            </tr>
            <tr>
                <th>KM retour</th>
                <td>{{ $deplacement->km_retour }}</td>
            </tr>
            <tr>
                <th>KM parcourus</th>
                <td>{{ $deplacement->km_parcourus }}</td>
            </tr>
            <tr>
                <th>carburant restant</th>
                <td>{{ $deplacement->carburant_restant }}</td>
            </tr>
            <tr>
                <th>carburant consomme</th>
                <td>{{ $deplacement->carburant_consomme }}</td>
            </tr>
            <tr>
                <th>approuve par</th>
                <td>{{ $deplacement->approved_by }}</td>
            </tr>
        </table>

        <a href="{{ route('deplacements.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
@endsection
