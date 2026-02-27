@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un utilisateur</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @include('users._form')
    </form>
</div>
@endsection