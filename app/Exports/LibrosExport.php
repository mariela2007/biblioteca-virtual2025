<?php

namespace App\Exports;

use App\Models\Libro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LibrosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Libro::select('id', 'titulo', 'autor', 'categoria', 'cantidad', 'descripcion')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Título',
            'Autor',
            'Categoría',
            'Cantidad',
            'Descripción',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // 🎨 Encabezados con fondo azul y letras blancas
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], 
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '2563EB'], // Azul Tailwind-600
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

        // 📦 Bordes para todo el contenido
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:F{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // 🔴 Resaltar libros con cantidad menor a 5
        for ($row = 2; $row <= $highestRow; $row++) {
            $cantidad = $sheet->getCell("E{$row}")->getValue();
            if (is_numeric($cantidad) && $cantidad < 5) {
                $sheet->getStyle("E{$row}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'DC2626'], // Rojo Tailwind-600
                    ],
                ]);
            }
        }

        return [];
    }
}
