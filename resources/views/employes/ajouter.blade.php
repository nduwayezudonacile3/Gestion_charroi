<!-- resources/views/employes/ajouter.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Employé
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('employes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block mb-1">Nom</label>
                        <input type="text" name="nom" class="form-control w-full" value="{{ old('nom') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Prénom</label>
                        <input type="text" name="prenom" class="form-control w-full" value="{{ old('prenom') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Téléphone</label>
                        <input type="text" name="telephone" class="form-control w-full" value="{{ old('telephone') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Résidence</label>
                        <input type="text" name="residence" class="form-control w-full" value="{{ old('residence') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Fonction</label>
                        <input type="text" name="fonction" class="form-control w-full" value="{{ old('fonction') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Description</label>
                        <textarea name="description" class="form-control w-full">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Enregistrer</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>