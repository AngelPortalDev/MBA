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
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class InstituteReportExport implements WithMultipleSheets
{
    protected $where;
    
    public function __construct($where = [])
    {
        $this->where = $where;
    }
    
    public function sheets(): array
    {
        return [
            new InstitutesReportSheet($this->where),
            new TeachersPerInstituteSheet($this->where),
        ];
    }
}

class InstitutesReportSheet implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents, WithCustomStartCell, WithTitle
{
    protected $where;
    protected $headingTotalStudent = 0;

    public function __construct($where = [])
    {
        $this->where = $where;
    }

    // Add this method to set the sheet title
    public function title(): string
    {
        return 'Institute Report';
    }

    public function collection()
    {
        $results = collect();

        $instituteIds = $this->where['institutes'] ?? [];

        $institutes = DB::table('users as user')
            ->join('institute_profile_master as ipm', 'user.id', '=', 'ipm.institute_id')
            ->select('user.id as institute_id', 'user.name as institute_name', 'ipm.university_code', 'ipm.contact_person_name', 'ipm.approved_on')
            ->where('user.role', 'institute')
            ->where('user.block_status', '0')
            ->where('user.is_deleted', 'No')
            ->when(!empty($instituteIds), function ($query) use ($instituteIds) {
                $query->whereIn('user.id', $instituteIds);
            })
            ->get();

        foreach ($institutes as $institute) {
            $totalNumberOfStudents = 0;
            $totalNumberOfTeachers = 0;

            $startDate = Carbon::parse($this->where['start_date'])->startOfDay();
            $endDate = Carbon::parse($this->where['end_date'])->endOfDay();

            $totalNumberOfTeachers = DB::table('lecturers_master')->where(['university_code' => $institute->university_code, 'is_deleted' => 'No'])->count();

            $students = DB::table('users')
                ->where('university_code', $institute->university_code)
                ->where('role', 'user')
                ->where('is_deleted', 'No')
                ->where('block_status', '0')
                ->pluck('id');

            $courseList = '';
            $studentsPerCourse = '';  

            if ($students->isNotEmpty()) {
                $coursesQuery = DB::table('student_course_master as scm')
                    ->join('course_master as cm', 'scm.course_id', '=', 'cm.id')
                    ->leftJoin('payments as p', 'scm.payment_id', '=', 'p.id')
                    ->whereIn('scm.user_id', $students);

                    if (!empty($this->where['start_date'])) {
                        $startDate = Carbon::parse($this->where['start_date'])->startOfDay();
                        $coursesQuery->where('scm.created_at', '>=', $startDate);
                    }
                    
                    if (!empty($this->where['end_date'])) {
                        $endDate = Carbon::parse($this->where['end_date'])->endOfDay();
                        $coursesQuery->where('scm.created_at', '<=', $endDate);
                    }                    
        
                    $courses = $coursesQuery
                        ->select('cm.course_title',  DB::raw('COUNT(scm.user_id) as student_count'), DB::raw('SUM(p.total_amount) as total_paid'))
                        ->groupBy('cm.course_title')
                        ->get();
                        
                $totalNumberOfStudents = count($courses);
                $this->headingTotalStudent += count($courses);
        
                $i = 1;              
                foreach ($courses as $course) {
                    $courseList .= '• ' . $course->course_title . "\n";
                    $studentsPerCourse .= '• ' . $course->student_count . " student\n";
                    $i++;
                }
            } else {
                $courseList = '-';
            }
            
            if (empty(trim($courseList))) {
                $courseList = '-';
            }

            $results->push([
                'Institute Name' => $institute->institute_name,
                'Institute Code' => $institute->university_code,
                'Representative' => $institute->contact_person_name ?? '',
                'Approved Date' => $institute->approved_on ? \Carbon\Carbon::parse($institute->approved_on)->format('Y-m-d') : '',
                'Course Titles' => $courseList,
                'Number Of Students Per Course' => $studentsPerCourse ?: '-',
                'Total Number Of Students By  Institute' => $totalNumberOfStudents ?? 0,
            ]);
        }
            
        return $results;
    }

    public function headings(): array
    {
        return [
            'Institute Name',
            'Institute Code',
            'Representative',
            'Approved Date',
            'Course Title',
            'Number Of Students Per Course',
            'Total Number Of Students By  Institute',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        for ($col = 'B'; $col <= 'G'; $col++) {
            $sheet->getStyle($col . '2:' . $col . $sheet->getHighestRow())
                ->getAlignment()->setWrapText(true);
        }

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
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setCellValue('A1', 'Institutes Report');
                $durationText = 'Duration - All records till date';
                if (!empty($this->where['start_date']) && !empty($this->where['end_date'])) {
                    $durationText = 'Duration - ' . $this->where['start_date'] . ' to ' . $this->where['end_date'];
                }
                $sheet->setCellValue('A2', $durationText);
                $sheet->setCellValue('A3', 'Total Number Of Students - ' . $this->headingTotalStudent);
            },
        ];
    }
    
    public function startCell(): string
    {
        return 'A5';
    }
}

class TeachersPerInstituteSheet implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle, WithEvents, WithCustomStartCell
{
    protected $where;
    protected $totalTeachers = 0;
    
    public function __construct($where = [])
    {
        $this->where = $where;
    }

    public function title(): string
    {
        return 'Institute Teachers Report';
    }

    public function collection()
    {
        $instituteIds = $this->where['institutes'] ?? [];

        $institutes = DB::table('users as user')
            ->join('institute_profile_master as ipm', 'user.id', '=', 'ipm.institute_id')
            ->select('user.id as institute_id', 'user.name as institute_name', 'ipm.university_code')
            ->where('user.role', 'institute')
            ->where('user.block_status', '0')
            ->where('user.is_deleted', 'No')
            ->when(!empty($instituteIds), function ($query) use ($instituteIds) {
                $query->whereIn('user.id', $instituteIds);
            })
            ->get();

        $results = collect();

        foreach ($institutes as $institute) {
            $totalTeachers = DB::table('lecturers_master')
                ->where(['university_code' => $institute->university_code, 'is_deleted' => 'No'])
                ->count();

            $this->totalTeachers += $totalTeachers;

            $results->push([
                'Institute Name' => $institute->institute_name,
                'Institute Code' => $institute->university_code,
                'Total Number Of Teachers' => $totalTeachers,
            ]);
        }

        return $results;
    }

    public function headings(): array
    {
        return [
            'Institute Name',
            'Institute Code',
            'Total Number Of Teachers',
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
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setCellValue('A1', 'Institute Teachers Report');
                $durationText = 'Duration - All records till date';
                if (!empty($this->where['start_date']) && !empty($this->where['end_date'])) {
                    $durationText = 'Duration - ' . $this->where['start_date'] . ' to ' . $this->where['end_date'];
                }
                $sheet->setCellValue('A2', $durationText);
                $sheet->setCellValue('A3', 'Total Number Of Teachers - ' . $this->totalTeachers);
            },
        ];
    }
    
    public function startCell(): string
    {
        return 'A5';
    }
}