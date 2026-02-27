@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier Affectation</h2>

    <form action="{{ route('deplacementemployes.update', $deplacementemploye->id) }}" method="POST">
        @method('PUT')
        @include('deplacementemployes._form')
    </form>
</div>
@endsection