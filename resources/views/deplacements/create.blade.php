@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un Déplacement</h1>
    <form action="{{ route('deplacements.store') }}" method="POST">
        @include('deplacements._form')
    </form>
</div>
@endsection