<!-- resources/views/employes/liste.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Employés
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('employes.ajouter') }}" class="btn btn-primary mb-3">Ajouter un Employé</a>

                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Prénom</th>
                            <th class="border px-4 py-2">Téléphone</th>
                            <th class="border px-4 py-2">Résidence</th>
                            <th class="border px-4 py-2">Fonction</th>
                            <th class="border px-4 py-2">Description</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employes as $employe)
                        <tr>
                            <td class="border px-4 py-2">{{ $employe->id }}</td>
                            <td class="border px-4 py-2">{{ $employe->nom }}</td>
                            <td class="border px-4 py-2">{{ $employe->prenom }}</td>
                            <td class="border px-4 py-2">{{ $employe->telephone }}</td>
                            <td class="border px-4 py-2">{{ $employe->residence }}</td>
                            <td class="border px-4 py-2">{{ $employe->fonction }}</td>
                            <td class="border px-4 py-2">{{ $employe->description }}</td>
                          <td class="border px-4 py-2 space-x-2">
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning">Modifier</a>

        <form action="{{ route('employes.delete', $employe->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?')">Supprimer</button>
        </form>
    @endif
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>