@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Fin de mission - {{ $deplacement->code_deplacement }}</h2>

        {{-- Messages succès / erreur --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="mb-4">
            <p><strong>Projet :</strong> {{ $deplacement->projet->nom_projet ?? 'N/A' }}</p>
            <p><strong>Itinéraire :</strong> {{ $deplacement->itineraire }}</p>
            <p><strong>Date départ :</strong>
                {{ $deplacement->date_depart ? date('d/m/Y H:i', strtotime($deplacement->date_depart)) : '' }}</p>
            <p><strong>Date prévue :</strong>
                {{ $deplacement->date_prevus ? date('d/m/Y H:i', strtotime($deplacement->date_prevus)) : '' }}</p>
            <p><strong>KM départ :</strong> {{ $deplacement->km_depart }}</p>
            <p><strong>Carburant initial :</strong> {{ $deplacement->carburant_initial }}</p>
            <p><strong>Motif :</strong> {{ $deplacement->motif }}</p>
            <p><strong>Frais mission :</strong> {{ number_format($deplacement->frais_mission ?? 0, 2) }} €</p>
        </div>

        {{-- Formulaire pour terminer la mission --}}

        <form action="{{ route('deplacements.terminer', $deplacement->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="date_retour" class="form-label">Date retour</label>
                <input type="date" name="date_retour" class="form-control" value="{{ old('date_retour') }}" required>
            </div>
            <div class="mb-3">
                <label>KM retour</label>
                <input type="number" name="km_retour" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="km_parcouru">KM parcouru</label>
                <input type="number" name="km_parcouru" id="km_parcouru" class="form-control" required readonly>
            </div>

            <div class="mb-3">
                <label>Carburant restant</label>
                <input type="number" name="carburant_restant" id="carburant_restant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Carburant consommé</label>
                <input type="number" name="carburant_consomme" class="form-control" required readonly
                    id="carburant_consomme">
            </div>
            {{-- Hidden field to store carburant_initial for JavaScript calculation --}}
            <input type="hidden" id="carburant_initial" value="{{ $deplacement->carburant_initial }}">
            <div class="mb-3">
                <label>Approuvé par</label>
                <select name="approved_by" id="approved_by" class="form-control" required>
                    <option value="">-- Sélectionner utilisateur --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('approved_by') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Enregistrer la fin de mission</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carburantInitialInput = document.getElementById('carburant_initial');
            const carburantRestantInput = document.getElementById('carburant_restant');
            const carburantConsommeInput = document.getElementById('carburant_consomme');

            // Function to calculate fuel consumed
            function calculateFuelConsumed() {
                const carburantInitial = parseFloat(carburantInitialInput.value) || 0;
                const carburantRestant = parseFloat(carburantRestantInput.value) || 0;
                const carburantConsomme = carburantInitial - carburantRestant;
                carburantConsommeInput.value = carburantConsomme.toFixed(0);
            }

            // Calculate when carburant_restant changes
            carburantRestantInput.addEventListener('change', calculateFuelConsumed);
            carburantRestantInput.addEventListener('input', calculateFuelConsumed);

            // Calculate KM parcouru
            const kmDepart = {{ $deplacement->km_depart }};
            const kmRetourInput = document.querySelector('input[name="km_retour"]');
            const kmParcouruInput = document.getElementById('km_parcouru');
            kmRetourInput.addEventListener('change', function() {
                const kmRetour = parseFloat(kmRetourInput.value) || 0;
                const kmParcouru = kmRetour - kmDepart;
                kmParcouruInput.value = kmParcouru.toFixed(2);
            });
        });
    </script>
@endsection
