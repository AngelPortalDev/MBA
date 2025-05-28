<?php

namespace App\Http\Controllers\Admin\CourseControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Auth, Validator, Storage, DB};
use App\Http\Controllers\Admin\DashboardController;
use App\Models\CourseModule;
use GuzzleHttp\Client;

class CourseAdminController extends Controller
{
    public $libraryId;
    public function __construct()
    {
        parent::__construct();
        $this->libraryId = '244600';
    }

    public function courseUpdate(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {


            $user_id = Auth::user()->id;
            $title = isset($req->title) ? htmlspecialchars_decode($req->input('title')) : '';
            $subheading = isset($req->subheading) ? htmlspecialchars_decode($req->input('subheading')) : '';
            $mqf = isset($req->mqf) ? htmlspecialchars($req->input('mqf')) : '';
            $ects = isset($req->ects) ? htmlspecialchars($req->input('ects')) : '';
            $total_module = isset($req->total_module) ? htmlspecialchars($req->input('total_module')) : '';
            $total_lecture = isset($req->total_lecture) ? htmlspecialchars($req->input('total_lecture')) : 0;
            $total_learning = isset($req->total_learning) ? htmlspecialchars($req->input('total_learning')) : '';
            $certifica_id = isset($req->certifica_id) ? base64_decode($req->input('certifica_id')) : '';
            $ementor_id = isset($req->ementor_id) ? base64_decode($req->input('ementor_id')) : 0;
            $lecturer_id = isset($req->lecturer_id)  && is_array($req->lecturer_id) ? implode(",", $req->input('lecturer_id')) : 0;
            $final_price = isset($req->final_price) ? htmlspecialchars($req->input('final_price')) : 0;
            $scholarship_percent = isset($req->scholarship_percent) ? htmlspecialchars($req->input('scholarship_percent')) : '';
            $course_old_price = isset($req->course_old_price) ? htmlspecialchars($req->input('course_old_price')) : 0;
            $thumbnail_img = $req->hasFile('thumbnail_img') ? $req->file('thumbnail_img') : '';
            $trailor_video = $req->hasFile('trailor_vid') ? $req->file('trailor_vid') : '';
            $module_name = isset($req->module_name) ? htmlspecialchars($req->input('module_name')) : '';
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $course_specialization = isset($req->course_specialization) ? htmlspecialchars_decode($req->input('course_specialization')) : '';
            $course_duration = isset($req->course_duration) ? htmlspecialchars($req->input('course_duration')) : '';
            $trailor_thumbnail = $req->hasFile('trailor_thumbnail') ? $req->file('trailor_thumbnail') : '';
            $course_cuttoff_perc = isset($req->course_cuttoff_perc) ? htmlspecialchars($req->input('course_cuttoff_perc')) : 0;
            $discord_joining_link = isset($req->discord_joining_link) ? htmlspecialchars($req->input('discord_joining_link')) : null;
            $discord_channel_link = isset($req->discord_channel_link) ? htmlspecialchars($req->input('discord_channel_link')) : null;
            $full_time_course_duration = isset($req->full_time_course_duration) ? htmlspecialchars($req->input('full_time_course_duration')) : '';
            $courseWhere = ['id' => $course_id];
            $exists = is_exist('course_master', $courseWhere);
            $isUpdate = FALSE;
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $isUpdate = TRUE;
            }
            $oldEmentorId = '';
            $courseMaster = DB::table('course_master')->where('id', base64_decode($req->course_id))->first();
            if(!empty($courseMaster)){
                $oldEmentorId = $courseMaster->ementor_id;
            }

            if($course_id){
                $validate_rules = [
                    'title' => 'required|string|max:150|min:5',
                    // 'subheading' => 'sometimes|max:400|min:5',
                    // 'mqf' => 'numeric|min:1',
                    // 'ects' => 'numeric|min:1',
                    // // 'total_module' => 'string',
                    // 'total_lecture' => 'numeric|min:1',
                    // 'total_learning' => 'numeric|min:1',
                    // 'certifica_id' => 'string',
                    // 'ementor_id' => 'string',
                    // 'lecturer_id' => 'array',
                    // 'final_price' => 'numeric|min:1',
                    // 'scholarship_percent' => 'numeric|min:1',
                    // 'thumbnail_img' => 'mimes:jpeg,png,jpg,svg|max:1024',
                    // 'trailor_vid' => 'mimes:mp4,jpg',
                ];
            }else{
                $validate_rules = [
                    'title' => 'required|string|max:150|min:5|unique:course_master,course_title',
                ];

            }
            if (isset($req->subheading) && !empty($subheading)) {
                $validate_rules = array_merge($validate_rules, ['subheading' => 'max:400|min:5']);
            }

            if ($req->hasFile('thumbnail_img')) {
                $validate_rules = array_merge($validate_rules, ['thumbnail_img' => 'mimes:jpeg,png,jpg,svg|max:1024']);
            }

            if ($req->hasFile('trailor_thumbnail')) {
                $validate_rules = array_merge($validate_rules, ['trailor_thumbnail' => 'mimes:jpeg,png,jpg,svg|max:1024']);
            }
            
            if ($req->hasFile('trailor_vid')) {
                $validate_rules = array_merge($validate_rules, ['trailor_vid' => 'mimes:mp4|max:512000']);
            }
            // if (isset($req->module_name) && !empty($module_name)) {
            //     $validate_rules = array_merge($validate_rules, ['title' => 'required|string|max:225|min:5']);
            // }

            $validate = Validator::make($req->all(), $validate_rules);

            if (!$validate->fails()) {
                           
                if ($req->hasFile('thumbnail_img')) {
                    $thumbnail_file =  UploadFiles($thumbnail_img, 'course/thumbnailsContent', '');
                    if ($thumbnail_file === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                    }
                }
            

                $collection_id = '';
                $ext_trail_videoId='';
                $ext_trailer_thumbnail='';
             
                if ($isUpdate === FALSE) {
                  
                    $collection_id = $this->CourseModule->getCollectionIdBn($title, 2);
                 
                } else {
                       
                    $collectionData = getData('course_master', ['bn_collection_id', 'bn_course_trailer_url','trailer_thumbnail_file'], ['id' => $course_id]);
                    $ext_trail_videoId = $collectionData[0]->bn_course_trailer_url;
                    $collection_id = $collectionData[0]->bn_collection_id;
                    $ext_trailer_thumbnail = $collectionData[0]->trailer_thumbnail_file;


                }
                $trailor_bn_id = '';
                $trailer_thumbnailFileName = '';
                
                if (isset($collection_id) && !empty($collection_id)) {
                    if ($req->hasFile('trailor_thumbnail')) {
                        $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $ext_trailer_thumbnail);
                        if ($trailer_thumbnail_file === FALSE) {
                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                        }

                        // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($ext_trail_videoId,$trailor_thumbnail,2);
                        // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                        //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                        // }
                    }
                    if ($req->hasFile('trailor_vid')) {
                        if ($isUpdate === FALSE) {
                            $getContent =  $this->CourseModule->getVideoId($collection_id, $trailor_video, $title . " (Trailer Video)", 2);
                            if (isset($getContent) && $getContent !== FALSE) {
                                $trailor_bn_id = $getContent['videoId'];
                                if ($req->hasFile('trailor_thumbnail')) {

                                    $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', '',$ext_trailer_thumbnail);
                                    if ($trailer_thumbnail_file === FALSE) {
                                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                    }
                                    // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                    // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                    //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                    // }
                                    
                                }
                            }
                           

                        } else {

                            if (isset($collectionData['ext_trail_videoId']) && !empty($collectionData['ext_trail_videoId'])) {
                                $getContent =  $this->CourseModule->videoAction($collectionData['ext_trail_videoId'], [$collection_id, $trailor_video, $title], 'REPLACE', 2);

                                $trailor_bn_id = $getContent['videoId'];
                                if ($req->hasFile('trailor_thumbnail')) {
                                    $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $ext_trailer_thumbnail);
                                    if ($trailer_thumbnail_file === FALSE) {
                                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                    }
                                    // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                    // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                    //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                    // }
                                    
                                }
                            } else {
                                $getContent =  $this->CourseModule->getVideoId($collection_id, $trailor_video, $title . " (Trailer Video)", 2);

                                if (isset($getContent) && $getContent !== FALSE) {
                                    $trailor_bn_id = $getContent['videoId'];
                                    if ($req->hasFile('trailor_thumbnail')) {
                                        $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $ext_trailer_thumbnail);
                                        if ($trailer_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                        // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                        //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                        // }
                                        
                                    }
                                }
                            }
                        }
                    }
                } else {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Unable to Create Video Module2', "icon" => "error"]);
                }
                // $final_price = 0;
                // if ($scholarship_percent > 0) {
                //     $final_price = round($course_old_price * 100 /  (100 - $scholarship_percent));
                // } else {
                //     $final_price = $final_price;
                // }
                $select = [
                    'category_id' => 1,
                    'course_title' => $title,
                    'course_subheading' => $subheading,
                    'course_specialization'=>$course_specialization,
                    'mqfeqf_level' => $mqf,
                    'ects' => $ects,
                    // 'total_modules' => $total_module,
                    'duration_month'=>$course_duration,
                    'total_lectures' => $total_lecture,
                    'total_learning' => $total_learning,
                    'certificate_id' => $certifica_id,
                    'ementor_id' => $ementor_id,
                    'lecturer_id' => $lecturer_id,
                    'course_old_price' => $final_price,
                    'scholarship' => $scholarship_percent,
                    'course_final_price' => $course_old_price,
                    'bn_collection_id' => $collection_id,
                    'course_cuttoff_perc'=>$course_cuttoff_perc,
                    'created_by' => Auth::user()->id,
                    'updated_at' =>  $this->time,
                    'full_time_duration_month'=> $full_time_course_duration,
                ];
                if($course_id == ''){
                    $select = array_merge($select, ['created_at' => $this->time]);
                }
                print_r($req->all());
                die;
                if (isset($req->module_name) && !empty($module_name)) {
                    $select = array_merge($select, ['bn_module_name' => $module_name]);
                }          

                if ($req->hasFile('thumbnail_img')) {
                    if (isset($thumbnail_file['url']) && Storage::disk('local')->exists($thumbnail_file['url'])) {
                        $thumbnail_filename = $thumbnail_img->getClientOriginalName();
                        $select = array_merge(
                            [
                             'course_thumbnail_file' => !empty($thumbnail_file['url']) ? $thumbnail_file['url'] : 'No File',
                             'thumbnail_file_name' => $thumbnail_filename
                            ], $select);
                    } else {
                        return json_encode(['code' => 201, 'title' => "Unable to Upload Thumbanail", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                }         
                if ($req->hasFile('trailor_vid')) {
                    $trailer_filename = $trailor_video->getClientOriginalName();
                    if (!empty($ext_trail_videoId) && !empty($trailor_bn_id) && $trailor_bn_id != $ext_trail_videoId) {
                        $select = array_merge([
                            'bn_course_trailer_url' => !empty($trailor_bn_id) ? $trailor_bn_id : '',
                            'course_trailer_file_name'=>$trailer_filename,
                            'trailer_thumbnail_file'=>'',
                            'trailer_thumbnail_file_name'=>''
                        ], $select);
                    }else if(!empty($trailor_bn_id)){
                        $select = array_merge([
                            'bn_course_trailer_url' => !empty($trailor_bn_id) ? $trailor_bn_id : '',
                            'course_trailer_file_name'=>$trailer_filename,
                            'trailer_thumbnail_file'=>'',
                            'trailer_thumbnail_file_name'=>''
                        ], $select);
                    } else {
                        return json_encode(['code' => 201, 'title' => "Unable to Upload Trailer Video", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                }
                if ($req->hasFile('trailor_thumbnail')) {
                    
                    $trailor_thumbnail_file_name = $trailor_thumbnail->getClientOriginalName();
                    if (!empty($ext_trailer_thumbnail) && !empty($trailer_thumbnail_file) && $trailer_thumbnail_file != $ext_trailer_thumbnail) {
                        $select = array_merge($select, 
                        [ 
                            'trailer_thumbnail_file' => !empty($trailer_thumbnail_file['url']) ? $trailer_thumbnail_file['url'] : '',
                            'trailer_thumbnail_file_name'=>$trailor_thumbnail_file_name
                        ]);
                    }else if(!empty($trailer_thumbnail_file['url'])){

                        $select = array_merge($select, 
                        [ 
                            'trailer_thumbnail_file' => !empty($trailer_thumbnail_file['url']) ? $trailer_thumbnail_file['url'] : '',
                            'trailer_thumbnail_file_name'=>$trailor_thumbnail_file_name
                        ]);
                    } else {
                        return json_encode(['code' => 201, 'title' => "Unable to Upload Trailer Thumbnail Image", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                }
                $updateUserProfile = false;
                if ($isUpdate === FALSE) {
                    $updateUserProfile = processData(['course_master', 'id'], $select, []);
                } else {
                    $updateUserProfile = processData(['course_master', 'id'], $select, $courseWhere);
                }
                print_r($updateUserProfile);
                die;
                if (isset($updateUserProfile) && is_array($updateUserProfile) && $updateUserProfile['status'] === TRUE) {

                    $where = ['course_id' => $course_id];
                    $course_id = $updateUserProfile['id'];

                    $select = [
                        'course_id' => $course_id,
                        'discord_joining_link' => $discord_joining_link,
                        'discord_channel_link' => $discord_channel_link,
                    ];

                    $exists = is_exist('course_other_details', ['course_id' => $course_id]);
                    if (isset($exists) && is_numeric($exists) && $exists == 0) {
                        $where = [];
                        $updateCourse = processData(['course_other_details', 'id'], $select,$where);
                    }else{
                        $updateCourse = processData(['course_other_details', 'id'], $select,$where);
                    }

                    if($ementor_id){
                        if($oldEmentorId != 0){
                            if($oldEmentorId !== base64_decode($req->ementor_id)){
                                $ementor = DB::table('users')->where('id', $ementor_id)->first();
                                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($ementor->email));
                                mail_send(
                                    37,
                                    [
                                        '#Name#',
                                        '#[Course Name]#',
                                        '#[Assigned Date]#',
                                        '#[Course Duration]#',
                                        '#unsubscribeRoute#',
                                    ],
                                    [
                                        $ementor->name . " " . $ementor->last_name,
                                        $title,
                                        now()->format('Y-m-d'),
                                        $course_duration,
                                        $unsubscribeRoute
                                    ],
                                    $ementor->email
                                );
                            }
                        }

                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Basic information updated successfully", "icon" => "success", 'data' => base64_encode($updateUserProfile['id'])]);
                }
                return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {

            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }
    public function courseUpdateOther(Request $req)
    {
        
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            // $course_id = Auth::user()->id;
            $course_overview =  isset($req->course_overview) ? htmlspecialchars_decode($req->input('course_overview')) : '';
            $programme_outcomes = isset($req->programme_outcomes) ? htmlspecialchars_decode($req->input('programme_outcomes')) : '';
            $entry_requirements = isset($req->entry_requirements) ? htmlspecialchars_decode($req->input('entry_requirements')) : '';
            $assessment = isset($req->assessment) ? htmlspecialchars_decode($req->input('assessment')) : '';
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $validate_rules = [];
            if (isset($req->course_overview) && !empty($course_overview)) {
                $validate_rules = array_merge($validate_rules, [
                    'course_overview' => [
                        'string',
                        function ($attribute, $value, $fail) {
                            // Remove HTML tags
                            $plainText = strip_tags($value);
                            if (strlen($plainText) > 1500) {
                                $fail('The ' . $attribute . ' may not be greater than 1500 characters.');
                            }
                        },
                    ]
                ]);
            }
            if (isset($req->programme_outcomes) && !empty($programme_outcomes)) {
                $validate_rules = array_merge($validate_rules, [
                    'programme_outcomes' => [
                        'string',
                        function ($attribute, $value, $fail) {
                            // Remove HTML tags
                            $plainText = strip_tags($value);
                            if (strlen($plainText) > 1500) {
                                $fail('The ' . $attribute . ' may not be greater than 1500 characters.');
                            }
                        },
                    ]
                ]);
            }
            if (isset($req->entry_requirements) && !empty($entry_requirements)) {
                $validate_rules = array_merge($validate_rules, [
                    'entry_requirements' => [
                        'string',
                        function ($attribute, $value, $fail) {
                            // Remove HTML tags
                            $plainText = strip_tags($value);
                            if (strlen($plainText) > 1500) {
                                $fail('The ' . $attribute . ' may not be greater than 1500 characters.');
                            }
                        },
                    ]
                ]);
            }
            if (isset($req->assessment) && !empty($assessment)) {
                $validate_rules = array_merge($validate_rules, [
                    'assessment' => [
                        'string',
                        function ($attribute, $value, $fail) {
                            // Remove HTML tags
                            $plainText = strip_tags($value);
                            if (strlen($plainText) > 500) {
                                $fail('The ' . $attribute . ' may not be greater than 500 characters.');
                            }
                        },
                    ]
                ]);
            }
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $where = ['id' => $course_id];
                $exists = is_exist('course_master', $where);
                if (isset($exists) && $exists > 0) {
                    $select = [
                        'overview' => $course_overview,
                        'programme_outcomes' => $programme_outcomes,
                        'entry_requirements' => $entry_requirements,
                        'assessment' => $assessment,
                        'id' => $course_id,
                        'created_by' => Auth::user()->id,
                        'updated_at' =>  $this->time
                    ];

                    $updateCourse = processData(['course_master', 'id'], $select, $where);
                } else {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }

                if (isset($updateCourse) && $updateCourse === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
                return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Course other details updated successfully", "icon" => "success", "data" => base64_encode($updateCourse['id'])]);
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please provide required info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
        }
    }
    public function updateSection(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $section_title =  isset($req->section_title) ? htmlspecialchars($req->input('section_title')) : '';
            $validate_rules = [
                'section_title' => 'required|string|max:250|min:5',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                // $where = ['section_name' => $section_title];
                // $exists = is_exist('course_section_masters', $where);
                // if (isset($exists) && $exists === 0) {
                    
                    $libraryId = env('AWARD_LIBRARY_ID');
                    // $collectionIdExist = $this->CourseModule->checkCollectionIdExist($libraryId, $section_title);
                    // if(isset($collectionIdExist['code']) && $collectionIdExist['code'] == 200){
                    //     $collectionItems = $collectionIdExist['data']['items'];
                    //     $sectionExists = false;

                    //     foreach ($collectionItems as $item) {
                    //         if ($item['name'] === $section_title) {
                    //             $sectionExists = true;
                    //             break;
                    //         }
                    //     }
                    // }
                    // if ($sectionExists) {
                    //     return json_encode(['code' => 201, 'title' => "Section already exist", 'message' => 'Please Try Again', "icon" => "error"]);
                    // }else{
                        
                        $collectionId = $this->CourseModule->createCollectionIdOnBunnyStream($libraryId, htmlspecialchars_decode($section_title));
                        
                        if(isset($collectionId['code']) && $collectionId['code'] == 200){
                            $select = [
                                'section_name' => htmlspecialchars_decode($section_title),
                                'created_by' => $admin_id,
                                'created_at' =>  $this->time,
                                'bn_collection_id' => $collectionId['data']['guid']
                            ];
                            
                            $updateSection = processData(['course_section_masters', 'id'], $select);
                            if (isset($updateSection) && $updateSection === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                            return json_encode(['code' => 200, 'title' => 'Successfully Added', "message" => "Section added successfully", "icon" => generateIconPath("success")]);
                        }else{
                            return json_encode(['code' => 202, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    // }

                // } else {
                //     return json_encode(['code' => 201, 'title' => "Section Name Already Exists ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
                // }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Try Again', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function assignSection(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $section =  isset($req->section) && is_array($req->section) ? $req->input('section') : [];

            $validate_rules = [
                'section_title' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $whereCourseModule = ['id' => $section_title];
                $existsModule = is_exist('course_master', $whereCourseModule);
                $whereCourseSection = ['id' => $section_title];
                $existsSection = is_exist('course_section_masters', $whereCourseSection);
                if (isset($existsModule) && isset($existsSection) && $existsModule > 0 && $existsSection > 0) {
                    $select = [
                        'section_name' => htmlspecialchars_decode($section_title),
                        'created_by' => $admin_id,
                        'created_at' =>  $this->time
                    ];

                    $updateSection = processData(['course_section_masters', 'id'], $select);
                    if (isset($updateSection) && $updateSection === FALSE) {
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Section Added Successfully", "icon" => "success"]);
                } else {
                    return json_encode(['code' => 201, 'title' => "Section Name Already Exists ", 'message' => 'Please Try Unique Name', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Try Again', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }
    public function coursePodcastContent(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $about_module = isset($req->about_module) ? htmlspecialchars($req->input('about_module')) : '';
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $videoFile = $req->hasFile('video_file') ? $req->file('video_file') : '';
            $podcast_thumbnail = $req->hasFile('podcast_thumbnail') ? $req->file('podcast_thumbnail') : '';
            
            $validate_rules = [
                'about_module' => 'string',
            ];
            if ($req->hasFile('podcast_thumbnail')) {
                $validate_rules = array_merge($validate_rules, ['podcast_thumbnail' => 'mimes:jpeg,png,jpg,svg|max:1024']);
            }
            if ($req->hasFile('video_file')) {
                $validate_rules = array_merge($validate_rules, ['videoFile' => 'mimes:mp4|max:512000']);
            }
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $exists = is_exist('course_master', ['id' => $course_id]);
                $ext_podcast_thumbnail ='';
                $podcast_thumbnail_file_url='';
                $podcast_thumbnail_file_name='';
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $getModuleData = getData(
                        'course_master',
                        ['id', 'bn_collection_id', 'course_title','podcast_thumbnail_file','podcast_thumbnail_file_name'],
                        ['id' => $course_id]
                    );

                    $whereOtherVideo = ['course_master_id' => $course_id, 'video_type' => 1, 'is_deleted' => 'No'];
                    $exists = is_exist('course_other_videos', $whereOtherVideo);
                    $collection_id = isset($getModuleData[0]->bn_collection_id) && !empty($getModuleData[0]->bn_collection_id) ? $getModuleData[0]->bn_collection_id : null;
                    $course_title = isset($getModuleData[0]->course_title) ? $getModuleData[0]->course_title : 'NA';
                    $ext_podcast_thumbnail =  isset($getModuleData[0]->podcast_thumbnail_file) ? $getModuleData[0]->podcast_thumbnail_file : '';
                    $podcast_thumbnail_file_name =  isset($getModuleData[0]->podcast_thumbnail_file_name) ? $getModuleData[0]->podcast_thumbnail_file_name : '';
                    $podcast_thumbnail_file_url=   isset($getModuleData[0]->podcast_thumbnail_file) ? $getModuleData[0]->podcast_thumbnail_file : '';

                    if (!isset($collection_id) && $collection_id === null) {
                        $collection_id =   $this->CourseModule->getCollectionIdBn($course_title . " (Podcast Videos)", 2);
                        $updateCollection = processData(['course_master', 'id'], [
                            'bn_collection_id' => $collection_id
                        ], [
                            'id' => $course_id
                        ]);
                        if (isset($updateCollection) && $updateCollection === FALSE) {
                            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                        }
                    }
                    $podcast_filename = '';
                    $getOtherVideo = getData(
                        'course_other_videos',
                        ['id', 'bn_video_url_id', 'bn_collection_id','video_file_name'],
                        ['course_master_id' => $course_id]
                    );
                    
                        if ($req->hasFile('video_file')) {
                           
                            $podcast_filename = $videoFile->getClientOriginalName();

                            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                                $whereOtherVideo = [];
                                $vidoId =   $this->CourseModule->getVideoId($getModuleData[0]->bn_collection_id, $videoFile, " (Podcast Video)", 2);
                                if (isset($vidoId) && $vidoId !== FALSE) {
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        // $podcast_thumbnail_Id =  $this->CourseModule->setThumbnail($vidoId['videoId'],$podcast_thumbnail,2);
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $ext_podcast_thumbnail);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];
                                        // if (isset($podcast_thumbnail_Id) && $podcast_thumbnail_Id !== FALSE) {
                                        //     $podcast_thumbnailFileName = $podcast_thumbnail_Id['thumbnailFileName'];
                                        // }
                                    }
                                }
                         
                            } else {

                          
                               
                                if($getOtherVideo[0]->bn_video_url_id == ''){
                                    $vidoId =   $this->CourseModule->getVideoId($getModuleData[0]->bn_collection_id, $videoFile, " (Podcast Video)", 2);
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        // $podcast_thumbnail_Id =  $this->CourseModule->setThumbnail($vidoId['videoId'],$podcast_thumbnail,2);
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file  =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $ext_podcast_thumbnail);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];

                                        // if (isset($podcast_thumbnail_Id) && $podcast_thumbnail_Id !== FALSE) {
                                        //     $podcast_thumbnailFileName = $podcast_thumbnail_Id['thumbnailFileName'];
                                        // }
                                    }
                                }else{
                                    $vidoId = $this->CourseModule->videoAction($getOtherVideo[0]->bn_video_url_id, [$collection_id, $videoFile, " Podcast Video"], 'REPLACE', 2);
         
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $ext_podcast_thumbnail);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];

                                    }
                                }
                            }
                        }
                        if ($req->hasFile('podcast_thumbnail')) {
                            // $podcast_thumbnail_Id =  $this->CourseModule->setThumbnail($getOtherVideo[0]->bn_video_url_id,$podcast_thumbnail,2);
                            $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                            $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $ext_podcast_thumbnail);
                            if ($podcast_thumbnail_file === FALSE) {
                                return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                            }
                            $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];

                            // if (isset($podcast_thumbnail_Id) && $podcast_thumbnail_Id !== FALSE) {
                            //     $podcast_thumbnailFileName = $podcast_thumbnail_Id['thumbnailFileName'];
                            // }
                        }

           

                    // return  $vidoId;
                    if (isset($vidoId) && $vidoId['status'] === false) {
                            return json_encode(['code' => 201, 'title' => "Unable to Upload Video", 'message' => 'Please Try Again', "icon" => "error"]);
                      
                        } else {

                            $select = [
                                'course_master_id' => $course_id,
                                'bn_collection_id' =>  $collection_id,
                                'video_title' => $course_title . " (Podcast Videos)",
                                'video_file_name'=>$podcast_filename,
                                'created_by' => $admin_id,
                                'video_type' => 1,
                                'status' => 1,
                                'created_at' =>  $this->time
                            ];
                            if ($req->hasFile('video_file')) {
                                $select = array_merge(['bn_video_url_id' => $vidoId['videoId']], $select);
                                $updateCourse = processData(['course_other_videos', 'id'], $select, $whereOtherVideo);
                            }

                            // if (isset($updateCourse) && $updateCourse !== FALSE) {
                                $where = [
                                    'id' => $course_id
                                ];
                                $select = [
                                    'about_module' => $about_module,
                                    'last_updated_by' =>  $admin_id,
                                    'updated_at' =>  $this->time,
                                    'podcast_thumbnail_file'=>$podcast_thumbnail_file_url,
                                    'podcast_thumbnail_file_name'=>$podcast_thumbnail_file_name
                                ];
                                $updateCourse = processData(['course_master', 'id'], $select, $where);
                                if (isset($updateCourse) && $updateCourse === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                            // }
                            return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => "Course podcast uploaded successfully", "icon" => "success", "data" => base64_encode($updateCourse['id'])]);
                        }
                       
                    }
                    if (isset($vidoId) && $vidoId['status'] === false) {
                        return json_encode(['code' => 201, 'title' => "Unable to Create Video", 'message' => 'Please Try Again', "icon" => "warning"]);
                    }else{
                        return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => "Course podcast uploaded successfully", "icon" => "success", "data" => base64_encode($updateCourse['id'])]);
                    }
                } else {
                    return json_encode(['code' => 201, 'title' => "Module Not Exist", 'message' => 'Please Try Again', "icon" => "warning"]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }


    public function loadCoursePreviewVideos($collection_id = '')
    {
        if (Auth::check()) {
            $CourseData = [];
            if (isset($collection_id) && !empty($collection_id)) {
                $id = base64_decode($collection_id);
                $query = DB::table('course_modules_videos');
                // if ($cat != 'all') {
                $where = ['section_id' => $id, 'is_deleted' => 'No'];
                $query->where($where);
                // }

                $CourseData = $query->orderByDesc('id')->get()->toArray();
            } else {
                $CourseData = DB::table('courses')->where('')->get();
            }
            return response()->json($CourseData);
        }
        return redirect('/login');
    }


    public function sectionList($cat = '', $action = '')
    {

     
        if (Auth::check()) {
            $sectionData = [];
            $where = ['is_deleted' => 'No'];
            $id = '';

            if (isset($cat) && !empty($cat) && $cat === 'Yes' || $cat === 'No') {
                $where = array_merge($where, ['is_active' => $cat]);
            } elseif (isset($cat) && !empty($cat) && $cat === 'deleted') {
                $where = ['is_deleted' => 'Yes'];
            } elseif (isset($cat) && !empty($cat) && is_numeric(base64_decode($cat))) {
                $id = base64_decode($cat);
                $where = ['id' => $id, 'is_deleted' => 'No'];
            } elseif (isset($cat) && !empty($cat) && $cat === 'undefined') {
                $where = ['is_deleted' => 'No'];
            }
            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                $exist = is_exist('course_section_masters', $where);
                if ($exist === 0) {
                    return redirect()->back()->with('msg', 'Section not Exist');
                }
            }
            $select = ['video_title', 'bn_video_url_id', 'video_duration'];
            $sectionData = $this->section->getSectionDetails($where, $select);
            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                return view('/admin/course/section-edit', compact('sectionData'));
            }
            return response()->json($sectionData);
        }
        return redirect('/login');
    }
    public function searchSection(Request $req)
    {
        if (Auth::check() && !empty($req->search) && isset($req->search) && !empty($req->course_id) && isset($req->course_id) && $req->ajax()) {
            $sectionData = [];
            $where = ['section_name' => htmlspecialchars($req->search)];
            $select = ['section_name', 'id'];
            $sectionData = $this->section->getSectionSearch($where, $select);
            return response()->json($sectionData);
        }
        return redirect('/login');
    }

    public function sectionAlreadyAdded(Request $req)
    {   

        if (Auth::check() && !empty($req->course_id) && isset($req->course_id) && $req->ajax()) {
            $sectionData = [];
            $whereCourseSection = ['course_master_id' => base64_decode($req->course_id),'section_id'=> base64_decode($req->section_id),'is_deleted'=>'No'];
            $existsSection = is_exist('course_managment_master', $whereCourseSection);
            if (isset($existsSection) && isset($existsSection) && $existsSection > 0) {
                return "true";
            }else{
                return "false";
            }
        }
        return redirect('/login');
    } 
    public function sectionListNew($cat = '', $action = '')
    {
        if (Auth::check()) {
            $sectionData = [];
            $where = ['is_deleted' => 'No'];
            $id = '';
            $section_id = base64_decode($cat);

            $data = getData('section_managment_master', ['section_id', 'content_id', 'content_type_id', 'placement_id'], ['is_deleted' => 'No', 'section_id' => $section_id], '', 'placement_id', 'ASC');
            $section_name = getData('course_section_masters', ['id', 'section_name'], ['is_deleted' => 'No', 'id' => $section_id]);
            $html = '';
            $select = [];

            foreach ($data as $content) {
                $content_type = $content->content_type_id;

         
                $content_id = $content->content_id;
                $getData = [];
                $displayIcon ='';
                if (isset($content_type) && !empty($content_type) && $content_type === 1) {
                    $where = ['id' => $content_id,'is_deleted'=>'No'];
                    $select = ['id', 'video_title'];
                    $table = 'course_modules_videos';
                    $getData = getData($table, $select, $where);
                    $title = isset($getData[0]->video_title) ? $getData[0]->video_title : '';
                    $id = isset($getData[0]->id) ? base64_encode($getData[0]->id) : '';
                    $content_type =  base64_encode($content_type);
                    $displayIcon = "<i class='bi bi-play-circle'></i>";

                } elseif (isset($content_type) && !empty($content_type) && $content_type === 2) {
                    $where = ['is_deleted' => 'No', 'id' => $content_id];
                    $select = ['id', 'docs_title','doc_file_name'];
                    $table = 'course_content_docs';
                    $getData = getData($table, $select, $where);
                    $title = isset($getData[0]->docs_title) ? $getData[0]->docs_title : '';
                    $id = isset($getData[0]->id) ? base64_encode($getData[0]->id) : '';
                    $doc_file_name = isset($getData[0]->doc_file_name) ? $getData[0]->doc_file_name : '';
                    $content_type =  base64_encode($content_type);
                    $extensionFile = pathinfo($doc_file_name); 
                    if(!empty($extensionFile['extension'])){
                        if($extensionFile['extension'] == 'pdf'){
                            $displayIcon = "<i class='bi bi-file-pdf'></i>";
                        }else if($extensionFile['extension']  == 'doc' || $extensionFile['extension']  == 'docx'){
                            $displayIcon = "<i class='bi bi-file-earmark-word'></i>";
                        }else if($extensionFile['extension']  == 'xls' || $extensionFile['extension']  == 'xlsx'){
                            $displayIcon = "<i class='bi bi-filetype-exe'></i>";
                        }
                    }


                }elseif (isset($content_type) && !empty($content_type) && $content_type === 3) {
                 
                    $where = ['is_deleted' => 'No', 'id' => $content_id];
                    $select = ['id', 'quiz_tittle'];
                    $table = 'exam_quiz';                  
                    $getData = getData($table, $select, $where);
                    $title = isset($getData[0]->quiz_tittle) ? $getData[0]->quiz_tittle : '';
                    $id = isset($getData[0]->id) ? base64_encode($getData[0]->id) : '';
                    $content_type =  base64_encode($content_type);
                    $displayIcon = "<i class='fe fe-help-circle nav-icon fs-14 color-cyan'></i>";
                }
                if (!empty($title)) {
                    $html .= "<div class='list-group-item rounded px-3 text-nowrap mb-1' id='development'>
                                <input type='text' name='content_id[]' value='$id' hidden>
                                <input type='text' name='content_type_id[]' value='$content_type' hidden>
                                <div class='d-flex align-items-center justify-content-between'>
                                                            <h5 class='mb-0 text-truncate'>
                                                                <a href='#' class='text-inherit'>
                                                                <span class='align-middle fs-4'> 
                                                                   $displayIcon
                                                                   $title
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                            <div>
                                                             
                                                                <a href='javascript:void(0)' class='me-1 text-inherit deleteContent' data-delete_id='$id' data-content_type='$content_type' data-
                                                                    data-bs-toggle='tooltip' data-placement='top'
                                                                    aria-   ='Delete' data-bs-original-title='Remove'>
                                                                    <i class='fe fe-trash-2 fs-5'></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>";
                }
            }
            $sectionData = ['section_name' => $section_name, 'content' => $html];
            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                return view('/admin/course/section-edit', compact('sectionData'));
            }

            
            return response()->json($sectionData);
        }
        return redirect('/login');
    }


    // ankita changes
    // public function CourseList($cat, $action)
    // {
    //     if (Auth::check()) {
    //         $CourseData = [];
    //         $where = [];

    //         if (isset($cat) && !empty($cat)) {
    //             if ($action == 'status') {
    //                 $where = [
    //                     'status' => $cat
    //                 ];
    //             }
    //             if ($action == 'category') {
    //                 $where = [
    //                     'category_id' => $cat
    //                 ];
    //             }
    //         }
    //         $CourseData = $this->CourseModule->getCouresDetails($where);
    //         foreach ($CourseData as $key => $course) {
    //             // Check if the course is enrolled using a custom function `is_enrolled`
    //             $CourseData[$key]['is_enrolled'] = is_enrolled('', $course['id']);
    //         }
    //         return response()->json($CourseData);
    //     }
    //     return redirect('/login');
    // }
    public function CourseList(Request $request,$cat,$action)
    {
        if (Auth::check()) {
            $CourseData = [];
            $where = [];
            $limit = $request->input('length'); // Number of records per page
            $offset = $request->input('start'); // Start index for the current page
            $searchValue = $request->input('search.value', ''); // Get the search term
            if (isset($cat) && !empty($cat)) {
                if ($action == 'status') {
                    $where = [
                        'status' => $cat
                    ];
                }
                if ($action == 'category') {
                    $where = [
                        'category_id' => $cat
                    ];
                }
            }
        
            $CourseData = $this->CourseModule->getCouresDetails($where,[],$offset,$limit,$searchValue);
            $CourseDatas = $CourseData['data'];
            $totalRecords = $CourseData['count'];

            foreach ($CourseDatas as $key => $course) {
                $CourseDatas[$key]['is_enrolled'] = is_enrolled('', $course['id']);
            }
            
            $response = [
                "draw" => intval($request->input('draw')), // Draw counter for DataTables
                "recordsTotal" => $totalRecords, // Total number of records
                "recordsFiltered" => $totalRecords, // Number of records after filtering (same as total if no filtering is applied)
                "data" => $CourseDatas // The actual data to be displayed
            ];            
            return response()->json($response);


        }
        return redirect('/login');
    }

    public function courseUpdateAdd(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $title = isset($req->title) ? htmlspecialchars($req->input('title')) : '';
            $category_id = isset($req->category_id) ? htmlspecialchars($req->input('category_id')) : '';
            $subheading = isset($req->subheading) ? htmlspecialchars($req->input('subheading')) : '';
            $mqf = isset($req->mqf) ? htmlspecialchars($req->input('mqf')) : 0;
            $certificate_id = isset($req->certificate_id) ? base64_decode($req->input('certificate_id')) : '';
            $ementor_id = isset($req->ementor_id) ? base64_decode($req->input('ementor_id')) : 0;
            $lecturer_id = isset($req->lecturer_id)  && is_array($req->lecturer_id) ? implode(",", $req->input('lecturer_id')) : 0;
            $course_old_price = isset($req->final_price) ? htmlspecialchars($req->input('final_price')) : 0;
            $scholarship_percent = isset($req->scholarship_percent) ? htmlspecialchars($req->input('scholarship_percent')) : '';
            $course_final_price = isset($req->course_old_price) ? htmlspecialchars($req->input('course_old_price')) : '0';
            $ects = isset($req->ects) ? htmlspecialchars($req->input('ects')) : '';
            $total_module = isset($req->total_module) ? htmlspecialchars($req->input('total_module')) : '';
            $total_lecture = isset($req->total_lecture) ? htmlspecialchars($req->input('total_lecture')) : 0;
            $total_learning = isset($req->total_learning) ? htmlspecialchars($req->input('total_learning')) : '';
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $course_cuttoff_perc = isset($req->course_cuttoff_perc) ? htmlspecialchars($req->input('course_cuttoff_perc')) : 0;
            $course_duration = isset($req->course_duration) ? htmlspecialchars($req->input('course_duration')) : '';
            $discord_joining_link = isset($req->discord_joining_link) ? htmlspecialchars($req->input('discord_joining_link')) : null;
            $discord_channel_link = isset($req->discord_channel_link) ? htmlspecialchars($req->input('discord_channel_link')) : null;
            $progress_tab = isset($req->progress_tab) && $req->has('progress_tab') ? '0' : '1';  
            $full_time_course_duration = isset($req->full_time_course_duration) ? htmlspecialchars($req->input('full_time_course_duration')) : '';
            $validate_rules = [
                'category_id' => 'required',
                'title' => 'required|string|max:225|min:5',
                // 'subheading' => 'required|string|max:225|min:5',
                // 'mqf' => 'required|numeric|min:1',
                // 'ementor_id' => 'required|string',
                // 'certificate_id' => 'required|string',
                // 'lecturer_id' => 'required|array',
                // 'final_price' => 'required|numeric|min:1'
                // 'scholarship_percent' => 'required|numeric|min:1',
            ];
            // return $req->all();
            $validate = Validator::make($req->all(), $validate_rules);

            $exists = is_exist('course_master', ['id' => $course_id]);
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $where = ['id' => $course_id];
            }
            // if($scholarship_percent > 0){
            //     $course_old_price_val = $final_price * 100 /  (100 - $scholarship_percent);
            // }else{
            //     $course_old_price_val = $final_price;
            // }
        
            if (!$validate->fails()) {
                $select = [
                    'category_id' => $category_id,
                    'course_title' => htmlspecialchars_decode($title),
                    'course_subheading' => htmlspecialchars_decode($subheading),
                    'mqfeqf_level' => $mqf,
                    'ects' => $ects,
                    // 'total_modules' => $total_module,
                    'duration_month'=>$course_duration,
                    'total_lectures' => $total_lecture,
                    'total_learning' => $total_learning,
                    'ementor_id' => $ementor_id,
                    'lecturer_id' => $lecturer_id,
                    'course_final_price' => $course_final_price,
                    'scholarship' => $scholarship_percent,
                    'course_old_price' => $course_old_price,
                    'course_cuttoff_perc'=>$course_cuttoff_perc,
                    'updated_at' =>  $this->time,
                    'created_by' => Auth::user()->id,
                    'progress_tab'=> $progress_tab,
                    'full_time_duration_month'=> $full_time_course_duration
                ];
                if($course_id == ''){
                    $select = array_merge($select, ['created_at' => $this->time]);
                }

                $updateCourse = processData(['course_master', 'id'], $select, $where);
                if (isset($updateCourse) && !is_array($updateCourse) && $updateCourse === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
                }else{
                    $where = ['course_id' => $course_id];
                    $course_id = $updateCourse['id'];

                    $select = [
                        'course_id' => $course_id,
                        'discord_joining_link' => $discord_joining_link,
                        'discord_channel_link' => $discord_channel_link,
                    ];

                    $exists = is_exist('course_other_details', ['course_id' => $course_id]);
                    if (isset($exists) && is_numeric($exists) && $exists == 0) {

                        $updateCourseOther = processData(['course_other_details', 'id'], $select);
                    }else{
                        $updateCourseOther = processData(['course_other_details', 'id'], $select,$where);
                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Basic Information updated successfully", "icon" => "success", 'data' => base64_encode($updateCourse['id'])]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }


    // Function Terminated 
    public function courseMediaUpdateAdd(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $thumbnail_img = $req->hasFile('thumbnail_img') ? $req->file('thumbnail_img') : '';
            $trailor_vid = $req->hasFile('trailor_vid') ? $req->file('trailor_vid') : '';
            $trailor_thumbnail = $req->hasFile('trailor_thumbnail') ? $req->file('trailor_thumbnail') : '';
            $course_podcast = $req->hasFile('course_podcast') ? $req->file('course_podcast') : '';
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $videoFile = $req->hasFile('video_file') ? $req->file('video_file') : '';
            $podcast_thumbnail = $req->hasFile('podcast_thumbnail') ? $req->file('podcast_thumbnail') : '';
            $validate_rules = [
                'thumbnail_img' => 'mimes:jpeg,png,jpg,svg|max:1024',
                'trailor_vid' => 'mimes:mp4|max:512000',
                'course_podcast' => 'mimes:mp4|max:512000',
                'trailor_thumbnail' => 'mimes:jpeg,png,jpg,svg|max:1024',
                'videoFile' => 'mimes:mp4|max:512000',
                'podcast_thumbnail' => 'mimes:jpeg,png,jpg,svg|max:1024',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            $exists = is_exist('course_master', ['id' => $course_id]);

            $isUpdate = FALSE;
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $isUpdate = TRUE;
            }
            if (!$validate->fails()) {

                $thumbnail_filename = '';
                $thumbnail_file = '';
                $collection_id = '';
                $trailer_filename = '';
                $trailer_thumbnail_file_name ='';
                $podcast_thumbnail_file_name = '';
                $podcast_thumbnail_file_url = '';
                $trailor_bn_id = '';
                $trailer_thumbnailFileName = '';
                $trailer_thumbnail_file= '';

               

                $collectionData = getData('course_master', ['bn_collection_id', 'bn_course_trailer_url','trailer_thumbnail_file','podcast_thumbnail_file','podcast_thumbnail_file_name','course_title','thumbnail_file_name','trailer_thumbnail_file_name','course_trailer_file_name','course_thumbnail_file'], ['id' => $course_id]);
                
                $title = isset($collectionData[0]->course_title) ? $collectionData[0]->course_title : '';

                if ($collectionData[0]->bn_collection_id == '') {

                    $collection_id = $this->CourseModule->getCollectionIdBn($title, 1);

                } else {
  
                    $collection_id = $collectionData[0]->bn_collection_id;

                    $podcast_thumbnail_file_url =  isset($collectionData[0]->podcast_thumbnail_file) ? $collectionData[0]->podcast_thumbnail_file : '';
                    $podcast_thumbnail_file_name =  isset($collectionData[0]->podcast_thumbnail_file_name) ? $collectionData[0]->podcast_thumbnail_file_name : '';

                    $trailer_filename = isset($collectionData[0]->course_trailer_file_name) ? $collectionData[0]->course_trailer_file_name : '';
                    $trailor_bn_id = isset($collectionData[0]->bn_course_trailer_url) ? $collectionData[0]->bn_course_trailer_url : '';

                    $thumbnail_filename = isset($collectionData[0]->thumbnail_file_name) ? $collectionData[0]->thumbnail_file_name : '';
                    $thumbnail_file = isset($collectionData[0]->course_thumbnail_file) ? $collectionData[0]->course_thumbnail_file : '';

                    $trailer_thumbnail_file_name = isset($collectionData[0]->trailer_thumbnail_file_name) ? $collectionData[0]->trailer_thumbnail_file_name : '';
                    $trailer_thumbnail_file = isset($collectionData[0]->trailer_thumbnail_file) ? $collectionData[0]->trailer_thumbnail_file : '';
                }

                if ($req->hasFile('thumbnail_img')) {
                    $thumbnail_filename = $thumbnail_img->getClientOriginalName();
                    $thumbnail_file =  UploadFiles($thumbnail_img, 'course/thumbnailsContent', '');
                    if ($thumbnail_file === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                    }
                }


                if (isset($collection_id) && !empty($collection_id)) {
                    if ($req->hasFile('trailor_thumbnail')) {
                        $trailer_thumbnail_file_name = $trailor_thumbnail->getClientOriginalName();
                        $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $thumbnail_filename);
                        if ($trailer_thumbnail_file === FALSE) {
                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                        }
                    }
                    if ($req->hasFile('trailor_vid')) {
                        if ($isUpdate === FALSE) {
                            $trailer_filename = $trailor_vid->getClientOriginalName();
                            $getContent =  $this->CourseModule->getVideoId($collection_id, $trailor_vid, $title . " (Trailer Video)", 1);
                            if (isset($getContent) && $getContent !== FALSE) {
                                $trailor_bn_id = $getContent['videoId'];
                                if ($req->hasFile('trailor_thumbnail')) {
                                    $trailer_thumbnail_file_name = $trailor_thumbnail->getClientOriginalName();
                                    $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', '',$thumbnail_filename);
                                    if ($trailer_thumbnail_file === FALSE) {
                                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                    }
                                    // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                    // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                    //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                    // }
                                    
                                }
                            }
                           

                        } else {
                            
                            if (isset($collectionData['trailor_bn_id']) && !empty($collectionData['trailor_bn_id'])) {
                                $getContent =  $this->CourseModule->videoAction($collectionData['trailor_bn_id'], [$collection_id, $trailor_vid, $title], 'REPLACE', 1);
                                $trailer_filename = $trailor_vid->getClientOriginalName();
                                $trailor_bn_id = $getContent['videoId'];
                                if ($req->hasFile('trailor_thumbnail')) {
                                    $trailer_thumbnail_file_name = $trailor_thumbnail->getClientOriginalName();
                                    $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $thumbnail_filename);
                                    if ($trailer_thumbnail_file === FALSE) {
                                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                    }
                                    // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                    // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                    //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                    // }
                                    
                                }
                            } else {
                                $getContent =  $this->CourseModule->getVideoId($collection_id, $trailor_vid, $title . " (Trailer Video)", 1);
                                $trailer_filename = $trailor_vid->getClientOriginalName();

                                if (isset($getContent) && $getContent !== FALSE) {
                                    $trailor_bn_id = $getContent['videoId'];
                                    if ($req->hasFile('trailor_thumbnail')) {
                                        $trailer_thumbnail_file_name = $trailor_thumbnail->getClientOriginalName();
                                        $trailer_thumbnail_file =  UploadFiles($trailor_thumbnail, 'course/thumbnailTrailer', $thumbnail_filename);
                                        if ($trailer_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        // $trailer_thumbnail_Id =  $this->CourseModule->setThumbnail($trailor_bn_id,$trailor_thumbnail,2);
                                        // if (isset($trailer_thumbnail_Id) && $trailer_thumbnail_Id !== FALSE) {
                                        //     $trailer_thumbnailFileName = $trailer_thumbnail_Id['thumbnailFileName'];
                                        // }
                                        
                                    }
                                }
                            }
                        }
                    }

                    $podcast_filename = '';
                    $whereOtherVideo = [];

                    $getOtherVideo = getData(
                        'course_other_videos',
                        ['id', 'bn_video_url_id', 'bn_collection_id','video_file_name'],
                        ['course_master_id' => $course_id]
                    );

                    $whereOtherVideo = ['course_master_id' => $course_id, 'video_type' => 1, 'is_deleted' => 'No'];
                    $exists = is_exist('course_other_videos', $whereOtherVideo);
                    
                        if ($req->hasFile('video_file')) {
                           
                            $podcast_filename = $videoFile->getClientOriginalName();
                           
                            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                                $vidoId =   $this->CourseModule->getVideoId($collection_id, $videoFile, " (Podcast Video)", 1);
                                if (isset($vidoId) && $vidoId !== FALSE) {
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        // $podcast_thumbnail_Id =  $this->CourseModule->setThumbnail($vidoId['videoId'],$podcast_thumbnail,2);
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $podcast_thumbnail_file_url);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];
                                        // if (isset($podcast_thumbnail_Id) && $podcast_thumbnail_Id !== FALSE) {
                                        //     $podcast_thumbnailFileName = $podcast_thumbnail_Id['thumbnailFileName'];
                                        // }
                                    }
                                }
                         
                            } else {

                                
                               
                                if($getOtherVideo[0]->bn_video_url_id == ''){
                                    $podcast_filename = $videoFile->getClientOriginalName();

                                    $vidoId =   $this->CourseModule->getVideoId($collection_id, $videoFile, " (Podcast Video)", 1);
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        // $podcast_thumbnail_Id =  $this->CourseModule->setThumbnail($vidoId['videoId'],$podcast_thumbnail,2);
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file  =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $podcast_thumbnail_file_url);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];

                                        // if (isset($podcast_thumbnail_Id) && $podcast_thumbnail_Id !== FALSE) {
                                        //     $podcast_thumbnailFileName = $podcast_thumbnail_Id['thumbnailFileName'];
                                        // }
                                    }
                                }else{
                                    $podcast_filename = $videoFile->getClientOriginalName();
                                    $vidoId = $this->CourseModule->videoAction($getOtherVideo[0]->bn_video_url_id, [$collection_id, $videoFile, " Podcast Video"], 'REPLACE', 1);
         
                                    if ($req->hasFile('podcast_thumbnail')) {
                                        $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                        $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $podcast_thumbnail_file_url);
                                        if ($podcast_thumbnail_file === FALSE) {
                                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                        }
                                        $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];

                                    }
                                }
                            }
                        }else{
                            if ($req->hasFile('podcast_thumbnail')) {
                                $podcast_thumbnail_file_name = $podcast_thumbnail->getClientOriginalName();
                                $podcast_thumbnail_file =  UploadFiles($podcast_thumbnail, 'course/thumbnailPodcast', $podcast_thumbnail_file_url);
                                if ($podcast_thumbnail_file === FALSE) {
                                    return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => 'error']);
                                }
                                $podcast_thumbnail_file_url = $podcast_thumbnail_file['url'];
                            }
                        }
                        
                } else {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Unable to Create Video Module2', "icon" => "error"]);
                }
                

                
                $select = [
                    'course_master_id' => $course_id,
                    'bn_collection_id' =>  $collection_id,
                    'video_title' => $title . " (Podcast Videos)",
                    'video_file_name'=>$podcast_filename,
                    'created_by' => $admin_id,
                    'video_type' => 1,
                    'status' => 1,
                    'created_at' =>  $this->time
                ];
                if ($req->hasFile('video_file')) {
                    $select = array_merge(['bn_video_url_id' => $vidoId['videoId']], $select);
                    $updateCourse = processData(['course_other_videos', 'id'], $select, $whereOtherVideo);

                }
                $select = [
                    'id' => $course_id,
                    'updated_at' =>  $this->time,
                    'course_thumbnail_file' => !empty($thumbnail_file['url']) ? $thumbnail_file['url'] : $thumbnail_file,
                    'thumbnail_file_name' => $thumbnail_filename,
                    'bn_course_trailer_url' => !empty($trailor_bn_id) ? $trailor_bn_id : '',
                    'course_trailer_file_name'=>$trailer_filename,
                    'trailer_thumbnail_file' => !empty($trailer_thumbnail_file['url']) ? $trailer_thumbnail_file['url'] : $trailer_thumbnail_file,
                    'trailer_thumbnail_file_name' => $trailer_thumbnail_file_name,
                    'podcast_thumbnail_file'=>$podcast_thumbnail_file_url,
                    'podcast_thumbnail_file_name'=>$podcast_thumbnail_file_name,
                    'updated_at' =>  $this->time,
                    'bn_collection_id' => $collection_id
                ];

                // if (isset($title) && !empty($title)) {
                //     $select = array_merge($select, ['bn_module_name' => $title]);
                // }

                $updateUserProfile = false;
                // if (isset($trailor_bn_id) && Storage::disk('local')->exists($thumbnail_file['url'])) {

                    $where = ['id' => $course_id];
                    $updateCourseMaster = processData(['course_master', 'id'], $select, $where);
                // }


               

                if (isset($updateCourseMaster) && $updateCourseMaster === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                } else {
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Course media details updated successfully", "icon" => "success", "data" => base64_encode($course_id)]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }
    // public function AwardCourseList($cat = '', $action = '')
    // {
    //     if (Auth::check()) {
    //         $CourseData = [];
    //         $where = [
    //             'category_id' => 1
    //         ];
    //         if (isset($cat) && !empty($cat)) {

    //             $where = array_merge($where, ['status' => $cat]);
    //             if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
    //                 $id = base64_decode($cat);
    //                 $exist = is_exist('course_master', ['id' => $id]);
    //                 if ($exist > 0) {
    //                     $where = [
    //                         'id' => $id
    //                     ];
    //                 } else {
    //                     return redirect()->back()->with('msg', 'Module not Exist');
    //                 }
    //             }
    //         }
    //         $CourseData = $this->CourseModule->getCouresDetails($where);
    //         foreach ($CourseData as $key => $course) {
    //             // Check if the course is enrolled using a custom function `is_enrolled`
    //             $CourseData[$key]['is_enrolled'] = is_enrolled('', $course['id']);
    //         }

    //         // return  $CourseData;
    //         if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
    //             return view('/admin/course/award-course-add', compact('CourseData'));
    //         }
    //         return response()->json($CourseData);
    //     }
    //     return redirect('/login');
    // }
    public function AwardCourseList(Request $request,$cat = '',$action ='')
    {
        if (Auth::check()) {
            
            $CourseData = [];
            $where = [];
            $limit = $request->input('length'); // Number of records per page
            $offset = $request->input('start'); // Start index for the current page
            $searchValue = $request->input('search.value', ''); // Get the search term
            // $CourseData = [];
            $where = [
                'category_id' => 1
            ];
            if (isset($cat) && !empty($cat)) {
                if($cat != 'all'){
                    $where = array_merge($where, ['status' => $cat]);
                }
                if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                    $id = base64_decode($cat);
                    $exist = is_exist('course_master', ['id' => $id]);
                    if ($exist > 0) {
                        $where = [
                            'id' => $id
                        ];
                    } else {
                        return redirect()->back()->with('msg', 'Module not Exist');
                    }
                }
            }

            if(!empty($cat)){
                $CourseData = $this->CourseModule->getCouresDetails($where,[],$offset,$limit,$searchValue);
                $CourseDatas = $CourseData['data'];
                $totalRecords = $CourseData['count'];
                             
                foreach ($CourseDatas as $key => $course) {
                    // Check if the course is enrolled using a custom function `is_enrolled`
                    $CourseDatas[$key]['is_enrolled'] = is_enrolled('', $course['id']);
                }
            }else{
                $CourseData = $this->CourseModule->getCouresDetails($where);
                $CourseDatas = $CourseData['data'];
                $totalRecords = $CourseData['count'];
            }

            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                $CourseData = $CourseData['data'];
                return view('/admin/course/award-course-add', compact('CourseData'));
            }
            $response = [
                "draw" => intval($request->input('draw')), // Draw counter for DataTables
                "recordsTotal" => $totalRecords, // Total number of records
                "recordsFiltered" => $totalRecords, // Number of records after filtering (same as total if no filtering is applied)
                "data" => $CourseDatas// The actual data to be displayed
            ];            
            return response()->json($response);


        }
        return redirect('/login');
    }
    
    public function AllCourseList(Request $request,$action ='')
    {
        if (Auth::check()) {
            
            $CourseData = [];
            $where = [];
            $limit = $request->input('length'); // Number of records per page
            $offset = $request->input('start'); // Start index for the current page
            $searchValue = $request->input('search.value', ''); // Get the search term
            // $CourseData = [];
            // $where = [
            //     'category_id' => 1
            // ];
            // if (isset($cat) && !empty($cat)) {
            //     if($cat != 'all'){
            //         $where = array_merge($where, ['status' => $cat]);
            //     }
            //     if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
            //         $id = base64_decode($cat);
            //         $exist = is_exist('course_master', ['id' => $id]);
            //         if ($exist > 0) {
            //             $where = [
            //                 'id' => $id
            //             ];
            //         } else {
            //             return redirect()->back()->with('msg', 'Module not Exist');
            //         }
            //     }
            // }

            if(!empty($action)){
                $CourseData = $this->CourseModule->getCouresDetails($where,[],$offset,$limit,$searchValue);
                $CourseDatas = $CourseData['data'];
                $totalRecords = $CourseData['count'];
                             
                foreach ($CourseDatas as $key => $course) {
                    // Check if the course is enrolled using a custom function `is_enrolled`
                    $CourseDatas[$key]['is_enrolled'] = is_purchased('', $course['id']);
                    $CourseDatas[$key]['total_students'] = total_purchased_students('', $course['id']);

                }
            }else{
                $CourseData = $this->CourseModule->getCouresDetails($where);
                $CourseDatas = $CourseData['data'];
                $totalRecords = $CourseData['count'];
            }
            
            $response = [
                "draw" => intval($request->input('draw')), // Draw counter for DataTables
                "recordsTotal" => $totalRecords, // Total number of records
                "recordsFiltered" => $totalRecords, // Number of records after filtering (same as total if no filtering is applied)
                "data" => $CourseDatas// The actual data to be displayed
            ];       
            return response()->json($response);


        }
        return redirect('/login');
    }
    public function courseAssignSection(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $section_ids =  isset($req->section_id) && is_array($req->section_id) ? $req->input('section_id') : [];
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            
            $where = ['id' => $course_id];
            $existsCourse = is_exist('course_master', $where);
          
            if (isset($existsCourse) && isset($existsCourse) && $existsCourse > 0) {
                $getExistSections = getDataArray('course_managment_master', ['section_id'], ['course_master_id' => $course_id, 'is_deleted' => 'No']);

                // if (count($section_ids) > 0) {
                try {
                        foreach ($getExistSections as $section) {
                            $where = [
                                'course_master_id' => $course_id,
                                'section_id' => $section->section_id,
                            ];
                            $select = [
                                'is_deleted' => 'Yes',
                                'deleted_by' => $admin_id,
                                'last_update_by' => $admin_id,
                            ];
                            processData(['course_managment_master', 'id'], $select, $where);
                        }

                        $i = 0;

                        foreach ($section_ids as $sectionId) {
                            $section_id = base64_decode($sectionId);
                            $whereCourseSection = ['id' => $section_id];
                            $existsSection = is_exist('course_section_masters', $whereCourseSection);


                            if (isset($existsSection) && isset($existsSection) && $existsSection > 0) {

                                $whereCourseSection = ['course_master_id' => $course_id, 'section_id' => $section_id];
                                $existsCourse = is_exist('course_managment_master', $whereCourseSection);
                                $assign = $i + 1;



                                $where = [];
                                if (isset($existsCourse) && isset($existsCourse) && $existsCourse > 0) {

                                    $where = [
                                        'course_master_id' => $course_id,
                                        'section_id' => $section_id,
                                    ];
                                    $select = [
                                        'placement_id' => $assign,
                                        'last_update_by' => $admin_id,
                                        'is_deleted' => 'No',
                                        'deleted_by' => 0,
                                    ];
                                } else {
                                    $select = [
                                        'course_master_id' => $course_id,
                                        'section_id' => $section_id,
                                        'placement_id' => $assign,
                                        'last_update_by' => $admin_id,
                                        'is_deleted' => 'No',
                                        'deleted_by' => 0,
                                        'created_at' =>  $this->time

                                    ];
                                }

                                $updateSection = processData(['course_managment_master', 'id'], $select, $where);
                                if (isset($updateSection) && $updateSection['status'] === true) {
                                    $i++;
                                }
                            }
                        }
                        if (isset($i) && $i > 0) {
                            return json_encode(['code' => 200, 'title' => "Section Assigned", 'message' => 'Section assigned successfully', "icon" => "success"]);
                        }
                        // return json_encode(['code' => 200, 'title' => "Section Already Added", "message" => "Section Assign Successfully", "icon" => "success"]);
                        return json_encode(['code' => 200, 'title' => "Section Assigned", 'message' => 'Section assign successfully', "icon" => "success"]);

                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                }
             
            // } else {
            //     return json_encode(['code' => 201, 'title' => "Section Not Exists ", 'message' => 'Please Assign Any One Section', "icon" => "error"]);
            // }
            } else {
                return json_encode(['code' => 201, 'title' => "Course Not Exists", 'message' => 'Please Assign Any One Section', "icon" => "error"]);
            }

        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again ', "icon" => "error"]);
        }
    }
    public function courseModuleMaster(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $course_id = isset($request->course_id) ? base64_decode($request->input('course_id')) : '';
            $main_course_id =  isset($request->main_course_id) && is_array($request->main_course_id) ? $request->input('main_course_id') : [];
            $optional_course_id =  isset($request->optional_course_id) && is_array($request->optional_course_id) ? $request->input('optional_course_id') : [];

                $exists = is_exist('course_master', ['id' => $course_id]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                   
                    $getExistAwardCourse = getDataArray('master_course_management', ['course_id','optional_course_id'], ['award_id' => $course_id, 'is_deleted' => 'No']);
                    try {
                        foreach ($getExistAwardCourse as $data) {
                            $where = [
                                'award_id' => $course_id,
                                'course_id'=> $data->course_id,
                                'optional_course_id'=> $data->optional_course_id
                            ];
                            $select = [
                                'is_deleted' => 'Yes',
                                'deleted_by' => $admin_id,
                                'last_update_by' => $admin_id,
                            ];
                            processData(['master_course_management', 'id'], $select, $where);
                        }   

                        $i = 0;

                        foreach ($main_course_id as $key => $course_award_data) {
                            $courseAwardId = base64_decode($course_award_data);
                            $whereCourseSection = ['award_id' => $course_id,'course_id'=> $courseAwardId];
                            $existsMasterSection = is_exist('master_course_management', $whereCourseSection);
                            $assign = $i + 1;

                            $where = [];
                            if (isset($existsMasterSection) && isset($existsMasterSection) && $existsMasterSection > 0) {
                                $select = [
                                    'updated_at' => $this->time,
                                    'last_update_by' => $admin_id,
                                    'placement_id' => $key,
                                    'course_id' => $courseAwardId,
                                    'is_deleted'=>'No'
                                ];
                            }else{
                                $select = [
                                    'award_id' => $course_id,
                                    'course_id' => $courseAwardId,
                                    'placement_id' => $key,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time
                                ];
                            }
                            $updateCourse = processData(['master_course_management', 'id'], $select,$whereCourseSection);
                            if (isset($updateCourse) && $updateCourse['status'] === true) {
                                $i++;
                            }
                        }

                        foreach ($optional_course_id as $key => $course_award_data) {
                            $courseAwardId = base64_decode($course_award_data);
                            $whereCourseSection = ['award_id' => $course_id,'optional_course_id'=> $courseAwardId];
                            $existsMasterSection = is_exist('master_course_management', $whereCourseSection);
                            $assign = $i + 1;

                            $selectCourse = [
                                'preference_status'=>'0'
                            ];
                            $updateCourse = processData(['course_master', 'id'], $selectCourse,['id'=>$course_id]);

                            $where = [];
                            if (isset($existsMasterSection) && isset($existsMasterSection) && $existsMasterSection > 0) {
                                $select = [
                                    'updated_at' => $this->time,
                                    'last_update_by' => $admin_id,
                                    'placement_id' => $key,
                                    'optional_course_id' => $courseAwardId,
                                    'is_deleted'=>'No'
                                ];
                            }else{
                                $select = [
                                    'award_id' => $course_id,
                                    'optional_course_id' => $courseAwardId,
                                    'placement_id' => $key,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time
                                ];
                            }
                            $updateCourse = processData(['master_course_management', 'id'], $select,$whereCourseSection);
                            if (isset($updateCourse) && $updateCourse['status'] === true) {
                                $i++;
                            }
                        }

                        if (isset($i) && $i > 0) {
                            return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Courses module uploaded successfully", "icon" => "success", "data" => '']);
                        }
                        // return json_encode(['code' => 200, 'title' => "Section Already Added", "message" => "Section Assign Successfully", "icon" => "success"]);
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Courses module uploaded successfully", "icon" => "success", "data" => '']);

                    } catch (\Throwable $th) {
                        return $th;
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                        // $whereCourseSection = '';
                        // foreach ($request->main_course_id as $key => $value) {
                        
                        //     $whereCourseSection = ['award_id' => $course_id,'course_id'=>base64_decode($value)];
                        //     $existsMasterSection = is_exist('master_course_management', $whereCourseSection);

                        //         if (isset($existsMasterSection) && isset($existsMasterSection) && $existsMasterSection > 0) {
                        //             $select = [
                        //                 'updated_at' => $this->time,
                        //                 'last_update_by' => $admin_id,
                        //                 'placement_id' => $key,
                        //                 'course_id' => base64_decode($value),
                        //                 'is_deleted'=>'No'
                        //             ];
                        //         }else{
                        //             $select = [
                        //                 'award_id' => $course_id,
                        //                 'course_id' => base64_decode($value),
                        //                 'placement_id' => $key,
                        //                 'last_update_by' => $admin_id,
                        //                 'created_at' =>  $this->time
                        //             ];
                        //         }
                        //         $updateCourse = processData(['master_course_management', 'id'], $select,$whereCourseSection);
                        //         if (isset($updateCourse) && $updateCourse['status'] === true) {
                        //             $i++;
                        //         }
                        // }
                        
                        // $decodedValues = array_map('base64_decode', $request->main_course_id);

                        // $concatenatedString = implode(',', $decodedValues);

                        // $myArray = explode(',', $concatenatedString);

                        //     $MasterCourseData = DB::table('master_course_management')
                        //     ->whereNotIn('course_id', $myArray)
                        //     ->where('award_id',$course_id)
                        //     ->get();
                            

                        //     foreach($MasterCourseData as $award){
                        //         $select = [
                        //             'is_deleted'=>'Yes'
                        //         ];
                        //         $whereCourseSection = ['id'=> $award->id];

                        //         $updateCourseDelete = processData(['master_course_management', 'id'], $select,$whereCourseSection);
                               
                        //     }
                    if($request->main_course_id){
                        if (isset($i) && $i > 0) {
                            return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Courses module uploaded successfully", "icon" => "success", "data" => '']);
                        }else{
                            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                        }
                    }
                    // $updateCourse = processData(['course_master', 'id'], $select);
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Courses module uploaded successfully", "icon" => "success", "data" => '']);

                } else {
                    return json_encode(['code' => 201, 'title' => "Module Not Exist", 'message' => 'Please Try Again', "icon" => "warning"]);
                }
            // } else {
            //     return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            // }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }

    public function CourseEdit($id)
    {

        $decodedCourseId = base64_decode($id);
        $where = [
            'id' => $decodedCourseId
        ];

        $CourseData = $this->CourseModule->getCouresDetails($where);

        $CourseData = $CourseData['data'];

        return view('admin.course.add-course', compact('CourseData'));
    }

    
    public function statusCourse(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "course_master";
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
                    $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
                    $where = ['id' => $id, 'is_deleted' => 'No'];
                    $exists = is_exist($table, $where);
                   
                    if (isset($exists) && $exists > 0) {
                        $where = ['id' => $id];
                        if($status == 'course_status_publish'){
                            $selectData = [
                                'status' => '3',
                                'published_on' => now(),
                            ];
                            $Message = "Status Changed";
                            $Text_Message = "Status changed";

                            $updateCourse = processData([$table, 'id'], $selectData , $where);

                        }
                        if($status == 'course_status_unpublish'){
                            $selectData = [
                                'status' => '2',
                                'published_on' => null,
                            ];
                            $Message = "Status Changed";
                            $Text_Message = "Status changed";
                            $updateCourse = processData([$table, 'id'], $selectData , $where);

                        }
                        if($status == 'course_status_draft'){
                            $selectData = [
                                'status' => '1',
                                'published_on' => null,
                            ];
                            $Message = "Status Changed";
                            $Text_Message = "Status changed";
                            $updateCourse = processData([$table, 'id'], $selectData , $where);

                        }
                        if (isset($updateCourse) && $updateCourse['status'] == TRUE) {
                            
                            $dashboardController = new DashboardController();
                            $dashboardData = $dashboardController->getDashboardData();

                            return json_encode(['code' => 200, 'title' => "Successfully $Message", "message" => " $Text_Message successfully", "icon" => "success"]);
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                    
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => "error"]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => "error"]);
        }
    }

    public function expiredCourse(Request $req){
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $exists = is_exist('course_master', ['id' => $course_id]);
            $validate_rules = [
                'course_id' => 'required'
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    try {
                        $courseExpired = is_expired(['course_id' => $course_id]);
                        if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired >= 0) {
                            return response()->json(['code' => 200, 'title'=>'Unpublish Course','message' => "       Are you sure you want to unpublish this course? <br> This will remove access for all ".$courseExpired." active students.", 'icon' => 'warning']);
                        }
                    } catch (\Throwable $th) {
                        DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                }else{
                    return json_encode(['code' => 201, 'title' => "Course not exist", 'message' => 'Course does not exists', "icon" => "error"]);

                }
            } else {
                return json_encode(['code' => 201, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "warning", 'data' => $validate->errors()]);
            }
        }
    }

    public function deleteCourse(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $table = "course_master";
            $course_id = isset($req->course_id) ? base64_decode($req->input('course_id')) : '';
            $exists = is_exist('course_master', ['id' => $course_id]);
            $validate_rules = [
                'course_id' => 'required'
            ];
            $validate_rules = [
                'course_id' => 'required'
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    try {
                        // DB::beginTransaction();
                        $deleteStudent = $this->CourseModule->deleteCourseData($course_id);
                        return response()->json(['code' => 200, 'title' => 'Records Successfully Deleted', 'icon' => 'success']);
                        
                        // DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    } catch (\Throwable $th) {
                        // DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                }else{
                    return json_encode(['code' => 201, 'title' => "Course not exist", 'message' => 'Course does not exists', "icon" => "error"]);

                }
            } else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
            }
        }
    }


    public function getCoursePanelData($course_id)
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
                    return view('admin/course/admin-course-panel', compact('courseDetails'));
                }
            }
        }
        return redirect()->back();
    }
    public function getMasterCoursePanelData($course_id)
    {
        if (isset($course_id) && !empty($course_id)) {
            $course_id = isset($course_id) ? base64_decode($course_id) : 0;
            $MasterCourseData = [];
            if (!empty($course_id) && is_numeric($course_id)) {
                $exists = is_exist('course_master', ['id' => $course_id,'status' => 3]);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'award_id' => $course_id
                    ];
                    $MasterCourseData = $this->MasterCourseManage->getMasterCouresData($where);
                    //  return response()->json(['data' => $awardCourseData]);
                    
                      return view('admin/course/admin-master-course-panel', compact('MasterCourseData','course_id'));
                    
                }
            }
        }
        return redirect()->back();
    }

    
    public function searchCourseList(Request $req)
    {
        if (Auth::check() && !empty($req->search) && isset($req->search) && !empty($req->course_id) && isset($req->course_id) && $req->ajax()) {
            $courseData = [];
            $where = ['course_title' => htmlspecialchars($req->search)];
            $select = ['course_title', 'id'];
            $courseData = $this->CourseModule->getCourseSearch($where, $select);
            return response()->json($courseData);
        }
        return redirect('/login');
    }
    public function CourseAlreadyAdded(Request $req)
    {   

        if (Auth::check() && !empty($req->course_id) && isset($req->course_id) && $req->ajax()) {
            $sectionData = [];
            $decodedCourseId = base64_decode($req->course_id);
            $decodedMainCourseId = base64_decode($req->main_course_id);
            $existsSection = DB::table('master_course_management')
                ->where('award_id', $decodedCourseId)
                ->where(function ($query) use ($decodedMainCourseId) {
                    $query->where('course_id', $decodedMainCourseId)
                        ->orWhere('optional_course_id', $decodedMainCourseId);
                })
                ->where('is_deleted', 'No')
                ->exists();
            if (isset($existsSection) && isset($existsSection) && $existsSection > 0) {
                return "true";
            }else{
                return "false";
            }
        }
        return redirect('/login');
    } 
}