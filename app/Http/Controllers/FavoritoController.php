<?php

namespace App\Http\Controllers;
use App\Models\Libro;

use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function misFavoritos(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search', ''); // Por defecto vacío

        $favoritos = $user->favoritos()
            ->when($search, function ($query, $search) {
                $query->where('titulo', 'like', "%{$search}%");
            })
            ->get();

        return view('libros.favoritos', compact('favoritos', 'search'));
    }

    public function toggle($libroId)
    {
        $user = auth()->user();

        if ($user->favoritos()->where('libro_id', $libroId)->exists()) {
            $user->favoritos()->detach($libroId);
            return back()->with('success', 'Libro eliminado de favoritos.');
        } else {
            $user->favoritos()->attach($libroId);
            return back()->with('success', 'Libro añadido a favoritos.');
        }
    }

}