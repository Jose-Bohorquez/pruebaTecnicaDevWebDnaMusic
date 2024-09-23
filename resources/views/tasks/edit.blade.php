@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Editar Tarea</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold">Título</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="title" id="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Descripción</label>
            <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="description" id="description" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-semibold">Estado</label>
            <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="status" id="status" required>
                <option value="pendiente" {{ $task->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en progreso" {{ $task->status == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                <option value="completada" {{ $task->status == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="due_date" class="block text-gray-700 font-semibold">Fecha Límite</label>
            <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Actualizar</button>
    </form>
</div>
@endsection
