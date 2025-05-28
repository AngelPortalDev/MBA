<!-- Header import -->
@extends('admin.layouts.main')
 @section('content')




    <!-- Container fluid -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- card -->
                    <div class="card mb-1">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <!-- img -->
                                <img src="../../../assets/images/avatar/avatar-12.jpg" class="avatar-xl rounded-circle" alt="">
                                <div class="ms-4">
                                    <!-- text -->
                                    <h3 class="mb-1">Harold Gonzalez</h3>
                                    <div>
                                        <span>
                                            <i class="fe fe-calendar me-2"></i>
                                            Customer since April 5,2022
                                        </span>
                                        <span class="ms-3">
                                            <i class="fe fe-map-pin me-2"></i>
                                            Florida, United States
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="pb-5 my-learning-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Side Navbar -->
                    <ul class="nav nav-lb-tab mb-6" id="tab" role="tablist">
                        <li class="nav-item ms-0" role="presentation">
                            <a class="nav-link active" id="student-profile-tab" data-bs-toggle="pill" href="#student-profile" role="tab" aria-controls="student-profile" aria-selected="false" tabindex="-1">Profile</a>
                        </li>

                        <li class="nav-item ms-0" role="presentation">
                            <a class="nav-link" id="all-courses-tab" data-bs-toggle="pill" href="#all-courses" role="tab" aria-controls="all-courses" aria-selected="false" tabindex="-1">Buy Courses</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="wishlist-tab" data-bs-toggle="pill" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="true">
                                Wishlist
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="expired-courses-tab" data-bs-toggle="pill" href="#expired-courses" role="tab" aria-controls="expired-courses" aria-selected="true">
                                Expired Courses
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="certificate-tab" data-bs-toggle="pill" href="#certificate" role="tab" aria-controls="certificate" aria-selected="true">
                                Certificate
                            </a>
                        </li>

                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content" id="tabContent">
                        
                        <div class="tab-pane fade active show" id="student-profile" role="tabpanel" aria-labelledby="student-profile-tab">
                            <div class="row gap-3">
                                <div class="col-lg-3 col-md-6 col-12">
                                   
                                </div>


                            </div>

                        </div>



                       
                        
                        <div class="tab-pane fade " id="all-courses" role="tabpanel" aria-labelledby="all-courses-tab">
                            <div class="row gap-3">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details.php " style="position: relative">
                                            <img src=" assets/images/course/award-recruitment-and-employee-selection.png "
                                                alt="course" class="card-img-top">

                                                <span class="course-video-overlay"></span>
                                            </a>
                                                

                                                <a id="play-video" class="video-play-button" href="#">
                                                    <span></span>
                                                </a>

                                                
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">6 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details.php"
                                                    class="text-inherit">Award in Recruitment and Employee Selection</a></h4>

                                            <div class="lh-1 mt-3">
                                                <span class="align-text-top ">
                                                    <span class="fs-6">
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                    </span>
                                                </span>
                                                <span >Rating</span>

                                            </div>

                                        </div>

                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <li class="list-group-item">
                                                    <div>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>10% Completed</small>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details.php " style="position: relative">
                                            <img src=" assets/images/course/masters-human-resource-management.png "
                                                alt="course" class="card-img-top">

                                                <span class="course-video-overlay"></span>
                                            </a>
                                                

                                                <a id="play-video" class="video-play-button" href="#">
                                                    <span></span>
                                                </a>

                                                
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Masters</span>
                                                <span class="badge bg-success-soft co-etcs">90 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details.php"
                                                    class="text-inherit">Masters of Arts in Human Resource Management</a></h4>

                                            <div class="lh-1 mt-3">
                                                <span class="align-text-top ">
                                                    <span class="fs-6">
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                        <i class="bi bi-star text-warning rating-star"></i>
                                                    </span>
                                                </span>
                                                <span >Rating</span>

                                            </div>

                                        </div>

                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <li class="list-group-item">
                                                    <div>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: 50%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>50% Completed</small>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div>
                        </div>



                       

                        <div class="tab-pane fade " id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details.php"><img src=" assets/images/course/award-employee-and-labor-relation.png" alt="course" class="card-img-top"></a>


                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">4 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details.php" class="text-inherit">Award in Employee and Labour Relations</a></h4>
                    
                                            <div class="lh-1 mt-3">
                                                <span class="align-text-top ">
                                                    <span class="fs-6">
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                    </span>
                                                </span>
                                                <span class="text-warning">4.1</span>
                                                <span class="fs-6">(324)</span>
                                            </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>
                    
                                                <!-- <div class="col-auto">
                                                    <a href="#" class="text-inherit"> -->
                                                        <!-- {{-- <i class="fe fe-trash text-primary align-middle me-2"></i> --}} -->
                                                        <!-- <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade " id="expired-courses" role="tabpanel" aria-labelledby="expired-courses-tab">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details.php"><img src=" assets/images/course/award-employee-and-labor-relation.png" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">4 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details.php" class="text-inherit">Award in Employee and Labour Relations</a></h4>
                    
                                            <div class="lh-1 mt-3">
                                                <span class="align-text-top ">
                                                    <span class="fs-6">
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                        <i class="bi bi-star-fill text-warning rating-star"></i>
                                                    </span>
                                                </span>
                                                <span class="text-warning">4.1</span>
                                                <span class="fs-6">(324)</span>
                                            </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>
                    
                                                <!-- <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-trash text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Again</a>
                                                    
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-12">
                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details.php"><img src="assets/images/certificate/certificate-sample-01.jpg" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">

                                            <h4 class=" mb-1 text-truncate-line-2 course-title"><a href="course-details.php" class="text-inherit">Award in Employee and Labour Relations</a></h4>

                                        </div>

                                         <!-- Button Block -->
                                            <div class="d-grid p-2">
                                                <button class="btn btn-primary" type="button"><i class="fe fe-download"></i> Download</button>
                                            </div>


                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-12">
                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

<!-- Footer import -->
