<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

// Rutas de la API para las notas
Route::apiResource('notes', NoteController::class);
