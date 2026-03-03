@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>
            {{ isset($deplacement) && $deplacement->status == 'En cours' ? 'Enregistrer la fin de mission' : 'Créer un nouveau déplacement' }}
        </h2>

        {{-- Messages succès / erreur --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Affichage erreurs de validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire départ ou fin de mission --}}
        <form
            action="{{ isset($deplacement) && $deplacement->status == 'En cours' ? route('deplacements.storeFin', $deplacement->id) : route('deplacements.store') }}"
            method="POST">
            @csrf
            @if (isset($deplacement) && $deplacement->status == 'En cours')
                @method('PUT') {{-- si tu utilises update pour la fin --}}
            @endif

            {{-- ===================== DEPART ===================== --}}
            @if (!isset($deplacement) || $deplacement->status != 'En cours')
                {{-- Employés --}}
                <div class="mb-3">
                    <label class="mb-2">Employés</label>
                    <select name="employe_ids[]" class="form-control" multiple required>
                        @foreach ($employes as $employe)
                            <option value="{{ $employe->id }}"
                                {{ collect(old('employe_ids', []))->contains($employe->id) || (isset($deplacement) && $deplacement->employes->contains($employe->id)) ? 'selected' : '' }}>
                                {{ $employe->nom }} {{ $employe->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs employés</small>
                </div>

                {{-- Projet --}}
                <div class="mb-3">
                    <label>Projet</label>
                    <select name="projet_id" class="form-control" required>
                        <option value="">-- Sélectionner projet --</option>
                        @foreach ($projets as $projet)
                            <option value="{{ $projet->id }}" {{ old('projet_id') == $projet->id ? 'selected' : '' }}>
                                {{ $projet->nom_projet }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Véhicule --}}
                <div class="mb-3">
                    <label>Véhicule (optionnel)</label>
                    <select name="vehicule_id" class="form-control">
                        <option value="">-- Aucun véhicule --</option>
                        @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}"
                                {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                {{ $vehicule->immatriculation }} ({{ $vehicule->status }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Itinéraire --}}
                <div class="mb-3">
                    <label>Itinéraire</label>
                    <input type="text" name="litineraire" class="form-control" value="{{ old('litineraire') }}"
                        required>
                </div>

                {{-- Date départ --}}
                <div class="mb-3">
                    <label>Date départ</label>
                    <input type="datetime-local" name="date_depart" class="form-control" value="{{ old('date_depart') }}"
                        required>
                </div>

                {{-- Date prévue --}}
                <div class="mb-3">
                    <label>Date prévue</label>
                    <input type="datetime-local" name="date_prevus" class="form-control" value="{{ old('date_prevus') }}"
                        required>
                </div>

                {{-- KM départ --}}
                <div class="mb-3">
                    <label>KM départ</label>
                    <input type="number" name="km_depart" class="form-control" value="{{ old('km_depart', 0) }}" required>
                </div>

                {{-- Carburant initial --}}
                <div class="mb-3">
                    <label>Carburant initial</label>
                    <input type="number" name="carburant_initial" class="form-control"
                        value="{{ old('carburant_initial', 0) }}" required>
                </div>

                {{-- Motif --}}
                <div class="mb-3">
                    <label>Motif</label>
                    <input type="text" name="motif" class="form-control" value="{{ old('motif') }}">
                </div>

                {{-- Frais mission --}}
                <div class="mb-3">
                    <label>Frais mission</label>
                    <input type="number" step="0.01" name="frais_mission" class="form-control"
                        value="{{ old('frais_mission') }}">
                </div>
            @endif

            {{-- ===================== FIN DE MISSION ===================== --}}
            @if (isset($deplacement) && $deplacement->status == 'En cours')
                {{-- Date retour --}}
                <div class="mb-3">
                    <label>Date retour</label>
                    <input type="datetime-local" name="date_retour" class="form-control" value="{{ old('date_retour') }}"
                        required>
                </div>

                {{-- KM retour --}}
                <div class="mb-3">
                    <label>KM retour</label>
                    <input type="number" name="km_retour" class="form-control" value="{{ old('km_retour', 0) }}" required>
                </div>

                {{-- Carburant restant --}}
                <div class="mb-3">
                    <label>Carburant restant</label>
                    <input type="number" name="carburant_restant" class="form-control"
                        value="{{ old('carburant_restant', 0) }}" required>
                </div>

                {{-- Carburant consommé --}}
                <div class="mb-3">
                    <label>Carburant consommé</label>
                    <input type="number" name="carburant_consomme" class="form-control"
                        value="{{ old('carburant_consomme', 0) }}" readonly>
                </div>

                {{-- Approved by --}}
                <div class="mb-3">
                    <label>Approuvé par</label>
                    <input type="text" name="approved_by" class="form-control" value="{{ old('approved_by') }}">
                </div>
            @endif

            {{-- Bouton --}}
            <button type="submit" class="btn btn-success">
                {{ isset($deplacement) && $deplacement->status == 'En cours' ? 'Enregistrer fin mission' : 'Enregistrer le départ' }}
            </button>

            <a href="{{ route('deplacements.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
