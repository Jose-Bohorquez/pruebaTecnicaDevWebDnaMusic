@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Tareas</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Crear Nueva Tarea</a>
    </div>

    <!-- Formulario de filtro -->
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-4 flex items-center">
        <select name="status" class="border border-gray-300 rounded-md p-2 mr-2">
            <option value="">Todos los estados</option>
            <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en progreso" {{ request('status') == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
            <option value="completada" {{ request('status') == 'completada' ? 'selected' : '' }}>Completada</option>
        </select>
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Filtrar</button>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-600">
                    <th class="py-2 px-4 border-b">Título</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                    <th class="py-2 px-4 border-b">Fecha Límite</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $task->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->description }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->status }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->due_date }}</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Editar</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No hay tareas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
