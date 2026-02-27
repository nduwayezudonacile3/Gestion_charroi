@csrf

<div class="mb-3">
    <label>Employé</label>
    <select name="employe_id" class="form-control">
        <option value="">-- Sélectionner --</option>
        @foreach($employes as $employe)
            <option value="{{ $employe->id }}"
                {{ old('employe_id', $deplacementemploye->employe_id ?? '') == $employe->id ? 'selected' : '' }}>
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Déplacement</label>
    <select name="deplacement_id" class="form-control">
        <option value="">-- Sélectionner --</option>
        @foreach($deplacements as $deplacement)
            <option value="{{ $deplacement->id }}"
                {{ old('deplacement_id', $deplacementemploye->deplacement_id ?? '') == $deplacement->id ? 'selected' : '' }}>
                {{ $deplacement->titre ?? 'Déplacement '.$deplacement->id }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($deplacementemploye) ? 'Modifier' : 'Enregistrer' }}
</button>

<a href="{{ route('deplacementemployes.index') }}" class="btn btn-secondary">
    Annuler
</a>