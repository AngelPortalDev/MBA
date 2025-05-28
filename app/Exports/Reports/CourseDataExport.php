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

class CourseDataExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $where;

    public function __construct($where = [])
    {
        $this->where = $where;
    }

    public function collection()
    {
        $courses = CourseModule::select('id', 'category_id', 'course_title', 'status', 'published_on')->get();
        
        $formattedData = collect($courses)->map(function ($data) {
            $enrolled = is_enrolled('',$data['id']);

            return [
                $data['course_title'],
                $this->getCourseCategory($data['category_id']),
                $enrolled,
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
            'Enrolled',
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
                return 'Master Course';
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
}
