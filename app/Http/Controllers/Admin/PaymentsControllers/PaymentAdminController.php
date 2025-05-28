<?php

namespace App\Http\Controllers\Admin\PaymentsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Auth, Validator, Storage, DB,Http};
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Str;
use App\Exports\PaymentExport;
class PaymentAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
  
    public function addCoursePromo(Request $request)

    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

         

            $admin_id = Auth::user()->id;

            $promo_code_name= isset($request->promo_code_name) ? htmlspecialchars_decode($request->input('promo_code_name')) : '';

            $promo_code = isset($request->promo_code) ? htmlspecialchars_decode($request->input('promo_code')) : '';

            $discount = isset($request->discount) ? htmlspecialchars($request->input('discount')) : '';

            $expiry_date = isset($request->expiry_date) ? htmlspecialchars($request->input('expiry_date')) : '';

            $course_id = isset($request->course_id) ? base64_decode($request->input('course_id')) : '';

            $coupon_id = isset($request->coupon_id) ? base64_decode($request->input('coupon_id')) : '';

            $institute_id = isset($request->institute_id) ? base64_decode($request->input('institute_id')) : '0';

                try {

                    $data = $request->validate([

                    'promo_code' => 'required|string|max:225|min:4',

                    'discount' => 'required|string|max:225|min:1',

                    'expiry_date' => 'required|date|after:today',

                    'course_id' => 'required',

                    ]);



                } catch (ValidationException $e) {

                    $errors = $e->validator->errors();

                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing.', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"),'data' => $errors]);



                } 



                $existCourse = is_exist('coupons', ['course_id' => $course_id]);

                $selectCols = [

                    'course_id'=>$course_id,

                    'coupon_name' => htmlspecialchars_decode($promo_code),

                    'coupon_code' => $promo_code_name,

                    'coupon_discount' => $discount,

                    'coupon_validity' => $expiry_date,

                    'institute_id'=>$institute_id,
                ];


                if($institute_id){
                    $duplicateCoupon = DB::table('coupons')->where('course_id', $course_id)->where('institute_id',$institute_id)->where('id', '!=', $coupon_id)->first();
                }else{
                    $duplicateCoupon = DB::table('coupons')->where('course_id', $course_id)->where(['institute_id'=>''])->where('id', '!=', $coupon_id)->first();
                }
         
                if (empty($duplicateCoupon)){
                
                    $where = ['id' => $coupon_id];

                    if($coupon_id == ''){

                        $message = 'Promo code added successfully';

                        $title= "Added";

                        $addSelect = [

                            'created_by'=>$admin_id,       

                            'created_at'=>$this->time, 

                        ];

    

                    }else{

                        $title= "Updated";

                        $message = 'Promo code updated successfully';

                        $addSelect = [

                            'updated_by'=>$admin_id,

                            'updated_at'=>$this->time

                        ];

                    }

                    $existsCheck = 0;

                    $addSelect = [

                        'updated_by'=>$admin_id,

                        'updated_at'=>$this->time

                    ];



                }else{

                    if($duplicateCoupon->is_deleted == 'No'){

                        return json_encode(['code' => 201, 'title' => "Promo Code Already Added", 'message' => 'Please try again', "icon" => generateIconPath("error")]);

                    }else{

                        $title= "Added";

                        $where = ['id' => $duplicateCoupon->id];

                        $message = 'Promo code added successfully.';

                        $addSelect = [

                            'is_deleted'=>'No',

                        ];
                    }

        

                }

                

                

                $selectData = array_merge(

                    $selectCols,

                    $addSelect

                );

               

                $PromoCreate = processData(['coupons', 'id'], $selectData , $where);

                

                if (isset($PromoCreate) && $PromoCreate === FALSE) {



                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);

                }



                return json_encode(['code' => 200, 'title' => "Successfully $title", 'message' => $message, "icon" => generateIconPath("success")]);

                            

            

        }else{



            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);



        }



    }
    public function PromoCodeList($id,$action){
        if (Auth::check()) {
            $PromoCodeData = [];
            $query =  DB::table('coupons')->select('coupons.*','course_master.course_title','institute_profile_master.university_code','users.name')
            ->join('course_master','course_master.id','=','coupons.course_id')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'coupons.institute_id')
                     ->whereNotNull('coupons.institute_id')
                     ->where('coupons.institute_id', '!=', '');
            })
            ->leftJoin('institute_profile_master', function ($join) {
                $join->on('institute_profile_master.institute_id', '=', 'coupons.institute_id')
                     ->whereNotNull('coupons.institute_id')
                     ->where('coupons.institute_id', '!=', '');
            })
            ->where('coupons.is_deleted','No');
            $id = base64_decode($id);
            if($action == 'edit'){
                $where = ['id' => $id];
                $exists = is_exist('coupons', $where);
                if (isset($exists) && $exists > 0) {
                    $query =  $query->where('coupons.id',$id);
                }else{
                    return $PromoCodeData;
                }
            }else{

                if($action != 'all'){
                    if($action == 'institute'){
                        $query =  $query->where('coupons.institute_id',$id);
                    }else{
                        $query =  $query->where('coupons.status',$action);
                    }
                }
            }
            
            $PromoCodeData = $query->orderBy('id','DESC')->get();
            $countApply = 0;
            foreach ($PromoCodeData as $key => $code) {
                // echo $code->id;
                $where = ['promo_code_id' => $code->id,'status'=>'0'];
                $applyCoupon = getData('orders',['id'],$where);
                $countApply = count($applyCoupon);
                $PromoCodeData[$key]->count_apply = $countApply;
            }
            return response()->json($PromoCodeData);
        }

    }
    public function PaymentsList($cat = ''){
        if (Auth::check()) {
            $PaymentData = [];
            $where = [];
            if (isset($cat) && !empty($cat)) {
               
                if($cat == 'Paid' || $cat == 'Hold' ){

                    $where = [
                        'status' => '0',
                    ];

                }else if($cat == 'Unpaid'){
                    $where = [
                        'status' => '2'
                    ];
                }else if($cat == 'Failed'){
                    $where = [
                        'status' => '1'
                    ];
                }else if($cat == 'Refund'){
                    $where = [
                        'status' => '2'
                    ];
                }
            }
            $PaymentData = $this->PaymentModule->getPaymentDetails($where,$cat);
            
            return response()->json($PaymentData);
        }

    }

    public function deletePromocode(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "coupons";
            $admin_id = Auth::user()->id;
            $status =  isset($req->status) ? base64_decode($req->input('status')) : '';
                $i=0;
                $rules = [
                    "status" => "required|string",
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                try {    
                    if($status == 'delete'){  
                        if (isset($req->id) && count($req->id) > 0) {
                            $Message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['id' => $id, 'is_deleted' => 'No'];
                                $is_exits = is_exist($table, $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                    $updatePromoCode = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id,'status' => 'Inactive'], $where);
                                    if (isset($updatePromoCode) && $updatePromoCode !== FALSE) {
                                        $i++;
                                    }
                                }
                            }
                        }

                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
                        }
                    }
                    
                    if($status == 'promo_status_active' || $status == 'promo_status_inactive'){
                        $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
                        $where = ['id' => $id, 'is_deleted' => 'No'];
                        $exists = is_exist($table, $where);
                        if (isset($exists) && $exists > 0) {
                            $where = ['id' => $id];
                            if($status == 'promo_status_active'){
                                $selectData = [
                                    'status' => 'Active',
                                    'updated_by' => $admin_id,
                                    'updated_at'=>$this->time
                                ];
                                $Message = "Status Changed";
                                $Text_Message="status changed";
                                $updatePromoCode = processData([$table, 'id'], $selectData , $where);

                            }
                            if($status == 'promo_status_inactive'){
                                $selectData = [
                                    'status' => 'Inactive',
                                    'updated_by' => $admin_id,
                                    'updated_at'=> $this->time
                                ];
                                $Message = "Status Changed";
                                $Text_Message="status changed";
                                $updatePromoCode = processData([$table, 'id'], $selectData , $where);

                            }
                            if (isset($updatePromoCode) && $updatePromoCode['status'] == '1') {
                                return json_encode(['code' => 200, 'title' => "$Message", "message" => "Promo Code $Text_Message successfully", "icon" => generateIconPath("success")]);
                            }
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                    
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
        }
    }

    public function refundPayment(Request $request){

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $payment_id = isset($request->payment_id) ? base64_decode($request->input('payment_id')) : '';
            $where = ['id'=> $payment_id];

            try {
                    $exists = is_exist('payments', $where);
                
                    if (isset($exists) && $exists > 0) {               

                        $PaymentData = $this->PaymentModule->getPaymentDetails($where,'');

                        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                        // Retrieve the payment intent to access its associated events
                        $payment_intent = $stripe->paymentIntents->retrieve($PaymentData[0]['payment_intent_id']);
                        
                        $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    
                        $chargeId = $paymentdetail->id;

                        $refund = $stripe->refunds->create([
                            'charge' => $chargeId,
                            'amount' => $PaymentData[0]['order_data'][0]['course_price']
                        ]);

                        if (isset($refund) && $refund['status'] == 'succeeded') {
                        
                            $select = [
                                'status' => '2'
                            ];
                            $updatePayment = processData(['payments', 'id'], $select,$where);
                            
                            if(isset($updatePayment) && $updatePayment['status'] == TRUE){

                                $where = ['payment_id'=>$payment_id];
                                $select = [
                                    'status' => '2'
                                ];
                                $updateOrder = processData(['orders', 'id'], $select,$where);

                                $where = ['payment_id'=>$payment_id];
                                $exists = is_exist('student_course_master', $where);
                                if (isset($exists) && $exists > 0) {
                                    $select = [
                                        'deleted_by' => auth()->user()->id,
                                        'is_deleted' => 'Yes',
                                        'refunded_date'=> $this->currentDate->format('Y-m-d')
                                    ];
                                    $updateCourse = processData(['student_course_master', 'id'], $select,$where);
                                }

                                $select = [
                                    'refund_id' => $refund['id'],
                                    'user_id'=> $PaymentData[0]['user_id'],
                                    'course_id'=> $PaymentData[0]['order_data'][0]['course_id'],
                                    'payment_id'=>$payment_id,
                                    'status'=>'1',
                                    'refund_res'=> $refund,
                                    'refund_amount'=> $PaymentData[0]['order_data'][0]['course_price'],
                                    'refund_date'=> $this->currentDate->format('Y-m-d'),
                                    'created_at'=>  $this->time,
                                    'created_by'=> auth()->user()->id
                                ];
                                $updateRefund = processData(['payment_refund', 'id'], $select,[]);

                                $user = User::where('id',$PaymentData[0]['user_id'])->first();
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
                                mail_send(
                                    47,
                                    [
                                        '#RecipientName#',
                                        '#Amount#',
                                        '#Date#',
                                        '#EXPYEAR#'
                                    ],
                                    [
                                        $user->name . ' ' . $user->last_name,
                                        '€'.' '.$PaymentData[0]['order_data'][0]['course_price'],
                                        $this->currentDate->format('F j, Y, \a\t g:i A'),
                                        $PaymentData[0]['exp_year']
                                    ],
                                    $user->email
                                );
                            }

                            if (isset($updateRefund) && $updateRefund['status'] == TRUE) {

                                return json_encode(['code' => 200, 'title' => "Successfully Refunded", "message" => "Amount Refunded Successfully.", "icon" => "success"]);
                            }
                            
                        }else{

                            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]); 
                        }

                    }else{

                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }

                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    
            } catch (ApiErrorException $e) {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
            }
        }else{
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }

    }

    public function savePaymentMethod(Request $req){
        
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "payment_methods";
            $admin_id = Auth::user()->id;
            $title =  isset($req->title) ? base64_decode($req->input('title')) : '';
            $rules = [
                "title" => "required",
            ];
            $validate = Validator::make(['title' => $req->title], $rules);
            if (!$validate->fails()) {

                try {    
                    $where = ['method_type' => $title];

                    $selectData = [
                        'status' => '0',
                        'updated_by' => $admin_id,
                        'updated_at'=> $this->time
                    ];
                    
                    $updatePromoCode = processData([$table, 'id'], $selectData , $where);

                    DB::table('payment_methods')->where('method_type','!=',$title)->update(['status'=>'1']);

                    return json_encode(['code' => 200, 'title' => "Payment Method", "message" => "Payment method successfully updated", "icon" => "success"]);

                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => "error"]);
            }
        }
    }

    public function getCoursePrice($course_id)
    {
        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $courseDetails = [];
            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'id' => $course_id
                    ];
                    $courseDetails = getData('course_master',['course_final_price'],$where,'1');
                    return response()->json($courseDetails);
                }
            }
        }
        return redirect()->back();
    }

    public function generatePaymentLink(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $course_id = isset($request->course_id) ? base64_decode($request->input('course_id')) : '';
            $user_id = isset($request->user_id) ? base64_decode($request->input('user_id')) : '';
            $overall_total = isset($request->amount) ? ($request->input('amount')) : '';
            // $country_id = isset($request->country_id) ? htmlspecialchars($request->input('country_id')) : '';

            $validate_rules = [
                'user_id' => 'required|string',
                'course_id' => 'required|string',
                'amount' => 'required'
            ];
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $paymentMethodData = getData('payment_methods', ['method_type', 'status','id'],['status'=>'0']);

            if($paymentMethodData[0]->method_type == 'flywire'){
                if (isset($overall_total) && !empty($overall_total) && $overall_total < 20) {
                    return json_encode(['code' => 202, 'title' => "Something Went Wrong", 'message' => 'Amount must be not less than 20.', "icon" => generateIconPath("error")]);
                }
            }else{
                if (isset($overall_total) && $overall_total == 0) {
                    return json_encode(['code' => 202, 'title' => "Something Went Wrong", 'message' => 'Amount must be not less than 0.', "icon" => generateIconPath("error")]);
                }
            }
            $validate = Validator::make($request->all(), $validate_rules);

            if (!$validate->fails()) {
                // $course_id = rtrim($course_id, ',');
                // $course_id_array = explode(',', $course_id);
              

                $CourseData = DB::table('course_master')->select('course_master.id', 'course_master.ementor_id', 'course_title', 'course_final_price', 'coupon_name', 'coupon_discount', 'coupons.id as coupon_id', 'course_old_price','scholarship')->leftjoin('coupons', 'coupons.course_id', '=', 'course_master.id')->where('course_master.id', $course_id)->get();


                $productItems = [];

                $product_name =  'Course';
                $total = $overall_total;
                $two0 = "00";
                $unit_amount = "$total$two0";
                
                $uniq_payment_id = rand();
                $uniq_order_id = rand();
               
                try {

                    $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => $user_id, 'course_id'=> $course_id,'is_deleted'=>'No'], "", 'created_at');

                    if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&  $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0'){

                        return json_encode(['code' => 201, 'title' => 'Already buy', "message" => "You have already purchased this course. Please check your my learning to access it.", "icon" => generateIconPath("success")]);

                    }elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&  $studentCourseMaster[0]->exam_attempt_remain == '2'){ 

                        return json_encode(['code' => 201, 'title' => 'Already buy', "message" => "You have already purchased this course. Please check your my learning to access it.", "icon" => generateIconPath("success")]);
                    }
                  
                    $Users = getData('users',['name','last_name','email','phone','mob_code'],['id'=>$user_id]);

                    // $CountryData = getData('payment_methods', ['method_type', 'status','id'],['status'=>'0']);
                    $first_name = $Users[0]->name;
                    $last_name = $Users[0]->last_name;
                    $email = $Users[0]->email;
                    $phone = $Users[0]->phone;


                    $mobCode = str_replace('+', '', $Users[0]->mob_code);
                    $CountryData = getData('country_master', ['country_name'],['country_code'=> $mobCode ]);
                    

                    // $country_id = explode("-", $country_id);
                    // $currency_code = $country_id[1];
                    $paymentMethodData = getData('payment_methods', ['method_type', 'status','id'],['status'=>'0']);

                    if($paymentMethodData[0]->method_type == 'stripe'){

                        $productItems = [
                            'price_data' => [
                                'product_data' => [
                                    'name' => $product_name,
                                ],
                                'currency'     => 'EUR',
                                'unit_amount'  => $unit_amount,
                            ],
                            'quantity' => '1'
                        ];

                        // }
                        $CustomerId = $stripe->customers->create([
                            'name' => $first_name . ' ' . $last_name,
                            'email' => $email,
                        ]);
                        $customerId = $CustomerId->id;
                       
                        $Checkoutsession = $stripe->checkout->sessions->create([
                            'line_items'            => [$productItems],
                            'mode'                  => 'payment',
                            // 'payment_method_types'  => ['card','bancontact','giropay','ideal'],
                            'allow_promotion_codes' => false,
                            'metadata' => [
                                'user_id' => $user_id,
                                'customer_name' => $first_name,
                                'customer_address' => '',
                                'customer_country' => '',
                                'customer_email' => $email // Include customer email in metadata
                            ],
                            'customer' => $customerId, // Associate the session with the customer
                            'success_url' =>  route('success', ['session_id' => Str::uuid()], true),
                            'cancel_url'  => route('cancel'),
                        ]);

                        // session('checkout_session_id',$session->id);
                        session(['checkout_session_id' => $Checkoutsession->id]);
                        $checkoutsessionId = $Checkoutsession->id;
                        $pay_url =  $Checkoutsession['url'];

                        session()->put('payment_reference', $Checkoutsession->id); // Store any unique reference or data in the session

                    }else if($paymentMethodData[0]->method_type == 'flywire'){
                    
                        $amountInCents = $overall_total * 100; // This will give you 100 for 1 euro
                        // $displayAmountInEuros = number_format($amountInCents, 2);
                        $uniq_callback_id = Str::uuid();
                        session(['checkout_session_id' => $uniq_callback_id]);
                        $data = [
                            "provider" => "zem",
                            "payment_destination" => env('PAYMENT_DESTINATION'),
                            "amount" => $amountInCents,
                            "currency" => 'EUR', // Specify the currency
                            "country" => 'India', // Pass the country to the API
                            "callback_url" => env('APP_URL').'/process_callback'.'/'.$uniq_callback_id,
                            "callback_version"=> 2,
                            "callback_id" => $uniq_callback_id,
                            "return_cta" => env('APP_URL') . '/payment_success?checkout_session_id=' . $uniq_callback_id, // Dynamic return_cta URL,
                            "return_cta_name" => "Return to eascencia.mt",
                            "dynamic_fields" => [
                                "student_id" => $user_id,
                                "student_first_name" => $first_name,
                                "student_last_name" => $last_name,
                                "student_email" => $email,
                                "uniq_payment_id" => $uniq_payment_id, // Pass the unique payment ID here
                                "student_phone_number"=> $phone,
                                "student_country"=>$CountryData[0]->country_name,
                                "course_name"=> $CourseData[0]->course_title
                            ]

                        ];

                        $headers = Http::withHeaders([
                            'X-Flywire-Digest' => 'G6kcHrGlKQGepZMsQ5IVfaykeLW5cwSgGmbz5HMwYHM=',
                            'Content-Type' => 'application/json',
                        ]);
                        $dataresps = $headers->post(env('PAYMENT_URL'), $data);

                        $url = $dataresps->json();

                        $pay_url =  $dataresps['url'];
                        // session(['checkout_session_id' => $uniq_callback_id]);
                        $checkoutsessionId = $uniq_callback_id;

                    }

                    $order_id = [];
                    foreach ($CourseData as $data) {
                        $discount = '';
                        $coupon_name = '';
                        $coupon_id= '';
                        // foreach ($promo_code_array as $key => $value) {
                        //     $CouponData = DB::table('coupons')->select('coupon_discount')->where('course_id', $data->id)->where('id',$value)->first();
                        //     if ($CouponData && isset($CouponData->coupon_discount)) {
                        //         $discount = $data->course_final_price * $data->coupon_discount / 100;
                        //         $coupon_name = $data->coupon_name;
                        //         $coupon_id = $data->coupon_id;
                        //     }
                        // }
                        $select = [
                            'user_id' => $user_id,
                            'course_id' => $data->id,
                            'instructor_id' => $data->ementor_id,
                            'course_title' => $data->course_title,
                            'course_price' => $data->course_final_price,
                            'promo_code_id'=> $coupon_id,
                            'promo_code_name' => $coupon_name,
                            'promo_code_discount' => $discount,
                            'final_price' => $data->course_old_price,
                            'created_at' =>  $this->time,
                            'created_by' =>   $user_id,
                            'session_id' => $checkoutsessionId,
                            'payment_method'=>$paymentMethodData[0]->id
                        ];

                        $product_name =  $data->course_title;
                        $total = $data->course_final_price;

                        $two0 = "00";
                        $unit_amount = "$total$two0";

                        // $productItems = [
                        //     'price_data' => [
                        //         'product_data' => [
                        //             'name' => $product_name,
                        //         ],
                        //         'currency'     => 'EUR',
                        //         'unit_amount'  => $unit_amount,
                        //     ],
                        //     'quantity' => count($CourseData)
                        // ];
                        $updateOrder = processData(['orders', 'id'], $select, []);
                        if (isset($updateOrder) && !is_array($updateOrder) && $updateOrder === FALSE) {
                            return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                        }


                        $quantity = count($CourseData);
                        $select = [
                            'user_id' =>  $user_id,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'address' => '',
                            'total_amount' => $overall_total,
                            'created_by' => $user_id,
                            'updated_by' => $user_id,
                            'session_id' => $checkoutsessionId,
                            'created_at' => $this->time,
                            'scholarship' => $data->course_old_price -  $data->course_final_price,
                            'discount' => $discount,
                            'course_quantity' => $quantity,
                            'uni_payment_id' => $uniq_payment_id,
                            'uni_order_id' => $uniq_order_id,
                            'payment_method'=>$paymentMethodData[0]->id
                        ];
                        $paymentData = processData(['payments', 'id'], $select, []);

                        $where = ['id' =>  $updateOrder['id']];
                        $select = [
                            'payment_id' => $paymentData['id'],
                        ];
                        $updateOrder = processData(['orders', 'id'], $select, $where);

                        // $select = [
                        //     'user_id' => auth()->user()->id,
                        //     'course_id' => $data->id,
                        //     'purchased_on' => $this->time,
                        //     'created_by' => auth()->user()->id,
                        //     'created_at' => $this->time,
                        // ];
                        // $paymentData = processData(['student_course_master', 'id'], $select, []);
                    }
                    // foreach($order_id as $order){
                    //     $where = ['id' => $order];

                    // }

                    // $webhook = $this->webhook();

                    // if (empty($checkoutSession['id'])) {
                    //     return redirect()->route('cancel')->with('error', 'Failed to create Stripe session. Please try again.');
                    // }

                    // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                    // $webhookEndpoint = $stripe->webhookEndpoints->create([
                    //   'enabled_events' => ['charge.succeeded', 'charge.failed'],
                    //   'url' => 'https://webhook.site/e7344a5f-6885-478f-8f42-adc17e9301cc',
                    // ]);  

                    // Replace 'SESSION_ID_PLACEHOLDER' with the actual session ID
                    // Replace 'SESSION_ID_PLACEHOLDER' with the actual session ID

                    // $reteriveoutSession = $stripe->checkout->sessions->retrieve($checkoutSession->id,[]);

                    // $select = [
                    //     'first_name' => $first_name,
                    //     'last_name' => $last_name,
                    //     'email' => $email,
                    //     'address' => $address,
                    //     'total_amount' => $unit_amount,
                    //     'course_final_price' => $final_price,
                    //     'scholarship' => $scholarship_percent,
                    //     'course_old_price' => $course_old_price_val,
                    //     'created_at' =>  $this->time,
                    // ];
                    // $updateOrder = processData(['payments', 'id'], $select);

                    // session(['stripe_checkout_url' => $pay_url]);
                    return json_encode(['code' => 200, 'title' => "Payment Course", 'message' => 'Payment Successful', "icon" => generateIconPath("success"), "data" => $pay_url]);
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    return $e;
                    return json_encode(['code' => 201, 'title' => "Unable to Paid", 'message' => 'Stripe cannot support this country. Please select another country...', "icon" => generateIconPath("error"), "data" => $e->getMessage()]);
                } catch (\Stripe\Exception\InvalidRequestException $e) {

                    return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error"), "data" => $e->getMessage()]);
                } catch (Exception $e) {
                    // Handle other exceptions
                    return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error"), "data" => $e->getMessage()]);
                }
            }
        }
    }

    public function exportPayment(Request $request){
        return Excel::download(new PaymentExport, 'payment.xlsx');
    }


}