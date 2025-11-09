<?php

namespace App\Exports;

use App\Models\Libro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteLibrosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $categoriaId;

    // ✅ Recibimos la categoría seleccionada (puede ser null)
    public function __construct($categoriaId = null)
    {
        $this->categoriaId = $categoriaId;
    }

    public function collection()
    {
        $query = Libro::with('categoria'); // Cargar relación

        // ✅ Filtrar solo si hay categoría seleccionada
        if ($this->categoriaId) {
            $query->where('categoria_id', $this->categoriaId);
        }

        return $query->get()->map(function ($libro) {
            return [
                'ID'         => $libro->id,
                'Título'     => $libro->titulo,
                'Autor'      => $libro->autor,
'Categoría' => [
    'enciclopedia' => 'Enciclopedia',
    'escritores'   => 'Escritores',
    'comic'        => 'Historietas',
    'gramatica'    => 'Lenguaje',
    'fisica'       => 'Ciencia',
    'arte'         => 'Arte',
][strtolower(trim($libro->categoria?->nombre ?? $libro->categoria))] ?? 'Sin categoría',
                'Cantidad'   => $libro->cantidad,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Título',
            'Autor',
            'Categoría',
            'Cantidad',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ✅ Estilo para encabezados (A1:E1 porque hay 5 columnas)
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '2563EB'], // Azul Tailwind
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // ✅ Bordes para toda la tabla
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:E{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // ✅ Resaltar cantidad < 5 en rojo (columna E)
        for ($row = 2; $row <= $lastRow; $row++) {
            $cantidad = $sheet->getCell("E{$row}")->getValue();
            if (is_numeric($cantidad) && $cantidad < 5) {
                $sheet->getStyle("E{$row}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'DC2626'], // Rojo Tailwind
                    ],
                ]);
            }
        }

        return [];
    }
}
