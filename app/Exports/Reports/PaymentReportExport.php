<?php

namespace App\Exports\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Http\Controllers\Admin\PaymentsControllers\PaymentAdminController;
use App\Models\PaymentModule;

class PaymentReportExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        $paymentModule = new PaymentModule;
        $paymentData = $paymentModule->getPaymentReportData($this->category, $this->where);
        
        $formattedData = collect($paymentData)->map(function ($order) {
            return [
                $order['uni_order_id'],
                $order['first_name'] . ' ' . $order['last_name'],
                $order['order_data'][0]['course_title'],
                '€ '.$order['total_amount'],
                $this->getPaymentStatusText($order['payment_status']),
                $order['pay_date'],
            ];
        });

        return $formattedData;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Student Name',
            'Course Name',
            'Amount',
            'Status',
            'Date',
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
    
    private function getPaymentStatusText($status)
    {
        switch ($status) {
            case 0:
                return 'Paid';
            case 1:
                return 'Unpaid';
            case 2:
                return 'Refund';
            default:
                return '';
        }
    }

}
