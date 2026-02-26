@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le véhicule</h2>
    <form action="{{ route('vehicules.update', $vehicule->id) }}" method="POST">
        @method('PUT')
        @include('vehicules._form')
    </form>
</div>
@endsection