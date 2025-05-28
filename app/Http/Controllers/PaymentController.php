<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, Http, DB, Log};
use Carbon\Carbon;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use App\Services\StudentDocumentService;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\DashboardController;

class PaymentController extends Controller
{

    public function __construct(StudentDocumentService $service)
    {
        parent::__construct();
        $this->service = $service;
    }
    public function checkout(Request $request)
    {
        
        $formData = session('form_data');
        if($formData != '' && $formData != "null"){
            if(Auth::user()->apply_dba == 'Yes'){
                $dbaCourseCheck = DB::table('course_master')->select(['category_id'])->where('id', base64_decode($formData['course_id']))->first();
                if($dbaCourseCheck->category_id == '5'){
                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt'],['student_id'=>Auth::user()->id]);

                    if($doc_verified[0]->identity_is_approved != "Approved" || $doc_verified[0]->edu_is_approved != "Approved" || $doc_verified[0]->resume_file == ''  || $doc_verified[0]->english_score < 10){
                        return redirect()->intended("student/student-document-verification");
                    } 
                }
                $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> base64_decode($formData['course_id'])]);
                if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0){
                    return redirect('/');
                }
            }else{
                $dbaCourseCheck = DB::table('course_master')->select(['category_id'])->where('id', base64_decode($formData['course_id']))->first();
                if($dbaCourseCheck->category_id == '5'){
                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt'],['student_id'=>Auth::user()->id]);

                    if($doc_verified[0]->identity_is_approved != "Approved" || $doc_verified[0]->edu_is_approved != "Approved" || $doc_verified[0]->resume_file == ''  || $doc_verified[0]->english_score < 10){
                        return redirect()->intended("student/student-document-verification");
                    } 
                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> base64_decode($formData['course_id'])]);
                    if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0){
                        return redirect('/');
                    }
                }
            }
            
            
            $studentCourseMaster = getData('student_course_master',['course_expired_on','course_progress','exam_remark','exam_attempt_remain','preference_id'],['course_id'=>base64_decode($formData['course_id']), 'user_id'=>Auth::user()->id,'is_deleted'=>'No'],'','created_at','desc');
            // $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> base64_decode($formData['course_id'])]);

            if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0' && $studentCourseMaster[0]->course_expired_on > now()){
                session()->forget('form_data');    

                $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>base64_decode($formData['course_id']),['optional_course_id','!=','']],'','','asc');

                if(count($existOptionalCourse) > 0){
                    if($studentCourseMaster[0]->preference_id == ''){
                        return redirect()->intended("student/student-my-learning")->with('optional_course_error', 'Select your optional ects to access course.');
                    }else{
                        return redirect()->intended("student/student-master-course-panel/".$formData['course_id']);
                    } 
                }else{
                    return redirect()->intended("student/student-award-course-panel/".$formData['course_id']);
                }

            }else if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->exam_attempt_remain == '2' && $studentCourseMaster[0]->course_expired_on > now()){
                session()->forget('form_data');       
                $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>base64_decode($formData['course_id']),['optional_course_id','!=','']],'','','asc');
                
                if(count($existOptionalCourse) > 0){
                    if($studentCourseMaster[0]->preference_id == ''){
                        return redirect()->intended("student/student-my-learning")->with('optional_course_error', 'Select your optional ects to access course.');
                    }else{
                        return redirect()->intended("student/student-master-course-panel/".$formData['course_id']);
                    } 
                }else{
                    return redirect()->intended("student/student-award-course-panel/".$formData['course_id']);
                }
            }else{

                $data['overallTotal'] = isset($formData['overall_total']) ? base64_decode($formData['overall_total']) : '';
                $data['overalloldTotal'] = isset($formData['overall_old_total']) ? base64_decode($formData['overall_old_total']) : '';
                $data['overallFullTotal'] = isset($formData['overall_full_totals']) ? base64_decode($formData['overall_full_totals']) : '';
                $data['promoCodeDiscount'] = isset($formData['promo_code_discounts']) ? base64_decode($formDPata['promo_code_discounts']) : '0';
                $data['directchekout'] = isset($formData['directchekout']) ? base64_decode($formData['directchekout']) : '0';
                $data['promo_code_id'] = isset($formData['promo_code_id']) ? base64_encode($formData['promo_code_id']) : '0';
                $course_id = isset($formData['course_id']) ? base64_decode($formData['course_id']) : '0';
                $course_id = rtrim($course_id, ',');
                $course_id_array = explode(',', $course_id);
                
                $rawData = DB::table('course_master')->select(['course_title', 'ects', 'total_modules', 'total_lectures',  'course_final_price', 'course_old_price', 'course_thumbnail_file', 'course_master.id', 'coupon_name', 'coupon_discount', 'coupons.status as coupon_status', 'coupons.is_deleted','course_master.id as course_id'])->leftjoin('coupons', 'coupons.course_id', '=', 'course_master.id')->whereIn('course_master.id', $course_id_array)->get();
                session()->forget('form_data');       

                $groupedData = $rawData->groupBy('course_id') // Group by course_id
                ->map(function ($items) { // No type hint for $items
                    return $items->first(); // Pick the first record in each group
                })
                ->values(); // Reset keys

                $data['CourseData'] = $groupedData->toArray();

                $checkAwardBuy = alreadyAwardBuy(Auth::user()->id,$course_id_array);
                $data['MessageCheck'] = $checkAwardBuy;
                
                return view('frontend.payment.checkout', [
                    'data' => $data
                ]);
            }
        }else{
         
            $data['overallTotal'] = isset($request->overall_total) ? base64_decode($request->input('overall_total')) : '';
            $data['overalloldTotal'] = isset($request->overall_old_total) ? base64_decode($request->input('overall_old_total')) : '';
            $data['overallFullTotal'] = isset($request->overall_full_totals) ? base64_decode($request->input('overall_full_totals')) : '';
            $data['promoCodeDiscount'] = isset($request->promo_code_discounts) ? base64_decode($request->input('promo_code_discounts')) : '0';
            $data['directchekout'] = isset($request->directchekout) ? base64_decode($request->input('directchekout')) : '0';
            $data['promo_code_id'] = isset($request->promo_code_id) ? base64_encode($request->input('promo_code_id')) : '0';
            $course_id = isset($request->course_id) ? base64_decode($request->input('course_id')) : '0';
            $course_id = rtrim($course_id, ',');
            $course_id_array = explode(',', $course_id);

                $rawData = DB::table('course_master')->select(['course_title', 'ects', 'total_modules', 'total_lectures',  'course_final_price', 'course_old_price', 'course_thumbnail_file', 'course_master.id', 'coupon_name', 'coupon_discount', 'coupons.status as coupon_status', 'coupons.is_deleted','course_master.id as course_id'])->leftjoin('coupons', 'coupons.course_id', '=', 'course_master.id')->whereIn('course_master.id', $course_id_array)
                ->get();

                $groupedData = $rawData->groupBy('course_id') // Group by course_id
                ->map(function ($items) { // No type hint for $items
                    return $items->first(); // Pick the first record in each group
                })
                ->values(); // Reset keys           

                $data['CourseData'] = $groupedData->toArray();
            
                if($data['directchekout'] == '0'){
                    $checkAwardBuy = alreadyAwardBuy(Auth::user()->id,$course_id_array);
                    $data['MessageCheck'] = $checkAwardBuy;
                }
        }
        return view('frontend.payment.checkout', [
            'data' => $data
        ]);
        
       
    }
    public function payment(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $course_id = isset($request->course_id) ? base64_decode($request->input('course_id')) : '';
            $first_name = isset($request->first_name) ? htmlspecialchars($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars($request->input('last_name')) : '';
            $address = isset($request->address) ? htmlspecialchars($request->input('address')) : '';
            $town = isset($request->town) ? htmlspecialchars($request->input('town')) : '';
            $country_id = isset($request->country_id) ? htmlspecialchars($request->input('country_id')) : '';
            $overall_total = isset($request->overall_full_totals) ? base64_decode($request->input('overall_full_totals')) : '';
            $promo_code_id = isset($request->promo_code_id) ? base64_decode($request->input('promo_code_id')) : '0';
            $overall_old_total = isset($request->overall_old_total) ? base64_decode($request->input('overall_old_total')) : '0';
            $promo_code_discount = isset($request->promo_code_discounts) ? base64_decode($request->input('promo_code_discounts')) : '0';


            // $promo_code_name = isset($request->promo_code_name) ? base64_decode($request->input('promo_code_name')) : '';
            // $promo_code_discount = isset($request->promo_code_discount) ? base64_decode($request->input('promo_code_discount')) : '';

            $validate_rules = [
                'first_name' => 'required',
                'last_name' => 'required|string|max:225',
                'address' => 'required|string|max:225',
                'town' => 'required|string',
                'country_id' => 'required|string',
                'course_id' => 'required|string',
                'overall_full_totals' => 'required'
            ];
            $validate = Validator::make($request->all(), $validate_rules);
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


            if (!$validate->fails()) {
                $course_id = rtrim($course_id, ',');
                $course_id_array = explode(',', $course_id);


                $CourseData = DB::table('course_master')->select('course_master.id', 'course_master.ementor_id', 'course_title', 'course_final_price', 'coupon_name', 'coupon_discount', 'coupons.id as coupon_id', 'course_old_price','scholarship','duration_month')->leftjoin('coupons', 'coupons.course_id', '=', 'course_master.id')->whereIn('course_master.id', $course_id_array)->get();
                
                $CourseData = $CourseData->groupBy('id') // Group by course_id
                ->map(function ($items) { // No type hint for $items
                    return $items->first(); // Pick the first record in each group
                })
                ->values(); // Reset keys

                $CourseData = $CourseData->toArray();

                $productItems = [];
                $country_id = explode("-", $country_id);
                $currency_code = $country_id[1];



                $promo_code_id = rtrim($promo_code_id, ',');
                $promo_code_array = explode(',', $promo_code_id);

                // foreach($CourseData as $data){

                $product_name =  'Course';
                $total = $overall_total;
                $two0 = "00";
                $unit_amount = "$total$two0";
                
                $uniq_payment_id = rand();
                $uniq_order_id = rand();
                // $checkoutsessionId = '';
               
                try {
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
                            'email' => auth()->user()->email,
                        ]);
                        $customerId = $CustomerId->id;

                        $Checkoutsession = $stripe->checkout->sessions->create([
                            'line_items'            => [$productItems],
                            'mode'                  => 'payment',
                            // 'payment_method_types'  => ['card','bancontact','giropay','ideal'],
                            'allow_promotion_codes' => false,
                            'metadata' => [
                                'user_id' => auth()->user()->id,
                                'customer_name' => $first_name . ' ' . $last_name,
                                'customer_address' => $address,
                                'customer_country' => $country_id[0],
                                'customer_email' => auth()->user()->email, // Include customer email in metadata
                            ],
                            'customer' => $customerId, // Associate the session with the customer
                            'success_url' =>  route('success', ['session_id' => Str::uuid()], true),
                            'cancel_url'  => route('cancel'),
                        ]);


                        // session('checkout_session_id',$session->id);
                        session(['checkout_session_id' => $Checkoutsession->id]);
                        $checkoutsessionId = $Checkoutsession->id;
                        $pay_url =  $Checkoutsession['url'];

                    }else if($paymentMethodData[0]->method_type == 'flywire'){
                        
                        $mobCode = str_replace('+', '', auth()->user()->mob_code);

                        $CountryData = getData('country_master', ['country_name'],['country_code'=> $mobCode]);

                        $CourseName = '';
                        foreach ($CourseData as $dataCourse) {
                            $CourseName .= $dataCourse->course_title . ',';
                        }
                        $CourseName = rtrim($CourseName, ',');


                        $amountInCents = $overall_total * 100; // This will give you 100 for 1 euro
                        // $displayAmountInEuros = number_format($amountInCents, 2);
                        $uniq_callback_id = Str::uuid();
                        session(['checkout_session_id' => $uniq_callback_id]);
                        $data = [
                            "provider" => "zem",
                            "payment_destination" => env('PAYMENT_DESTINATION'),
                            "amount" => $amountInCents,
                            "currency" => 'EUR', // Specify the currency
                            "country" => $currency_code, // Pass the country to the API
                            "callback_url" => env('APP_URL').'/process_callback'.'/'.$uniq_callback_id,
                            "callback_version"=> 2,
                            "callback_id" => $uniq_callback_id,
                            "return_cta" => env('APP_URL') . '/payment_success?checkout_session_id=' . $uniq_callback_id, // Dynamic return_cta URL,
                            "return_cta_name" => "Return to eascencia.mt",
                            "dynamic_fields" => [
                                "student_id" => auth()->user()->id,
                                "student_first_name" => auth()->user()->name,
                                "student_last_name" => auth()->user()->last_name,
                                "student_email" => auth()->user()->email,
                                "uniq_payment_id" => $uniq_payment_id,
                                "student_phone_number"=> auth()->user()->phone,
                                "student_country"=>$CountryData[0]->country_name,
                                "course_name"=> $CourseName
                                // "payer_info" => [ // Include payer information
                                //     "payer_first_name" => $first_name, // Full name of the payer
                                //     "payer_last_name"=> $last_name,
                                //     "payer_address" => $address, // Address of the payer (make sure this field exists)
                                //     "payer_city" => $town   // City of the payer (make sure this field exists)
                                // ],
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
                        foreach ($promo_code_array as $key => $value) {
                            $CouponData = DB::table('coupons')->select('coupon_discount','coupon_name','id')->where('course_id', $data->id)->where('id',$value)->first();
                            if ($CouponData && isset($CouponData->coupon_discount)) {
                                $discount = $data->course_final_price * $CouponData->coupon_discount / 100;
                                $coupon_name = $CouponData->coupon_name;
                                $coupon_id = $CouponData->id;
                            }
                        }
                        $select = [
                            'user_id' => auth()->user()->id,
                            'course_id' => $data->id,
                            'instructor_id' => $data->ementor_id,
                            'course_title' => $data->course_title,
                            'course_price' => $data->course_final_price,
                            'promo_code_id'=> $coupon_id,
                            'promo_code_name' => $coupon_name,
                            'promo_code_discount' => $discount,
                            'final_price' => $data->course_old_price,
                            'created_at' =>  $this->time,
                            'created_by' =>  auth()->user()->id,
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
                            return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
                        }


                        $quantity = count($CourseData);
                        $select = [
                            'user_id' => auth()->user()->id,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => auth()->user()->email,
                            'address' => $address,
                            'total_amount' => $overall_total,
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
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

                        if($overall_total == '0' && !empty($coupon_name)){
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$data->id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 

                            $whereOrder = ['payment_id' => $paymentData['id'] ];
                            $selectOrder = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $selectOrder,$whereOrder);
                            
                            if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                                $wherePayment = ['id' => $paymentData['id'] ];
                                $selectPayment = [
                                    'status' => '0',
                                    'payment_status'=>'0'
                                ];
                                $updatePayment = processData(['payments', 'id'], $selectPayment,$wherePayment);

                                $where = ['course_id' => $data->id,'student_id'=> auth()->user()->id,'status'=>'Active','is_by'=>'1'];
                                $exists = is_exist('cart', $where);
                                if (isset($exists) && $exists > 0) {

                                    $whereCart = ['course_id' => $data->id,'student_id'=> auth()->user()->id];
                                    $selectCart = [
                                        'status' => 'Inactive',
                                        'is_by'=>'0'
                                    ];
                                    $updateCart = processData(['cart', 'id'], $selectCart,$whereCart);
                                }

                                $select = [
                                    'user_id' => auth()->user()->id,
                                    'course_id' => $data->id,
                                    'payment_id'=>  $paymentData['id'],
                                    'purchased_on' => $this->time,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => $this->time,
                                    'course_start_date' => now()->format('Y-m-d'),
                                    'course_expired_on' => Carbon::now()->addMonths($data->duration_month)->format('Y-m-d'),
                                    'payment_method'=>$paymentMethodData[0]->id,
                                    'preference_status' => $preference_status
                                ];
                                $courseMasterData = processData(['student_course_master', 'id'], $select, []);
                                if (isset($courseMasterData) && $courseMasterData['status'] == 'TRUE') {
                                    $url_promo = 'student/success/'.$checkoutsessionId;
                                        return json_encode(['code' => 200, 'title' => "Payment Successful", 'message' => 'Payment Successful', "icon" => "success", "data" => 'payment-promo','url'=> $url_promo]);
                                } else {
                                    return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "data" => $e->getMessage()]);
                                }
                            }else {
                                return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "data" => $e->getMessage()]);
                            }
                        }
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


                    return json_encode(['code' => 200, 'title' => "Payment Course", 'message' => 'Payment Successful', "icon" => "success", "data" => $pay_url]);
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    // return $e->message;
                    return json_encode(['code' => 201, 'title' => "Unable to Paid", 'message' => 'Stripe cannot support this country. Please select another country...', "icon" => "error", "data" => $e->getMessage()]);
                } catch (\Stripe\Exception\InvalidRequestException $e) {

                    return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "data" => $e->getMessage()]);
                } catch (Exception $e) {
                    // Handle other exceptions
                    return json_encode(['code' => 201, 'title' => "Unable to Create", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "data" => $e->getMessage()]);
                }
            }
        }
    }
    public function stripe_webhook()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $payload = file_get_contents('php://input');
        $event = null;
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE']; // Get the signature from the headers
        
        try {
            // Verify the webhook signature
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400); // Send HTTP status code 400 (Bad Request)
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400); // Send HTTP status code 400 (Bad Request)
            exit();
        }

        catch (SignatureVerificationException $e) {
            return response()->json(['error' => 'Webhook signature verification failed.'], 403);
        }
        // Handle the event
        switch ($event->type) {
            case 'radar.early_fraud_warning.created':
                $paymentIntentData = $event->data->object;
                return $this->cancel();
                
            case 'charge.succeeded':
                $paymentIntentData = $event->data->object;
                $session_id = session('checkout_session_id');

                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',Auth::user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $payment_intent_id = $paymentIntentData['id'];
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                if (isset($exists) && $exists > 0) {
                    
                    $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);
                    $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    if($paymentdetail->status == 'succeeded'){
                        $payment_status = '0';
                    }else{
                        $payment_status = '1';
                    }

                    $paymentData = DB::table('payments')
                    ->where('session_id',$session_id)
                    ->where('status','1')
                    ->latest()
                    ->get();
                             
                    foreach($paymentData as $key => $payment){

                        $carbonDate = Carbon::now();
                        $formattedDate = $carbonDate->format('Y-m-d');
                        $currentDate = Carbon::parse($formattedDate);
                        $addedDays = 0;
                        while ($addedDays < 7) {
                            $currentDate->addDay();
                            if ($currentDate->isWeekday()) {
                                $addedDays++;
                            }
                        }
                        $transaction = '';
                        $type = '';
                        $brand = '';
                        $exp_month = '';
                        $exp_year = '';
                        if($paymentdetail->balance_transaction){
                            $transaction = $paymentdetail->balance_transaction;
                        }
                        if($paymentdetail->payment_method_details->type){
                            $type = $paymentdetail->payment_method_details->type;
                        }
                        if($paymentdetail->payment_method_details->card->brand){
                            $brand = $paymentdetail->payment_method_details->card->brand;
                        }
                        if($paymentdetail->payment_method_details->card->exp_month){
                            $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                        }
                        if($paymentdetail->payment_method_details->card->exp_year){
                            $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                        }
                        $where = ['id' => $payment->id];
                        $select = [
                            'status' => $payment_status,
                            'transaction_id' => $transaction,
                            'payment_type' => $type,
                            'card_type' => $brand,
                            'exp_month' => $exp_month,
                            'exp_year' => $exp_year,
                            'payment_intent_id' => $payment_intent_id,
                            'payment_status' => '0',
                            'pay_date' => $formattedDate,
                            'hold_date' => $currentDate->toDateString()

                        ];  

                        $updatePayment = processData(['payments', 'id'], $select, $where);

                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $whereOrder = ['payment_id' => $payment->id ];
                            $select = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                        }

                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            $where = ['id' => $payment->user_id, 'roll_no' => null];
                            $select = ['roll_no'  => "E" . date("YmdHis")];
                            $exists = is_exist('users', $where);
                            if (isset($exists) && $exists > 0) {
                                $addUserRollNumber = processData(['users','id'], $select, $where);
                            }

                            $OrderData = DB::table('orders')
                                        ->select('course_id','course_price','promo_code_discount')
                                        ->where('payment_id', $payment->id)
                                        ->first();

                            $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                            $exists = is_exist('cart', $where);
                            if (isset($exists) && $exists > 0) {
                                DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                            }

                            $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                            $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 
                            $select = [
                                'user_id' => $payment->user_id,
                                'course_id' => $OrderData->course_id,
                                'payment_id'=>$payment->id,
                                'purchased_on' => $this->time,
                                'created_by' => $payment->user_id,
                                'created_at' => $this->time,
                                'course_start_date' => now()->format('Y-m-d'),
                                'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                'payment_method'=>$paymentMethodData[0]->id,
                                'preference_status'=>$preference_status
                            ];
                            $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                            $studentCourseMaster = DB::table('student_course_master')
                                ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                ->where('student_course_master.user_id', $payment->user_id)
                                ->where('student_course_master.course_id', $OrderData->course_id)
                                ->first();
                                            
                                    
                            $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                            $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                            $receiptLink = route('receipt', [
                                'id' => base64_encode($payment->id), 
                                'action' => base64_encode('receipt')
                            ]);

                            $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                            $CoursePrice = $OrderData->course_price;
                            if($OrderData->promo_code_discount){
                                $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                            }
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                            mail_send(
                                31,
                                [
                                    '#Name#',
                                    '#XXXXXXXXXX#',
                                    '#DD/MM/YYYY#',
                                    '#amount#',
                                    '#Course Name#',
                                    '#Receipt Link#',
                                    '#unsubscribeRoute#',
                                ],
                                [
                                    $student->name . " " . $student->last_name,
                                    $payment->transaction_id,
                                    Carbon::parse($payment->created_at)->format('Y-m-d'),
                                    $CoursePrice,
                                    $studentCourseMaster->course_title,
                                    $receiptLink,
                                    $unsubscribeRoute
                                ],
                                $recipients
                            );

                            if($ementor){
                                
                                if ($studentCourseMaster) {
                                    $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                } else {
                                    $base64EncodedCourseId = null;
                                }
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    46,
                                    [
                                        '#E-mentor Name#',
                                        '#studentName#',
                                        '#Course Name#',
                                        '#Start Date#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $student->name." ".$student->last_name,
                                        $studentCourseMaster->course_title,
                                        Carbon::parse($payment->created_at)->format('Y-m-d'),
                                        $ementorunsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }
                                    
                    }
                                
                    return $this->success();

                }else{
                    return $this->cancel();
                }
            break;
            case 'payment_intent.processing':
                $paymentIntentData = $event->data->object;
                $session_id = session('checkout_session_id');
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',Auth::user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $payment_intent_id = $paymentIntentData['id'];
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                if (isset($exists) && $exists > 0) {
                    $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);
                    $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    if($paymentdetail->status == 'succeeded'){
                        $payment_status = '0';
                    }else{
                        $payment_status = '1';
                    }

                    $paymentData = DB::table('payments')
                    ->where('session_id',$session_id)
                    ->where('status','1')
                    ->latest()
                    ->get();
                             
                    foreach($paymentData as $key => $payment){

                        $carbonDate = Carbon::now();
                        $formattedDate = $carbonDate->format('Y-m-d');
                        $currentDate = Carbon::parse($formattedDate);
                        $addedDays = 0;
                        while ($addedDays < 7) {
                            $currentDate->addDay();
                            if ($currentDate->isWeekday()) {
                                $addedDays++;
                            }
                        }
                        $transaction = '';
                        $type = '';
                        $brand = '';
                        $exp_month = '';
                        $exp_year = '';
                        if($paymentdetail->balance_transaction){
                            $transaction = $paymentdetail->balance_transaction;
                        }
                        if($paymentdetail->payment_method_details->type){
                            $type = $paymentdetail->payment_method_details->type;
                        }
                        if($paymentdetail->payment_method_details->card->brand){
                            $brand = $paymentdetail->payment_method_details->card->brand;
                        }
                        if($paymentdetail->payment_method_details->card->exp_month){
                            $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                        }
                        if($paymentdetail->payment_method_details->card->exp_year){
                            $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                        }
                        $where = ['id' => $payment->id];
                        $select = [
                            'status' => $payment_status,
                            'transaction_id' => $transaction,
                            'payment_type' => $type,
                            'card_type' => $brand,
                            'exp_month' => $exp_month,
                            'exp_year' => $exp_year,
                            'payment_intent_id' => $payment_intent_id,
                            'payment_status' => '0',
                            'pay_date' => $formattedDate,
                            'hold_date' => $currentDate->toDateString()

                        ];  

                        $updatePayment = processData(['payments', 'id'], $select, $where);

                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $whereOrder = ['payment_id' => $payment->id ];
                            $select = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                        }

                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            $where = ['id' => $payment->user_id, 'roll_no' => null];
                            $select = ['roll_no'  => "E" . date("YmdHis")];
                            $exists = is_exist('users', $where);
                            if (isset($exists) && $exists > 0) {
                                $addUserRollNumber = processData(['users','id'], $select, $where);
                            }

                            $OrderData = DB::table('orders')
                                        ->select('course_id','course_price','promo_code_discount')
                                        ->where('payment_id', $payment->id)
                                        ->first();

                            $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                            $exists = is_exist('cart', $where);
                            if (isset($exists) && $exists > 0) {
                                DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                            }

                            $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                        
                            $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 
                            $select = [
                                'user_id' => $payment->user_id,
                                'course_id' => $OrderData->course_id,
                                'payment_id'=>$payment->id,
                                'purchased_on' => $this->time,
                                'created_by' => $payment->user_id,
                                'created_at' => $this->time,
                                'course_start_date' => now()->format('Y-m-d'),
                                'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                'payment_method'=>$paymentMethodData[0]->id,
                                'preference_status' => $preference_status
                            ];
                            $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                            $studentCourseMaster = DB::table('student_course_master')
                                ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                ->where('student_course_master.user_id', $payment->user_id)
                                ->where('student_course_master.course_id', $OrderData->course_id)
                                ->first();
                                            
                                    
                            $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                            $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                            $receiptLink = route('receipt', [
                                'id' => base64_encode($payment->id), 
                                'action' => base64_encode('receipt')
                            ]);

                            $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                            $CoursePrice = $OrderData->course_price;
                            if($OrderData->promo_code_discount){
                                $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                            }
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                            mail_send(
                                31,
                                [
                                    '#Name#',
                                    '#XXXXXXXXXX#',
                                    '#DD/MM/YYYY#',
                                    '#amount#',
                                    '#Course Name#',
                                    '#Receipt Link#',
                                    '#unsubscribeRoute#',
                                ],
                                [
                                    $student->name . " " . $student->last_name,
                                    $payment->transaction_id,
                                    Carbon::parse($payment->created_at)->format('Y-m-d'),
                                    $CoursePrice,
                                    $studentCourseMaster->course_title,
                                    $receiptLink,
                                    $unsubscribeRoute
                                ],
                                $recipients
                            );

                            if($ementor){
                                
                                if ($studentCourseMaster) {
                                    $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                } else {
                                    $base64EncodedCourseId = null;
                                }
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    46,
                                    [
                                        '#E-mentor Name#',
                                        '#studentName#',
                                        '#Course Name#',
                                        '#Start Date#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $student->name." ".$student->last_name,
                                        $studentCourseMaster->course_title,
                                        Carbon::parse($payment->created_at)->format('Y-m-d'),
                                        $ementorunsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }
                                    
                    }
                    return $this->success();

                }else{
                    return $this->cancel();
                }
            break;
            case 'payment_intent.succeeded':
                $paymentIntentData = $event->data->object;
                $session_id = session('checkout_session_id');
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',auth()->user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $payment_intent_id = $paymentIntentData['id'];
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                if (isset($exists) && $exists > 0) {
                    $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);
                    $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    if($paymentdetail->status == 'succeeded'){
                        $payment_status = '0';
                    }else{
                        $payment_status = '1';
                    }
                    $paymentData = DB::table('payments')
                    ->where('session_id',$session_id)
                    ->where('status','1')
                    ->latest()
                    ->get();
                             
                    foreach($paymentData as $key => $payment){

                        $carbonDate = Carbon::now();
                        $formattedDate = $carbonDate->format('Y-m-d');
                        $currentDate = Carbon::parse($formattedDate);
                        $addedDays = 0;
                        while ($addedDays < 7) {
                            $currentDate->addDay();
                            if ($currentDate->isWeekday()) {
                                $addedDays++;
                            }
                        }
                        $transaction = '';
                        $type = '';
                        $brand = '';
                        $exp_month = '';
                        $exp_year = '';
                        if($paymentdetail->balance_transaction){
                            $transaction = $paymentdetail->balance_transaction;
                        }
                        if($paymentdetail->payment_method_details->type){
                            $type = $paymentdetail->payment_method_details->type;
                        }
                        if($paymentdetail->payment_method_details->card->brand){
                            $brand = $paymentdetail->payment_method_details->card->brand;
                        }
                        if($paymentdetail->payment_method_details->card->exp_month){
                            $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                        }
                        if($paymentdetail->payment_method_details->card->exp_year){
                            $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                        }
                        $where = ['id' => $payment->id];
                        $select = [
                            'status' => $payment_status,
                            'transaction_id' => $transaction,
                            'payment_type' => $type,
                            'card_type' => $brand,
                            'exp_month' => $exp_month,
                            'exp_year' => $exp_year,
                            'payment_intent_id' => $payment_intent_id,
                            'payment_status' => '0',
                            'pay_date' => $formattedDate,
                            'hold_date' => $currentDate->toDateString()

                        ];  

                        $updatePayment = processData(['payments', 'id'], $select, $where);

                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $whereOrder = ['payment_id' => $payment->id ];
                            $select = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                        }

                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            $where = ['id' => $payment->user_id, 'roll_no' => null];
                            $select = ['roll_no'  => "E" . date("YmdHis")];
                            $exists = is_exist('users', $where);
                            if (isset($exists) && $exists > 0) {
                                $addUserRollNumber = processData(['users','id'], $select, $where);
                            }

                            $OrderData = DB::table('orders')
                                        ->select('course_id','course_price','promo_code_discount')
                                        ->where('payment_id', $payment->id)
                                        ->first();

                            $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                            $exists = is_exist('cart', $where);
                            if (isset($exists) && $exists > 0) {
                                DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                            }


                            $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                            $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 
                            $select = [
                                'user_id' => $payment->user_id,
                                'course_id' => $OrderData->course_id,
                                'payment_id'=>$payment->id,
                                'purchased_on' => $this->time,
                                'created_by' => $payment->user_id,
                                'created_at' => $this->time,
                                'course_start_date' => now()->format('Y-m-d'),
                                'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                'payment_method'=>$paymentMethodData[0]->id,
                                'preference_status'=>$preference_status
                            ];
                            $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                            $studentCourseMaster = DB::table('student_course_master')
                                ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                ->where('student_course_master.user_id', $payment->user_id)
                                ->where('student_course_master.course_id', $OrderData->course_id)
                                ->first();
                                            
                                    
                            $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                            $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                            $receiptLink = route('receipt', [
                                'id' => base64_encode($payment->id), 
                                'action' => base64_encode('receipt')
                            ]);

                            $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                            $CoursePrice = $OrderData->course_price;
                            if($OrderData->promo_code_discount){
                                $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                            }
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                            mail_send(
                                31,
                                [
                                    '#Name#',
                                    '#XXXXXXXXXX#',
                                    '#DD/MM/YYYY#',
                                    '#amount#',
                                    '#Course Name#',
                                    '#Receipt Link#',
                                    '#unsubscribeRoute#',
                                ],
                                [
                                    $student->name . " " . $student->last_name,
                                    $payment->transaction_id,
                                    Carbon::parse($payment->created_at)->format('Y-m-d'),
                                    $CoursePrice,
                                    $studentCourseMaster->course_title,
                                    $receiptLink,
                                    $unsubscribeRoute
                                ],
                                $recipients
                            );

                            if($ementor){
                                
                                if ($studentCourseMaster) {
                                    $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                } else {
                                    $base64EncodedCourseId = null;
                                }
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    46,
                                    [
                                        '#E-mentor Name#',
                                        '#studentName#',
                                        '#Course Name#',
                                        '#Start Date#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $student->name." ".$student->last_name,
                                        $studentCourseMaster->course_title,
                                        Carbon::parse($payment->created_at)->format('Y-m-d'),
                                        $ementorunsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }
                                    
                    }
                    return $this->success();

                }else{
                    return $this->cancel();
                }
            break;
            case 'payment_intent.created':
                $paymentIntentData = $event->data->object;
                $session_id = session('checkout_session_id');
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',auth()->user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $payment_intent_id = $paymentIntentData['id'];
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                if (isset($exists) && $exists > 0) {
                    $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);
                    $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    if($paymentdetail->status == 'succeeded'){
                        $payment_status = '0';
                    }else{
                        $payment_status = '1';
                    }
                    $paymentData = DB::table('payments')
                    ->where('session_id',$session_id)
                    ->where('status','1')
                    ->latest()
                    ->get();
                             
                    foreach($paymentData as $key => $payment){

                        $carbonDate = Carbon::now();
                        $formattedDate = $carbonDate->format('Y-m-d');
                        $currentDate = Carbon::parse($formattedDate);
                        $addedDays = 0;
                        while ($addedDays < 7) {
                            $currentDate->addDay();
                            if ($currentDate->isWeekday()) {
                                $addedDays++;
                            }
                        }
                        $where = ['id' => $payment->id];
                        $transaction = '';
                        $type = '';
                        $brand = '';
                        $exp_month = '';
                        $exp_year = '';
                        if($paymentdetail->balance_transaction){
                            $transaction = $paymentdetail->balance_transaction;
                        }
                        if($paymentdetail->payment_method_details->type){
                            $type = $paymentdetail->payment_method_details->type;
                        }
                        if($paymentdetail->payment_method_details->card->brand){
                            $brand = $paymentdetail->payment_method_details->card->brand;
                        }
                        if($paymentdetail->payment_method_details->card->exp_month){
                            $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                        }
                        if($paymentdetail->payment_method_details->card->exp_year){
                            $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                        }
                        $select = [
                            'status' => $payment_status,
                            'transaction_id' => $transaction,
                            'payment_type' => $type,
                            'card_type' => $brand,
                            'exp_month' => $exp_month,
                            'exp_year' => $exp_year,
                            'payment_intent_id' => $payment_intent_id,
                            'payment_status' => '0',
                            'pay_date' => $formattedDate,
                            'hold_date' => $currentDate->toDateString()

                        ];  

                        $updatePayment = processData(['payments', 'id'], $select, $where);

                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $whereOrder = ['payment_id' => $payment->id ];
                            $select = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                        }

                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            $where = ['id' => $payment->user_id, 'roll_no' => null];
                            $select = ['roll_no'  => "E" . date("YmdHis")];
                            $exists = is_exist('users', $where);
                            if (isset($exists) && $exists > 0) {
                                $addUserRollNumber = processData(['users','id'], $select, $where);
                            }

                            $OrderData = DB::table('orders')
                                        ->select('course_id','course_price','promo_code_discount')
                                        ->where('payment_id', $payment->id)
                                        ->first();

                            $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                            $exists = is_exist('cart', $where);
                            if (isset($exists) && $exists > 0) {
                                DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                            }

                            $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                            $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 
                            $select = [
                                'user_id' => $payment->user_id,
                                'course_id' => $OrderData->course_id,
                                'payment_id'=>$payment->id,
                                'purchased_on' => $this->time,
                                'created_by' => $payment->user_id,
                                'created_at' => $this->time,
                                'course_start_date' => now()->format('Y-m-d'),
                                'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                'payment_method'=>$paymentMethodData[0]->id,
                                'preference_status' => $preference_status
                            ];
                            $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                            $studentCourseMaster = DB::table('student_course_master')
                                ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                ->where('student_course_master.user_id', $payment->user_id)
                                ->where('student_course_master.course_id', $OrderData->course_id)
                                ->first();
                                            
                                    
                            $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                            $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                            $receiptLink = route('receipt', [
                                'id' => base64_encode($payment->id), 
                                'action' => base64_encode('receipt')
                            ]);

                            $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                            $CoursePrice = $OrderData->course_price;
                            if($OrderData->promo_code_discount){
                                $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                            }
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                            mail_send(
                                31,
                                [
                                    '#Name#',
                                    '#XXXXXXXXXX#',
                                    '#DD/MM/YYYY#',
                                    '#amount#',
                                    '#Course Name#',
                                    '#Receipt Link#',
                                    '#unsubscribeRoute#',
                                ],
                                [
                                    $student->name . " " . $student->last_name,
                                    $payment->transaction_id,
                                    Carbon::parse($payment->created_at)->format('Y-m-d'),
                                    $payment->total_amount,
                                    $CoursePrice,
                                    $receiptLink,
                                    $unsubscribeRoute
                                ],
                                $recipients
                            );

                            if($ementor){
                                
                                if ($studentCourseMaster) {
                                    $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                } else {
                                    $base64EncodedCourseId = null;
                                }
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    46,
                                    [
                                        '#E-mentor Name#',
                                        '#studentName#',
                                        '#Course Name#',
                                        '#Start Date#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $student->name." ".$student->last_name,
                                        $studentCourseMaster->course_title,
                                        Carbon::parse($payment->created_at)->format('Y-m-d'),
                                        $ementorunsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }
                                    
                    }
                    return $this->success();
                    
                }else{
                    return $this->cancel();
                }
            break;
            case 'checkout.session.completed':
                $paymentIntentData = $event->data->object;
                $session_id = $paymentIntentData['id'];
                $payment_intent_id = $paymentIntentData['payment_intent'];
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',auth()->user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                if (isset($exists) && $exists > 0) {
                    $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);
                    $paymentdetail= $stripe->charges->retrieve($payment_intent->latest_charge , []);
                    if($paymentIntentData['status'] == 'complete'){
                        $payment_status = '0';
                    }else{
                        $payment_status = '1';
                    }
                    $paymentData = DB::table('payments')
                    ->where('session_id',$session_id)
                    ->where('status','1')
                    ->latest()
                    ->get();
                             
                    foreach($paymentData as $key => $payment){

                        $carbonDate = Carbon::now();
                        $formattedDate = $carbonDate->format('Y-m-d');
                        $currentDate = Carbon::parse($formattedDate);
                        $addedDays = 0;
                        while ($addedDays < 7) {
                            $currentDate->addDay();
                            if ($currentDate->isWeekday()) {
                                $addedDays++;
                            }
                        }
                        $where = ['id' => $payment->id];
                        $transaction = '';
                        $type = '';
                        $brand = '';
                        $exp_month = '';
                        $exp_year = '';
                        if($paymentdetail->balance_transaction){
                            $transaction = $paymentdetail->balance_transaction;
                        }
                        if($paymentdetail->payment_method_details->type){
                            $type = $paymentdetail->payment_method_details->type;
                        }
                        if($paymentdetail->payment_method_details->card->brand){
                            $brand = $paymentdetail->payment_method_details->card->brand;
                        }
                        if($paymentdetail->payment_method_details->card->exp_month){
                            $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                        }
                        if($paymentdetail->payment_method_details->card->exp_year){
                            $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                        }
                        $select = [
                            'status' => $payment_status,
                            'transaction_id' => $transaction,
                            'payment_type' => $type,
                            'card_type' => $brand,
                            'exp_month' => $exp_month,
                            'exp_year' => $exp_year,
                            'payment_intent_id' => $payment_intent_id,
                            'payment_status' => '0',
                            'pay_date' => $formattedDate,
                            'hold_date' => $currentDate->toDateString()

                        ];  

                        $updatePayment = processData(['payments', 'id'], $select, $where);

                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $whereOrder = ['payment_id' => $payment->id ];
                            $select = [
                                'status' => '0',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                        }

                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            $where = ['id' => $payment->user_id, 'roll_no' => null];
                            $select = ['roll_no'  => "E" . date("YmdHis")];
                            $exists = is_exist('users', $where);
                            if (isset($exists) && $exists > 0) {
                                $addUserRollNumber = processData(['users','id'], $select, $where);
                            }

                            $OrderData = DB::table('orders')
                                        ->select('course_id','course_price','promo_code_discount')
                                        ->where('payment_id', $payment->id)
                                        ->first();

                            $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                            $exists = is_exist('cart', $where);
                            if (isset($exists) && $exists > 0) {
                                DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                            }

                            $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                            $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                            $preference_status = '1';
                            $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                            if(count($existOptionalCourse) > 0){
                                $preference_status = '0';
                            } 
                            $select = [
                                'user_id' => $payment->user_id,
                                'course_id' => $OrderData->course_id,
                                'payment_id'=>$payment->id,
                                'purchased_on' => $this->time,
                                'created_by' => $payment->user_id,
                                'created_at' => $this->time,
                                'course_start_date' => now()->format('Y-m-d'),
                                'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                'payment_method'=>$paymentMethodData[0]->id,
                                'preference_status' => $preference_status
                            ];
                            $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                            $studentCourseMaster = DB::table('student_course_master')
                                ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                ->where('student_course_master.user_id', $payment->user_id)
                                ->where('student_course_master.course_id', $OrderData->course_id)
                                ->first();
                                            
                                    
                            $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                            $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                            $receiptLink = route('receipt', [
                                'id' => base64_encode($payment->id), 
                                'action' => base64_encode('receipt')
                            ]);

                            $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                            $CoursePrice = $OrderData->course_price;
                            if($OrderData->promo_code_discount){
                                $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                            }
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                            mail_send(
                                31,
                                [
                                    '#Name#',
                                    '#XXXXXXXXXX#',
                                    '#DD/MM/YYYY#',
                                    '#amount#',
                                    '#Course Name#',
                                    '#Receipt Link#',
                                    '#unsubscribeRoute#',
                                ],
                                [
                                    $student->name . " " . $student->last_name,
                                    $payment->transaction_id,
                                    Carbon::parse($payment->created_at)->format('Y-m-d'),
                                    $CoursePrice,
                                    $studentCourseMaster->course_title,
                                    $receiptLink,
                                    $unsubscribeRoute
                                ],
                                $recipients
                            );

                            if($ementor){
                                
                                if ($studentCourseMaster) {
                                    $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                } else {
                                    $base64EncodedCourseId = null;
                                }
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    46,
                                    [
                                        '#E-mentor Name#',
                                        '#studentName#',
                                        '#Course Name#',
                                        '#Start Date#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $student->name." ".$student->last_name,
                                        $studentCourseMaster->course_title,
                                        Carbon::parse($payment->created_at)->format('Y-m-d'),
                                        $ementorunsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }
                                    
                    }

                    return $this->success();
                }else{
                    return $this->cancel();
                }
            break;
            case 'checkout.session.async_payment_failed':
                $paymentIntent = $event->data->object;
                $session_id = session('checkout_session_id');
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',auth()->user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                
                if (isset($exists) && $exists > 0) {
                    $where = ['session_id' => $session_id];
                    $select = [
                        'status' => '2',
                        'payment_status'=>'1'
                    ];
                    $updatePayment = processData(['payments', 'id'], $select,$where);
                }
                return $this->cancel();

            case 'checkout.session.expired':

                $paymentIntent = $event->data->object;
                $session_id = session('checkout_session_id');
                if($session_id == ''){
                    $paymentDataSessionId = DB::table('payments')->where('user_id',auth()->user()->id)->where('status','1')->orderBy('id','desc')->latest()->first();
                    $session_id = $paymentDataSessionId->session_id;
                }
                $where = ['session_id' => $session_id,'status'=>'1'];
                $exists = is_exist('payments', $where);
                
                if (isset($exists) && $exists > 0) {
                    $where = ['session_id' => $session_id];
                    $select = [
                        'status' => '2',
                        'payment_status'=>'1'
                    ];
                    $updatePayment = processData(['payments', 'id'], $select,$where);
                }
                return $this->cancel();
            default:
                Log::warning('Unhandled event type', ['type' => $event->type]);
                return response()->json(['error' => 'Unhandled event type'], 400);
        }

        return response('', 200);
    }
    public function processCallback(Request $request,$unique_callback_id)
    {
        // Log the incoming request for debugging
        Log::info('Callback received', $request->all());
        
        $callbackData = $request->all();   
        $eventType = $callbackData['event_type'] ?? null;
        $status = $callbackData['data']['status'] ?? null;

        // Get additional data fields
        $paymentId = $callbackData['data']['payment_id'] ?? null;
        $amountFrom = $callbackData['data']['amount_from'] ?? null;
        $currencyFrom = $callbackData['data']['currency_from'] ?? null;
        $amountTo = $callbackData['data']['amount_to'] ?? null;
        $currencyTo = $callbackData['data']['currency_to'] ?? null;
        $reason = $callbackData['data']['reason'] ?? null;
        $clientReason = $callbackData['data']['client_reason'] ?? null;
        $studentFirstName = $callbackData['data']['fields']['student_first_name'] ?? null;
        $studentLastName = $callbackData['data']['fields']['student_last_name'] ?? null;
        $studentEmail = $callbackData['data']['fields']['student_email'] ?? null;
        $passportNumber = $callbackData['data']['fields']['passport_number'] ?? null;

        $session_id = session('checkout_session_id');

        Log::info("session_id: $session_id");

        // Log the extracted data for debugging
        Log::info("Event Type: $eventType");
        Log::info("Status: $status");
        Log::info("Payment ID: $paymentId");
        Log::info("Amount From: $amountFrom $currencyFrom");
        Log::info("Amount To: $amountTo $currencyTo");
        Log::info("Reason: $reason");
        Log::info("Client Reason: $clientReason");
        Log::info("Student: $studentFirstName $studentLastName, Email: $studentEmail, Passport: $passportNumber");
        Log::info("unique_callback_id: $unique_callback_id");
        // $updatePayments = DB::table('payments')->where($where)->update(['session_id'=>$paymentId]);
        $status = $callbackData['data']['status'];
        $checkoutSessionId = $paymentId;

        $where = ['session_id' => $unique_callback_id,'status'=>'1'];
        $exists = is_exist('payments', $where);
        if (isset($exists) && $exists > 0) {
            try{

                switch ($eventType) {
                    case 'initiated':
                        Log::info("Event Type: $eventType");
                        Log::info('Payment Initiated', $request->all());

                        break;
                    case 'processed':
                        Log::info("Event Type: $eventType");
                        Log::info('Payment Processed', $request->all());
    
                        break;
                    case 'guaranteed':
                        Log::info("Event Type: $eventType");
                        Log::info('Payment Guaranteed', $request->all());
                        $paymentData = DB::table('payments')
                        ->where('session_id',$unique_callback_id)
                        ->where('status','1')
                        ->latest()
                        ->get();
                                    
                            foreach($paymentData as $key => $payment){

                                $carbonDate = Carbon::now();
                                $formattedDate = $carbonDate->format('Y-m-d');
                                $currentDate = Carbon::parse($formattedDate);
                                $addedDays = 0;
                                while ($addedDays < 7) {
                                    $currentDate->addDay();
                                    if ($currentDate->isWeekday()) {
                                        $addedDays++;
                                    }
                                }
                                $transaction = '';
                                $type = '';
                                $brand = '';
                                $exp_month = '';
                                $exp_year = '';

                                $paymentMethod = $callbackData['data']['payment_method'];
                                // $cardExpiration = $paymentMethod['card_expiration'];
                                // $cardExpirationEx =  explode('/', $cardExpiration);

                                    $transaction = '';
                                
                                if($paymentMethod['type']){
                                    $type = $paymentMethod['type'];
                                }
                                // if($paymentMethod['brand']){
                                //     $brand = $paymentMethod['brand'];
                                // }
                                // if($cardExpiration){
                                //     $exp_month = $cardExpiration[0];
                                // }
                                // if($cardExpiration){
                                //     $exp_year = $cardExpirationEx[1];
                                // }
                                $where = ['id' => $payment->id];
                                $select = [
                                    'status' => '0',
                                    'transaction_id' => $transaction,
                                    'payment_type' => $type,
                                    'card_type' => $brand,
                                    'exp_month' => $exp_month,
                                    'exp_year' => $exp_year,
                                    'payment_intent_id' => $paymentId,
                                    'payment_status' => '0',
                                    'pay_date' => $formattedDate,
                                    'hold_date' => $currentDate->toDateString()

                                ];  

                                $updatePayment = processData(['payments', 'id'], $select, $where);

                                if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                                    $whereOrder = ['payment_id' => $payment->id ];
                                    $select = [
                                        'status' => '0',
                                    ];
                                    $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                                }

                                if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                                    $where = ['id' => $payment->user_id, 'roll_no' => null];
                                    $select = ['roll_no'  => "E" . date("YmdHis")];
                                    $exists = is_exist('users', $where);
                                    if (isset($exists) && $exists > 0) {
                                        $addUserRollNumber = processData(['users','id'], $select, $where);
                                    }

                                    $OrderData = DB::table('orders')
                                                ->select('course_id','course_price','promo_code_discount')
                                                ->where('payment_id', $payment->id)
                                                ->first();

                                    $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                                    $exists = is_exist('cart', $where);
                                    if (isset($exists) && $exists > 0) {
                                        DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                                    }

                                    $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                                    $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                                    $preference_status = '1';
                                    $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                                    if(count($existOptionalCourse) > 0){
                                        $preference_status = '0';
                                    } 
                                    $select = [
                                        'user_id' => $payment->user_id,
                                        'course_id' => $OrderData->course_id,
                                        'payment_id'=>$payment->id,
                                        'purchased_on' => $this->time,
                                        'created_by' => $payment->user_id,
                                        'created_at' => $this->time,
                                        'course_start_date' => now()->format('Y-m-d'),
                                        'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                        'payment_method'=>$paymentMethodData[0]->id,
                                        'preference_status'=>$preference_status
                                    ];
                                    $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                                
                                    $studentCourseMaster = DB::table('student_course_master')
                                        ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                        ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                        ->where('student_course_master.user_id', $payment->user_id)
                                        ->where('student_course_master.course_id', $OrderData->course_id)
                                        ->first();
                                                    
                                            
                                    $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                                    $student = DB::table('users')->where('id', $payment->user_id)->first();
                                    

                                    $receiptLink = route('receipt', [
                                        'id' => base64_encode($payment->id), 
                                        'action' => base64_encode('receipt')
                                    ]);

                                    $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                                    $CoursePrice = $OrderData->course_price;
                                    if($OrderData->promo_code_discount){
                                        $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                                    }
                                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                                    mail_send(
                                        31,
                                        [
                                            '#Name#',
                                            '#XXXXXXXXXX#',
                                            '#DD/MM/YYYY#',
                                            '#amount#',
                                            '#Course Name#',
                                            '#Receipt Link#',
                                            '#unsubscribeRoute#',
                                        ],
                                        [
                                            $student->name . " " . $student->last_name,
                                            $payment->transaction_id,
                                            Carbon::parse($payment->created_at)->format('Y-m-d'),
                                            $CoursePrice,
                                            $studentCourseMaster->course_title,
                                            $receiptLink,
                                            $unsubscribeRoute
                                        ],
                                        $recipients
                                    );
                                    if ((request()->getHost() === 'www.eascencia.mt')) {
                                        $email = 'claire@ascenciamalta.mt';
                                        $ccEmail = 'info@eascencia.mt';
                                    }else{
                                        $email = 'chetan@angel-portal.com';
                                        $ccEmail = 'ankita@angel-portal.com';
                                    }
                                    $status = "<span class='badge text-bg-success'>Success</span>";
                                    mail_send(
                                        62,
                                        [
                                            '#user#',
                                            '#amount#',
                                            '#course_name#',
                                            '#status#',
                                            '#subjectemail#',
                                            '#emailpng_url#'
                                            
                                        ],
                                        [
                                            $student->name . ' ' . $student->last_name,
                                            $CoursePrice,
                                            $studentCourseMaster->course_title,
                                            $status,
                                            'Success',
                                            'https://www.eascencia.mt/frontend/images/email/paymentsuccess.png'
                                        ],
                                        $email, $ccEmail
                                    );

                                    if($ementor){
                                        
                                        if ($studentCourseMaster) {
                                            $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                        } else {
                                            $base64EncodedCourseId = null;
                                        }
                                        $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                        mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                        $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                        mail_send(
                                            46,
                                            [
                                                '#E-mentor Name#',
                                                '#studentName#',
                                                '#Course Name#',
                                                '#Start Date#',
                                                '#unsubscribeRoute#',
                                            ],
                                            [
                                                $ementor->name . " " . $ementor->last_name,
                                                $student->name." ".$student->last_name,
                                                $studentCourseMaster->course_title,
                                                Carbon::parse($payment->created_at)->format('Y-m-d'),
                                                $ementorunsubscribeRoute
                                            ],
                                            $ementor->email
                                        );
                                    }
                                }
                            }
                            return $this->success();
                        break;
                    case 'delivered':
           
                        $paymentData = DB::table('payments')
                        ->where('session_id',$unique_callback_id)
                        ->where('status','1')
                        ->latest()
                        ->get();
                                    
                            foreach($paymentData as $key => $payment){

                                $carbonDate = Carbon::now();
                                $formattedDate = $carbonDate->format('Y-m-d');
                                $currentDate = Carbon::parse($formattedDate);
                                $addedDays = 0;
                                while ($addedDays < 7) {
                                    $currentDate->addDay();
                                    if ($currentDate->isWeekday()) {
                                        $addedDays++;
                                    }
                                }
                                $transaction = '';
                                $type = '';
                                $brand = '';
                                $exp_month = '';
                                $exp_year = '';

                                $paymentMethod = $callbackData['data']['payment_method'];
                                // $cardExpiration = $paymentMethod['card_expiration'];
                                // $cardExpirationEx =  explode('/', $cardExpiration);

                                    $transaction = '';
                                
                                if($paymentMethod['type']){
                                    $type = $paymentMethod['type'];
                                }
                                // if($paymentMethod['brand']){
                                //     $brand = $paymentMethod['brand'];
                                // }
                                // if($cardExpiration){
                                //     $exp_month = $cardExpiration[0];
                                // }
                                // if($cardExpiration){
                                //     $exp_year = $cardExpirationEx[1];
                                // }
                                $where = ['id' => $payment->id];
                                $select = [
                                    'status' => '0',
                                    'transaction_id' => $transaction,
                                    'payment_type' => $type,
                                    'card_type' => $brand,
                                    'exp_month' => $exp_month,
                                    'exp_year' => $exp_year,
                                    'payment_intent_id' => $paymentId,
                                    'payment_status' => '0',
                                    'pay_date' => $formattedDate,
                                    'hold_date' => $currentDate->toDateString()

                                ];  

                                $updatePayment = processData(['payments', 'id'], $select, $where);

                                if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                                    $whereOrder = ['payment_id' => $payment->id ];
                                    $select = [
                                        'status' => '0',
                                    ];
                                    $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                                }

                                if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                                    $where = ['id' => $payment->user_id, 'roll_no' => null];
                                    $select = ['roll_no'  => "E" . date("YmdHis")];
                                    $exists = is_exist('users', $where);
                                    if (isset($exists) && $exists > 0) {
                                        $addUserRollNumber = processData(['users','id'], $select, $where);
                                    }

                                    $OrderData = DB::table('orders')
                                                ->select('course_id','course_price','promo_code_discount')
                                                ->where('payment_id', $payment->id)
                                                ->first();

                                    $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                                    $exists = is_exist('cart', $where);
                                    if (isset($exists) && $exists > 0) {
                                        DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                                    }

                                    $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                                    $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                                    $preference_status = '1';
                                    $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                                    if(count($existOptionalCourse) > 0){
                                        $preference_status = '0';
                                    } 
                                    $select = [
                                        'user_id' => $payment->user_id,
                                        'course_id' => $OrderData->course_id,
                                        'payment_id'=>$payment->id,
                                        'purchased_on' => $this->time,
                                        'created_by' => $payment->user_id,
                                        'created_at' => $this->time,
                                        'course_start_date' => now()->format('Y-m-d'),
                                        'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                                        'payment_method'=>$paymentMethodData[0]->id,
                                        'preference_status' => $preference_status
                                    ];
                                    $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                                
                                    $studentCourseMaster = DB::table('student_course_master')
                                        ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                                        ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                                        ->where('student_course_master.user_id', $payment->user_id)
                                        ->where('student_course_master.course_id', $OrderData->course_id)
                                        ->first();
                                                    
                                            
                                    $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                                    $student = DB::table('users')->where('id', $payment->user_id)->first();
                                    

                                    $receiptLink = route('receipt', [
                                        'id' => base64_encode($payment->id), 
                                        'action' => base64_encode('receipt')
                                    ]);

                                    $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                                    $CoursePrice = $OrderData->course_price;
                                    if($OrderData->promo_code_discount){
                                        $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                                    }
                                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                                    mail_send(
                                        31,
                                        [
                                            '#Name#',
                                            '#XXXXXXXXXX#',
                                            '#DD/MM/YYYY#',
                                            '#amount#',
                                            '#Course Name#',
                                            '#Receipt Link#',
                                            '#unsubscribeRoute#',
                                        ],
                                        [
                                            $student->name . " " . $student->last_name,
                                            $payment->transaction_id,
                                            Carbon::parse($payment->created_at)->format('Y-m-d'),
                                            $CoursePrice,
                                            $studentCourseMaster->course_title,
                                            $receiptLink,
                                            $unsubscribeRoute
                                        ],
                                        $recipients
                                    );

                                    if($ementor){
                                        
                                        if ($studentCourseMaster) {
                                            $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                                        } else {
                                            $base64EncodedCourseId = null;
                                        }
                                        $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                                        mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                                        $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                        mail_send(
                                            46,
                                            [
                                                '#E-mentor Name#',
                                                '#studentName#',
                                                '#Course Name#',
                                                '#Start Date#',
                                                '#unsubscribeRoute#',
                                            ],
                                            [
                                                $ementor->name . " " . $ementor->last_name,
                                                $student->name." ".$student->last_name,
                                                $studentCourseMaster->course_title,
                                                Carbon::parse($payment->created_at)->format('Y-m-d'),
                                                $ementorunsubscribeRoute
                                            ],
                                            $ementor->email
                                        );
                                    }
                                }
                            }
                            // return view('frontend.payment.payment-successful', compact('checkoutSessionId'));
                            return $this->success();
                            
                        break;
                    case 'failed':
                        // Log::info('Payment Failed', $request->all());
                        Log::error('Failed to update payment or order status for failed payment.');
                        // return redirect()->route('payment-unsuccessful');
                        return $this->success();

                        break;
                    case 'cancelled':
                        $where = ['session_id' => $unique_callback_id];
                        $select = [
                            'status' => '1',
                            'payment_status'=>'1'
                        ];
                        $updatePayment = processData(['payments', 'id'], $select,$where);
                        if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                            $select = [
                                'status' => '1',
                            ];
                            $updateOrder = processData(['orders', 'id'], $select,$where);
                        }
                        if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                            return redirect()->route('payment-unsuccessful');

                        }
                        Log::error('Failed to update payment or order status for cancelled payment.');
                        return $this->success();
                       
                        break;
                    default:
                        Log::info("Unknown Event Type: $eventType");
                        break;
                }
            
            } catch (\Exception $e) {
                // Handle the exception and log the error message
                \Log::error("Payment processing error: " . $e->getMessage());
                return view('frontend.payment.payment-unsuccessful', ['message' => $e->getMessage()]);
            }
        }
        // // Validate incoming data
        // $validatedData = $request->validate([
        //     'event_type' => 'required|string',
        //     'data.payment_id' => 'required|string',
        //     'data.status' => 'required|string',
        //     'data.amount_from' => 'required|numeric',
        //     // Add more validation rules as needed
        // ]);

        // // Find the payment record by payment ID
        // $paymentId = $validatedData['data']['payment_id'];
        // $payment = Payment::where('payment_id', $paymentId)->first();

        // if (!$payment) {
        //     return response()->json(['message' => 'Payment not found'], 404);
        // }

        // // Update the payment record with the callback data
        // $payment->amount_from = $validatedData['data']['amount_from'];
        // $payment->status = $validatedData['data']['status'];
        // // Optionally save other relevant fields
        // // $payment->currency_from = $validatedData['data']['currency_from']; // Add this if needed
        // // $payment->currency_to = $validatedData['data']['currency_to']; // Add this if needed
        // $payment->pay_url = $validatedData['data']['payment_url'] ?? null; // If available in the response
        // $payment->save();

        // // Return a response to acknowledge receipt
        // return response()->json(['message' => 'Callback processed successfully'], 200);
    }

    // public function success()
    // {
        
    //     $checkoutSessionId = session('checkout_session_id');
    //     if ($checkoutSessionId) {
    //         try {
    //             $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //             $session =  $stripe->checkout->sessions->retrieve(
    //                 $checkoutSessionId,
    //                 []
    //             );

    //             if (!$session) {
    //                 return view('frontend.payment.payment-unsuccessful', ['message' => 'Invalid Session ID']);
    //             }

                
    //             $where = ['session_id' => $checkoutSessionId,'status'=>'0'];
    //             $exists = is_exist('payments', $where);

    //             $paymentData = getData('payments', ['id'], $where);

    //             // $whereCourse = ['payment_id' => $paymentData[0]->id];
    //             // $existsCourse = is_exist('student_course_master', $whereCourse);

    //             // if (isset($exists) && $exists > 0 && isset($existsCourse) && $existsCourse > 0 ) {
    //             //     return view('frontend.payment.payment-successful',compact('checkoutSessionId'));
    //             // }else{
    //             //     return view('frontend.payment.payment-unsuccessful');

    //             // }
               
    //             $payment = DB::table('payments')
    //                 ->where(['session_id' => $checkoutSessionId])
    //                 ->whereIn('status', ['0', '1'])
    //                 ->first();
    //             if (!$payment) {

    //                 return view('frontend.payment.payment-unsuccessful');
    //             }
    //             if ($payment->status === '1') {
    //                 $UpdateOrder = $this->updateOrderAndSession($checkoutSessionId);
    //                 $updateOrderJson = json_decode($UpdateOrder);
    //                 $updateOrderStatus = $updateOrderJson->code;
    //                 if ($updateOrderStatus == 200) {
                       
    //                     $paymentData = DB::table('payments')
    //                         ->select('id', 'transaction_id', 'created_at', 'total_amount')
    //                         ->where('user_id', Auth::user()->id)
    //                         ->where('session_id',$checkoutSessionId)
    //                         ->latest()
    //                         ->get();
                                
    //                     $where = ['id' => Auth::user()->id, 'roll_no' => null];
    //                     $select = ['roll_no'  => "E" . date("YmdHis")];
    //                     $exists = is_exist('users', $where);
    //                     if (isset($exists) && $exists > 0) {
    //                         $addUserRollNumber = processData(['users','id'], $select, $where);
    //                     }

    //                     foreach($paymentData as $key => $payment){

    //                         $OrderData = DB::table('orders')
    //                             ->select('course_id')
    //                             ->where('payment_id', $payment->id)
    //                             ->first();

    //                             $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                            
    //                             $select = [
    //                                 'user_id' => auth()->user()->id,
    //                                 'course_id' => $OrderData->course_id,
    //                                 'payment_id'=>$payment->id,
    //                                 'purchased_on' => $this->time,
    //                                 'created_by' => auth()->user()->id,
    //                                 'created_at' => $this->time,
    //                                 'course_start_date' => now()->format('Y-m-d'),
    //                                 'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d')
    //                             ];
    //                             $courseMasterData = processData(['student_course_master', 'id'], $select, []);

    //                             // DB::table('student_course_master')
    //                             // ->where('user_id', Auth::user()->id)
    //                             // ->where('course_id', $OrderData->course_id)
    //                             // ->latest()
    //                             // ->limit(1)
    //                             // ->update([
    //                             //     'course_start_date' => now()->format('Y-m-d'),
    //                             //     'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
    //                             // ]); 

    //                             // $whereStudentExist = [
    //                             //     'user_id' => Auth::user()->id,
    //                             //     'course_id' => $OrderData->course_id
    //                             // ];
                                
    //                             // // Check if the record exists with empty `course_start_date` and `course_expired_on`
    //                             // $masterExists = DB::table('student_course_master')
    //                             //     ->where($whereStudentExist)
    //                             //     ->where(function($query) {
    //                             //         $query->whereNull('course_start_date')
    //                             //               ->orWhere('course_start_date', '')
    //                             //               ->whereNull('course_expired_on')
    //                             //               ->orWhere('course_expired_on', '');
    //                             //     })
    //                             //     ->exists();
                                
    //                             // if ($masterExists) {
    //                             //     // Delete the record
    //                             //     DB::table('student_course_master')
    //                             //         ->where($whereStudentExist)
    //                             //         ->where(function($query) {
    //                             //             $query->whereNull('course_start_date')
    //                             //                   ->orWhere('course_start_date', '')
    //                             //                   ->whereNull('course_expired_on')
    //                             //                   ->orWhere('course_expired_on', '');
    //                             //         })
    //                             //         ->delete();
    //                             // }
                                
    //                             $studentCourseMaster = DB::table('student_course_master')
    //                                 ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
    //                                 ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
    //                                 ->where('student_course_master.user_id', Auth::user()->id)
    //                                 ->where('student_course_master.course_id', $OrderData->course_id)
    //                                 ->first();
                                    
                            
    //                             $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
    //                             $student = DB::table('users')->where('id', Auth::user()->id)->first();
                                

    //                             $receiptLink = route('receipt', [
    //                                 'id' => base64_encode($payment->id), 
    //                                 'action' => base64_encode('receipt')
    //                             ]);

    //                             $recipients = [Auth::user()->email, env('RECIPIENT_EMAIL')];
                                
    //                             $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
    //                             mail_send(
    //                                 31,
    //                                 [
    //                                     '#Name#',
    //                                     '#XXXXXXXXXX#',
    //                                     '#DD/MM/YYYY#',
    //                                     '#amount#',
    //                                     '#Course Name#',
    //                                     '#Receipt Link#',
    //                                     '#unsubscribeRoute#',
    //                                 ],
    //                                 [
    //                                     Auth::user()->name . " " . Auth::user()->last_name,
    //                                     $payment->transaction_id,
    //                                     Carbon::parse($payment->created_at)->format('Y-m-d'),
    //                                     $payment->total_amount,
    //                                     $studentCourseMaster->course_title,
    //                                     $receiptLink,
    //                                     $unsubscribeRoute
    //                                 ],
    //                                 $recipients
    //                             );

    //                             if($ementor){
                                    
    //                                 if ($studentCourseMaster) {
    //                                     $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
    //                                 } else {
    //                                     $base64EncodedCourseId = null;
    //                                 }
    //                                 $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                
    //                                 mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);
    //                             }
                        
                    
                        
    //                 }
                    
    //                 return view('frontend.payment.payment-successful', compact('checkoutSessionId'));
    //             } else {
    //                 $where = ['id' => $payment->id];
    //                 $select = [
    //                     'status' => "1",
    //                 ];
    //                 $updatePayment = processData(['payments', 'id'], $select, $where);
    //                 $where = ['session_id' => $checkoutSessionId];
    //                 return view('frontend.payment.payment-unsuccessful');
    //             }
    //             }
    //         } catch (NotFoundHttpException $e) {
    //             throw $e;
    //         } catch (\Exception $e) {
    //             return view('frontend.payment.payment-unsuccessful', ['message' => $e->getMessage()]);
    //         }
    //     } else {
    //         return view('frontend.payment.payment-unsuccessful');
    //     }
    // }
    public function success($checkoutSessionIds)
    {

        $checkoutSessionId = session('checkout_session_id');
        Log::info("SESSION VLAUE TEST: $checkoutSessionId");

        if ($checkoutSessionId) {
            try {

                Log::info("SESSION VLAUE TEST CHECK: $checkoutSessionId");
                
                // Live

                $where = ['session_id' => $checkoutSessionId,'status'=>'0'];
                $exists = is_exist('payments', $where);

                $paymentData = getData('payments', ['id'], $where);
                $whereCourse = ['payment_id' => $paymentData[0]->id];
                $existsCourse = is_exist('student_course_master', $whereCourse);
                    Log::error('payment successful');

                if (isset($exists) && $exists > 0 && isset($existsCourse) && $existsCourse > 0 ) {

                    Log::error('payment successful direct');

                    $dashboardController = new DashboardController();
                    $dashboardData = $dashboardController->getDashboardData();

                    return view('frontend.payment.payment-successful', compact('checkoutSessionId'));
                    
                }else{

                    Log::error('payment unsuccessful');

                    return view('frontend.payment.payment-unsuccessful');

                }
                
                // local

                // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                // $session =  $stripe->checkout->sessions->retrieve(
                //     $checkoutSessionId,
                //     []
                // );
                // if (!$session) {
                //     Log::error('page unsuccessful');

                //     return view('frontend.payment.payment-unsuccessful', ['message' => 'Invalid Session ID']);
                // }
                // $where = ['session_id' => $checkoutSessionId,'status'=>'0'];
                // $exists = is_exist('payments', $where);

                // $paymentData = getData('payments', ['id'], $where);
                // $existsCourse ='';
                // if(!empty($paymentData) && isset($paymentData) && count($paymentData) > 0){

                //     $whereCourse = ['payment_id' => $paymentData[0]->id];
                //     $existsCourse = is_exist('student_course_master', $whereCourse);
                // }

                // if (isset($exists) && $exists > 0 && isset($existsCourse) && $existsCourse > 0 ) {
                    
                //     $dashboardController = new DashboardController();
                //     $dashboardData = $dashboardController->getDashboardData();

                //     return view('frontend.payment.payment-successful', compact('checkoutSessionId'));

                // }else{
                 
                //     $where = ['session_id' => $checkoutSessionId,'status'=>'1'];

                //     $exists = is_exist('payments', $where);

                //     $paymentData = getData('payments', ['id'], $where);

                //     $payment_intent_id = $session->payment_intent;
                    
                //     // Retrieve the payment intent to access its associated events
                //     $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);


                //     $paymentdetail = $stripe->charges->retrieve($payment_intent->latest_charge, []);
                //     if ($paymentdetail->status == 'succeeded') {
                //         $payment_status = '0';
                //     } else {
                //         $payment_status = '1';
                //     }
                    
                //     $paymentData = DB::table('payments')
                //         ->where('session_id',$checkoutSessionId)
                //         ->where('status','1')
                //         ->latest()
                //         ->get();
            
                //     foreach($paymentData as $key => $payment){

                //         $carbonDate = Carbon::now();
                //         $formattedDate = $carbonDate->format('Y-m-d');
                //         $currentDate = Carbon::parse($formattedDate);
                //         $addedDays = 0;
                //         while ($addedDays < 7) {
                //             $currentDate->addDay();
                //             if ($currentDate->isWeekday()) {
                //                 $addedDays++;
                //             }
                //         }
                //         $where = ['id' => $payment->id];
                //         $transaction = '';
                //         $type = '';
                //         $brand = '';
                //         $exp_month = '';
                //         $exp_year = '';
                //         if($paymentdetail->balance_transaction){
                //             $transaction = $paymentdetail->balance_transaction;
                //         }
                //         if($paymentdetail->payment_method_details->type){
                //             $type = $paymentdetail->payment_method_details->type;
                //         }
                //         if($paymentdetail->payment_method_details->card->brand){
                //             $brand = $paymentdetail->payment_method_details->card->brand;
                //         }
                //         if($paymentdetail->payment_method_details->card->exp_month){
                //             $exp_month = $paymentdetail->payment_method_details->card->exp_month;
                //         }
                //         if($paymentdetail->payment_method_details->card->exp_year){
                //             $exp_year = $paymentdetail->payment_method_details->card->exp_year;
                //         }
                //         $select = [
                //             'status' => $payment_status,
                //             'transaction_id' => $transaction,
                //             'payment_type' => $type,
                //             'card_type' => $brand,
                //             'exp_month' => $exp_month,
                //             'exp_year' => $exp_year,
                //             'payment_intent_id' => $payment_intent_id,
                //             'payment_status' => '0',
                //             'pay_date' => $formattedDate,
                //             'hold_date' => $currentDate->toDateString()

                //         ];  

                //         $updatePayment = processData(['payments', 'id'], $select, $where);

                //         if(isset($updatePayment) && $updatePayment['status'] == TRUE){
                //             $whereOrder = ['payment_id' => $payment->id ];
                //             $select = [
                //                 'status' => '0',
                //             ];
                //             $updateOrder = processData(['orders', 'id'], $select,$whereOrder);
                //         }

                //         if (isset($updateOrder) && $updateOrder['status'] == TRUE) {
                //             $where = ['id' => $payment->user_id, 'roll_no' => null];
                //             $select = ['roll_no'  => "E" . date("YmdHis")];
                //             $exists = is_exist('users', $where);
                //             if (isset($exists) && $exists > 0) {
                //                 $addUserRollNumber = processData(['users','id'], $select, $where);
                //             }

                //             $OrderData = DB::table('orders')
                //                         ->select('course_id','course_price','promo_code_discount')
                //                         ->where('payment_id', $payment->id)
                //                         ->first();

                //             $where = ['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id,'status'=>'Active','is_by'=>'1'];
                //             $exists = is_exist('cart', $where);

                //             if (isset($exists) && $exists > 0) {
                //                 DB::table('cart')->where(['course_id' => $OrderData->course_id,'student_id'=> $payment->user_id])->update(['is_by' => '0','status'=>'Inactive']);
                //             }

                //             $CourseMaster = DB::table('course_master')->select('duration_month')->where('id', $OrderData->course_id)->first();
                //             $paymentMethodData = getData('payment_methods', ['id'],['status'=>'0']);
                //             $preference_status = '1';
                //             $existOptionalCourse = getData('master_course_management',['optional_course_id'],['award_id'=>$OrderData->course_id,['optional_course_id','!=','']],'','','asc');
                //             if(count($existOptionalCourse) > 0){
                //                 $preference_status = '0';
                //             } 
                //             $select = [
                //                 'user_id' => $payment->user_id,
                //                 'course_id' => $OrderData->course_id,
                //                 'payment_id'=>$payment->id,
                //                 'purchased_on' => $this->time,
                //                 'created_by' => $payment->user_id,
                //                 'created_at' => $this->time,
                //                 'course_start_date' => now()->format('Y-m-d'),
                //                 'course_expired_on' => Carbon::now()->addMonths($CourseMaster->duration_month)->format('Y-m-d'),
                //                 'payment_method'=> $paymentMethodData[0]->id,
                //                 'preference_status'=>$preference_status
                //             ];
                //             $courseMasterData = processData(['student_course_master', 'id'], $select, []);

                                        
                //             $studentCourseMaster = DB::table('student_course_master')
                //                 ->select('course_master.course_title','course_master.id','student_course_master.id as student_course_id','course_master.duration_month','course_master.ementor_id','student_course_master.course_start_date')
                //                 ->leftJoin('course_master', 'course_master.id', '=', 'student_course_master.course_id')
                //                 ->where('student_course_master.user_id', $payment->user_id)
                //                 ->where('student_course_master.course_id', $OrderData->course_id)
                //                 ->first();
                                            
                                    
                //             $ementor = DB::table('users')->where('id', $studentCourseMaster->ementor_id)->first();
                //             $student = DB::table('users')->where('id', $payment->user_id)->first();
                            

                //             $receiptLink = route('receipt', [
                //                 'id' => base64_encode($payment->id), 
                //                 'action' => base64_encode('receipt')
                //             ]);

                //             $recipients = [$student->email, env('RECIPIENT_EMAIL')];
                //             $CoursePrice = $OrderData->course_price;
                //             if($OrderData->promo_code_discount){
                //                 $CoursePrice = $CoursePrice - $OrderData->promo_code_discount;
                //             }
                //             $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                //             mail_send(
                //                 31,
                //                 [
                //                     '#Name#',
                //                     '#XXXXXXXXXX#',
                //                     '#DD/MM/YYYY#',
                //                     '#amount#',
                //                     '#Course Name#',
                //                     '#Receipt Link#',
                //                     '#unsubscribeRoute#',
                //                 ],
                //                 [
                //                     $student->name . " " . $student->last_name,
                //                     $payment->transaction_id,
                //                     Carbon::parse($payment->created_at)->format('Y-m-d'),
                //                     $CoursePrice,
                //                     $studentCourseMaster->course_title,
                //                     $receiptLink,
                //                     $unsubscribeRoute
                //                 ],
                //                 $recipients
                //             );
                //             $status = "<span class='badge text-bg-success'>Success</span>";
                //             if ((request()->getHost() === 'www.eascencia.mt')) {
                //                 $email = 'claire@ascenciamalta.mt';
                //                 $ccEmail = 'info@eascencia.mt';
                //             }else{
                //                 $email = 'chetan@angel-portal.com';
                //                 $ccEmail = 'ankita@angel-portal.com';
                //             }
                //             mail_send(
                //                 62,
                //                 [
                //                     '#user#',
                //                     '#amount#',
                //                     '#course_name#',
                //                     '#status#',
                //                     '#subjectemail#',
                //                     '#emailpng_url#'
                //                 ],
                //                 [
                //                     $student->name . ' ' . $student->last_name,
                //                     $CoursePrice,
                //                     $studentCourseMaster->course_title,
                //                     $status,
                //                     'Success',
                //                     'https://www.eascencia.mt/frontend/images/email/paymentsuccess.png'
                //                     
                //                 ],
                //                 $email, $ccEmail
                //             );
                //             if($ementor){
                                
                //                 if ($studentCourseMaster) {
                //                     $base64EncodedCourseId = base64_encode($studentCourseMaster->id);
                //                 } else {
                //                     $base64EncodedCourseId = null;
                //                 }
                //                 $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));

                //                 mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $studentCourseMaster->course_title, $studentCourseMaster->duration_month, $studentCourseMaster->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $student->email);

                //                 $ementorunsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                
                //                     mail_send(
                //                         46,
                //                         [
                //                             '#E-mentor Name#',
                //                             '#studentName#',
                //                             '#Course Name#',
                //                             '#Start Date#',
                //                             '#unsubscribeRoute#',
                //                         ],
                //                         [
                //                             $ementor->name . " " . $ementor->last_name,
                //                             $student->name." ".$student->last_name,
                //                             $studentCourseMaster->course_title,
                //                             Carbon::parse($payment->created_at)->format('Y-m-d'),
                //                             $ementorunsubscribeRoute
                //                         ],
                //                         $ementor->email
                //                     );
                //             }
                //         }
                                    
                //     }
                // // if($checkoutSessionIds){
                // //      $studentId = isset(Auth::user()->id) ? Auth::user()->id : 0;
                // //      if (Auth::check() && !empty($studentId) && $studentId != 0) {
                // //          $InvoiceData = DB::table('payments')->where('user_id',$studentId)->orderBy('id','desc')->get();
                // //          $studentData = $this->userProfile->getCurrentUserProfile();
            
                // //          return view('frontend.student.student-invoice', compact('InvoiceData','studentData'));
                // //      }else{
                // //           return view('frontend.payment.payment-unsuccessful');
                // //     }
                // // }else{
                // //     $dashboardController = new DashboardController();
                // //     $dashboardData = $dashboardController->getDashboardData();
                //     return view('frontend.payment.payment-successful', compact('checkoutSessionId'));
                // // }
                // }

            } catch (NotFoundHttpException $e) {
                \Log::error("Payment processing error test: " . $e);
                throw $e;
            } catch (\Exception $e) {
                \Log::error("Payment processing error: " . $e);
                return view('frontend.payment.payment-unsuccessful', ['message' => $e->getMessage()]);
            }
        } else {
            return view('frontend.payment.payment-unsuccessful');
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Get the session_id from the query parameters
        $checkoutSessionId = $request->query('checkout_session_id');
        Log::info("SESSION VLAUE: $checkoutSessionId");

        if ($checkoutSessionId) {
            try {

                $where = ['session_id' => $checkoutSessionId,'status'=>'0'];
                $exists = is_exist('payments', $where);

                $paymentData = getData('payments', ['id'], $where);
                $whereCourse = ['payment_id' => $paymentData[0]->id];
                $existsCourse = is_exist('student_course_master', $whereCourse);

                if (isset($exists) && $exists > 0 && isset($existsCourse) && $existsCourse > 0 ) {
                    return view('frontend.payment.payment-successful',compact('checkoutSessionId'));
                }else{
                    return view('frontend.payment.payment-unsuccessful');

                }

            } catch (NotFoundHttpException $e) {
                Log::error('Page Not Found');
                throw $e;
            } catch (\Exception $e) {
                Log::error('Page Not Failed');
                return view('frontend.payment.payment-unsuccessful', ['message' => $e->getMessage()]);
            }
        } else {
            return view('frontend.payment.payment-unsuccessful');
        }
    }

    public function cancel()
    {
        if (session()->has('checkout_session_id')) {
            session()->forget('checkout_session_id');
        }
        return view('frontend.payment.payment-unsuccessful');
    }
    // public function updateOrderAndSession($checkoutSessionId)
    // {
    //     try {
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //         $session =  $stripe->checkout->sessions->retrieve(
    //             $checkoutSessionId,
    //             []
    //         );

    //         $payment_intent_id = $session->payment_intent;

    //         // Retrieve the payment intent to access its associated events
    //         $payment_intent = $stripe->paymentIntents->retrieve($payment_intent_id);

    //         $paymentdetail = $stripe->charges->retrieve($payment_intent->latest_charge, []);
    //         if ($paymentdetail->status == 'succeeded') {
    //             $payment_status = '0';
    //         } else {
    //             $payment_status = '1';
    //         }

    //         $carbonDate = Carbon::now();
    //         $formattedDate = $carbonDate->format('Y-m-d');
    //         $currentDate = Carbon::parse($formattedDate);
    //         $addedDays = 0;
    //         while ($addedDays < 7) {
    //             $currentDate->addDay();
    //             if ($currentDate->isWeekday()) {
    //                 $addedDays++;
    //             }
    //         }
    //         $where = ['session_id' => $checkoutSessionId];
    //         $select = [
    //             'status' => $payment_status,
    //             'transaction_id' => $paymentdetail->balance_transaction,
    //             'payment_type' => $paymentdetail->payment_method_details->type,
    //             'card_type' => $paymentdetail->payment_method_details->card->brand,
    //             'exp_month' => $paymentdetail->payment_method_details->card->exp_month,
    //             'exp_year' => $paymentdetail->payment_method_details->card->exp_year,
    //             'payment_intent_id' => $payment_intent_id,
    //             'payment_status' => '0',
    //             'pay_date' => $formattedDate,
    //             'hold_date' => $currentDate->toDateString()

    //         ];
    //         $updatePayment = processData(['payments', 'id'], $select, $where);

    //         $updatePayments = DB::table('payments')->where($where)->update($select);


    //         if (isset($updatePayment) && $updatePayment['status'] === true) {


    //             $OrderData = getData('orders', ['id'], ['session_id' => $checkoutSessionId, 'status' => '1']);

    //             // Log::info('Checkout Session cart value orderdata order table update', ['updatePayment' => $updatePayment['id']]);

    //             DB::table('orders')->where(['session_id' => $checkoutSessionId])->where(['status' => '1'])->update(['status' => '0']);

    //             $OrderData = getData('orders', ['course_id'], ['session_id' => $checkoutSessionId, 'status' => '0']);

    //             Log::info('Checkout Session cart value orderdata course_id ', ['updatePayment' => $OrderData]);

    //             foreach ($OrderData as $value) {
    //                 Log::info('Checkout Session cart value  course_id ', ['updatePayment' => $value]);

    //                 DB::table('cart')->where(['course_id' => $value->course_id])->update(['is_by' => '0']);
    //             }
    //         }
    //         if (isset($updateOrder) && $updateOrder === FALSE && isset($updatePayment) && $updatePayment === FALSE) {
    //             return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
    //         }
    //         return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Student social profile updated successfully", "icon" => "success"]);
    //     } catch (\Exception $e) {
    //         // DB::rollBack();
    //         // return $e->getMessage();
    //         Log::critical(__METHOD__ . ' method does not work. ' . $e->getMessage());
    //         throw $e;
    //     }

    //     DB::commit();
    // }

    public function thankyoupage(Request $request)
    {
        $session_id = base64_decode($request->session_id);
        $data['OrderData'] = DB::table('orders')->leftjoin('course_master', 'course_master.id', '=', 'orders.course_id')->where(['session_id' => $session_id])->get();
        $data['PaymentData'] = DB::table('payments')->where(['session_id' => $session_id])->first();
        return view('frontend.payment.order-thank-you', $data);
    }
    //     public function processCheckoutSessionWebhook()
    //     {
    //         // This is your Stripe CLI webhook secret for testing your endpoint locally.
    //         $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');


    //         $payload = @file_get_contents('php://input');
    //         $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    //         $event = null;

    //         try {
    //             $event = \Stripe\Webhook::constructEvent(
    //                 $payload, $sig_header, $endpoint_secret
    //             );
    //         } catch (\UnexpectedValueException $e) {
    //             // Invalid payload
    //             return response('', 400);
    //         } catch (\Stripe\Exception\SignatureVerificationException $e) {
    //             // Invalid signature
    //             return response('', 400);
    //         }

    // // Handle the event


    //         switch ($event->type) {
    //             case 'checkout.session.completed':
    //                 $session = $event->data->object;

    //                 $order = Order::where('session_id', $session->id)->first();
    //                 if ($order && $order->status === 'unpaid') {
    //                     $order->status = 'paid';
    //                     $order->save();
    //                     // Send email to customer
    //                 }

    //             // ... handle other event types
    //             default:
    //                 echo 'Received unknown event type ' . $event->type;
    //         }

    //         return response('');
    //     }
    //             // public function success()
    //             // {
    //             //     return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    //             // }

    //             // public function cancel()
    //             // {
    //             //     return view('cancel');
    //             // }




}