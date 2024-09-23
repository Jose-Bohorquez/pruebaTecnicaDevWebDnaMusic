<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Notification;
use App\Mail\TaskNotificationMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Ordenar por fecha límite
        if ($request->filled('sort')) {
            $query->orderBy('due_date', $request->input('sort') === 'asc' ? 'asc' : 'desc');
        }

        $tasks = $query->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create'); // No necesitas verificar autenticación aquí, ya que se hace en store.
    }

    public function store(Request $request)
    {
        // Verifica si el usuario está autenticado
        if (!auth()->check()) {
            \Log::info('Usuario no autenticado');
            return redirect()->route('login')->withErrors(['error' => 'Debes estar autenticado para crear una tarea.']);
        }
    
        // Validar la entrada
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en progreso,completada',
            'due_date' => 'required|date|after:today',
        ]);
    
        // Crear la tarea
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'due_date' => $validated['due_date'],
            'user_id' => auth()->id(),
        ]);
    
        // Enviar notificación usando Notification
        try {
            \Log::info('Intentando enviar notificación a: ' . auth()->user()->email);
            Notification::send(auth()->user(), new TaskNotification($task));
            \Log::info('Notificación enviada exitosamente');
        } catch (\Exception $e) {
            \Log::error('Error al enviar la notificación: ' . $e->getMessage());
        }
    
        \Log::info('Tarea creada: ', $task->toArray());
        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
    }
    
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
        ]);
    
        $task = Task::findOrFail($id);
        $task->update($validated);

        // Notificar al usuario si es necesario
        Notification::send(auth()->user(), new TaskNotification($task));

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        // Notificar al usuario si es necesario
        Notification::send(auth()->user(), new TaskNotification($task));

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con éxito.');
    }
}
