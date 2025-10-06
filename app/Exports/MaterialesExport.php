<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaterialesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Retorna los registros de materiales.
     */
    public function collection()
    {
        return Material::select('id', 'titulo', 'descripcion', 'cantidad')->get();
    }

    /**
     * Encabezados de la hoja Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Título',
            'Descripción',
            'Cantidad',
        ];
    }

    /**
     * Estilos de la hoja Excel.
     */
    public function styles(Worksheet $sheet)
    {
        // Estilo para los encabezados
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // Texto blanco
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '15803D'], // Verde Tailwind-700
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
        $sheet->getStyle("A2:D{$highestRow}")->applyFromArray([
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
