<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SolicitudesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Solicitud::with(['libro', 'user'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Libro',
            'Usuario',
            'Estado',
            'Fecha de solicitud',
        ];
    }

    public function map($solicitud): array
    {
        return [
            $solicitud->id,
            $solicitud->libro->titulo ?? 'N/A',
            $solicitud->user->name ?? 'N/A',
            ucfirst($solicitud->estado),
            $solicitud->created_at->format('d/m/Y'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Encabezados en negrita y fondo suave
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD9EAD3');

        // Autoajustar columnas
        foreach(range('A','E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Bordes completos en toda la tabla
        $highestRow = $sheet->getHighestRow(); // última fila con datos
        $sheet->getStyle("A1:E{$highestRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    }
}
