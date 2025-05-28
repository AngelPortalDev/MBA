<!-- Header import -->
@extends('admin.layouts.main') @section('content')
@section('maintitle') Edit Admin  @endsection

    <section class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-3 d-md-flex align-items-center justify-content-between mb-3">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-0 h2 fw-bold">Edit Admin</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.index')}}">Admin</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Admin </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                        <a href="{{route('admin.index')}}" class="btn btn-primary me-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
                    <!-- card -->
                    <div class="card">
                    <div class="card-header">
                            <h3 class="mb-0">Admin Profile</h3>
                        </div>

                        <div class="card-body">
                            <div class="d-lg-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-4 mb-lg-0">
                                <div class="me-2 position-relative">
                                {{-- <div class="d-flex align-items-center mb-4 mb-lg-0">
                                    <img src="{{asset('admin/images/avatar/avatar-2.jpg')}}" id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar">
                                    <div class="ms-3">
                                        <h4 class="mb-0">Profile Photo</h4>
                                        <p class="mb-0">PNG or JPG no bigger than 800px wide and tall.</p>
                                    </div>
                                </div> --}}
                                {{-- <div>
                                    <a href="#" class="btn btn-outline-secondary btn-sm">Update</a>
                                    <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                </div> --}}
                                <form class="proflilImage" enctype="multipart/form-data">
                                    @if ($admin->photo)
                                    <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover" src="{{ Storage::url($admin->photo) }}">
                                    @else
                                    <img src="{{Storage::url('adminDocs/admin-profile-photo.png')}}" class="avatar-xl rounded-circle border border-4 border-white imagePreview" alt="avatar" />
                                    @endif
                                    <div class="student-profile-photo-edit-pencil-icon">
                                       
                                        <input type="file" id="imageUpload_profile" class="image profileAdminPic" name="image_file" accept=".png, .jpg, .jpeg">                                        
                                        <input type="hidden" id="user_id" value="{{base64_encode($admin->id)}}" name="user_id" >
                                        <input type="hidden" id="user_name" value="{{base64_encode($admin->name)}}" name="user_name" >
                                        <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                        <input type="text"  class='curr_img' value="{{ isset($admin->photo) ? $admin->photo : ''  }}" name='old_img_name' hidden>
                                        
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                            <hr class="mt-4 mb-0">

                        </div>
                        <!-- card body -->
                        <div class="card-body p-lg-6 pt-lg-2">
                            <!-- form -->
                            <form class="row gx-3 needs-validation editadminData" novalidate>
                                <!-- form group -->
                                <div class="mb-3 col-md-6">
                                    <input type="hidden" class="form-control"   value="{{$admin->id}}"  name="admin_id" required/>

                                    <label class="form-label"> First Name <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" placeholder="First Name"  value="{{$admin->name}}"  name="first_name" id='first_name' required/>
                                    <div class="invalid-feedback" id="first_name_error">Please enter First Name</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Last Name <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" placeholder="Last Name" id='last_name'  value="{{$admin->last_name}}"  name="last_name" required />
                                    <div class="invalid-feedback" id="last_name_error" >Please enter Last Name.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Email Id <span class="text-danger">*</span> </label>
                                    <input type="email" class="form-control" placeholder="Email Id" value="{{$admin->email}}"  name="email" id="email" required />
                                    <div class="invalid-feedback" id="email_error" >Please enter Email Id.</div>
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="MobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span> </label>
                                    <div class="mobile-with-country-code">
                                        <select class="form-select" name="mob_code" aria-label="Default select example" id="mob_code">
                                            <option value="">Select</option>
                                            @foreach (getDropDownlist('country_master',['country_code']) as $mob_code)
                                            <option value="+{{$mob_code->country_code}}" @if('+'.$mob_code->country_code == $admin->mob_code) selected @endif> +{{$mob_code->country_code}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="mob_code_error" >Please select Mob Code</div>

                                        <input type="number" id="mobile" class="form-control" name="mobile" placeholder="+123 4567 890" value="{{$admin->phone}}" required="">
                                    </div>
                                    <div class="invalid-feedback" id="mobile_error" >Please enter Mobile Number</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class=""> Address  </label>
                                    <textarea name="address" id='address' class="form-control" >{{$admin->address}}</textarea>
                                </div>
                                {{-- <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label" for="privacy">Status</label>
                                    <select class="form-select" id="status" name="status" required="">
                                        <option value="">Select</option>
                                        <option value="1" @if('1' == $admin->status) selected @endif>Active</option>
                                        <option value="0" @if('0' == $admin->status) selected @endif>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback" id="status_error" >Please choose option.</div>
                                </div> --}}
                                {{-- <br>       --}}
                                {{-- <div class="mb-3 col-md-6 col-12">   
                                    <br><br>     
                                    <label class="form-label" for="privacy">Status  &nbsp;&nbsp;
                                    <input type="checkbox" id="status-toggle"<?php echo $admin->status === '1' ? 'checked' : ''; ?> name='status'>
                                    <label class="switch" for="status-toggle">
                                        <span class="slider"></span>
                                    </label> </label>
                                </div> --}}
                                <div class="mb-3 col-md-6">
                                    <input type="hidden" class="form-control" placeholder="role" id="role" name="role" value="{{$admin->role}}" required />
                                </div>


                                <div class="col-md-8 pt-3"></div>
                                <!-- button -->
                                <div class="col-12">
                                    <button class="btn btn-primary editAdmin" type="submit" >Save</button>
                                    {{-- <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas" aria-label="Close">Close</button> --}}
                                    <a href="{{route('admin.index')}}" class="btn btn-outline-primary ms-2">Back</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Create Admin Modal -->
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation" novalidate>
                        <div class="mb-2 col-6">
                            <label for="FirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="FirstName" placeholder="First Name" required>
                            <div class="invalid-feedback">Please enter First Name</div>
                        </div>
                        <div class="mb-2 col-6">
                            <label for="LastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="LastName" placeholder="Last Name" required>
                            <div class="invalid-feedback">Please enter Last Name</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="EmailId" class="form-label">Email Id</label>
                            <input type="text" class="form-control" id="EmailId" placeholder="Email Id" required>
                            <div class="invalid-feedback">Please enter Email Id</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="MobileNumber" placeholder="Mobile Number" required>
                            <div class="invalid-feedback">Please enter Mobile Number</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" placeholder="*********" required>
                            <div class="invalid-feedback">Please enter Password</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="ConfirmPassword" placeholder="*********" required>
                            <div class="invalid-feedback">Please enter Password</div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
