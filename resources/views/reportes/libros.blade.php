
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Libros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; text-align: left; }
        th { background-color: #4A5568; color: #fff; }
    </style>
</head>
<body>
    <h2>Reporte de Libros</h2>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Descripción</th> <!-- 🔹 Nueva columna -->
                 <th>Categoría</th>
                 <th>Cantidad</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $libro->titulo }}</td>
                <td>{{ $libro->autor }}</td>
                <td>{{ $libro->descripcion }}</td> <!-- 🔹 -->
                <td>{{ $libro->categoria }}</td>
                <td>{{ $libro->cantidad }}</td> 

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
