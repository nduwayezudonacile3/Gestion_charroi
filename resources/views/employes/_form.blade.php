@csrf

<div class="mb-3">
    <label>Nom</label>
    <input type="text" name="nom" class="form-control" 
        value="{{ old('nom', $employe->nom ?? '') }}">
</div>

<div class="mb-3">
    <label>Prénom</label>
    <input type="text" name="prenom" class="form-control" 
        value="{{ old('prenom', $employe->prenom ?? '') }}">
</div>

<div class="mb-3">
    <label>Téléphone</label>
    <input type="text" name="telephone" class="form-control" 
        value="{{ old('telephone', $employe->telephone ?? '') }}">
</div>

<div class="mb-3">
    <label>Résidence</label>
    <input type="text" name="residence" class="form-control" 
        value="{{ old('residence', $employe->residence ?? '') }}">
</div>

<div class="mb-3">
    <label>Fonction</label>
    <input type="text" name="fonction" class="form-control" 
        value="{{ old('fonction', $employe->fonction ?? '') }}">
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">
        {{ old('description', $employe->description ?? '') }}
    </textarea>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($employe) ? 'Modifier' : 'Enregistrer' }}
</button>

<a href="{{ route('employes.index') }}" class="btn btn-secondary">
    Annuler
</a>