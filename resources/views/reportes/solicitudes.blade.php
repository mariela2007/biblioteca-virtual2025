<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Solicitudes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>📘 Reporte de Solicitudes</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Libro</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $i => $solicitud)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $solicitud->libro->titulo ?? 'N/A' }}</td>
                    <td>{{ $solicitud->user->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($solicitud->estado) }}</td>
                    <td>{{ $solicitud->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
