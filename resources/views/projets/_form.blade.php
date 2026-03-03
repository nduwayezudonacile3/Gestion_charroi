@csrf

<div class="mb-3">
    <label for="code_projet" class="form-label">Code projet</label>
    <input type="text" name="code_projet" class="form-control"
        value="{{ old('code_projet', $projet->code_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nom_projet" class="form-label">Nom projet</label>
    <input type="text" name="nom_projet" class="form-control"
        value="{{ old('nom_projet', $projet->nom_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="delais_projet" class="form-label">Delais projet</label>
    <input type="text" name="delais_projet" class="form-control"
        value="{{ old('delais_projet', $projet->delais_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="budget" class="form-label">Budget</label>
    <input type="number" step="0.01" name="budget" class="form-control"
        value="{{ old('budget', $projet->budget ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="statut" class="form-label">Statut</label>
    <input type="text" name="statut" class="form-control" value="{{ old('statut', $projet->statut ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $projet->description ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($projet) ? 'Mettre à jour' : 'Enregistrer' }}
</button>
