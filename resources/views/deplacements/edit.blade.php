@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier le déplacement #{{ $deplacement->id }}</h2>

        {{-- Messages d’erreur --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('deplacements.update', $deplacement->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Inclure le formulaire réutilisable --}}
            @include('deplacements._form')

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('deplacements.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
