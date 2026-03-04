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
            <p><strong>Litineraire :</strong> {{ $deplacement->litineraire }}</p>
            <p><strong>Date départ :</strong>
                {{ $deplacement->date_depart ? \Carbon\Carbon::parse($deplacement->date_depart)->format('d/m/Y H:i') : '' }}
            </p>
            <p><strong>Date prévue :</strong>
                {{ $deplacement->date_prevus ? \Carbon\Carbon::parse($deplacement->date_prevus)->format('d/m/Y H:i') : '' }}
            </p>
            <p><strong>KM départ :</strong> {{ $deplacement->km_depart }}</p>
            <p><strong>Carburant initial :</strong> {{ $deplacement->carburant_initial }}</p>
            <p><strong>Motif :</strong> {{ $deplacement->motif }}</p>
            <p><strong>Frais mission :</strong> {{ number_format($deplacement->frais_mission ?? 0, 2) }} €</p>
        </div>

        {{-- Formulaire pour terminer la mission --}}
        <form action="{{ route('deplacements.storeTerminer', $deplacement->id) }}" method="POST">
            @csrf
            {{-- Si tu veux utiliser update() au lieu d'une route dédiée, ajoute : --}}
            @method('PUT')

            <div class="mb-3">
                <label for="date_retour" class="form-label">Date retour</label>
                <input type="date" name="date_retour" class="form-control" value="{{ old('date_retour') }}" required>
            </div>

            <div class="mb-3">
                <label>KM retour</label>
                <input type="number" name="km_retour" id="km_retour" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="km_parcouru">KM parcouru</label>
                <input type="number" name="km_parcouru" id="km_parcouru" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>Carburant restant</label>
                <input type="number" name="carburant_restant" id="carburant_restant" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Carburant consommé</label>
                <input type="number" name="carburant_consomme" id="carburant_consomme" class="form-control" readonly>
            </div>

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
            const kmDepart = {{ $deplacement->km_depart }};
            const kmRetourInput = document.getElementById('km_retour');
            const kmParcouruInput = document.getElementById('km_parcouru');

            const carburantInitial = parseFloat(document.getElementById('carburant_initial').value) || 0;
            const carburantRestantInput = document.getElementById('carburant_restant');
            const carburantConsommeInput = document.getElementById('carburant_consomme');


            kmRetourInput.addEventListener('input', function() {
                // si le kmretour n\ KmDepqrt

                const kmRetour = parseFloat(kmRetourInput.value) || 0;
                kmParcouruInput.value = (kmRetour - kmDepart).toFixed(2);
            });

            // Calcul KM parcouru
            kmRetourInput.addEventListener('input', function() {
                const kmRetour = parseFloat(kmRetourInput.value) || 0;
                kmParcouruInput.value = (kmRetour - kmDepart).toFixed(2);
            });

            // Calcul carburant consommé
            carburantRestantInput.addEventListener('input', function() {
                const carburantRestant = parseFloat(carburantRestantInput.value) || 0;
                carburantConsommeInput.value = (carburantInitial - carburantRestant).toFixed(2);
            });
        });
    </script>
@endsection
