<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash,Log};

use Carbon\Carbon;

class CertificateController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->currentDate = Carbon::now('Europe/Malta');
        $this->time = $this->currentDate->format('Y-m-d H:i:s');
        $this->date = $this->currentDate->format('Y-m-d');
    }
    public function uploadCertTemplate(Request $reqt)
    {
        if ($reqt->isMethod('POST') && $reqt->ajax() && Auth::check()) {
            $certFile = $reqt->hasFile('certFile') ? $reqt->file('certFile') : null;
            $certCat = isset($reqt->certCat) ? base64_decode($reqt->input('certCat')) : '';
            $certid = isset($reqt->certid) ? base64_decode($reqt->input('certid')) : 0;
            $certName = isset($reqt->certName) ? htmlspecialchars($reqt->input('certName')) : '';


            $existing_file = isset($reqt->existing_file) && !empty($reqt->existing_file) ? htmlspecialchars($reqt->input('existing_file')) : null;
            $exists =   is_exist('users', ['id' => Auth::user()->id,  'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'User Not Available', 'message' => 'User not Exist', 'remark' => 'warning']);
            }
            $validate_rules = [
                'certCat' => 'required',
                'certName' => 'required|string|max:50|min:3',
            ];
            $errorMessege = [
                'certCat.required' => 'Please Select Certificate Type.',
                'certName.required' => 'Please Enter Certificate Name.',
                'certName.max' => 'Certificate Name should be more than 50 characters.',
                'certName.min' => 'Certificate Name should be at least 3 characters.',
                'certFile.required' => 'Please Upload Certificate File.',
                'certFile.mimes' => 'Certificate File Should be in .Jpg, .Png, .Svg formate.',
                'certFile.max' => 'Certificate File Size Should be less than or equal to 2MB.',
            ];

            if ($certFile === null && $existing_file === null) {
                $validate_rules = array_merge($validate_rules, [
                    'certFile' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
                ]);
                $errorMessege = array_merge($errorMessege, [
                    'certFile.required' => 'Please Upload Certificate File.',
                    'certFile.mimes' => 'Certificate File Should be in .Jpg, .Png, .Svg formate.',
                    'certFile.max' => 'Certificate File Size Should be less than or equal to 2MB.',
                ]);
            }

            $validate = Validator::make($reqt->all(), $validate_rules, $errorMessege);
            if (!$validate->fails()) {
                $folder = getData('categories', ['certifcate_folder'], ['id' => $certCat]);
                $getfoldername = $folder[0]->certifcate_folder;
                $cert = getData('certificate', ['certificate_file'], ['id' => $certCat]);
                $certificate_file = isset($cert[0]->certificate_file) && !empty($cert[0]->certificate_file) ? $cert[0]->certificate_file : '';
                if (!isset($getfoldername) && empty($getfoldername) && !Storage::exists($getfoldername)) {
                    return json_encode(['code' => 201, 'title' => 'Required Fields are Missing', 'message' => 'Folder Not Exists', "icon" => "error"]);
                }

                $data = [
                    'category_id' => $certCat,
                    'certificate_name' => $certName,
                    'added_by' => Auth::user()->id,
                ];
                $is_upload = false;
                if ($reqt->hasFile('certFile')) {
                    $is_upload = UploadFiles($certFile, $getfoldername, $certificate_file);
                    if ($is_upload === FALSE) {
                        return json_encode(['code' => 201, 'title' => 'File is corrupt', 'message' => 'File is corrupt', "icon" => "error"]);
                    }
                    if ($is_upload !== false) {
                        $data = array_merge($data, ['certificate_file' => $is_upload['url']]);
                    }
                }
                if (isset($certid) && !empty($certid) && $certid != 0) {
                    $is_updated = saveData($this->Certificate, $data, ['id' => $certid]);
                } else {
                    $is_updated = saveData($this->Certificate, $data);
                }
                if (isset($is_updated) && $is_updated !== false) {
                    return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => "Certificaate Uploaded successfully", "icon" => "success"]);
                }
                return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Unable to Upload Certificate', "icon" => "error"]);
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        }
    }

    public function getCertData($certid = '')
    {
        if (Auth::check()) {
            $certData = [];
            $certData = $this->Certificate->getCertData($certid);
            if (isset($certData) && count($certData) > 0) {
                if (!empty($certid)) {
                    return response()->json(['code' => 200, 'data' => $certData]);
                }
                return response()->json($certData);
            }
            return response()->json(['code' => 202, 'title' => 'Data Not Found', 'message' => 'Something went wrong', 'icon' => 'error']);
        }

        return redirect('/login');
    }
    public function deleteCert(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $where = ['id' => $id];
            $exists = is_exists($this->Certificate, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    $delete_File = false;
                    $qeury = $this->Certificate->find($id);
                    $filename = $qeury->select('certificate_file')->first();
                    if (isset($filename['certificate_file']) && !empty($filename['certificate_file']) && Storage::exists($filename['certificate_file'])) {
                        $delete_File = Storage::delete($filename['certificate_file']);
                    }
                    if ($delete_File === true) {
                        $deleted =  $qeury->delete();
                        if (isset($deleted) && $deleted === true) {
                            return json_encode(['code' => 200, 'title' => "Certificate Deleted", "message" => "Section deleted successfully", "icon" => "success"]);
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try Again', "icon" => "error"]);
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
        }
    }
    public function generateCert(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exists($this->StudentMaster, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    $student = $this->StudentMaster->StudentCertificateData($where);
                    if (isset($student) && !empty($student)) {
                            $where = ['course_id' => $student[0]['student_courses']['id'],['pinata_group_id','!=','']];
                            $exists = is_exists($this->CourseOtherDetail, $where);
                            if (isset($exists) && $exists == 0) {
                                $certificateGroupCreate  = $this->Certificate->setIPFSGroup($student[0]['student_courses']['course_title']);
                                $courseOtherDetail = saveData($this->CourseOtherDetail, ['pinata_group_id' => $certificateGroupCreate['data']['id']], ['course_id' => $student[0]['student_courses']['id']]);
                                $pinata_group_id = $certificateGroupCreate['data']['id'];
                            }else{
                                $qeury = $this->CourseOtherDetail->where(['course_id'=>$student[0]['student_courses']['id']]);
                                $pinataGroup = $qeury->select('pinata_group_id')->first();
                                $pinata_group_id = $pinataGroup['pinata_group_id'];
                            }
                          
                            $cert_file_data = $this->createCertificate($student[0]);
                            $cert_file_data = json_decode($cert_file_data);
                            if (isset($cert_file_data) && Storage::exists($cert_file_data->certificate_url) && $cert_file_data->status !== false) {
                                $cert_file = $cert_file_data->certificate_url;
                                $status = saveData($this->StudentMaster, ['cert_file' => $cert_file], ['id' => $id, 'is_deleted' => 'No']);
                                if (isset($status) && $status['status'] === true) {
                                    $cert_file_path = Storage::path($cert_file); 
                                    $certificateImageUpload = $this->Certificate->setPinFiletoIPFS($cert_file_path,$pinata_group_id);
                                    if(!empty($certificateImageUpload) && isset($certificateImageUpload)){
                                        $ipfs_hash = $certificateImageUpload['data']['IpfsHash'];
                                        $ipfs_certificate_name = $student[0]['student_user_data']['roll_no'].'_'.$student[0]['student_courses']['course_title'];
                                        $metadata = json_encode([
                                            'name' => $student[0]['student_cert_data']['name_on_education_doc'],
                                            'course_name'=>$student[0]['student_courses']['course_title'],
                                            'file_hash'=>$ipfs_hash,
                                            'issue_date'=>$this->time,
                                            'course_duration'=>$student[0]['student_courses']['duration_month'],
                                            'certificate_no' => $cert_file_data->certificate_no ?? '',
                                            'college_name'=>'Ascencia Malta'
                                        ]);

                                        $updateFileMetaData  = $this->Certificate->updateFileMetaData($ipfs_hash,$ipfs_certificate_name,$metadata);

                                        if (isset($updateFileMetaData) && $updateFileMetaData['data'] == true) {
                                           
                                            $data = [
                                                'ementor_id'=> $student[0]['student_courses']['ementor_id'] ?? '',
                                                'course_id'=>  $student[0]['student_courses']['id'] ?? '',
                                                'student_course_master_id' => $student[0]['id'],
                                                'certificate_no' => $cert_file_data->certificate_no ?? '',
                                                'cid'=>$ipfs_hash,
                                                'meta_data'=>$metadata,
                                                'created_by' => Auth::user()->id,
                                                'created_at' => $this->time,
                                            ];

                                            $is_updated = saveData($this->CertificateIssue, $data, []);
                                            Storage::delete($cert_file);
                                            if (isset($is_updated) && $is_updated !== false) {
                                                return json_encode(['code' => 200, 'title' => "Successfully Generated", 'message' => '', "icon" => "success"]);
                                            }                                        
                                        }
                                    }
                                }
                            }
                    }
                        
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try Again', "icon" => "error"]);
                } catch (\Throwable $th) {
                    return $th;
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted", 'message' => 'Please try unique name', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
        }
    }
    protected function createCertificate($data)
    {
        if (Auth::check() && is_array($data) && count($data) > 0) {
            $course = $data['student_courses'];
            $student = $data['student_cert_data'];
            $temp_id = isset($course['category_id']) && !empty($course['category_id']) ? $course['category_id'] : 0;
            $course_name = isset($course['course_title']) && !empty($course['course_title']) ? $course['course_title'] : null;
            $duration_month = isset($course['duration_month']) && !empty($course['duration_month']) ? $course['duration_month'] : null;
            $student_name = isset($student['name_on_education_doc']) && !empty($student['name_on_education_doc']) ? strtoupper($student['name_on_education_doc']) : null;

            if ($temp_id > 0 && $course_name !== null && $student_name !== null && is_exists($this->Certificate, ['category_id' => $temp_id]) > 0 && $duration_month !== null) {
                $template = $this->Certificate->select('certificate_file')->where(['category_id' => $temp_id])->first();

                // return $template['certificate_file'];
                if (Storage::exists($template['certificate_file'])) {


                    $temp_url = Storage::disk('public')->path($template['certificate_file']);
                    $sign = Storage::disk('public')->path('certificates/sign.png');
                    try {
                        $image = @imagecreatefrompng($temp_url);
                        $nfont = public_path('admin/fonts/gd_fonts/monotype-corsiva-bold.ttf');
                        $cfont = public_path('admin/fonts/gd_fonts/monotype-corsiva-italic.ttf');
                        $ofont = public_path('admin/fonts/gd_fonts/monotype-corsiva-regular.ttf');
                        $fsize = 70;
                        $boxWidth = imagesx($image);
                        $boxHeight = imagesy($image);
                        $margin = [550, 900];


                        $black = imagecolorallocate($image, 65, 65, 65);
                        $texts = [
                            ['text' => $student_name, 'font_size' => 70],
                            ['text' => $this->wrapText($fsize, 0, $ofont, $course_name, 1500), 'font_size' => 70],
                        ];

                        $i = 0;
                        foreach ($texts as $text) {
                            $yPosition = $margin[$i];
                            $bbox = imagettfbbox($fsize, 0, $ofont, $text['text']);
                            $textWidth = $bbox[2] - $bbox[0];
                            $textHeight = $bbox[1] - $bbox[7];
                            $xPosition = ($boxWidth - $textWidth) / 2;
                            imagettftext($image, $text['font_size'], 0, $xPosition, $yPosition, $black, $ofont, $text['text']);
                            $yPosition += $textHeight + 20; // Add some extra spacing

                            $i++;
                        }
                        $certificate_no = rand(2, 999999);
                        $other_text = [
                            ['txt' =>  $certificate_no, 'x' => 750, 'y' => 130, 'font_size' => 40, 'font' => $ofont],
                            ['txt' => $duration_month . " months (Full-time)", 'x' => 1500, 'y' => 1420, 'font_size' => 60, 'font' => $ofont],
                            ['txt' => date('Y') . "-" . rand(10, 99), 'x' => 2250, 'y' => 1510, 'font_size' => 60, 'font' => $ofont],
                            ['txt' => date('jS F Y'), 'x' => 1700, 'y' => 2110, 'font_size' => 50, 'font' => $ofont],
                        ];
                        foreach ($other_text as $text) {
                            imagettftext($image, $text['font_size'], 0, $text['x'], $text['y'], $black, $text['font'], $text['txt']);
                        }
                        // imagettftext($image, $fsize, 0, $t['x'], $t['y'], $black, $ofont, $t['text']);
                        $logo = imagecreatefrompng($sign);

                        // Get dimensions of the logo
                        $logoWidth = imagesx($logo);
                        $logoHeight = imagesy($logo);

                        // Define where to place the logo
                        $logoX = $boxWidth - $logoWidth - 1500; // Right-align with margin
                        $logoY = $boxHeight - $logoHeight - 630; // Bottom-align with margin
                        imagecopy($image, $logo, $logoX, $logoY, 0, 0, $logoWidth, $logoHeight);
                        imagedestroy($logo);
                        $newUrl = 'certificates/generated/' . "test_" . rand(2, 9999999) . ".png";
                        header('Content-Type: image/png');
                        $img = imagepng($image, Storage::disk('public')->path($newUrl));
                        imagedestroy($image);
                        if ($img === true) {
                            return json_encode([
                                'status' =>'true',
                                'certificate_url' =>$newUrl,
                                'certificate_no'=>$certificate_no
                            ]);
                        } else {

                            return false;
                        }
                    } catch (\Throwable $th) {
                        return $th;
                    }
                } else {

                    return false;
                }
            } else {
                return false;
            }
        }
    }
    protected function wrapText($fontSize, $angle, $font, $text, $maxWidth)
    {
        $words = explode(' ', $text);
        $wrappedText = '';
        $line = '';
        foreach ($words as $word) {
            $testLine = $line . ' ' . $word;
            $bbox = imagettfbbox($fontSize, $angle, $font, $testLine);
            $lineWidth = $bbox[2] - $bbox[0];

            if ($lineWidth > $maxWidth) {
                $wrappedText .= $line . "\n";
                $line = $word;
            } else {
                $line = $testLine;
            }
        }

        $wrappedText .= $line;
        return $wrappedText;
    }

    public function getStudentCertData(){
        if (Auth::check()) {
            $certData = [];
            $certData = $this->StudentMaster->studentCerficateGenerateData();
            Log::info('Callback certData', $certData);
            if(Auth::user()->role == 'superadmin'){
                return view('admin.adminCertificate.admin-certificate', compact('certData'));
            }else{
                if (isset($certData) && count($certData) > 0) {
                    // return view('frontend.teacher.e-mentor-certificate', compact('certData'));
                    return response()->json($certData);
                }
            }
            // return response()->json(['code' => 202, 'title' => 'Data Not Found', 'message' => 'Something went wrong', 'icon' => 'error']);
        }

        return redirect('/login');
    }
}