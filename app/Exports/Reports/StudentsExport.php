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


class StudentsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $user;
    protected $where;

    public function __construct($user = '', $where = [])
    {
        $this->user = $user;
        $this->where = $where;
    }

    public function collection()
    {
        $studentData = [];
        $user;
        $where = [];
        $studentData = $this->user->studentReportData($where);

        foreach ($studentData as $user) {
            $where['user_id'] = $user->id;
            $user->allPaidCourses = getAllPaidCourse($where);
            $examResults = [];
            $statusInfo = [];
          
            foreach ($user->allPaidCourses as $course) {
                $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                $examRemarkMasters = DB::table('exam_remark_master')->where([
                    'course_id' => $course->course_id,
                    'user_id' => $user->id,
                    'student_course_master_id' => $course->scmId,
                    'is_active' => 1,
                ])->get();

                $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                    'course_id' => $course->course_id,
                    'user_id' => $user->id,
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
                $statusInfo[$course->scmId] = getCourseStatus($course);
            }

            $user->examResults = $examResults;
            $user->statusInfo = $statusInfo;
        }

        $formattedData = collect($studentData)->map(function ($data) {
            $paidCoursesList = collect($data->allPaidCourses)->map(function ($course, $index) {
                return ($index + 1) . '. ' . $course->course_title;
            })->implode("\n");
            
            $coursesExamResults = collect($data->allPaidCourses)->map(function ($course, $index) use ($data) {
                $examData = $data->examResults && $data->examResults[$course->scmId] ? $data->examResults[$course->scmId] : null;
            
                if ($examData) {
                    return ($index + 1) . '. ' . $examData['result'];
                } else {
                    return ($index + 1) . '. ' . 'Pending';
                }
            })->implode("\n");
            
            $coursesStatus = collect($data->allPaidCourses)->map(function ($course, $index) use ($data) {
                $statusData = $data->statusInfo && $data->statusInfo[$course->scmId] ? $data->statusInfo[$course->scmId] : null;

                if ($statusData) {
                    return ($index + 1) . '. ' . $statusData['status'];
                }
                
            })->implode("\n");

            return [
                $data['roll_no'],
                $data['name'] . ' ' . $data['last_name'],
                $data['email'],
                $data['mob_code'] . ' ' . $data['phone'],
                $paidCoursesList ?: '',
                $coursesExamResults ?: '',
                $coursesStatus ?: '',
                $data['is_verified'],
                $data['is_active'],
            ];
        });

        return $formattedData;
    }

    public function headings(): array
    {
        return [
            'Roll No.',
            'Name',
            'Email',
            'Phone No.',
            'Course Name',
            'Exam',
            'Course Status',
            'Verification Status',
            'Is Active',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        $sheet->getStyle('E2:E' . $sheet->getHighestRow())
            ->getAlignment()->setWrapText(true);
        $sheet->getStyle('F2:F' . $sheet->getHighestRow())
            ->getAlignment()->setWrapText(true);
        $sheet->getStyle('G2:G' . $sheet->getHighestRow())
            ->getAlignment()->setWrapText(true);

        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
    
}
