@csrf

<div class="mb-3">
    <label for="code_projet" class="form-label">Code projet</label>
    <input type="text" name="code_projet" class="form-control" value="{{ old('code_projet', $projet->code_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nom_projet" class="form-label">Nom projet</label>
    <input type="text" name="nom_projet" class="form-control" value="{{ old('nom_projet', $projet->nom_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="delais_projet" class="form-label">Delais projet</label>
    <input type="text" name="delais_projet" class="form-control" value="{{ old('delais_projet', $projet->delais_projet ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="budget" class="form-label">Budget</label>
    <input type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget', $projet->budget ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="statut" class="form-label">Statut</label>
    <input type="number" step="0.01" name="statut" class="form-control" value="{{ old('statut', $projet->statut ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $projet->description ?? '') }}</textarea>
</div>
 
<td>
        <div class="dropdown">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionMenu{{ $projet->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            &#x22EE; <!-- ⋮ trois points verticaux -->
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $projet->id }}">
            <li>
                <a class="dropdown-item" href="{{ route('projets.edit', $projet->id) }}">Modifier</a>
            </li>
            <li>
                <form action="{{ route('projets.destroy', $projet->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce projet ?');">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger" type="submit">Supprimer</button>
                </form>
            </li>
        </ul>
    </div>
</td>