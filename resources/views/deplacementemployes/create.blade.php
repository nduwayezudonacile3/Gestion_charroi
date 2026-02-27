@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nouvelle Affectation</h2>

    <form action="{{ route('deplacementemployes.store') }}" method="POST">
        @include('deplacementemployes._form')
    </form>
</div>
@endsection