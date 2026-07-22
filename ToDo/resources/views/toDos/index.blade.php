<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Tareas</h1>

            <!-- Formulario de Búsqueda -->
            <form action="{{ route('toDos.index') }}" method="GET" class="mb-6">
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <input type="text" name="description" placeholder="Buscar por descripción" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                    <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Todas</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="completed" class="block text-sm font-medium text-gray-700">Estado:</label>
                    <select name="completed" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Todas</option>
                        <option value="1">Completadas</option>
                        <option value="0">No Completadas</option>
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Buscar</button>
            </form>

            <!-- Formulario de Nueva Tarea -->
            <form action="{{ route('toDos.store') }}" method="POST" class="flex items-center mb-4">
                @csrf
                <input type="text" name="description" placeholder="Nueva tarea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                <button type="submit" class="ml-4 px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Agregar</button>
            </form>
            <ul class="list-disc pl-5 space-y-2">
                @foreach ($toDos as $toDo)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                    <span>{{ $toDo->description }}</span>
                    <div>
                        <a href="{{ route('toDos.edit', $toDo) }}" class="mr-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Editar</a>
                        <form action="{{ route('toDos.toggle', $toDo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="mr-2 px-4 py-2 {{ $toDo->completed ? 'bg-green-500' : 'bg-gray-500' }} text-white rounded-lg hover:bg-green-600">
                                {{ $toDo->completed ? 'Completado' : 'Pendiente' }}
                            </button>
                        </form>
                        <form action="{{ route('toDos.destroy', $toDo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Eliminar</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
