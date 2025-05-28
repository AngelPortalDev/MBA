<?php

namespace App\Exports\Reports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithEvents,
    WithCustomStartCell,
    WithDrawings
};
use Maatwebsite\Excel\Events\AfterSheet;

class TeacherReportExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithEvents,
    WithCustomStartCell,
    WithDrawings
{
    protected $where;
    protected $lecturers;

    public function __construct($where = [])
    {
        $this->where = $where;
    }

    public function collection()
    {
        $query = DB::table('lecturers_master')
            ->where('is_deleted', 'No');

        if (!empty($this->where['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($this->where['start_date'])->startOfDay());
        }

        if (!empty($this->where['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($this->where['end_date'])->endOfDay());
        }

        $this->lecturers = $query->get();

        $results = collect();
        foreach ($this->lecturers as $lecturer) {
            $results->push([
                $lecturer->lactrure_name,
                $lecturer->designation,
                $lecturer->email ?? '',
                $lecturer->university_code ?? '',
                '', // Image cell placeholder
            ]);
        }

        return $results;
    }

    public function headings(): array
    {
        return [
            'Lecturer Name',
            'Designation',
            'Email',
            'Institute Code',
            'Image'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:C4')->getFont()->setBold(true);
        
        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
        ];
    }
    public function startCell(): string
    {
        return 'A5';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setCellValue('A1', 'Teachers Report');
                $durationText = 'Duration - All records till date';
                if (!empty($this->where['start_date']) && !empty($this->where['end_date'])) {
                    $durationText = 'Duration - ' . $this->where['start_date'] . ' to ' . $this->where['end_date'];
                }
                $sheet->setCellValue('A2', $durationText);
                $startRow = 6;
                $rowCount = count($this->lecturers);
                for ($i = 0; $i < $rowCount; $i++) {
                    $sheet->getRowDimension($startRow + $i)->setRowHeight(45); // Adjust if needed
                }

                // Optional: Set column width for the image column
                $sheet->getColumnDimension('E')->setWidth(50); // Adjust for better f
            },
        ];
    }
    

    public function drawings()
    {
        $drawings = [];
        $startRow = 6; // Since startCell() returns A5, and headings are on row 5

        foreach ($this->lecturers as $index => $lecturer) {
            if (!empty($lecturer->image)) {
                $imagePath = public_path('storage/' . $lecturer->image);
                if (file_exists($imagePath)) {
                    $drawing = new Drawing();
                    $drawing->setName('Lecturer Image');
                    $drawing->setDescription($lecturer->lactrure_name);
                    $drawing->setPath($imagePath);
                    $drawing->setHeight(60);  // Adjust image height (fit in 1 row)
                    $drawing->setWidth(40);   // Set the width of the image
                    $drawing->setCoordinates('E' . ($startRow + $index));  // Ensure images are placed correctly in the same row as data
                    $drawing->setOffsetX(10); // Optional spacing
                    $drawing->setOffsetY(5);
                    $drawings[] = $drawing;
                }
            }
        }

        return $drawings;
    }
}
