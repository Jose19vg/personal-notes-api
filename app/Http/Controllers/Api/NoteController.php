<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        // Mostrar todas las notas
        return response()->json(Note::all(), 200);
    }

    public function store(Request $request)
    {
        // Validación (opcional)
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date_time' => 'required|date',
            'body' => 'required|string',
            'classification' => 'required|string',
        ]);

        // Crear nueva nota
        $note = Note::create($request->all());

        // Devolver respuesta
        return response()->json($note, 201);
    }

    public function show($id)
    {
        // Mostrar una nota específica
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        return response()->json($note, 200);
    }

    public function update(Request $request, $id)
    {
        // Buscar nota por ID
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        // Validación (opcional)
        $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'date_time' => 'date',
            'body' => 'string',
            'classification' => 'string',
        ]);

        // Actualizar nota
        $note->update($request->all());

        // Devolver respuesta
        return response()->json($note, 200);
    }

    public function destroy($id)
    {
        // Buscar y eliminar nota
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Nota eliminada'], 204);
    }
}
