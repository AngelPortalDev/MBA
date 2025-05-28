<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB};
use App\Models\CourseModule;
use App\Models\StudentCourseModel;
class CourseController extends Controller
{

    private $stripe;
    // public function __construct()
    // {
    //     $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    // }

    
    public function uploadFileupload(Request $request)
    {
        $apiKey = '73c43a2f-d1c4-4e6e-a2da48f60fc9-72b7-440e';
        $libraryId = '242465';
        $cdnHostname = 'vz-9dc10e83-a9b.b-cdn.net';
        $collectionName = 'MyEascenciaCollection';
        
        // Step 1: Create a collection and associate it with a library
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])
        ->post("https://video.bunnycdn.com/library/{$libraryId}/collections", [
            'name' => $collectionName,
        ]);
        
        // Check if the request was successful
        if ($response->successful()) {
            $collectionId = $response->json('id');
            echo "Collection created with ID: $collectionId";
        } else {
            echo "Failed to create collection: " . $response->status();
        }
    }
    public function uploadfile(Request $request)
    {
         // Enter Your Stripe Secret
         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        		
         $amount = 100;
         $amount *= 100;
         
         $payment_intent = \Stripe\PaymentIntent::create([
             'description' => 'Stripe Test Payment',
             'amount' => $amount,
             'currency' => 'AED',
             'description' => 'Payment From All About Laravel',
             'payment_method_types' => ['card'],
         ]);
         $intent = $payment_intent->client_secret;
 
        return view('admin.admin.uploadfile',compact('intent'));
    }
    // public function checkout()
    // {   
    //     // Enter Your Stripe Secret
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        		
	// 	$amount = 6000;
	// 	$amount *= 6000;
        
    //     $payment_intent = \Stripe\PaymentIntent::create([
	// 		'description' => 'Stripe Test Payment',
	// 		'amount' => $amount,
	// 		'currency' => 'AED',
	// 		'description' => 'Payment From All About Laravel',
	// 		'payment_method_types' => ['card'],
	// 	]);
	// 	$intent = $payment_intent->client_secret;

	// 	return view('admin.admin.uploadfile',compact('intent'));

    // }

    // public function afterPayment()
    // {
    //     echo 'Payment Received, Thanks you for using our services.';
    // }
    
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            $request->session()->flash('danger', 'Payment failed.');
            return response()->redirectTo('/');
        }

        $charge = $this->createCharge($token['id'], 2000);
        if (!empty($charge) && $charge['status'] == 'succeeded') {
            $request->session()->flash('success', 'Payment completed.');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
        }
        return response()->redirectTo('/');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }


    public function cancel()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }
    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }




    public function eportfolioData()
    {

        $EportfolioData = getData('eportfolio_section', ['id','eportfolio_instruction'], ['section_id' => 2]);   
        // return $EportfolioData;
        // $QuestionData = getData('exam_assignment_questions', ['id','question','assignment_mark'], ['assignments_id' => $AssignmentData[0]->id]);   

        return view('frontend.exam.e-portfolio',compact('EportfolioData'));

    }
    public function getCourseDetails($course_id)
    {
        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $awardCourseData = [];

            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'id' => $course_id
                    ];
                    $awardCourseData = $this->CourseModule->getCouresDetails($where);
                    $awardCourseData = $awardCourseData['data'];
                    // return dd($awardCourseData[0]);
                    // return response()->json(['data' => $awardCourseData]);
                    return view('frontend/course-details', compact('awardCourseData'));
                }
            }
           
        }
        return redirect()->back();
    }
    public function getAwardCourseData($course_id)
    {
        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $courseDetails = [];
            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id,'status' => 3]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'course_master_id' => $course_id
                    ];

                    $courseDetails = $this->CourseManage->getCouresData($where);
                    // return   $courseDetails;
                    //  return response()->json(['data' => $awardCourseData]);
                    return view('frontend/student/student-award-course-panel', compact('courseDetails'));
                }
            }
        }
        return redirect()->back();
    }

    public function getMastersCourseDetails($course_id)
    {

        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $MasterCourseData = [];

            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'id' => $course_id
                    ];
                    $MasterCourseData = $this->CourseModule->getMasterCouresDetails($where);
                    return view('frontend/master-course-details', compact('MasterCourseData'));
                }
            }
           
        }
        return redirect()->back();
    }

    public function getMasterCourseData($course_id)
    {
        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $courseDetails = [];
            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id,'status' => 3]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'award_id' => $course_id
                    ];
                    $MasterCourseData = $this->MasterCourseManage->getMasterCouresData($where);
                    //  return response()->json(['data' => $awardCourseData]);
                    if (Auth::check() && Auth::user()->role === 'user') {
                        $studentCourseMaster = StudentCourseModel::select('preference_status', 'preference_id')
                        ->where('course_id', $course_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
                        
                        if(!empty($studentCourseMaster) ){
                            if ($studentCourseMaster->preference_id == "" && $studentCourseMaster->preference_status == '0') {
                                return view("frontend/student/student-my-learning")->with('optional_course_error', 'Select your optional ects to access course.');
                            }else{
                                return view('frontend/student/student-master-course-panel', compact('MasterCourseData','course_id'));
                            }
                        }else{
                            return view('frontend/student/student-master-course-panel', compact('MasterCourseData','course_id'));
                        }
                    }
                }
            }
        }
        return redirect()->back();
    }


    public function getBrowseCourseDetails(Request $request)
    {   
        $categories = $request->input('categories', []); // Get selected categories
        $subjects = $request->input('subjects', []); // Get selected subjects
        $ects = $request->input('ects', []); // Get selected ects
        $price = $request->input('price', []); // Get selected price
        $search_name = base64_decode($request->input('search_name')); // Get selected price
        $query = CourseModule::query();
        
        if (!empty($categories)) {
            $categories = explode(',', $categories);
            $categories = array_map('base64_decode', $categories);
            $query->whereIn('category_id', $categories);
        }
        
        if (!empty($subjects)) {
            $subjects = explode(',', $subjects);
            $subjects = array_map('base64_decode', $subjects);
            $query->where(function ($q) use ($subjects) {
                foreach ($subjects as $subject) {
                    $q->orWhere('course_title', 'LIKE', '%' . $subject . '%');
                }
            });
        }
        if (!empty($ects)) {
            $ects = explode(',', $ects);
            $ects = array_map('base64_decode', $ects);
            $query->where(function ($q) use ($ects) {
                foreach ($ects as $ects_data) {
                    if ($ects_data == "ects_30") {
                        $q->orWhereBetween('ects', [1, 30]);
                    }
                    if ($ects_data == "ects_60"){
                        $q->orWhereBetween('ects', [31, 60]);
                    }
                    if ($ects_data == "ects_90"){
                        $q->orWhereBetween('ects', [61, 90]);
                    }
                }
            });
        }

        if (!empty($price)) {
            $price = explode(',', $price);
            $price = array_map('base64_decode', $price);
            $query->where(function ($q) use ($price) {
                foreach ($price as $price_data) {
                    if ($price_data == "price_500") {
                        $q->orWhereBetween('course_final_price', [500, 999]);
                    }
                    if ($price_data == "price_5000"){
                        $q->orWhereBetween('course_final_price', [1000, 4999]);
                    }
                    if ($price_data == "price_above"){
                        $q->orWhere('course_final_price', '>', 5000);
                    }
                }
            });
        }

        if (!empty($search_name)) {
            $query->Where('course_title', 'LIKE', '%' . $search_name . '%');
        
        }

        $status = $request->input('course_status');
        if(empty($status)){
            $status = 3;
        }else{
            $status = $status;
        }
        $query->where('status',$status)->where('is_deleted','No');
        $totalCourseCount = $query->count();
        $browseCourseData = $query->orderBy('category_id','desc')->orderBy('id','asc')->paginate(5);
        // $browseCourseData['totalCourse'] = $browseCourseData->count();
        if ($request->ajax()) {
            return response()->json([

                'user' => Auth::check() ? ['id' => Auth::id(), 'role' => Auth::user()->role] : null,
                'totalCourseCount' => $totalCourseCount, // Adding the total count
                'courses' => $browseCourseData->map(function ($course) {
                    return [
                        'id' => $course->id,
                        'course_title' => $course->course_title,
                        'course_thumbnail_file'=>$course->course_thumbnail_file,
                        'ects'=>$course->ects,
                        'category_id'=>$course->category_id,
                        'mqfeqf_level'=>$course->mqfeqf_level,
                        'temp_count'=>$course->temp_count,
                        'course_final_price'=>$course->course_final_price,
                        'course_old_price'=>$course->course_old_price,
                        'status'=>$course->status,
                        'isPaid' => Auth::check() ? is_exist('orders', ['user_id' => Auth::user()->id, 'status' => '0', 'course_id' => $course->id]) : false,
                        'isCart' => Auth::check() ? is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']) : false,
                        'isWishlist' => Auth::check() ?  is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]) : false,
                        'studentCourseMaster' => Auth::check() ?  getData('student_course_master', ['course_expired_on', 'exam_attempt_remain', 'exam_remark'], ['user_id' => Auth::user()->id,'course_id'=>$course->id,'is_deleted'=>'No'],'1','created_at','desc') : null,
                        'playLink' => isset($course->category_id) && ($course->category_id == 1) ? route('start-course-panel', ['course_id' => base64_encode($course->id)]) : route('master-course-panel', ['course_id' => base64_encode($course->id)]),
                        // other course data...
                    ];
                }),
                // 'courses' => $browseCourseData->items(),
                'pagination' => (string) $browseCourseData->links(),
            ]);
        }
        // print_r($browseCourseData);
    
        return view('frontend/browse-course', compact('browseCourseData','totalCourseCount'));
    }
    

    public function optionalCourseData($course_id){

        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $masterOptionalData = [];
            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id,'status' => 3]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'award_id' => $course_id
                    ];
                    $masterOptionalData = DB::table('master_course_management')
                    ->leftJoin('course_master as cm_optional', 'cm_optional.id', '=', 'master_course_management.optional_course_id')
                    ->leftJoin('course_master as cm_course', 'cm_course.id', '=', 'master_course_management.course_id')
                    ->select(['cm_optional.id as optional_course_id', 'cm_optional.course_title as optional_course_title', 'cm_optional.ects as optional_ects', 
                            'cm_course.id as course_id', 'cm_course.course_title as course_title', 'cm_course.ects as course_ects'])
                    ->where('master_course_management.is_deleted', 'No')
                    ->where('master_course_management.award_id', $course_id)
                    ->orderBy('master_course_management.placement_id','ASC')
                    ->get();
                    return response()->json($masterOptionalData);
                }
            }
        }
        return redirect()->back();
        
    }

    public function StoreOptionalCourse(Request $request){

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $student_course_master_id = isset($request->student_course_master_id) ? base64_decode($request->input('student_course_master_id')) : '';
            $all_award_course_id =  isset($request->all_award_course_id) ? $request->input('all_award_course_id') : [];
            $master_course_id = isset($request->master_course_id) ? base64_decode($request->input('master_course_id')) : '';

            $masterOptionalData = [];
            if (!empty($master_course_id) && is_numeric($master_course_id)) {
                $exists = is_exist('course_master', ['id' => $master_course_id,'status' => 3]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $length = strlen($all_award_course_id); // Get the length of the string
                    if($length > 1){
                        $all_award_course_id = implode(",",array_map('base64_decode', explode(',', $all_award_course_id)));
                    }else{
                        $all_award_course_id = implode(",",$all_award_course_id);
                    }
                    $where = [
                        'id' => $student_course_master_id,
                        'course_id'=>$master_course_id
                    ];
                    $exists = is_exist('student_course_master', $where);
                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        $select = [
                            'preference_id' => $all_award_course_id,
                            'preference_status' => '0',
                        ];
            
                        $updateCourse = processData(['student_course_master', 'id'], $select, $where);

                        if (isset($updateCourse) && $updateCourse['status'] === true) {
                            return json_encode(['code' => 200, 'title' => 'Selection Successful!', "message" => "Your optional ECTS have been selected successfully.", "icon" => generateIconPath("success")]);
                        }else{
                            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    }else{
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);

                    }

                }
            }
        }
        return redirect()->back();
        
    }
    
}