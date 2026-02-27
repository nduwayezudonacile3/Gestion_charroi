@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Employé</h2>

    <form action="{{ route('employes.store') }}" method="POST">
        @include('employes._form')
    </form>
</div>
@endsection