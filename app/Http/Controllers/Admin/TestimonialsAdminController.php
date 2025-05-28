<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonals;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use File;
use App\Rules\WordCount;
class TestimonialsAdminController extends Controller
{

    public function TestimonialList($cat)
    {   

        if (Auth::check()) {
            $testimonalsData = [];
            if (isset($cat) && !empty($cat)) {
                $query = Testimonals::where(['is_deleted' => 'No']);
                if ($cat == 'delete') {

                    $testimonalsData = Testimonals::where(['is_deleted' => 'Yes'])->orderByDesc('id')->get()->toArray();
                    return response()->json($testimonalsData);
                }else if($cat == 'active'){
                    
                    $where = ['status' => '0'];
                    $query->where($where);

                }else if($cat == 'inactive'){

                    $where = ['status' => '1'];
                    $query->where($where);

                }else{
                    $id = base64_decode($cat);
                    $exists = is_exist('testimonals', ['id' => $id]);
                    if ($exists > 0) {
                        $where = ['id' => $id];
                        $query->where($where);
                        $testimonalsData = $query->orderByDesc('id')->first();
                        return view('admin.testimonials.edit-testimonials', compact('testimonalsData'));
                    }
                }

                $testimonalsData = $query->orderByDesc('id')->get()->toArray();
            } 
            return response()->json($testimonalsData);
        }
        return redirect('/login');
    }
    
    public function createTestimonials(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $name = isset($request->first_name) ? htmlspecialchars_decode($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $designation = isset($request->designation) ? htmlspecialchars_decode($request->input('designation')) : '';
            $feedback = isset($request->feedback) ? htmlspecialchars_decode($request->input('feedback')) : '';
            $image_file = $request->hasFile('image_file') ? $request->file('image_file') : '';
            $testimonial_id = isset($request->testimonial_id) ? base64_decode($request->input('testimonial_id')) : '';
            $old_img_name = isset($request->old_img_name) ? $request->input('old_img_name') : '';

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

                $data = $request->validate([
                    'first_name' => ['required', 'string', 'min:3', 'max:255'],
                    'last_name' => ['required', 'string', 'min:3', 'max:255'],
                    'designation' => ['required','string'],
                    'feedback' => ['required', 'string', new WordCount(50)],
                ],[
                    // 'specialization' => 'The specialization must not be greater than 50 words.',
                    'feedback.required' => 'The feedback field is required.',
                    'feedback' => 'The feedback must not be greater than 50 words.'
                ]
                );
                if($request->hasFile('image_file')){
                    $request->validate([
                        'image_file' => 'required|mimes:jpeg,png,jpg,svg|max:1024',
                    ], [
                        'image_file.mimes' => 'The image must be a file of type: jpeg, png, jpg, svg.',
                        'image_file.max' => 'The image must not exceed 1 MB.',
                    ]);
                }

                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
                $Message = "created";
                // $Text_Message = "created";
                $where = ['id' => $testimonial_id];
                $exists = is_exist('testimonals', $where);
                if (isset($exists) && $exists > 0) {
                    $where = ['id' => $testimonial_id];
                    $Message = 'updated';
                }
                if ($request->hasFile('image_file')) {

                    $folder = 'testimonialDocs';

                    if (!Storage::exists($folder)) {
                        Storage::makeDirectory($folder);
                    }
                    $docUpload = UploadFiles($image_file, $folder, '');
                    if ($docUpload === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                    }

                }
                
                
                $data = [
                    'name' => $name,
                    'last_name' => $last_name,
                    'designation' => $designation,
                    'feedback' => $feedback,
                    'created_at'=>$this->time,
                    'image' =>  !empty($docUpload['url']) ? $docUpload['url'] : $old_img_name
                ];
                $where = ['id' => $testimonial_id];
                $exists = is_exist('testimonals', $where);
                if (isset($exists) && $exists > 0) {
                    $update = array_merge(
                        $data,
                        [
                            'updated_at'=>$this->time,
                            'updated_by'=>$admin_id,
                        ]
                    );
                }else{
                    $update = array_merge(
                        $data,
                        [
                            'created_at'=>$this->time,
                            'created_by'=>$admin_id,
                        ]
                    );
                }

                $updateTestimonals = processData(['testimonals', 'id'], $update, $where);
                if (isset($updateTestimonals) && $updateTestimonals === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                return json_encode(['code' => 200, 'title' => 'Successfully '.$Message.'', "message" => "Testimonial $Message successfully", "icon" => generateIconPath("success")]);
        }else{
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function deleteTestimonials(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "testimonals";
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
                    // echo $status;
                    if($status == 'delete'){  
                        if (isset($req->id) && count($req->id) > 0) {
                            $Message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['id' => $id, 'is_deleted' => 'No'];
                                $is_exits = is_exist($table, $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                    $updateTestimonals = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
                                    if (isset($updateTestimonals) && $updateTestimonals !== FALSE) {
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
                    
                    if($status == 'testimonial_status_active' || $status == 'testimonial_status_inactive'){
                        $id =  isset($req->id) ? base64_decode($req->input('id')) : '';

                        $where = ['id' => $id, 'is_deleted' => 'No'];           
                        $exists = is_exist($table, $where);

                        if (isset($exists) && $exists > 0) {


                            $where = ['id' => $id];

                            if($status == 'testimonial_status_active'){

                                $selectData = [
                                    'status' => '0',
                                    'updated_by' => $admin_id,
                                    'updated_at'=>$this->time
                                ];
                               
                            }else if($status == 'testimonial_status_inactive'){

                                $selectData = [
                                    'status' => '1',
                                    'updated_by' => $admin_id,
                                    'updated_at'=> $this->time
                                ];
                            }   

                            $Message = "Status Changed";
                            $Message_Text = "status changed";
                            $updateTestimonals = processData([$table, 'id'], $selectData , $where);
                            if (isset($updateTestimonals)) {

                                return json_encode(['code' => 200, 'title' => "Successfully $Message", "message" => "Testimonials $Message_Text successfully", "icon" => generateIconPath("success")]);
                            }
                        }
                    }
                    
                } catch (\Throwable $th) {
                    return $th;
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
        }
    }

}
