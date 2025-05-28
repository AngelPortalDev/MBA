<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-12 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Edit Testimonials
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Edit Testimonials</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="offset-xl-3 col-xl-6 col-12">
                <!-- card -->
                <form class="TestimonialForm" novalidate enctype="multipart/form-data">

                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">

                            <!-- row -->
                            <div class="d-lg-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-4 mb-lg-0">

        
                                            <div class="me-2 position-relative">
                                                    
                                                @if (!empty($testimonalsData->image))
                                                    <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover"
                                                    src="{{ Storage::url($testimonalsData->image) }}">
                                                @else
                                                    <img  src="{{ Storage::url('teacherDocs/no-image.jpeg') }}"
                                                        class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                                        alt="avatar" />
                                                @endif
                                                <div class="student-profile-photo-edit-pencil-icon">
                                                    <input type="file" id="image_file" class="image testimonalsPic" name="image_file" accept=".png, .jpg, .jpeg">
                                                    <label for="image_file"><i class="bi-pencil"></i></label>
                                                    <input type="text" class="old_img_name" value="{{$testimonalsData->image}}" name="old_img_name" id="old_img_name" hidden="">
                                                </div>
                                                <div class="invalid-feedback" id="file_error">Please Upload File</div>
                                            </div>
        

                                    <div class="ms-2">
                                        <h4 class="mb-0">{{isset($testimonalsData->name) ? $testimonalsData->name.' '.$testimonalsData->last_name : ''}}</h4>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <h4 class="mb-4 border-bottom pb-2">Edit Testimonials</h4>

                            <!-- row -->
                            <div class="row gx-3">
                                <!-- input -->
                                <input type="hidden" class="form-control" id="testimonial_id" value="{{base64_encode($testimonalsData->id)}}" name="testimonial_id" required>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="firstName">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" value="{{isset($testimonalsData->name) ? $testimonalsData->name : ''}}" required>
                                    <div class="invalid-feedback" id="first_name_error">Please enter first name</div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="lastName">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" value="{{isset($testimonalsData->last_name) ? $testimonalsData->last_name : ''}}" required>
                                    <div class="invalid-feedback" id="last_name_error">Please enter last name</div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="Designation">Designation</label>
                                    <input type="text" class="form-control" placeholder="Designation" id="designation" name="designation" value="{{isset($testimonalsData->designation) ? $testimonalsData->designation : ''}}" required>
                                    <div class="invalid-feedback" id="designation_error">Please enter designation</div>
                                </div>                                
                               

                                <div class="col-md-12">
                                    <label for="customerNotes" class="form-label">
                                        Feedback <span class="text-danger">*</span>
                                        <small>(Maximum 100 words)</small>
                                    </label>
                                    <textarea class="form-control" id="feedback" rows="5" name="feedback" placeholder="Write here..." required="">{{ isset($testimonalsData->feedback) ? htmlspecialchars_decode($testimonalsData->feedback) : '' }}</textarea>
                                    <div class="invalid-feedback" id="feedback_error">Please enter feedback</div>
                                </div>
                            </div>
                        </div>
                    </div>
                   

                    <div class="d-flex justify-content-end">
                        <!-- buttons -->
                        <button class="btn btn-primary  me-2 testimonalsCreate" type="submit">Save Now</button>
                        
                        <a href="{{route('admin.testimonials.testimonials')}}" class="btn btn-outline-primary">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
        
    </section>
</main>


@endsection
