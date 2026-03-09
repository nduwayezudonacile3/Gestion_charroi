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
    <label for="date_debut" class="form-label">Date debut</label>
    <input type="datetime-local" name="date_debut" class="form-control"
        value="{{ old('date_debut', $projet->date_debut ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="date_cloture" class="form-label">Date cloture</label>
    <input type="datetime-local" name="date_cloture" class="form-control"
        value="{{ old('date_cloture', $projet->date_debut ?? '') }}" required>

</div>

<div class="mb-3">
    <label for="statut" class="form-label">Statut</label>
    <span class="badge bg-{{ $projet->statut_color ?? 'secondary' }}">
        {{ $projet->statut_text ?? 'N/A' }}
    </span>
</div>
<label for="description" class="form-label">Description</label>
<textarea name="description" class="form-control">{{ old('description', $projet->description ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($projet) ? 'Mettre à jour' : 'Enregistrer' }}
</button>
