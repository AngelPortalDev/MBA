<?php

namespace App\Http\Controllers\Admin\SectionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator, DB};


class CourseVideoController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function getSectionVideos(Request $req)
    {
        if (Auth::check()) {
            $id = isset($req->id) ? base64_decode($req->input('id')) : '';
            $action = isset($req->action) ? base64_decode($req->input('action')) : '';
            $videoData = [];
            if (!empty($section_id) && is_numeric($section_id) && empty($action)) {
                $exists = is_exist('course_section_masters', ['id' => $id, 'is_deleted' => 'No', 'is_active' => 'Yes']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'section_id' => $section_id, 'is_deleted' => 'No'
                    ];
                    $videoData = $this->videosData->getVideos($where);
                }
            } elseif (!empty($action) && $action === 'edit') {
              
                $exists = is_exist('course_modules_videos', ['id' => $id, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = [
                        'id' => $id, 'is_deleted' => 'No'
                    ];
                    
                    $videoData = $this->videosData->getVideos($where);
                  
                }
            } elseif (!empty($action) && $action === 'deleted') {

                $where = [
                    'is_deleted' => 'Yes'
                ];
                $videoData = $this->videosData->getVideos($where);

            } else {

                $where = [
                    'is_deleted' => 'No'
                ];
                $videoData = $this->videosData->getVideos($where);
            }
            
            return response()->json(['data' => $videoData]);
        }
        return redirect('/login');
    }
    public function courseVideoUpload(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $video_title = isset($req->video_title) ? htmlspecialchars($req->input('video_title')) : '';
            $section_id = isset($req->section_id) ? base64_decode($req->input('section_id')) : '';
            $video_type = isset($req->video_type) ? base64_decode($req->input('video_type')) : '';
            $video_table_id = isset($req->video_id) ? base64_decode($req->input('video_id')) : '';
            $video_id = isset($req->guid) ? base64_decode($req->input('guid')) : '';
            $video_length = isset($req->video_length) ? base64_decode($req->input('video_length')) : '';
            $collection_id = isset($req->collection_id) ? base64_decode($req->input('collection_id')) : '';
            // $videoFile = $req->hasFile('video_file') ? $req->file('video_file') : '';
            // $video_duration = isset($req->video_duration) ? htmlspecialchars($req->input('video_duration')) : 0;

            if($video_id){
                $validate_rules = [
                    'video_title' => 'required|string|max:150',
                    // 'video_file' => [ 'file', function ($attribute, $value, $fail) {
                    //     // Check if the uploaded file is a PDF
                    //     if ($value->getClientOriginalExtension() === 'pdf') {
                    //         // Validate PDF file size (up to 5MB)
                    //         if ($value->getSize() > 5 * 1024 * 1024) {
                    //             $fail('The PDF file must be up to 5MB in size.');
                    //         }
                    //     } elseif ($value->getClientOriginalExtension() === 'mp4') {
                    //         // Validate MP4 file size (up to 2GB)
                    //         if ($value->getSize() > 2 * 1024 * 1024 * 1024) {
                    //             $fail('The MP4 file must be up to 2GB in size.');
                    //         }
                    //     } else {
                    //         // Fail validation if the file type is neither PDF nor MP4
                    //         $fail('The uploaded file must be either a PDF or an MP4.');
                    //     }
                    // }]
                ];
            }else{
                $validate_rules = [
                    'video_title' => 'required|string|max:150',
                    // 'video_file' => ['required', 'file', function ($attribute, $value, $fail) {
                    //     // Check if the uploaded file is a PDF
                    //     if ($value->getClientOriginalExtension() === 'pdf') {
                    //         // Validate PDF file size (up to 5MB)
                    //         if ($value->getSize() > 5 * 1024 * 1024) {
                    //             $fail('The PDF file must be up to 5MB in size.');
                    //         }
                    //     } elseif ($value->getClientOriginalExtension() === 'mp4') {
                    //         // Validate MP4 file size (up to 2GB)
                    //         if ($value->getSize() > 2 * 1024 * 1024 * 1024) {
                    //             $fail('The MP4 file must be up to 2GB in size.');
                    //         }
                    //     } else {
                    //         // Fail validation if the file type is neither PDF nor MP4
                    //         $fail('The uploaded file must be either a PDF or an MP4.');
                    //     }
                    // }]
                ];
            }


            $exists = is_exist('course_section_masters', ['id' => $section_id]);
            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {
                $validate = Validator::make($req->all(), $validate_rules);
                if (!$validate->fails()) {


                    if (empty($video_id)) {

                        $exists = is_exist('course_modules_videos', ['video_title' => $video_title,'section_id'=> $section_id,'is_deleted' => 'No']);
                        if (isset($exists) && is_numeric($exists) && $exists > 0) {
                            return json_encode(['code' => 201, 'title' => "Video already exist.", 'message' => 'Please Select Correct Video', "icon" => generateIconPath("error")]);
                        }
    
                    }
                    // if (isset($video_id) && !empty($video_id)) {
                    //     $exists = is_exist('course_modules_videos', ['id' => $video_id, 'is_deleted' => 'No']);
    
                    //     $getVideoData = getData('course_modules_videos', ['video_title','id'],['id' => $video_id]);
                    //     $video_title_check = $getVideoData[0]->video_title;
                    //     if($video_title != $video_title_check){
                    //         $exists = getData('course_modules_videos',['video_title','id'],['video_title' => $video_title,'section_id'=> $section_id,'is_deleted' => 'No']);

                    //         if (isset($exists[0]) && !empty($exists[0])) {

                    //             if ($video_id != $exists[0]->id) {

                    //                 return json_encode(['code' => 201, 'title' => "Video already exist.", 'message' => 'Please Select Correct Video', "icon" => generateIconPath("error")]);
                    //             }
                    //         }else{

                    //             $where = ['id' => $video_id];
                    //         }
                    //     }

                    // }
                    
                    // if($req->hasFile('video_file')){
                    // $filename = $videoFile->getClientOriginalName();

                    // if($videoFile->getClientOriginalExtension() == 'pdf'){
                    //     $orientation_file =  UploadFiles($videoFile, 'course/orientation', '');
                    //     $collection_id = '';
                    //     $orientationUrl = isset($orientation_file['url']) ? $orientation_file['url'] : 'No File';
                    //     $videolength ='';
                    //     $VideoFileType = "PDF";
                    // }else{
                        
                        if (is_numeric($section_id) && !empty($section_id) && !empty($video_type) &&  $video_type === 'COURSE_VIDEO') {
                            $library  = 2;
                            $section_name = '';
                            // $collection_id = '';
                            $getModuleData = getData(
                                'course_section_masters',
                                ['id', 'bn_collection_id', 'section_name'],
                                ['id' => $section_id]
                            );
                            $collection_id = $collection_id;
                            // $section_name = $getModuleData[0]->section_name;
                            if($video_id > 0){
                                $getOriData = getData(
                                    'course_modules_videos',
                                    ['bn_video_url_id'],
                                    ['id' => $video_id]
                                );
        
                                // $videoId = $getOriData[0]->bn_video_url_id;
                                // $delete = $this->CourseModule->videoAction($videoId, [], 'DELETE', $library);
                                $VideoFileType = 'Video';
                            }
                        } elseif (is_numeric($section_id) && !empty($section_id) && !empty($video_type) && $video_type === 'ORIENTATIOIN') {
                            $collection_id = '58247364-9dd9-4571-be3c-621a3137130d';
                            $library  = 1;
                        }
                        if (!isset($collection_id) && $collection_id === null) {
                            // $collection_id =   $this->CourseModule->getCollectionIdBn($section_name, $library);
                            $updateCourse = processData(['course_section_masters', 'id'], [
                                'bn_collection_id' => $collection_id
                            ], [
                                'id' => $section_id
                            ]);
                        }
                        // $vidoId = $this->CourseModule->getVideoId($collection_id,$videoFile,$video_title,$library);

                        // $vidoId =  UploadFiles($videoFile, 'course/orientation', '');

                        // if (isset($vidoId) && is_array($vidoId) && $vidoId['status'] === TRUE && $vidoId['videoId'] != '') {
                        // // if (isset($vidoId)) {
                        //     $orientationUrl = $vidoId['videoId'];
                        //     $videolength = $video_duration;
                        //     $VideoFileType = "Video";
                        // } else {
                        //     return json_encode(['code' => 201, 'title' => "Unable to Upload Video", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                        // }
                    // }
                    // }else{
        
                    //     if($video_id > 0){
                    //         $getOriData = getData(
                    //             'course_modules_videos',
                    //             ['id', 'bn_collection_id', 'bn_video_url_id','video_file_name','video_duration'],
                    //             ['id' => $video_id]
                    //         );
    
                    //         $collection_id = $getOriData[0]->bn_collection_id;
                    //         $orientationUrl = $getOriData[0]->bn_video_url_id;
                    //         $videolength = $getOriData[0]->video_duration;
                    //         $filename = $getOriData[0]->video_file_name;
                    //         $VideoFileType = "Video";

                    //     }
                    // }   
                    $where =[];
                    $wheresection = [];
                    if($video_id > 0){
                        $where = ['id' => $video_table_id];
                        // $wheresection = ['content_id'=>$video_id];
                    }
                    if ($video_length === null || $video_length === 0) {
                        return json_encode([
                            'code' => 201,
                            'title' => "Something Went Wrong",
                            'message' => 'Video duration not found. Please try again.',
                            'icon' => generateIconPath("error")
                        ]);
                    }
                            // $minutes = floor($video_length / 60);
                            // $seconds = $video_length % 60;
                            
                            // $formatted_duration = sprintf('%02d:%02d', $minutes, $seconds);
                            // dd($formatted_duration);
                            
                            $hours = floor($video_length / 3600);
                            $minutes = floor(($video_length % 3600) / 60);
                            $seconds = $video_length % 60;

                            $formatted_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                            $select = [
                                'section_id' => $section_id,
                                'bn_collection_id' => $collection_id,
                                'video_title' => $video_title,
                                'bn_video_url_id' => $video_id,
                                'created_by' => $admin_id,
                                'created_at' =>  $this->time,
                                'video_duration' => $formatted_duration,
                                'video_file_name' => $video_title,
                                'status' => 1
                            ];

                            $updateCourse = processData(['course_modules_videos', 'id'], $select,$where);
                            if (isset($updateCourse) && $updateCourse !== FALSE) {
                                $cols = [
                                    'section_id' => $section_id,
                                    'content_id' => $updateCourse['id'],
                                    'content_type_id' => 1,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time,
                                    'is_deleted' => 'No'

                                ];
                                $wheresection = ['content_id'=>$updateCourse['id']];
                                $updateCourse = processData(['section_managment_master', 'id'], $cols,$wheresection);
                                if (isset($updateCourse) && $updateCourse === FALSE) {
                                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                                }
                            

                            return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => "$VideoFileType uploaded successfully", "icon" => generateIconPath("success"), "data" => base64_encode($updateCourse['id'])]);
                       
                    }
                } else {
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please provide required info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Section Not Exist", 'message' => 'Please try again', "icon" => generateIconPath("warning")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteVideo(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "course_modules_videos";
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
            $video_type = isset($req->video_type) ? base64_decode($req->input('video_type')) : '';

          
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $videoData =  getData($table, ['bn_video_url_id','bn_collection_id'], $where);

                $videoId = $videoData[0]->bn_video_url_id;
                $select = [
                    'is_deleted' => 'Yes',
                    'deleted_by' => $admin_id
                ];
                // $updateSection = processData([$table, 'id'], $select, $where);
                try {
                    DB::beginTransaction();
                    $delete = $this->CourseModule->deleteVideos($videoId,2);
                    if($delete['status'] == TRUE){
                        $updateSection = processData([$table, 'id'], $select, $where);

                        $sectionAssginwhere = ['content_type_id' => 1, 'content_id' => $id];
                        $updateSectionManagement = processData(['section_managment_master', 'id'], $select, $sectionAssginwhere);


                    }
                    
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        $VideoFileType = 'Video';
                        return json_encode(['code' => 200, 'title' => "$VideoFileType  Successfully Deleted", "message" => "$VideoFileType deleted successfully", "icon" => generateIconPath("success")]);
                    }

                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique Name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteSection(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "course_section_masters";
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
            $id = (int) $id;
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'is_deleted' => 'Yes',
                    'deleted_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $whereSection = ['section_id' => $id];
                    $sectionData =  getData($table, ['bn_collection_id'], $where);
                    $collection_id = $sectionData[0]->bn_collection_id;
                    $delete = $this->CourseModule->deleteCollection($collection_id,2);
                    if($delete['status'] == TRUE){
                        $updateSection = processData([$table, 'id'], $select, $where);
                        if (isset($updateSection) && $updateSection['status'] === true) {
                            
                            $deleted_section = DB::table('section_managment_master')->where($whereSection)->update($select);
                            // return  $deleted_section;
                            if (isset($updateSection) && $updateSection['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Section Deleted", "message" => "Section deleted successfully", "icon" => generateIconPath("success")]);
                            }
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try Again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    return $th;
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteSectionContent(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $content_type =  isset($req->content_type) ? base64_decode($req->input('content_type')) : 0;


            $table = "section_managment_master";
            $where = ['content_id' => $id, 'content_type_id' => $content_type, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'is_deleted' => 'Yes',
                    'deleted_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] == '1') {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Removed', "message" => "Section content unassign successfully.", "icon" => "success"]);
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
        }
    }
    public function assignContent(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $section_id =  isset($req->section_id) ? base64_decode($req->input('section_id')) : 0;
            $content_id =  isset($req->content_id) && is_array($req->content_id) ? $req->input('content_id') : [];
            $content_type_id =  isset($req->content_type_id) && is_array($req->content_type_id) ? $req->input('content_type_id') : [];
            $section_title =  isset($req->section_title) ? htmlspecialchars($req->input('section_title')) : '';
            $validate_rules = [
                'section_title' => 'required|string|max:150|min:5',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if ($validate->fails()) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please try again', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);

            }
            $where = ['id' => $section_id, 'is_deleted' => 'No'];
            $exists = is_exist('course_section_masters', $where);
            if (isset($exists) && is_numeric($exists) && $exists > 0) {

                $sectionData = getData('course_section_masters', ['bn_collection_id'], ['id' => $section_id]);
                $libraryId = env('AWARD_LIBRARY_ID');
                $collectionId = isset($sectionData[0]->bn_collection_id) ? $sectionData[0]->bn_collection_id : 0;
                $collection = $this->CourseModule->updateCollection($libraryId, $collectionId, $section_title);
                        
                if(isset($collection['code']) && $collection['code'] == 200){

                    $update = 
                    [
                        'section_name' => $section_title,
                    ];
                    
                    $updateSectionName = processData(['course_section_masters', 'id'], $update, $where);
                }
                
                foreach ($content_id as $key => $enc_id) {
                    $content_type = base64_decode($content_type_id[$key]);
                    $id = base64_decode($enc_id);
                    $cols = [
                        'section_id' => $section_id,
                        'content_id' => $id,
                        'content_type_id' => $content_type,
                        'is_deleted' => 'No'
                    ];
                    $existsContent = is_exist('section_managment_master', $cols);
                    $updateSection = TRUE;
                    $placement_id = $key + 1;
                    
                    if (isset($existsContent) && is_numeric($existsContent) && $existsContent === 0) {
                        $update = array_merge(
                            $cols,
                            [
                                'placement_id' => $placement_id,
                                'last_update_by' => $admin_id,
                                'created_at' =>  $this->time
                            ]
                        );
                        $updateSection = processData(['section_managment_master', 'id'], $update);
                    } else {

                        $update = 
                            [
                            'placement_id' => $placement_id,
                            'last_update_by' => $admin_id,
                            ];

                        $updateSection = processData(['section_managment_master', 'id'], $update, $cols);
                    }

                }
                if (isset($updateSection) && $updateSection === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
                return json_encode(['code' => 200, 'title' => 'Successfully Assigned', "message" => "Section content assigned successfully", "icon" => generateIconPath("success")]);
            } else {
                return json_encode(['code' => 201, 'title' => "Section Not Exists ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
        }
    }

    public function editOrientation(Request $req){
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "course_modules_videos";
            $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $getOrientationData = getData('course_modules_videos',['id', 'bn_collection_id', 'video_title','bn_video_url_id','video_duration','video_file_name'], ['id' => $id]);
                return json_encode(['code' => 200, "message" => "Orientation Data", "icon" => "success","data"=>$getOrientationData]);
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
        }
    }

    public function courseEditVideoUpload(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $video_title = isset($req->edit_video_title) ? htmlspecialchars($req->input('edit_video_title')) : '';
            $section_id = isset($req->section_id) ? base64_decode($req->input('section_id')) : '';
            $video_type = isset($req->video_type) ? base64_decode($req->input('video_type')) : '';
            $videoFile = $req->hasFile('edit_video_file') ? $req->file('edit_video_file') : '';
            $orientation_id = isset($req->orientation_id) ? base64_decode($req->input('orientation_id')) : '';
            $video_duration = isset($req->video_duration) ? htmlspecialchars($req->input('video_duration')) : '';
            $validate_rules = [
                'edit_video_title' => 'required|max:150',
                'edit_video_file' => ['file', function ($attribute, $value, $fail) {
                    // Check if the uploaded file is a PDF
                    if ($value->getClientOriginalExtension() === 'pdf') {
                        // Validate PDF file size (up to 5MB)
                        if ($value->getSize() > 5 * 1024 * 1024) {
                            $fail('The PDF file must be up to 5MB in size.');
                        }
                    } elseif ($value->getClientOriginalExtension() === 'mp4') {
                        // Validate MP4 file size (up to 2GB)
                        if ($value->getSize() > 2 * 1024 * 1024 * 1024) {
                            $fail('The MP4 file must be up to 2GB in size.');
                        }
                    } else {
                        // Fail validation if the file type is neither PDF nor MP4
                        $fail('The uploaded file must be either a PDF or an MP4.');
                    }
                }]
            ];
            $exists = is_exist('course_section_masters', ['id' => $section_id]);
            
            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {

                
                $validate = Validator::make($req->all(), $validate_rules);
                if (!$validate->fails()) {      
                    $videolength = $video_duration;              
                    if($req->hasFile('edit_video_file')){
                        $filename = $videoFile->getClientOriginalName();

                        if($videoFile->getClientOriginalExtension() == 'pdf'){
                            $orientation_file =  UploadFiles($videoFile, 'course/orientation', '');
                            $collection_id = '';
                            $videolength = '';
                            $orientationUrl = isset($orientation_file['url']) ? $orientation_file['url'] : 'No File';
                            $VideoFileType = "PDF";
                        } else {
                            if (is_numeric($section_id) && !empty($section_id) && !empty($video_type) &&  $video_type === 'COURSE_VIDEO') {
                                $library  = 2;
                                $section_name = '';
                                $collection_id = '';
                                $getModuleData = getData(
                                    'course_section_masters',
                                    ['id', 'bn_collection_id', 'section_name'],
                                    ['id' => $section_id]
                                );
                                $collection_id = $getModuleData[0]->bn_collection_id;
                                $section_name = $getModuleData[0]->section_name;
                            } elseif (is_numeric($section_id) && !empty($section_id) && !empty($video_type) && $video_type === 'ORIENTATIOIN') {
                                $collection_id = '58247364-9dd9-4571-be3c-621a3137130d'; // ORIENTATIOIN Collection ID Alrways Fixed
                                $library  = 1;
                                $getModuleData = getData('course_modules_videos',['id','bn_video_url_id'],['id' => $orientation_id]);
                                $videoId = $getModuleData[0]->bn_video_url_id;
                                $delete = $this->CourseModule->videoAction($videoId, [], 'DELETE', 1);
                                
                            }
                            if (!isset($collection_id) && $collection_id === null) {
                                $collection_id =   $this->CourseModule->getCollectionIdBn($section_name, $library);
                                $updateCourse = processData(['course_section_masters', 'id'], [
                                    'bn_collection_id' => $collection_id
                                ], [
                                    'id' => $section_id
                                ]);
                            }
                            
                            
                            $vidoId =   $this->CourseModule->getVideoId($collection_id, $videoFile, $video_title, $library);

                            if (isset($vidoId) && $vidoId === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Unable to Upload Video", 'message' => 'Please try again', "icon" => "error"]);
                            }
                            $orientationUrl = $vidoId['videoId']; 
                            $videolength = $video_duration;

                            if($videolength == 0){
                                $vidoIdsd =   $this->CourseModule->getVideoLength($vidoId['videoId'], $library);
                            }
                            $VideoFileType = "Video";
                        }
                    }else{
                        $getOriData = getData(
                            'course_modules_videos',
                            ['id', 'bn_collection_id', 'bn_video_url_id','video_file_name'],
                            ['id' => $orientation_id]
                        );
                        $collection_id = $getOriData[0]->bn_collection_id;
                        $orientationUrl = $getOriData[0]->bn_video_url_id;
                        $filename = $getOriData[0]->video_file_name;
                        if ($collection_id == '') {
                            $VideoFileType = "PDF";
                        }else{
                            $VideoFileType = "Video";
                        }
                    }
                        $select = [
                            'section_id' => $section_id,
                            'bn_collection_id' => $collection_id,
                            'video_title' => $video_title,
                            'bn_video_url_id' => $orientationUrl,
                            'created_by' => $admin_id,
                            'created_at' =>  $this->time,
                            'video_duration'=> $videolength,
                            'video_file_name'=>$filename
                        ];  
                        $where = ['id'=> $orientation_id];

                        $updateCourse = processData(['course_modules_videos', 'id'], $select , $where);

                        if (isset($updateCourse) && $updateCourse !== FALSE) {
                            $cols = [
                                'section_id' => $section_id,
                                'content_id' => $updateCourse['id'],
                                'content_type_id' => 1,
                                'last_update_by' => $admin_id,
                                'created_at' =>  $this->time,
                                'is_deleted' => 'No'
                            ];
                            $updateCourse = processData(['section_managment_master', 'id'], $cols);
                            if (isset($updateCourse) && $updateCourse === FALSE) {
                            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                            }
                        }
                    
                
                    return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => " $VideoFileType uploaded successfully ", "icon" => "success", "data" => base64_encode($orientation_id)]);
                } else {
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Section Not Exist", 'message' => 'Please Try Again', "icon" => "warning"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }

    public function checkVideoId(Request $req)
    {
        if ($req->isMethod('POST') && Auth::check() && $req->video_id !== '') {
            $libraryId = env('AWARD_LIBRARY_ID');
            $videoId = $req->video_id;
            $method = 'GET';
            $video = $this->CourseModule->checkVideoIdOnBunnyStream($method, $libraryId, $videoId);
            if(isset($video['code']) && $video['code'] == 200){
                return json_encode([
                    'code' => 200,
                    'icon' => 'success',
                    'data' => $video,
                    'exists' => isset($video),
                    'error' => ''
                ]);
            }else{
                return json_encode(['code' => 202, 'title' => "Video id not found ", 'message' => 'Please enter correct video id', "icon" => "error"]);
            }
        }
    }
}