<x-app-layout>
    <div class="container max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Categorías</h1>
            <div class="my-4 px-3.5 py-2.5 ">
                <a href="{{ route('categories.create') }}" class="rounded-lg bg-gray-700 px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-gray-600">Nueva Categoría</a>
            </div>
            <ul class="list-disc pl-5 space-y-2">
                @foreach ($categories as $category)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                    <a href="{{ route('categories.edit', $category) }}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
