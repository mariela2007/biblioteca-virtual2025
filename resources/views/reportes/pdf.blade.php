<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Libros por Categoría</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Libros</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th>Cantidad</th> 

            </tr>
        </thead>
        <tbody>
            @foreach($libros as $index => $libro)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
<td>
{{
    [
        'enciclopedia' => 'Enciclopedia',
        'escritores'   => 'Escritores',
        'comic'        => 'Historietas',
        'gramatica'    => 'Lenguaje',
        'fisica'       => 'Ciencia',
        'arte'         => 'Arte',
    ][strtolower(trim($libro->categoria?->nombre ?? $libro->categoria))] ?? 'Sin categoría'
}}
</td>

                    <td>{{ $libro->cantidad }}</td> 

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
