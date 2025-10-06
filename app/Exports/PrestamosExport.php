<?php

namespace App\Exports;

use App\Models\Prestamo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PrestamosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Prestamo::with('libro')->get()->map(function ($prestamo) {
            return [
                'ID' => $prestamo->id,
                'Libro' => $prestamo->libro->titulo ?? 'N/A',
                'Alumno' => $prestamo->nombre_alumno . ' ' . $prestamo->apellido_alumno,
                'Grado' => $prestamo->grado,
                'Sección' => $prestamo->seccion,
                'Turno' => ucfirst($prestamo->turno),
                'Fecha de Préstamo' => $prestamo->fecha_prestamo->format('d/m/Y'),
                'Fecha de Devolución' => $prestamo->fecha_devolucion?->format('d/m/Y') ?? 'Pendiente',
                'Estado' => $prestamo->fecha_devolucion ? 'Devuelto' : 'En préstamo',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Libro',
            'Alumno',
            'Grado',
            'Sección',
            'Turno',
            'Fecha de Préstamo',
            'Fecha de Devolución',
            'Estado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilos para la fila de encabezados
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // blanco
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '1D4ED8'], // azul tailwind-600
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Bordes para todas las filas con datos
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:I{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        return [];
    }
}
