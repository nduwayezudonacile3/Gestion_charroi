@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Déplacement</h1>
    <a href="{{ route('deplacements.index') }}" class="btn btn-secondary mb-3">Retour</a>

    <table class="table table-striped">
        <tr><th>ID</th><td>{{ $deplacement->id }}</td></tr>
        <tr><th>Code</th><td>{{ $deplacement->code_deplacement }}</td></tr>
        <tr><th>Date départ</th><td>{{ $deplacement->date_depart }}</td></tr>
        <tr><th>Date prévue</th><td>{{ $deplacement->date_prevus }}</td></tr>
        <tr><th>Date retour</th><td>{{ $deplacement->date_retour }}</td></tr>
        <tr><th>Litinéraire</th><td>{{ $deplacement->litineraire }}</td></tr>
        <tr><th>Km départ</th><td>{{ $deplacement->km_depart }}</td></tr>
        <tr><th>Km retour</th><td>{{ $deplacement->km_retour }}</td></tr>
        <tr><th>Km parcourus</th><td>{{ $deplacement->km_parcourus }}</td></tr>
        <tr><th>Carburant initial</th><td>{{ $deplacement->carburant_initial }}</td></tr>
        <tr><th>Carburant restant</th><td>{{ $deplacement->carburant_restant }}</td></tr>
        <tr><th>Carburant consommé</th><td>{{ $deplacement->carburant_consomme }}</td></tr>
        <tr><th>Motif</th><td>{{ $deplacement->motif }}</td></tr>
        <tr><th>Frais mission</th><td>{{ $deplacement->frais_mission }}</td></tr>
        <tr><th>Statut</th><td>{{ $deplacement->statut }}</td></tr>
        <tr><th>Utilisateur</th><td>{{ $deplacement->user->name ?? '' }}</td></tr>
        <tr><th>Véhicule</th><td>{{ $deplacement->vehicule->name ?? '' }}</td></tr>
        <tr><th>Projet</th><td>{{ $deplacement->projet->name ?? '' }}</td></tr>
        <tr><th>Approved by</th><td>{{ $deplacement->approved_by }}</td></tr>
        <tr><th>Description</th><td>{{ $deplacement->description }}</td></tr>
        <tr><th>Créé le</th><td>{{ $deplacement->created_at }}</td></tr>
    </table>
</div>
@endsection