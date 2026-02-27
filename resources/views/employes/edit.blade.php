@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier Employé</h2>

    <form action="{{ route('employes.update', $employe->id) }}" method="POST">
        @method('PUT')
        @include('employes._form')
    </form>
</div>
@endsection