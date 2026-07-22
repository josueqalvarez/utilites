<x-app-layout>
    <div class="container max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Nueva Categoría</h1>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
