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
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;


class StudentsReportExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $user;
    protected $where;
    protected $totalSalesAmount = 0;
    protected $totalCourseSales = 0;
    
    public function __construct(User $user, $where = [])
    {
        $this->user = $user;
        $this->where = $where;
    }

    public function collection()
    {
        $studentData = [];
        $user;
        $where = [];

        if (isset($this->where['start_date']) && isset($this->where['end_date'])) {
            $where['start_date'] = ['course_start_date', '>=', $this->where['start_date']];
            $where['end_date'] = ['course_start_date', '<=', $this->where['end_date']];
        }

        $studentData = $this->user->studentReportData($where);

        foreach ($studentData as $user) {
            $where['user_id'] = $user->id;
            $user->allPaidCourses = getAllPaidCourse($where);
            $this->totalCourseSales += count($user->allPaidCourses);
            $examResults = [];
            $instituteAffiliation = 'N';
            if (!empty($user->university_code)) {
                $institute = DB::table('institute_profile_master')
                    ->where('university_code', $user->university_code)
                    ->first();

                if ($institute) {
                    $instituteUser = DB::table('users')
                        ->where('id', $institute->institute_id)
                        ->select('name')
                        ->first();

                    if ($instituteUser) {
                        $instituteAffiliation = 'Y - ' . $instituteUser->name;
                    }
                }
            }
            
            
            foreach ($user->allPaidCourses as $course) {
                $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                $examRemarkMasters = DB::table('exam_remark_master')->where([
                    'student_course_master_id' => $course->scmId,
                    'is_active' => 1,
                ])->get();

                $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                    'id' => $course->scmId
                ]);

                $examResult = determineExamResult(
                    $studentCourseMaster[0]->exam_attempt_remain ?? 0,
                    count($examRemarkMasters),
                    $courseExamCount,
                    $course->course_id,
                    $user->id,
                    $course->scmId
                );

                $examResults[$course->scmId] = $examResult;
            }

            $user->examResults = $examResults;
            $user->instituteAffiliation = $instituteAffiliation;
        }
        
        $formattedData = collect($studentData)->map(function ($student) {
            $coursesTitles = collect($student->allPaidCourses)->map(function ($course, $index) {
                return ($index + 1) . '. ' . $course->course_title;
            })->implode("\n");
        
            $coursesStartDates = collect($student->allPaidCourses)->map(function ($course) {
                return $course->course_start_date;
            })->implode("\n");

            $coursesExpireDates = collect($student->allPaidCourses)->map(function ($course) {
                return $course->course_expired_on;
            })->implode("\n");

            // $coursesPurchasePrices = collect($student->allPaidCourses)->map(function ($course) {
            //     return $course->purchase_price ? '€ ' . $course->purchase_price : '';
            // })->implode("\n");

            $coursesPurchasePrices = collect($student->allPaidCourses)->map(function ($course) {

                $this->totalSalesAmount += $course->purchase_price;
                return $course->purchase_price !== null ? '€ ' . $course->purchase_price : '';
            })->implode("\n");
            

            $coursesExamResults = collect($student->allPaidCourses)->map(function ($course) use ($student) {
                $examData = $student->examResults && $student->examResults[$course->scmId] ? $student->examResults[$course->scmId] : null;
            
                if ($examData) {
                    return $examData['result'];
                } else {
                    return 'Pending';
                }
            })->implode("\n");
            

            $coursesExpiries = collect($student->allPaidCourses)->map(function ($course) {
                $today = now();
                $adjustedExpiryDate = \Carbon\Carbon::parse($course->adjusted_expiry);
                $isExpired = ($adjustedExpiryDate < $today) ||
                            ($course->exam_attempt_remain === 0) ||
                            ($course->exam_remark === '1');

                return $isExpired ? 'Yes' : 'No';
            })->implode("\n");
            
            $examAttemptRemain = collect($student->allPaidCourses)->map(function ($course) {
                $today = now();
                $adjustedExpiryDate = \Carbon\Carbon::parse($course->adjusted_expiry);
                $isExpired = ($adjustedExpiryDate < $today) ||
                            ($course->exam_attempt_remain === 0) ||
                            ($course->exam_remark === '1');

                return $isExpired ? '' : $course->exam_attempt_remain;
            })->implode("\n");


            // return [
            //     $student['roll_no'],
            //     $student['name'] . ' ' . $student['last_name'],
            //     $student['identity_doc_type'],
            //     $student['identity_doc_number'],
            //     $student['is_verified'],
            //     $coursesTitles ?: '',
            //     $coursesStartDates ?: '',
            //     $coursesExpireDates ?: '',
            //     $coursesPurchasePrices ?: '',
            //     $coursesExamResults ?: '',
            //     $coursesExpiries ?: '',
            //     $coursesExpiries ?: '',
            //     $examAttemptRemain ?: '',
            // ];

            $baseData = [
                $student['roll_no'],
                $student['name'] . ' ' . $student['last_name'],
                $student['identity_doc_type'],
                $student['identity_doc_number'],
                $student['is_verified'],
                $coursesTitles ?: '',
                $coursesStartDates ?: '',
                $coursesExpireDates ?: '',
                $coursesPurchasePrices ?: '',
                $coursesExamResults ?: '',
            ];
            
            if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
                $baseData[] = $coursesExpiries ?: '';
                $baseData[] = $coursesExpiries ?: '';
            }
            
            $baseData[] = $examAttemptRemain ?: '';
            $baseData[] = $student->instituteAffiliation ?? 'N';


            
            return $baseData;
            
        });

        return $formattedData;
    }
    
    public function headings(): array
    {
        return [
            'Roll No.',
            'Student Name',
            'Identity Type',
            'Identity Number',
            'Verification Status',
            'Course Name',
            'Purchase Date',
            'Expire Date',
            'Purchase Price',
            'Exam Remark',
            // 'Is Expired',
            // 'Is Completed',
            'Exam Attempt Remain',
            'Institute Affiliation',
        ];
        
        if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            array_splice($headings, 10, 0, ['Is Expired', 'Is Completed']);
        }

        return $headings;
    }

    // public function styles(Worksheet $sheet)
    // {
    //     $sheet->getStyle('A1:F1')->getFont()->setBold(true);

    //     $sheet->getStyle('B2:B' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('C2:C' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('D2:D' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('E2:E' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('F2:F' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('G2:G' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('H2:H' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('I2:I' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('J2:J' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('K2:K' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('L2:L' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('M2:M' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('N2:N' . $sheet->getHighestRow())
    //         ->getAlignment()->setWrapText(true);
            
    //     $rows = $sheet->getHighestRow();
    //     for ($row = 2; $row <= $rows; $row++) {
    //         $cellValue = $sheet->getCell('E' . $row)->getValue();

    //         // Style for verification status
    //         if ($cellValue === 'Verified') {
    //             $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('33A294');
    //         }
    //         if ($cellValue === 'Unverified') {
    //             $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('DB2D7A');
    //         }
    //         if ($cellValue === 'Pending') {
    //             $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('FF771D');
    //         }
    //     }

    //     return [
    //         1 => [
    //             'font' => [
    //                 'bold' => true,
    //             ],
    //         ],
    //     ];
    // }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        for ($col = 'B'; $col <= 'P'; $col++) {
            $sheet->getStyle($col . '2:' . $col . $sheet->getHighestRow())
                ->getAlignment()->setWrapText(true);
        }

        $rows = $sheet->getHighestRow();
        for ($row = 2; $row <= $rows; $row++) {
            $cellValue = $sheet->getCell('E' . $row)->getValue();
            if ($cellValue === 'Verified') {
                $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('33A294');
            } elseif ($cellValue === 'Unverified') {
                $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('DB2D7A');
            } elseif ($cellValue === 'Pending') {
                $sheet->getStyle('E' . $row)->getFont()->getColor()->setARGB('FF771D');
            }
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
            4 => [
                'font' => [
                    'bold' => true,
                ],
            ],
            6 => [
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
                $sheet->setCellValue('A1', 'Students Report');
                $durationText = 'Duration - All records till date';
                if (!empty($this->where['start_date']) && !empty($this->where['end_date'])) {
                    $durationText = 'Duration - ' . $this->where['start_date'] . ' to ' . $this->where['end_date'];
                }
                $sheet->setCellValue('A2', $durationText);
                $sheet->setCellValue('A3', 'Total courses sales - ' . $this->totalCourseSales);
                $sheet->setCellValue('A4', 'Total sales amount - € ' . $this->totalSalesAmount);
            },
        ];
    }
    
    public function startCell(): string
    {
        return 'A6';
    }

}
