<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class ChatBotController extends Controller
{
    public function responder(Request $request)
    {
        try {
            $mensaje = trim(strtolower($request->mensaje ?? ''));

            if (!$mensaje) {
                return response()->json([
                    'type' => 'text',
                    'respuesta' => 'No recibí ningún mensaje.'
                ]);
            }

            // Map de categorías base -> nombre visual
            $mapaCategorias = [
                'enciclopedia' => 'Enciclopedia',
                'escritores'   => 'Escritores',
                'comic'        => 'Historietas',
                'gramatica'    => 'Lenguaje',
                'fisica'       => 'Ciencia',
                'arte'         => 'Arte'
            ];

            // (Opcional) Map de imágenes por categoría
            $mapaImagenes = [
                'enciclopedia' => 'enciclopedia.jpg',
                'escritores'   => 'escritores.jpg',
                'comic'        => 'comic.jpg',
                'gramatica'    => 'lenguaje.jpg',
                'fisica'       => 'ciencia.jpg',
                'arte'         => 'arte.jpg',
            ];

            // ✅ Si el mensaje contiene "categoría" o "categorias"
            if (str_contains($mensaje, 'categoría') || str_contains($mensaje, 'categorias')) {

                $categorias = Libro::select('categoria')
                    ->distinct()
                    ->pluck('categoria')
                    ->filter()
                    ->values();

                if ($categorias->isEmpty()) {
                    return response()->json([
                        'type' => 'text',
                        'respuesta' => 'No hay categorías disponibles.'
                    ]);
                }

                return response()->json([
                    'type' => 'list',
                    'respuesta' => 'Estas son las categorías disponibles:',
                    'libros' => $categorias->map(function($c) use ($mapaCategorias, $mapaImagenes) {
                        return [
                            'id' => 0,
                            'titulo' => $mapaCategorias[$c] ?? ucfirst($c),
                            'autor' => '',
                            'imagen' =>asset('imagenes/'.$c.'.png'),
                            'cantidad' => '',
                            'url' => route('categoria.mostrar', $c)
                        ];
                    })
                ]);
            }

            // ✅ Buscar libros por título o autor
            $libros = Libro::query()
                ->where('titulo', 'like', "%{$mensaje}%")
                ->orWhere('autor', 'like', "%{$mensaje}%")
                ->take(20)
                ->get()
                ->map(function($l){
                    return [
                        'id' => $l->id,
                        'titulo' => $l->titulo,
                        'autor' => $l->autor,
                        'imagen' => $l->imagen
                            ? asset('imagenes/' . $l->imagen)
                            : asset('imagenes/default-book.png'),
                        'cantidad' => $l->cantidad,
                        'url' => route('libros.show', $l->id)
                    ];
                });

            if ($libros->isEmpty()) {
                return response()->json([
                    'type' => 'text',
                    'respuesta' => 'No encontré libros con esa búsqueda.'
                ]);
            }

            return response()->json([
                'type' => 'list',
                'respuesta' => 'Encontré estos libros:',
                'libros' => $libros
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'text',
                'respuesta' => 'Ocurrió un error: ' . $e->getMessage()
            ], 500);
        }
    }
}
