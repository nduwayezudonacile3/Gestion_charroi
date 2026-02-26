@extends('layouts.app')

@section('content')
<h1 class="mb-4">Bienvenue sur le Dashboard</h1>

<div class="row g-4">

    @php
        $colors = ['primary', 'success', 'warning', 'danger', 'secondary'];
        $labels = ['Employés','Véhicules','Projets','Déplacements','Users'];
        $values = [$stats['employes'],$stats['vehicules'],$stats['projets'],$stats['deplacements'],$stats['users']];
        $icons = ['Employés' => 'people', 'Véhicules' => 'truck', 'Projets' => 'folder2', 'Déplacements' => 'geo-alt', 'Users' => 'person-circle'];
    @endphp

    @foreach($labels as $index => $label)
    <div class="col-md">
        <div class="card text-white bg-{{ $colors[$index] }}">
            <div class="card-body text-center">
                <i class="bi bi-{{ $icons[$label] }} fs-2 mb-2"></i>
                <h5 class="card-title">{{ $label }}</h5>
                <p class="card-text fs-4">{{ $values[$index] }}</p>
            </div>
        </div>
    </div>
    @endforeach

</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6 class="card-title mb-3">Répartition générale</h6>
            <canvas id="statsChart" height="200"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6 class="card-title mb-3">Projets par statut</h6>
            <canvas id="projetsChart" height="200"></canvas>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Derniers employés ajoutés</h6>
                <ul class="list-group list-group-flush">
                    @foreach($dernierEmployes as $employe)
                        <li class="list-group-item">{{ $employe->nom }} {{ $employe->prenom }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Projets récents</h6>
                <ul class="list-group list-group-flush">
                    @foreach($dernierProjets as $projet)
                        <li class="list-group-item">{{ $projet->nom_projet }} - {{ $projet->statut }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('statsChart').getContext('2d');
    const statsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nombre total',
                data: {!! json_encode($values) !!},
                backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545','#6c757d']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false }, title: { display: false } } }
    });

    const projetsData = @json($projetsStatuts);
    const projetsLabels = Object.keys(projetsData);
    const projetsValues = Object.values(projetsData);

    const ctx2 = document.getElementById('projetsChart').getContext('2d');
    const projetsChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: projetsLabels,
            datasets: [{
                label: 'Projets par statut',
                data: projetsValues,
                backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545','#6c757d']
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection