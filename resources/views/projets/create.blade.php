@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un projet</h1>
    <form action="{{ route('projets.store') }}" method="POST">
        @include('projets._form')
    </form>
</div>
@endsection