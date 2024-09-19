@extends('layouts.app')

@section('title', 'Ajouter un Contact')

@section('content')
    <h1>Ajouter un Nouveau Contact</h1>
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter le Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
@endsection
