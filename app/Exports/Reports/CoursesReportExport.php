<?php

namespace App\Exports\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\CourseModule;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class CoursesReportExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize,WithEvents, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $courseModule;
    protected $where;
    protected $totalCourseSales = 0;
    

    public function __construct(CourseModule $courseModule, $where = [])
    {
        $this->courseModule = $courseModule;
        $this->where = $where;
    }

    public function collection()
    {
        $coursesData = [];
        $courseModule;
        $where = [];

        if (isset($this->where['start_date']) && isset($this->where['end_date'])) {
            $where['start_date'] = ['orders.created_at', '>=', $this->where['start_date']];
            $where['end_date'] = ['orders.created_at', '<=', $this->where['end_date']];
        }

        $courses = $this->courseModule->courseReportData($where);

        $formattedData = collect($courses)->map(function ($data) {
            $where = []; 
            if (isset($this->where['start_date']) && isset($this->where['end_date'])) {
                $where = [
                    ['orders.created_at', '>=', $this->where['start_date']],
                    ['orders.created_at', '<=', $this->where['end_date']],
                ];
            }

            $enrolled = is_purchased('',$data['id'],$where);
            $total_students = total_purchased_students('',$data['id'],$where);
            $this->totalCourseSales += $total_students;

            $ementorName = isset($data['Ementor']['name']) ? $data['Ementor']['name'] ." ". $data['Ementor']['last_name'] : '' ;

            return [
                $data['course_title'],
                $this->getCourseCategory($data['category_id']),
                $ementorName,
                $enrolled,
                $total_students,
                $this->getStatus($data['status']),
                $data['published_on'],
            ];
        });

        return $formattedData;

    }

    public function headings(): array
    {
        return [
            'Course Name',
            'Category',
            'Ementor',
            'Total Students',
            'Courses Sales',
            'Status',
            'Published On',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
            2 => [
                'font' => [
                    'bold' => true,
                ],
            ],
            3 => [
                'font' => [
                    'bold' => true,
                ],
            ],
            5 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    private function getCourseCategory($status)
    {
        switch ($status) {
            case 1:
                return 'Award';
            case 2:
                return 'Certificate';
            case 3:
                return 'Diploma';
            case 4:
                return 'Master';
            case 5:
                return 'DBA';
            default:
                return '';
        }
    }
    private function getStatus($status)
    {
        switch ($status) {
            case 1:
                return 'Draft';
            case 2:
                return 'Unpublish';
            case 3:
                return 'Publish ';
            default:
                return '';
        }
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setCellValue('A1', 'Courses Report');
                $durationText = 'Duration - All records till date';
                if (!empty($this->where['start_date']) && !empty($this->where['end_date'])) {
                    $durationText = 'Duration - ' . $this->where['start_date'] . ' to ' . $this->where['end_date'];
                }
                $sheet->setCellValue('A2', $durationText);
                $sheet->setCellValue('A3', 'Total Courses Sales - ' . $this->totalCourseSales);

            },
        ];
    }
    
    public function startCell(): string
    {
        return 'A5';
    }
}
