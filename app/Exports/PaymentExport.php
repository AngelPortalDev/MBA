<?php

namespace App\Exports;

use App\Models\PaymentModule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $paymentModule;

    public function __construct(PaymentModule $paymentModule = null)
    {
        $this->paymentModule = $paymentModule ?: new PaymentModule();
    }
    public function collection()
    {
        $where  = [];
        $cat = '';
        $PaymentData = $this->paymentModule->getPaymentDetails($where,$cat);
        $formattedData = collect($PaymentData)->map(function ($payment) {

            if (isset($payment['order_data']) && is_array($payment['order_data']) && count($payment['order_data']) > 0) {
                $course = $payment['order_data'][0];
                $total_amount = $course['course_price'];
                if (isset($course['promo_code_discount']) && $course['promo_code_discount']) {
                    $total_amount = $course['course_price'] - $course['promo_code_discount'];
                }
            } else {
                $total_amount = 0;
            }
            return [
                $payment['uni_order_id'],
                isset($payment['user_data']['name']) ? $payment['user_data']['name'].' '.$payment['user_data']['last_name'] : '', 
                isset($payment['order_data']) && is_array($payment['order_data']) && count($payment['order_data']) > 0 ? $payment['order_data'][0]['course_title'] : '',
                $total_amount,
                $this->getPaymentStatus($payment['status']),
                $payment['created_at']
            ];
        });
        return $formattedData;
    }

    public function headings(): array
    {
        return ["Order ID", "Student Name","Course Name","Total","Status","Paid Date"];
    }
    private function getPaymentStatus($status)
    {
        switch ($status) {
            case 0:
                return 'Success';
            case 1:
                return 'Failed';
            case 2:
                return 'Refunded';
            default:
                return '';
        }
    }
}
