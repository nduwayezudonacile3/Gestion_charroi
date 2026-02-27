@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Déplacement</h1>
    <form action="{{ route('deplacements.update', $deplacement) }}" method="POST">
        @method('PUT')
        @include('deplacements._form')
    </form>
</div>
@endsection