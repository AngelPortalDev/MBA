<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StudentDocument;
use App\Models\StudentCourseModel;
use App\Models\StudentProfile;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\{Auth, Redirect, RateLimiter, DB};
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'otp_verified_at',
        'password',
        'photo',
        'mob_code',
        'phone',
        'role',
        'institute_name',
        'last_seen',
        'last_session_ip',
        'user_agent',
        'is_verified',
        'is_active',
        'is_deleted',
        'deleted_on',
        'university_code',
        'apply_dba'
    ];
    
    protected static function boot()
    {
        parent::boot();

        // Hook into the updating event of the model
        // static::updating(function ($user) {
        //     $user->verificationStatutsUpdate($user->id);
        // });
        static::deleting(function ($user) {
            $user->deleteUserData($user->id);
        });
    }

    public function deleteUserData($id){

        $user =  User::where('id',$id)->first();
        if($user->role == 'user'){
            $user->is_deleted = 'Yes';
            $user->save();
            $user->userData()->delete();
            $user->StudentDocs()->delete();
            $user->StudentProfile()->delete();
        }

    }


    public function verificationStatutsUpdate($id)
    {   
        $data = StudentDocument::select('identity_is_approved', 'edu_is_approved','english_level','english_score','identity_trail_attempt','edu_trail_attempt','resume_file','english_test_attempt')
                ->where('student_id', $id)
                ->first();
        $user =  User::where('id',$id)->first();
        $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
        if($data && isset($data) && !empty($data) && $data != "null" && $data != ""){
            if($data->identity_is_approved == 'Approved' && $data->edu_is_approved == 'Approved'  && $data->resume_file != ''  && $data->english_score >= '10'){
                mail_send(
                    44,
                    [
                        '#Name#',
                        '#unsubscribeRoute#'
                    ],
                    [
                        $user->name . ' ' . $user->last_name,
                        $unsubscribeRoute
                    ],
                    $user->email
                );
                $status = 'Verified';
                $enrolled_on = now();
            }else if(($data->identity_is_approved == 'Reject' && $data->identity_trail_attempt == '0') || ($data->edu_is_approved == 'Reject'  && $data->edu_trail_attempt == '0') || ($data->english_test_attempt == "0" && $data->english_score <= 10)){
                $studentCourseMasters = DB::table('student_course_master')->join('course_master', 'course_master.id', 'student_course_master.course_id')->where('user_id', $id)->where('student_course_master.is_deleted','No')->select('course_title')->get();
                if(isset($studentCourseMasters) && !empty($studentCourseMasters)){
                    foreach($studentCourseMasters as $course){
                        mail_send(
                            48,
                            [
                                '#Name#',
                                '#CourseName#',
                                '#unsubscribeRoute#'
                            ],
                            [
                                $user->name . ' ' . $user->last_name,
                                $course->course_title,
                                $unsubscribeRoute
                            ],
                            $user->email
                        );
                    }
                }
                $status = 'Rejected';
                $enrolled_on = null;
            }else{
                $status = "Unverified";
                $enrolled_on = null; 
            }   
            User::where('id', $id)->update(['is_verified' => $status, 'verified_on' => $enrolled_on]);   

            $dashboardController = new DashboardController();
            $dashboardData = $dashboardController->getDashboardData();
        }

    }
    // public function studentDocument()
    // {
    //     return $this->hasMany(StudentDocument::class, 'student_id', 'id');
    // }
    public function StudentProfile()
    {
        return $this->hasOne(StudentProfile::class, 'student_id');
    }
    public function StudentDocs()
    {
        return $this->hasOne(StudentDocument::class, 'student_id');
    }
    public function CourseModule()
    {
        return $this->hasMany(CourseModule::class, 'ementor_id');
    }

    public function studentDocument()
    {
        return $this->hasOne(StudentDocument::class, 'student_id');
    }

    public function userData()
    {
        return $this->hasOne(User::class, 'id');
    }
    public function Orderlist()
    {
        return $this->hasMany(OrderModel::class, 'user_id','id');
    }
    public function studentCourses()
    {
        return $this->hasMany(StudentCourseModel::class, 'user_id', 'id');
    }
    public function Paymentlist()
    {
        return $this->hasMany(PaymentModel::class, 'user_id','id');
    }
    public function Examlist()
    {
        return $this->hasMany(StudentCourseModel::class, 'user_id','id');
    }

    public function examStudentRemark()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'user_id', 'id');
    }

    public function getStudentData($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = User::with('studentprofile')->with('studentdocument')->with(['orderlist' => function ($query) {
                $query->where('status', '0')->orderBy('id','DESC');
            }])->with(['paymentlist' => function ($query) {
                $query->where('status', '0');
            }])->with('examlist')->with('examstudentremark');

            $studentData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $studentData = $query->where('role','user')->where($where)->orderBy('id','DESC')->get();
            } else {
                $studentData = $query->where('role','user')->orderBy('id','DESC')->get();
            }
            return $studentData;
        }
    }

    public function studentReportData($where)
    {
        $query = $this->with('studentCourses')
            ->leftJoin('student_doc_verification', 'users.id', '=', 'student_doc_verification.student_id')
            ->select('users.id', 'name', 'last_name', 'users.created_at', 'users.is_verified', 'users.is_active', 'email', 'mob_code', 'phone', 'roll_no','photo', 'block_status', 'student_doc_verification.identity_doc_type', 'student_doc_verification.identity_doc_number', 'university_code')
            ->where(['users.is_active' => 'Active', 'role' => 'user', 'users.block_status' => '0']);
            
        if (isset($where['start_date']) && isset($where['end_date'])) {
            $query->whereHas('studentCourses', function($q) use ($where) {
                $q->whereBetween('course_start_date', [$where['start_date'][2], $where['end_date'][2]]);
            });
        }
    
        $studentData = $query->orderBy('users.id', 'desc')->distinct()->get();
        return $studentData;
    } 

    public function sendOTP($number, $randomNumber, $key)
    {
        if (isset($number) && !empty($number) && isset($randomNumber) && !empty($randomNumber) && isset($key) && !empty($key)) {

            $maxAttempts = 1;
            $decayMinutes = 5;
    
            if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
                $seconds = RateLimiter::availableIn($key);
                $minutes = floor($seconds / 60);
                $remainingSeconds = $seconds % 60;
        
                return redirect()->back()->with('rate_limit_error', 'Too many requests. Please try again in ' . $minutes . ' minute and ' . $remainingSeconds . ' second.');
    
            }
            RateLimiter::hit($key, $decayMinutes * 60);

            try {
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('SMS_COUNTRY_AUTHORIZATION_TOKEN')
                ];

                $body = json_encode([
                    "Text" => "$randomNumber is your One-Time Password for login in to E-ASCENCIA website. Please do not share with anyone.",
                    "Number" => $number,
                    "SenderId" => "EASCEN",
                    "DRNotifyUrl" => "https://www.domainname.com/notifyurl",
                    "DRNotifyHttpMethod" => "POST",
                    "Tool" => "API"
                ]);

                $client = new Client();
                
                $request = new Request('POST', 'https://restapi.smscountry.com/v0.1/Accounts/' . env('SMS_COUNTRY_AUTH_KEY') . '/SMSes/', $headers, $body);
                
                $res = $client->sendAsync($request)->wait();

                $data = json_decode($res->getBody()->getContents(), true);

                if (is_array($data) && isset($data['Success']) && $data['Success'] === 'True') {
                    return ['code' => 200, 'data' => $data];
                } else {
                    return ['code' => 201, 'title' => "Failed", 'message' => 'OTP not sent. Please try again.', "icon" => "error"];
                }
            } catch (ClientException $e) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                return ['code' => 400, 'title' => "Client Error", 'message' => $responseBody, "icon" => "error"];
            } catch (RequestException $e) {
                $responseBody = $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'Network error or no response';
                return ['code' => 500, 'title' => "Request Error", 'message' => $responseBody, "icon" => "error"];
            } catch (\Throwable $th) {
                return ['code' => 201, 'title' => "Something Went Wrong", 'message' => $th->getMessage(), "icon" => "error"];
            }
        }
    }

    public function sendOtpApiRequest($method, $messageId)
    {
        if (isset($method) && !empty($method) && isset($messageId) && !empty($messageId)) {
            try {
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('SMS_COUNTRY_AUTHORIZATION_TOKEN')
                ];
                $client = new Client();

                $request = new Request($method, 'https://restapi.smscountry.com/v0.1/Accounts/' . env('SMS_COUNTRY_AUTH_KEY') . '/SMSes/' . $messageId, $headers);
                $res = $client->sendAsync($request)->wait();

                $data = $res->getBody()->getContents();
                $response = json_decode($data, true);

                if (is_array($response) && isset($response['SMS']['SenderId']) && $response['SMS']['SenderId'] !== '') {
                    
                    return ['code' => 200, 'data' => $response];
                } else {
                    return [
                        'code' => 400,
                        'title' => "Response Error",
                        'message' => 'Invalid response format or missing Success key.',
                        "icon" => "error"
                    ];
                }
            } catch (ClientException $e) {
                return [
                    'code' => 400,
                    'title' => "Client Error",
                    'message' => $e->getResponse()->getBody()->getContents(),
                    "icon" => "error"
                ];
            } catch (RequestException $e) {
                return [
                    'code' => 500,
                    'title' => "Request Error",
                    'message' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'Network error or no response',
                    "icon" => "error"
                ];
            } catch (\Throwable $th) {
                return [
                    'code' => 500,
                    'title' => "Unexpected Error",
                    'message' => $th->getMessage(),
                    "icon" => "error"
                ];
            }
        }

        return [
            'code' => 400,
            'title' => "Input Error",
            'message' => 'Invalid method or message ID',
            "icon" => "error"
        ];
    }
    
    public function createStudentOnZohoApiRequest($data)
    {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Cookie' => 'JSESSIONID=78F65E1A473C4EE563B2CD54E148612B; _zcsr_tmp=c224fe57-145d-4dfb-a504-5cd98eaf4230; iamcsr=c224fe57-145d-4dfb-a504-5cd98eaf4230; zalb_b266a5bf57=9f371135a524e2d1f51eb9f41fa26c60'
        ];
        $options = [
            'form_params' => [
                'refresh_token' => env('ZOHO_CRM_SELF_CLIENT_REFRESH_TOKEN'),
                'grant_type' => 'refresh_token',
                'client_id' => '1000.64GZHRP5NRW9BVI4457HO5K5Q4S3NJ',
                'client_secret' => '35eb401ba178b2c5b12ed13786e4e855f7e1a22a7a'
            ]
        ];
        
        $request = new Request('POST', 'https://accounts.zoho.com/oauth/v2/token', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        $mob_code = ltrim($data['mob_code'], '+');
        $country = DB::table('country_master')->where('country_code', $mob_code)->first();
        
        $refreshData = $res->getBody();
        $response = json_decode($refreshData, true);

        if(isset($response['access_token']) && !empty($response['access_token'])){
            try {
                $url = "https://www.zohoapis.com/crm/v5/Leads";
                $headers = [
                    'Authorization' => 'Zoho-oauthtoken ' . $response['access_token'],
                    'Content-Type' => 'application/json',
                    'Cookie' => '_zcsr_tmp=3a93c1d2-5480-4c7a-a6d0-693cfa6e0f38; crmcsr=3a93c1d2-5480-4c7a-a6d0-693cfa6e0f38; zalb_1a99390653=d9f95bb5df27bd3e0983ea68c0da5a8d; zalb_1ccad04dca=6d34a50fbe8cb49cea551ab7ad34eadd'
                ];
                $body = json_encode([
                    'data' => [
                        [
                            'First_Name' => $data['name'],
                            'Last_Name' => $data['last_name'],
                            'Email' => $data['email'],
                            'Mobile' => $data['mob_code'] . " " . $data['phone'],
                            "Miscellaneous" => "Facebook",
                            "Intake_Year" => "2025",
                            "Intake_Month" => "July",
                            "Fees_Source" => "Other",
                            "Lead_Source" => "Advertisement",
                            "Owner" => [
                                "id" => "6295260000007658035" // Replace with the actual owner ID
                            ],
                            "Country" => isset($country->country_name) ? $country->country_name : '',
                        ]
                    ]
                ]);
    
                $client = new Client();
                
                $request = new Request('POST', 'https://www.zohoapis.com/crm/v5/Leads', $headers, $body);
                
                $res = $client->sendAsync($request)->wait();
                $data =  $res->getBody();
                $response = json_decode($data, true);
                return $response;
            } catch (\Throwable $th) {
                return $th;
            }
        }else{
            return False;
        }

    }

    // private function getZohoAccessToken()
    // {
    //     $client = new Client();
    //     $tokenUrl = 'https://accounts.zoho.com/oauth/v2/token';
    
    //     $params = [
    //         'refresh_token' => env('ZOHO_CRM_SELF_CLIENT_REFRESH_TOKEN'),
    //         'grant_type' => 'refresh_token',
    //         'client_id' => '1000.64GZHRP5NRW9BVI4457HO5K5Q4S3NJ',
    //         'client_secret' => '35eb401ba178b2c5b12ed13786e4e855f7e1a22a7a'
    //     ];
    
    //     $response = $client->post($tokenUrl, ['form_params' => $params]);
    
    //     return json_decode($response->getBody(), true);
    // }

    private function getZohoAccessToken()
    {
        $client = new Client();
        $tokenUrl = 'https://accounts.zoho.com/oauth/v2/token';

        // Get the latest token from the database
        $tokenData = DB::table('zoho_tokens')->latest('id')->first();

        if ($tokenData && strtotime($tokenData->expires_at) > time()) {
            return ['access_token' => $tokenData->access_token];
        }

        // Refresh token if expired
        $params = [
            'refresh_token' => env('ZOHO_CRM_SELF_CLIENT_REFRESH_TOKEN'),
            'grant_type' => 'refresh_token',
            'client_id' => env('ZOHO_CLIENT_ID'),
            'client_secret' => env('ZOHO_CLIENT_SECRET'),
        ];

        try {
            $response = $client->post($tokenUrl, ['form_params' => $params]);
            $tokenResponse = json_decode($response->getBody(), true);

            if (isset($tokenResponse['access_token'])) {
                if ($tokenData) {
                    DB::table('zoho_tokens')->where('id', $tokenData->id)->update([
                        'access_token' => $tokenResponse['access_token'],
                        'expires_at' => now()->addMinutes(55),
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('zoho_tokens')->insert([
                        'access_token' => $tokenResponse['access_token'],
                        'expires_at' => now()->addMinutes(55),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                return ['access_token' => $tokenResponse['access_token']];
            }

            return false;
        } catch (\Exception $e) {
            \Log::error("Zoho Token Error: " . $e->getMessage());
            return false;
        }
    }

    public function syncInstituteWithZoho($data)
    {
        $client = new Client();

        //  Get Zoho Access Token
        $tokenResponse = $this->getZohoAccessToken();
        if (!$tokenResponse || !isset($tokenResponse['access_token'])) {
            return false;
        }
        $accessToken = $tokenResponse['access_token'];

        try {
            // Check if Institute Exists
            $accountId = DB::table('institute_profile_master')
                ->where('institute_id', $data['institute_id'])
                ->value('account_id');
            

            if ($accountId) {
                // Update existing institute in Zoho
                $this->updateInstituteOnZoho($accountId, $data, $accessToken);
            } else {
                // Create a new institute
                $accountId = $this->createInstituteOnZoho($data, $accessToken);

                // Save the newly created Zoho Account ID in the database
                if ($accountId) {
                    DB::table('institute_profile_master')
                        ->where('institute_id', $data['institute_id'])
                        ->update(['account_id' => $accountId]);
                }
            }

            // Upload or Update Attachments
            $this->uploadAttachmentsToZoho($accountId, $data, $accessToken);

            // Create or Update Institute Contacts
            $this->createOrUpdateInstituteContacts($data, $accountId, $accessToken);

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function createInstituteOnZoho($data, $accessToken)
    {
        $accountData = [
            'data' => [
                [
                    'Account_Name' => $data['name'],
                    'Website_URL' => $data['website'],
                    'Phone' => $data['mob_code'] . " " . $data['phone'],
                    'Billing_Street' => $data['address'] ?? '',
                    'Billing_City' => $data['billing_city'] ?? '',
                    'Billing_State' => $data['billing_state'] ?? '',
                    'Billing_Country' => $data['billing_country'] ?? '',
                    'Account_Type' => 'Institute in Data',
                    'Owner' => ['id' => '856084001'],
                ]
            ]
        ];

        $response = $this->sendZohoRequest('POST', 'https://www.zohoapis.com/crm/v5/Accounts', $accessToken, $accountData);

        return $response['data'][0]['details']['id'] ?? null;
    }

    private function updateInstituteOnZoho($accountId, $data, $accessToken)
    {
        $accountData = [
            'data' => [
                [
                    'id' => $accountId,
                    'Account_Name' => $data['name'],
                    'Website_URL' => $data['website'],
                    'Phone' => $data['mob_code'] . " " . $data['phone'],
                    'Billing_Street' => $data['address'] ?? '',
                    'Billing_City' => $data['billing_city'] ?? '',
                    'Billing_State' => $data['billing_state'] ?? '',
                    'Billing_Country' => $data['billing_country'] ?? '',
                ]
            ]
        ];

        return $this->sendZohoRequest('PUT', 'https://www.zohoapis.com/crm/v5/Accounts', $accessToken, $accountData);
    }
    
    private function uploadAttachmentsToZoho($accountId, $data, $accessToken)
    {
        $zohoAttachmentUrl = "https://www.zohoapis.com/crm/v5/Accounts/$accountId/Attachments";
        $client = new Client();

        // Delete existing attachments if new ones are available
        if (!empty($data['photo_id']) || !empty($data['licence'])) {
            $this->deleteZohoAttachments($accountId, $accessToken);
        }

        // Prepare files for upload
        $files = [];
        if (!empty($data['photo_id']) && Storage::exists($data['photo_id'])) {
            $photoExtension = pathinfo($data['photo_id'], PATHINFO_EXTENSION);
            $files[] = [
                'name' => 'file',
                'contents' => Storage::get($data['photo_id']),
                'filename' => 'photo_id.' . $photoExtension
            ];
        }
        if (!empty($data['licence']) && Storage::exists($data['licence'])) {
            $licenseExtension = pathinfo($data['licence'], PATHINFO_EXTENSION);
            $files[] = [
                'name' => 'file',
                'contents' => Storage::get($data['licence']),
                'filename' => 'license.' . $licenseExtension
            ];
        }

        // Upload new files
        foreach ($files as $file) {
            try {
                $client->post($zohoAttachmentUrl, [
                    'headers' => [
                        'Authorization' => "Zoho-oauthtoken $accessToken",
                    ],
                    'multipart' => [$file]
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    private function deleteZohoAttachments($accountId, $accessToken)
    {
        $zohoAttachmentUrl = "https://www.zohoapis.com/crm/v5/Accounts/$accountId/Attachments?fields=id";

        try {
            // Fetch existing attachments
            $response = $this->sendZohoRequest('GET', $zohoAttachmentUrl, $accessToken);

            // Check if we got valid attachment data
            if (!isset($response['data']) || empty($response['data'])) {
                return; // No attachments to delete
            }

            // Collect attachment IDs
            $attachmentIds = array_column($response['data'], 'id');

            // Delete attachments in bulk
            if (!empty($attachmentIds)) {
                $deleteUrl = "https://www.zohoapis.com/crm/v5/Attachments?ids=" . implode(',', $attachmentIds);
                $deleteResponse = $this->sendZohoRequest('DELETE', $deleteUrl, $accessToken);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function createOrUpdateInstituteContacts($data, $accountId, $accessToken)
    {
        $existingContact = $this->getZohoContactByEmail($data['contact_person_email'], $accessToken);

        $contactData = [
            'data' => [
                [
                    'Name' => $data['contact_person_name'],
                    'Contact_Person_Name' => $data['contact_person_name'],
                    'Email' => $data['contact_person_email'],
                    'Mobile' => $data['contact_person_mob_code'] . " " . $data['contact_person_mobile'],
                    'Designation' => $data['contact_person_designation'],
                    'Institute_Status' => 'Data Institute',
                    'Institute_Name' => [
                        'id' => $accountId
                    ]
                ]
            ]
        ];
        
        if ($existingContact) {
            // Update the existing contact
            $contactData['data'][0]['id'] = $existingContact['id'];
            return $this->sendZohoRequest('PUT', 'https://www.zohoapis.com/crm/v5/Institutes_Contacts', $accessToken, $contactData);
        } else {
            // If email is not found, delete all contacts related to the institute before adding a new one
            $this->deleteZohoInstituteContacts($accountId, $accessToken);

            // Create a new contact
            return $this->sendZohoRequest('POST', 'https://www.zohoapis.com/crm/v5/Institutes_Contacts', $accessToken, $contactData);
        }

        // if ($existingContact) {
        //     // Update the existing contact
        //     $contactData['data'][0]['id'] = $existingContact['id'];
        //     return $this->sendZohoRequest('PUT', 'https://www.zohoapis.com/crm/v5/Institutes_Contacts', $accessToken, $contactData);
        // } else {
        //     // Create a new contact
        //     return $this->sendZohoRequest('POST', 'https://www.zohoapis.com/crm/v5/Institutes_Contacts', $accessToken, $contactData);
        // }
    }
    
    private function getZohoContactByEmail($email, $accessToken)
    {
        $url = 'https://www.zohoapis.com/crm/v5/Institutes_Contacts/search?email=' . urlencode($email);
        
        try {
            $response = $this->sendZohoRequest('GET', $url, $accessToken);

            if (!empty($response['data'][0])) {
                return $response['data'][0]; // Return the existing contact details
            }
        } catch (\Exception $e) {
            return null; // No contact found or error occurred
        }

        return null;
    }
    
    private function deleteZohoInstituteContacts($accountId, $accessToken)
    {
        $url = 'https://www.zohoapis.com/crm/v5/Institutes_Contacts/search?criteria=(Institute_Name.id:equals:' . $accountId . ')';

        try {
            $response = $this->sendZohoRequest('GET', $url, $accessToken);

            if (!empty($response['data'])) {
                $contactIds = array_column($response['data'], 'id');

                if (!empty($contactIds)) {
                    $deleteUrl = 'https://www.zohoapis.com/crm/v5/Institutes_Contacts?ids=' . implode(',', $contactIds);
                    $this->sendZohoRequest('DELETE', $deleteUrl, $accessToken);
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error deleting contacts: " . $e->getMessage());
        }
    }

    private function sendZohoRequest($method, $url, $accessToken, $data = [])
    {
        $client = new Client();

        $headers = [
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ];

        $options = ['headers' => $headers];
        if (!empty($data)) {
            $options['json'] = $data;
        }

        $response = $client->request($method, $url, $options);
        return json_decode($response->getBody(), true);
    }
    
    // public function createInstituteOnZohoApiRequest($data)
    // {
    //     $client = new Client();

    //     // Step 1: Get Zoho Access Token
    //     $tokenResponse = $this->getZohoAccessToken();
    //     if (!$tokenResponse || !isset($tokenResponse['access_token'])) {
    //         return false;
    //     }
    //     $accessToken = $tokenResponse['access_token'];

    //     try {
    //         // Step 2: Create an Account (Institute)
    //         $accountData = [
    //             'data' => [
    //                 [
    //                     'Account_Name' => $data['name'],
    //                     'Website_URL' => $data['website'],
    //                     'Phone' => $data['mob_code'] . " " . $data['phone'],
    //                     'Billing_Street' => $data['address'] ?? '',
    //                     'Billing_City' => $data['billing_city'] ?? '',
    //                     'Billing_State' => $data['billing_state'] ?? '',
    //                     'Billing_Country' => $data['billing_country'] ?? '',
    //                     'Account_Type' => 'Institute in Data',
    //                     'Owner' => ['id' => '856084001'],
    //                 ]
    //             ]
    //         ];

    //         $accountResponse = $this->sendZohoRequest('POST', 'https://www.zohoapis.com/crm/v5/Accounts', $accessToken, $accountData);

    //         if (!isset($accountResponse['data'][0]['details']['id'])) {
    //             return false;
    //         }

    //         $accountId = $accountResponse['data'][0]['details']['id'];

    //         DB::table('institute_profile_master')
    //         ->where('institute_id', $data['institute_id'])
    //         ->update(['account_id' => $accountId]);
            
    //         // Upload Attachments (Photo ID and Institute License)
    //         $this->uploadAttachmentsToZoho($accountId, $data, $accessToken);

    //         // Create Institute Contacts (CustomModule3)
    //         return $this->createInstituteContacts($data, $accountId, $accessToken);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    
    // private function uploadAttachmentsToZoho($accountId, $data, $accessToken)
    // {
    //     $zohoAttachmentUrl = "https://www.zohoapis.com/crm/v5/Accounts/$accountId/Attachments";
    //     $client = new Client();

    //     // Prepare the files for upload
    //     $files = [];
    //     if (!empty($data['photo_id']) && Storage::exists($data['photo_id'])) {
    //         $photoExtension = pathinfo($data['photo_id'], PATHINFO_EXTENSION); 
    //         $files[] = ['name' => 'file', 'contents' => Storage::get($data['photo_id']), 'filename' => 'photo_id.' . $photoExtension];
    //     }
    //     if (!empty($data['licence']) && Storage::exists($data['licence'])) {
    //         $licenseExtension = pathinfo($data['licence'], PATHINFO_EXTENSION); 
    //         $files[] = ['name' => 'file', 'contents' => Storage::get($data['licence']), 'filename' => 'license.' . $licenseExtension];
    //     }

    //     if (!empty($files)) {
    //         foreach ($files as $file) {
    //             try {
    //                 $response = $client->post($zohoAttachmentUrl, [
    //                     'headers' => [
    //                         'Authorization' => "Zoho-oauthtoken $accessToken",
    //                     ],
    //                     'multipart' => [$file]
    //                 ]);
    //             } catch (\Exception $e) {
    //                 return $e->getMessage();
    //             }
    //         }
    //     }
    // }
    
    // private function createInstituteContacts($data, $accountId, $accessToken)
    // {
    //     $contactData = [
    //         'data' => [
    //             [
    //                 'Name' => $data['contact_person_name'],
    //                 'Contact_Person_Name' => $data['contact_person_name'],
    //                 'Email' => $data['contact_person_email'],
    //                 'Mobile' => $data['contact_person_mob_code'] . " " . $data['contact_person_mobile'],
    //                 'Designation' => $data['contact_person_designation'],
    //                 'Institute_Status' => 'Data Institute',
    //                 'Institute_Name' => [
    //                     'id' => $accountId
    //                 ]
    //             ]
    //         ]
    //     ];

    //     return $this->sendZohoRequest('POST', 'https://www.zohoapis.com/crm/v5/Institutes_Contacts', $accessToken, $contactData);
    // }


    public function hasRole($roles)
{
    // Get the user's roles and trim them
    $userRoles = explode(',', $this->role);
    $userRoles = array_map('trim', $userRoles);

    // If a single role is passed, convert it to an array
    if (count($roles) === 1 && is_string($roles[0])) {
        $roles = explode(',', $roles[0]);
    }
    
    // Trim and check each role against the user's roles
    foreach ($roles as $role) {
        if (in_array(trim($role), $userRoles)) {
            return true;
        }
    }
    
    return false;
}

    public function assignedStudents()
    {
        return $this->belongsToMany(User::class, 'subementor_student_relations', 'sub_ementor_id', 'student_id')
                    ->wherePivot('users.is_active', 'Active')
                    ->wherePivot('users.is_verified', 'Verified')
                    ->where('role', 'user');
    }





    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}