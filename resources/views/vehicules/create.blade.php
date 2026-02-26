@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un véhicule</h2>
    <form action="{{ route('vehicules.store') }}" method="POST">
        @include('vehicules._form')
    </form>
</div>
@endsection