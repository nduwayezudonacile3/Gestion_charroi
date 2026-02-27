@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nom</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="username" class="form-label">Nom d'utilisateur</label>
    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username ?? '') }}">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control">
    @if(isset($user))
        <small class="text-muted">Laissez vide pour conserver le mot de passe actuel</small>
    @endif
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rôle</label>
    <input type="text" name="role" class="form-control" value="{{ old('role', $user->role ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $user->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="statut" class="form-label">Statut</label>
    <select name="statut" class="form-control">
        <option value="active" {{ (old('statut', $user->statut ?? '') == 'active') ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ (old('statut', $user->statut ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">Enregistrer</button>