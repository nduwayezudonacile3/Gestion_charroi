@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le projet</h1>
    <form action="{{ route('projets.update', $projet->id) }}" method="POST">
        @method('PUT')
        @include('projets._form')
    </form>
</div>
@endsection