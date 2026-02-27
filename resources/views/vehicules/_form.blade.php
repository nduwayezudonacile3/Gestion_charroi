@csrf
<div class="mb-3">
    <label for="immatriculation" class="form-label">Immatriculation</label>
    <input type="text" name="immatriculation" class="form-control" value="{{ old('immatriculation', $vehicule->immatriculation ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="categorie" class="form-label">Catégorie</label>
    <input type="text" name="categorie" class="form-control" value="{{ old('categorie', $vehicule->categorie ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="marque" class="form-label">Marque</label>
    <input type="text" name="marque" class="form-control" value="{{ old('marque', $vehicule->marque ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Statut</label>
    <select name="status" class="form-control" required>
        @php
            $statuses = ['disponible', 'indisponible', 'au service', 'maintenance'];
        @endphp
        @foreach($statuses as $status)
            <option value="{{ $status }}" {{ (old('status', $vehicule->status ?? '') == $status) ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $vehicule->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="annee_fabrication" class="form-label">Année de fabrication</label>
    <input type="text" name="annee_fabrication" class="form-control" value="{{ old('annee_fabrication', $vehicule->annee_fabrication ?? '') }}" required>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($vehicule) ? 'Modifier' : 'Enregistrer' }}
</button>

<a href="{{ route('vehicules.index') }}" class="btn btn-secondary">
    Annuler
</a>