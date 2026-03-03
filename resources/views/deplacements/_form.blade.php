<div class="mb-3">
    <label for="code_deplacement" class="form-label">Code déplacement</label>
    <input type="text" class="form-control" value="{{ $deplacement->code_deplacement ?? 'Généré automatiquement' }}"
        readonly>
</div>

<div class="mb-3">
    <label for="date_depart" class="form-label">Date départ</label>
    <input type="datetime-local" name="date_depart" class="form-control"
        value="{{ old('date_depart', isset($deplacement) && $deplacement->date_depart ? date('Y-m-d\TH:i', strtotime($deplacement->date_depart)) : '') }}"
        required>
</div>

<div class="mb-3">
    <label for="date_prevus" class="form-label">Date prévue</label>
    <input type="datetime-local" name="date_prevus" class="form-control"
        value="{{ old('date_prevus', isset($deplacement) && $deplacement->date_prevus ? date('Y-m-d\TH:i', strtotime($deplacement->date_prevus)) : '') }}"
        required>
</div>

<div class="mb-3">
    <label for="litineraire" class="form-label">Itinéraire</label>
    <input type="text" name="litineraire" class="form-control"
        value="{{ old('litineraire', $deplacement->litineraire ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="km_depart" class="form-label">KM départ</label>
    <input type="number" name="km_depart" class="form-control"
        value="{{ old('km_depart', $deplacement->km_depart ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="carburant_initial" class="form-label">Carburant initial</label>
    <input type="number" name="carburant_initial" class="form-control"
        value="{{ old('carburant_initial', $deplacement->carburant_initial ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="motif" class="form-label">Motif</label>
    <input type="text" name="motif" class="form-control" value="{{ old('motif', $deplacement->motif ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label for="frais_mission" class="form-label">Frais mission</label>
    <input type="number" step="0.01" name="frais_mission" class="form-control"
        value="{{ old('frais_mission', $deplacement->frais_mission ?? 0) }}">
</div>

<div class="mb-3">
    <label for="status" class="form-label">Statut</label>
    <select name="status" class="form-control">
        @foreach (['En attente', 'En cours', 'Termine', 'Confirme', 'Cloture'] as $statut)
            <option value="{{ $statut }}"
                {{ old('status', $deplacement->status ?? 'En attente') == $statut ? 'selected' : '' }}>
                {{ $statut }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="user_id" class="form-label">Utilisateur</label>
    <select name="user_id" class="form-control" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}"
                {{ old('user_id', $deplacement->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="vehicule_id" class="form-label">Véhicule</label>
    <select name="vehicule_id" class="form-control" required>
        @foreach ($vehicules as $vehicule)
            <option value="{{ $vehicule->id }}"
                {{ old('vehicule_id', $deplacement->vehicule_id ?? '') == $vehicule->id ? 'selected' : '' }}>
                {{ $vehicule->immatriculation }} ({{ $vehicule->status }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="projet_id" class="form-label">Projet</label>
    <select name="projet_id" class="form-control" required>
        @foreach ($projets as $projet)
            <option value="{{ $projet->id }}"
                {{ old('projet_id', $deplacement->projet_id ?? '') == $projet->id ? 'selected' : '' }}>
                {{ $projet->nom_projet }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="employe_ids" class="form-label">Employés</label>
    <select name="employe_ids[]" class="form-control" multiple required>
        @foreach ($employes as $employe)
            <option value="{{ $employe->id }}"
                {{ collect(old('employe_ids', isset($deplacement) ? $deplacement->employes->pluck('id')->toArray() : []))->contains($employe->id) ? 'selected' : '' }}>
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>
    <small class="form-text text-muted">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs employés</small>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $deplacement->description ?? '') }}</textarea>
</div>
