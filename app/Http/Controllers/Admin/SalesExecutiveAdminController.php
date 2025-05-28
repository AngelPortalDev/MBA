<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use File;
use App\Models\SalesExecutiveProfile;
use App\Models\User;
use App\Rules\WordCount;
use Illuminate\Support\Str;

class SalesExecutiveAdminController extends Controller
{
    
    public function getSalesExecutiveData($cat)
    {
        if (Auth::check()) {
            $salesExecutiveData = [];
            $where = [];

            if (isset($cat) && !empty($cat) && $cat != 'all'){

                if ($cat == 'Active') {
                    $where = ['status' => '1', 'role' => 'sales', 'is_deleted' => 'No', 'is_active' => 'Active'];
                }
                if($cat == 'Inactive'){
                    $where = ['status' => '1', 'role' => 'sales', 'is_deleted' => 'No', 'is_active' => 'Inactive'];
                }
                if ($cat == 'delete') {
                    $where = ['is_deleted' => 'Yes'];
                }
                if(base64_decode($cat) > 0){
                    $where = ['id' => base64_decode($cat)];
                }
            }
            if(base64_decode($cat) > 0 && $cat != 'all'){

                $salesExecutiveData = $this->salesExecutiveProfile->getSalesExecutiveProfile($where);
                
                return view('admin.sales-executive.sales-executive-edit', compact('salesExecutiveData'));

            }else{
                if ($cat == 'all') {
                    $where = ['role' => 'sales', 'is_deleted' => 'No'];
                }
                
                $salesExecutiveData = $this->salesExecutiveProfile->getSalesExecutiveProfile($where);
                
                return response()->json($salesExecutiveData);

            }

        }
        return redirect('/login');
    }
    
    public function createSalesExecutive(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $name = isset($request->name) ? htmlspecialchars_decode($request->input('name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $id = isset($request->id) ? base64_decode($request->input('id')) : '';
            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                if($id == ''){
                    $data = $request->validate([
                        'name' => ['required', 'string', 'min:3', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'mob_code' => ['required', 'string', 'min:1'],
                        'mobile' => ['required', 'string', 'min:6', 'max:20','unique:users,phone'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class,'regex:' . $emailRegex],
                        'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                        'confirm_password' => ['required', 'same:password'],
                    ],[
                        'name.min' => 'First name must be atleast 3 characters.',
                        'mobile.min'=>'The mobile number must be at least 6 digits.',
                        'password.regex' => 'Password format should be Like e.g Abc@1234.',
                        'mobile.unique' => 'This mobile number is already registered.',
                    ]);
                }
                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
                $message = "created";
                $where = ['id' => $id];
                $exists = is_exist('users', $where);
                if (isset($exists) && $exists > 0) {
                    $where = ['id' => $id];
                    $message = 'updated';   
                }else{
                    if($email){
                        $where = ['email' => $email];
                        $exists = is_exist('users', $where);
                        if (isset($exists) && $exists > 0) {
                            return json_encode(['code' => 201, 'title' => "Email is already taken.", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    }

                }
                
                $where = ['id'=> $id];
                $data = [
                    'name' => $name, 
                    'last_name' => $last_name, 
                ];
                if($id == ''){
                    $data = array_merge($data, ['email' => $email,
                    'mob_code' => $mob_code,
                    'phone' => $mobile,
                    'role' => 'sales',
                    'last_seen' => $timestamp,
                    'last_session_ip' => $ipAddress,
                    'user_agent' => $userAgent,
                    'password' => Hash::make($request->password)]);
                }
                $updateUser = processData(['users', 'id'], $data, $where);
                if (isset($updateUser)) {
                    return json_encode(['code' => 200, 'title' => 'Successfully '.$message.'', "message" => "Sales executive $message successfully", "icon" => generateIconPath("success")]);

                } else {
                    return json_encode(['code' => 404, 'title' => "Unable to create sales executive", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                if (isset($deleteSalesExecutive) && $deleteSalesExecutive === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something went wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
        }else{
            return json_encode(['code' => 201, 'title' => "Something went wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function deleteSalesExecutive(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
                $i=0;
                $rules = [
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                try {    
                    // echo $status;
                        if (isset($req->id) && count($req->id) > 0) {
                            $message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['id' => $id];
                                $is_exits = is_exist('users', $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {

                                    User::where('id', $id)->update([
                                        'is_deleted' => 'Yes',
                                        'deleted_by' => auth()->id(),
                                    ]);

                                    $deleteSalesExecutive = User::where('id', $id)->delete();

                                    if (isset($deleteSalesExecutive) && $deleteSalesExecutive !== FALSE) {
                                        $i++;
                                    }
                                }
                            }

                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
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
    
    public function statusSalesExecutive(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "users";
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
                    $where = ['id' => $id];
                    $exists = is_exist($table, $where);
                    if (isset($exists) && $exists > 0) {
                        $where = ['id' => $id];
                        if($status == 'sales_executive_status_active'){
                            $selectData = [
                                'is_active' => 'Active',
                            ];
                            $message = "Status changed";
                            $updateSalesExecutive = processData([$table, 'id'], $selectData , $where);

                        }
                        if($status == 'sales_executive_status_inactive'){
                            $selectData = [
                                'is_active' => 'Inactive',
                            ];
                            $message = "status changed";
                            $updateSalesExecutive = processData([$table, 'id'], $selectData , $where);

                        }
                        if (isset($updateSalesExecutive) && $updateSalesExecutive['status'] == TRUE) {
                            return json_encode(['code' => 200, 'title' => ucfirst($message) . ' Successfully', "message" => "Sales Executive $message successfully", "icon" => generateIconPath("success")]);
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something went wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something went wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something went wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
        }
    }
}
