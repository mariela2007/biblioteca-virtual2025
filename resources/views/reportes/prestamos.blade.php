<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Préstamos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { 
            text-align: center; 
            margin-bottom: 20px; 
            color: #2d3748; 
            font-size: 20px;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 13px; }
        th { background-color: #4A5568; color: #fff; text-align: center; }

        /* Estados visuales */
        .devuelto { background-color: #ffffffff; }    /* verde claro */
        .en-prestamo { background-color: #ffffffff; } /* amarillo claro */

        /* Centrar número y fechas */
        td:nth-child(1),
        td:nth-child(7),
        td:nth-child(8) {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Reporte de Préstamos</h2>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Libro</th>
                <th>Alumno</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Turno</th>
                <th>Fecha de préstamo</th>
                <th>Fecha de devolución</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
            <tr class="{{ $prestamo->devuelto == 1 ? 'devuelto' : 'en-prestamo' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $prestamo->libro->titulo ?? 'Desconocido' }}</td>
                <td>{{ $prestamo->nombre_alumno }} {{ $prestamo->apellido_alumno }}</td>
                <td>{{ $prestamo->grado }}</td>
                <td>{{ $prestamo->seccion }}</td>
                <td>{{ ucfirst($prestamo->turno) }}</td>
                <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
                <td>
                    {{ $prestamo->fecha_devolucion 
                        ? \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') 
                        : 'No devuelto' 
                    }}
                </td>
                <td>
                    @if($prestamo->devuelto == 1)
                         Devuelto
                    @else
                         En préstamo
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
