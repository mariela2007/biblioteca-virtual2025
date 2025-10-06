<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Materiales</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Reporte de Materiales</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->titulo }}</td>
                    <td>{{ $material->descripcion }}</td>
                    <td>{{ $material->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
