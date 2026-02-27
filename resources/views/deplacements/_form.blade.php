@csrf

<div class="mb-3">
    <label class="form-label">Code Déplacement</label>
    <input type="text" name="code_deplacement" class="form-control" value="{{ old('code_deplacement', $deplacement->code_deplacement ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Date départ</label>
    <input type="datetime-local" name="date_depart" class="form-control" value="{{ old('date_depart', isset($deplacement) ? $deplacement->date_depart->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Date prévue</label>
    <input type="datetime-local" name="date_prevus" class="form-control" value="{{ old('date_prevus', isset($deplacement) ? $deplacement->date_prevus?->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Date retour</label>
    <input type="datetime-local" name="date_retour" class="form-control" value="{{ old('date_retour', isset($deplacement) ? $deplacement->date_retour?->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Litinéraire</label>
    <input type="text" name="litineraire" class="form-control" value="{{ old('litineraire', $deplacement->litineraire ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Km départ</label>
    <input type="number" name="km_depart" class="form-control" value="{{ old('km_depart', $deplacement->km_depart ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Km retour</label>
    <input type="number" name="km_retour" class="form-control" value="{{ old('km_retour', $deplacement->km_retour ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Km parcourus</label>
    <input type="number" class="form-control" value="{{ $deplacement->km_parcourus ?? 0 }}" readonly>
</div>

<div class="mb-3">
    <label class="form-label">Carburant initial</label>
    <input type="number" name="carburant_initial" class="form-control" value="{{ old('carburant_initial', $deplacement->carburant_initial ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Carburant restant</label>
    <input type="number" name="carburant_restant" class="form-control" value="{{ old('carburant_restant', $deplacement->carburant_restant ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Carburant consommé</label>
    <input type="number" class="form-control" value="{{ $deplacement->carburant_consomme ?? 0 }}" readonly>
</div>

<div class="mb-3">
    <label class="form-label">Motif</label>
    <input type="text" name="motif" class="form-control" value="{{ old('motif', $deplacement->motif ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Frais mission</label>
    <input type="number" step="0.01" name="frais_mission" class="form-control" value="{{ old('frais_mission', $deplacement->frais_mission ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Statut</label>
    <select name="statut" class="form-select">
        @foreach(['En attente','En cours','Terminé','Confirmé'] as $status)
            <option value="{{ $status }}" {{ old('statut', $deplacement->statut ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Utilisateur</label>
    <select name="user_id" class="form-select">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $deplacement->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Véhicule</label>
    <select name="vehicule_id" class="form-select">
        @foreach($vehicules as $vehicule)
            <option value="{{ $vehicule->id }}" {{ old('vehicule_id', $deplacement->vehicule_id ?? '') == $vehicule->id ? 'selected' : '' }}>{{ $vehicule->name ?? $vehicule->id }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Projet</label>
    <select name="projet_id" class="form-select">
        @foreach($projets as $projet)
            <option value="{{ $projet->id }}" {{ old('projet_id', $deplacement->projet_id ?? '') == $projet->id ? 'selected' : '' }}>{{ $projet->name ?? $projet->id }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Approved by</label>
    <input type="number" name="approved_by" class="form-control" value="{{ old('approved_by', $deplacement->approved_by ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $deplacement->description ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Enregistrer</button>