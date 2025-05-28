<?php

namespace App\Exports;

use App\Models\CourseModule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CourseExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $category;
    protected $where;

    public function __construct($category = '', $where = [])
    {
        $this->category = $category;
        $this->where = $where;
    }

    public function collection()
    {

        $courseModule = new CourseModule;
        $where = [];

        if (isset($this->where['start_date']) && isset($this->where['end_date'])) {
            $where['start_date'] = ['created_at', '>=', $this->where['start_date']];
            $where['end_date'] = ['created_at', '<=', $this->where['end_date']];
        }   
        $CourseData = $courseModule->getCouresDetailsExportList($where);

        $formattedData = collect($CourseData)->map(function ($course) {

            // isset($course['ementor']['name']);
            // echo isset($course['ementor']['name']) ? ($course['ementor']['name']) : '';
            return [
                $course['course_title'],
                isset($course['ementor']['name']) ? $course['ementor']['name'].' '.$course['ementor']['last_name'] : '', 
                $this->getCategoryName($course['category_id']),
                is_enrolled('',$course['id']),
                $this->getCourseStatusText($course['status']),
                $course['published_on'],
                env('APP_URL')."/"."course-details/".base64_encode($course['id'])
            ];
        });

        return $formattedData;

    }

    public function headings(): array
    {
        return [
            'Course Title',
            'Ementor',
            'Category',
            'Enrolled',
            'Is Publish',
            'Publish On',
            'Url',
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

    private function getCourseStatusText($status)
    {
        switch ($status) {
            case 3:
                return 'Yes';
            default:
                return 'No';
        }
    }
    private function getCategoryName($status)
    {
        switch ($status) {
            case 1:
                return 'Award';
            case 1:
                return 'Certificate';
            case 1:
                return 'Diploma';
            case 1:
                return 'Masters';
            default:
                return '';
        }
    }
}
