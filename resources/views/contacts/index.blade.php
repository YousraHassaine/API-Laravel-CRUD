@extends('layouts.app')

@section('content')
    <h1>Liste des Contacts</h1>
    <br>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Ajouter un Contact</a>

    <br>
    <br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (empty($contacts))
        <p>Aucun contact trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact['name'] }}</td>
                        <td>{{ $contact['phone'] }}</td>
                        <td>{{ $contact['email'] }}</td>
                        <td>
                            <!-- Bouton pour modifier le contact -->
                            <a href="{{ route('contacts.edit', $contact['id']) }}" class="btn btn-success">Edit</a>

                            <!-- Bouton pour supprimer le contact -->
                            <form action="{{ route('contacts.destroy', $contact['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
