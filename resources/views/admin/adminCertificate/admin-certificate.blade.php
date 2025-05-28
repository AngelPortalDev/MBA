<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


<style>
    .sidenav.navbar .navbar-nav .e-men-10>.nav-link {
        background-color: var(--gk-gray-200);
    }

    .view-details:hover {
        color: white !important;
    }

    /* New Style css */

    .button-container {
        margin-top: 20px;
    }

    .bs-stepper-header {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 992px) {
        .bs-stepper-header {
                flex-direction: column;
            }
    }

    .bs-stepper-circle {
        background-color: #0062cc;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .bs-stepper-label {
        font-size: 16px;
        margin-left: 10px;
        display: block !important;
    }

    .step.active .bs-stepper-circle {
        background-color: #28a745;
    }

    .step.completed .bs-stepper-circle {
        background-color: #2b3990;
    }

    .btn {
        font-size: 13px;
        padding: 7px 14px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: 0;
    }

    .btn:hover {
        transform: scale(1.05);
    }


    .btn-primary,
    .btn-secondary {
        color: white;
    }

    .bs-stepper-content {
        padding: 20px;
    }

    .developed_card{
        width: 18rem; 
        border: 2px solid #28A745; 
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .developed_card img{
        border-radius: 8px 8px 0 0; 
        object-fit: cover; 
        height: auto;
    }

    .developed_card .card-title{
        font-size: 15px;
    }

    .developed_card .card-text{
        color: #555; 
        margin-bottom: 10px; 
        line-height: 1.2rem;"
        style="font-size: 13px
    }

    .developed_card .badge{
        font-size: 0.8rem; 
        padding: 5px 10px;
        display: inline-block; 
        margin-bottom: 10px;
        font-size: 11px;
    }

    .developed_card .generate-btn{
        text-transform: uppercase;
         font-size: 0.9rem;
          width: 100%; 
          border-radius: 4px; 
          padding: 5px 10px;
    }

    /* View Certifica56e Sections */

    .in-progress {
        background-color: #fff3cd;
        box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        border: 2px solid #ffc107;
        opacity: 0.6;
    }


</style>

    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Certificates
                            <span class="fs-5" id="count">(0)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Certificate</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom-0">
                <div>
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">Certificate Management</h3>
                                <span>Generate, view, and Review your certificate with ease by following these simple steps.</span>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- Step 1: Generate Certificate -->
                            <div class="step active" data-target="#generate-certificate-part">
                                <button type="button" class="step-trigger" role="tab"
                                    aria-controls="generate-certificate-part" id="generate-certificate-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Generate Certificate</span>
                                </button>
                            </div>
                            <div class="line"></div>
                    
                            <!-- Step 2: View Certificate -->
                            <div class="step" data-target="#view-certificate-part">
                                <button type="button" class="step-trigger" role="tab"
                                    aria-controls="view-certificate-part" id="view-certificate-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class='bs-stepper-label '>Deploy on Blockchain</span>
                                </button>
                            </div>
                            <div class="line"></div>
                    
                            <!-- Step 3: Get Certificate -->
                            <div class="step" data-target="#get-certificate-part">
                                <button type="button" class="step-trigger" role="tab"
                                    aria-controls="get-certificate-part" id="get-certificate-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label transfer-btn">Transfer to Student</span>
                                </button>
                            </div>
                        </div>
                    
                        <div class="bs-stepper-content">
                            <!-- Step 1 Content: Generate Certificate -->
                            <div id="generate-certificate-part" class="content mt-3 active" role="tabpanel" aria-labelledby="generate-certificate-part-trigger">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        
                                        <div class="mb-3">
                                            <input type="text" id="customSearch" class="form-control" placeholder="Search certificate data...">
                                        </div>
                                        <table id="certTable" class="table mb-0 table-hover table-centered text-nowrap studentPassData">
                                            
                                            <!-- Table Head -->
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Name</th>
                                                    <th>Course Name</th>
                                                    <th>Enrolled</th>
                                                    <th>Certificate</th>
                                                </tr>
                                            </thead>
                                            <!-- Table Body -->
                                            
                                            <tbody>
                                                @if(!empty($certData) && isset($certData))
                                                @php $i=1; @endphp
                                                @foreach($certData as $data)
                                                
                                                    <!-- Add your certificate data here -->
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-primary">{{ isset($data['student_user_data']['name']) ? $data['student_user_data']['name'].' '.$data['student_user_data']['last_name']: '' }}</span></td>
                                                        <td>{{ isset($data['student_courses']['course_title']) ? $data['student_courses']['course_title']: '' }}</td>
                                                        <td><span class="text-primary">{{ isset($data['course_start_date']) ? $data['course_start_date']: '' }}</span></td>
                                                        
                                                        <td>
                                                            @if(!empty($data['cert_file']) && isset($data['cert_file']))
                                                                <a href="{{ env('PINATA_IPFS_VIEW_PATH') . (isset($data['student_certificate_issue']['cid']) ? $data['student_certificate_issue']['cid'] : '') }}" target="_blank" class="btn btn-success">View</button>
                                                            @else
                                                                <button class="btn btn-primary btn-sm genCert d-block" data-student_id="{{base64_encode($data['id'])}}" data-role="{{ Auth::user()->role }}" >Proceed</button>
                                                            @endif 
                                                        </tr>
                                                @php $i++; @endphp

                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Step 2 Content: Deploy on Blockchain -->
                            {{-- <div id="view-certificate-part" class="content" role="tabpanel" aria-labelledby="view-certificate-part-trigger">
                                <div class="container-fluid">
                                    <!-- Developed Certificate Section -->
                                    <div class="mt-3">
                                        <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate- Deployment On Blockchain</label>
                        
                                        <div class="row">
                                            <!-- Static Certificate Card 1 -->
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="card mt-3 developed_card">
                                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="not found">
                        
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title fw-semibold text-primary">John Doe</h5>
                                                        <p class="card-text">Introduction to Web Development</p>
                                                        <span class="badge bg-warning">Pending</span>
                                                        <button class="btn btn-primary d-block mt-1 developed generate-btn">Deploy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Static Certificate Card 2 -->
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="card mt-3 developed_card">
                                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="not found">
                        
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title fw-semibold text-primary">Jane Smith</h5>
                                                        <p class="card-text">Advanced Python Programming</p>
                                                        <span class="badge bg-warning">Pending</span>
                                                        <button class="btn btn-primary d-block mt-1 developed generate-btn">Deploy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Static Certificate Card 3 -->
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="card mt-3 developed_card">
                                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="not found">
                        
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title fw-semibold text-primary">Alice Johnson</h5>
                                                        <p class="card-text">Machine Learning Basics</p>
                                                        <span class="badge bg-warning">Pending</span>
                                                        <button class="btn btn-primary d-block mt-1 developed generate-btn">Deploy</button>
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- Static Certificate Card 3 -->
                                             <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="card mt-3 developed_card">
                                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="not found">
                        
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title fw-semibold text-primary">Alice Johnson</h5>
                                                        <p class="card-text">Machine Learning Basics</p>
                                                        <span class="badge bg-warning">Pending</span>
                                                        <button class="btn btn-primary d-block mt-1 developed generate-btn">Deploy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- In-progress Certificate Section -->
                                    <div class="mt-3">
                                        <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate - Deployed On Blockchain</label>
                                        <div class="row">
                                            <!-- Static Deployed Certificate Card 1 -->
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="box1 in-progress">
                                                    <img src="https://via.placeholder.com/150" alt="Developed Certificate" class="img-fluid">
                                                </div>
                                                <a href="#" class="btn btn-primary d-block mt-2" onclick="alert('View Certificate')">View Certificate <i class="bi bi-eye"></i></a>
                                            </div>
                                            <!-- Static Deployed Certificate Card 2 -->
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="box1 in-progress">
                                                    <img src="https://via.placeholder.com/150" alt="Developed Certificate" class="img-fluid">
                                                </div>
                                                <a href="#" class="btn btn-primary d-block mt-2" onclick="alert('View Certificate')">View Certificate <i class="bi bi-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            
                            <div id="view-certificate-part" class="content" role="tabpanel"
                            aria-labelledby="view-certificate-part-trigger">
                                <div class="container">
                                    <!-- Developed Certificate Section -->
                                    <div class="mt-3">
                                        
                                        <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate- Deployment On Blockchain
                                            </label>
                                
                                        <div class="row">
                                            @if(!empty($certData) && isset($certData))
                                            @foreach($certData as $data)
                                            @if(isset($data['student_certificate_issue']) && !empty($data['student_certificate_issue']))
                                                @if($data['student_certificate_issue']['deployed_on_blockchain'] == '')
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="card mt-3 developed_card" >
                                                        <img src="{{ env('PINATA_IPFS_VIEW_PATH') . (isset($data['student_certificate_issue']['cid']) ? $data['student_certificate_issue']['cid'] : '') }}" class="card-img-top" alt="not found">

                                                        <div class="card-body p-3">
                                                            <h5 class="card-title fw-semibold text-primary">{{ isset($data['student_user_data']['name']) ? $data['student_user_data']['name'].' '.$data['student_user_data']['last_name']: '' }}</h5>
                                                            <p class="card-text">{{ isset($data['student_courses']['course_title']) ? $data['student_courses']['course_title']: '' }}</p>
                                                            <!-- Badge: Deployed -->
                                                            <span class="badge bg-warning">Pending</span>
                                                            <!-- Generate Button -->
                                                            <button class="btn btn-primary d-block mt-1 developed generate-btn" data-ipfs="{{base64_encode(env('PINATA_IPFS_PATH').$data['student_certificate_issue']['cid'])}}" data-student_id="{{base64_encode($data['id'])}}">Deploy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                            {{-- @else
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="card mt-3 developed_card" >
                                                        {{"No Record Found"}}
                                                    </div>
                                                </div>
                                            @endif --}}
                                        @endforeach
                                        @endif
                                        </div>
                                    
                                    </div>

                                    <!-- In-progress Certificate Section -->
                                    <div class="mt-3">
                                        <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate - Deployed On Blockchain
                                            </label>
                                        <div class="row">
                                            @if(!empty($certData) && isset($certData))
                                            @foreach($certData as $data)
                                            @if(isset($data['student_certificate_issue']) && !empty($data['student_certificate_issue']))
                                                @if($data['student_certificate_issue']['deployed_on_blockchain'] != '')
                                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                                                        <div class="box1 in-progress">
                                                            <img src="{{ env('PINATA_IPFS_VIEW_PATH') . (isset($data['student_certificate_issue']['cid']) ? $data['student_certificate_issue']['cid'] : '') }}" alt="Developed Certificate" class="img-fluid">
                                                        </div>
                                                        
                                                        <a href="#" 
                                                        class="btn btn-primary d-block mt-2" 
                                                        onclick="ViewCertificateModel('{{ base64_encode($data['student_user_data']['name']) }}', '{{ base64_encode($data['student_courses']['course_title']) }}','{{ $data['student_certificate_issue']['transactionHash'] }}','{{base64_encode($data['student_certificate_issue']['tokenId'])}}','{{base64_encode($data['id'])}}','{{ $data['student_certificate_issue']['cid'] }}', false)">
                                                        View Certificate
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    </div>
                                                @endif
                                                {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                                                    <div class="box1 in-progress">
                                                        <img src="https://marketplace.canva.com/EAFy42rCTA0/1/0/1600w/canva-blue-minimalist-certificate-of-achievement-_asVJz8YgJE.jpg"
                                                            alt="Developed Certificate 1" class="img-fluid" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                    <div class="box1 in-progress">
                                                        <img src="https://marketplace.canva.com/EAFy42rCTA0/1/0/1600w/canva-blue-minimalist-certificate-of-achievement-_asVJz8YgJE.jpg"
                                                            alt="Developed Certificate 1" class="img-fluid" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                    <div class="box1 in-progress">
                                                        <img src="https://sertifier.com/blog/wp-content/uploads/2020/10/certificate-text-samples.jpg"
                                                            alt="Developed Certificate 1" class="img-fluid" />
                                                    </div>
                                                </div> --}}
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Step 3 Content: Transfer to Student -->
                            {{-- <div id="get-certificate-part" class="content" role="tabpanel" aria-labelledby="get-certificate-part-trigger">
                                <div class="container-fluid">
                                    <div class="table-responsive mt-3 active">
                                        <table class="table mb-0 table-hover table-centered text-nowrap">
                                            <!-- Table Head -->
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Name</th>
                                                    <th>Course Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table Body -->
                                            <tbody>
                                                <!-- Static Data Row for Certificate -->
                                                <tr>
                                                    <td>1</td>
                                                    <td><span class="text-primary">John Doe</span></td>
                                                    <td>Introduction to Web Development</td>
                                                    <td>
                                                        <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch">
                                                            <a href="#" class="btn btn-primary w-100 text-center">View Certificate On Blockchain <i class="bi bi-eye"></i></a>
                                                            <a href="#" class="btn btn-primary w-100 text-center">View Certificate <i class="bi bi-eye"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Static Data Row for Certificate -->
                                                <tr>
                                                    <td>2</td>
                                                    <td><span class="text-primary">Jane Smith</span></td>
                                                    <td>Advanced Python Programming</td>
                                                    <td>
                                                        <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch">
                                                            <a href="#" class="btn btn-primary w-100 text-center">View Certificate On Blockchain <i class="bi bi-eye"></i></a>
                                                            <a href="#" class="btn btn-primary w-100 text-center">View Certificate <i class="bi bi-eye"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            <div id="get-certificate-part" class="content" role="tabpanel" aria-labelledby="get-certificate-part-trigger">
                                <div class="container-fluid">
                                    <div class="table-responsive mt-3 active">
                                        <div class="mb-3">
                                            <input type="text" id="customSearchStudent" class="form-control" placeholder="Search certificate data...">
                                        </div>
                                        <table class="table mb-0 table-hover table-centered text-nowrap w-100" id="certStudent">
                                            <!-- Table Head -->
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Name</th>
                                                    <th>Course Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table Body -->
                                            <tbody>
                                                
                                                @if(!empty($certData) && isset($certData))
                                                @php $j=1; @endphp
                                                @foreach($certData as $data)
                                                    @if(isset($data['student_certificate_issue']) && !empty($data['student_certificate_issue']) && $data['student_certificate_issue']['deployed_on_blockchain'] != '')
                                                    <!-- Add your certificate data here -->
                                                        <tr>
                                                            <td>{{$j}}</td>
                                                            <td><span class="text-primary">{{ isset($data['student_user_data']['name']) ? $data['student_user_data']['name'].' '.$data['student_user_data']['last_name']: '' }}</span></td>
                                                            <td>{{ isset($data['student_courses']['course_title']) ? $data['student_courses']['course_title']: '' }}</td>
                                                            {{-- <td><span class="badge bg-success">Pass</span></td> --}}

                                                            <td>
                                                                @if($data['student_certificate_issue']['transferred_on'] != '')
                                                                  
                                                                    <div class="d-flex flex-column flex-md-row gap-2 align-items-stretch">
                                                                        <!-- Blockchain Certificate Button -->
                                                                        <a href="https://holesky.etherscan.io/nft/<?= $data['student_certificate_issue']['smartContract']; ?>/<?= $data['student_certificate_issue']['tokenId']; ?>" 
                                                                            class="btn btn-primary w-100 text-center">
                                                                            View Certificate On Blockchain
                                                                            <i class="bi bi-eye"></i>
                                                                        </a>
                                                                    
                                                                        <!-- View Certificate Button -->
                                                                        <a href="#" 
                                                                            class="btn btn-primary w-100 text-center" 
                                                                            onclick="ViewCertificateModel('{{ base64_encode($data['student_user_data']['name']) }}', '{{ base64_encode($data['student_courses']['course_title']) }}','{{ $data['student_certificate_issue']['transactionHash'] }}','{{ base64_encode($data['student_certificate_issue']['tokenId']) }}','{{ base64_encode($data['id']) }}','{{ $data['student_certificate_issue']['cid'] }}', false)">
                                                                            View Certificate
                                                                            <i class="bi bi-eye"></i>
                                                                        </a>
                                                                    </div>
                                                                    

                                                                @else
                                                                    <a href="#" 
                                                                        class="btn btn-primary d-block" 
                                                                        onclick="ViewCertificateModel('{{ base64_encode($data['student_user_data']['name']) }}', '{{ base64_encode($data['student_courses']['course_title']) }}','{{ $data['student_certificate_issue']['transactionHash'] }}','{{base64_encode($data['student_certificate_issue']['tokenId'])}}','{{base64_encode($data['id'])}}','{{ $data['student_certificate_issue']['cid'] }}', true)">
                                                                        Transfer to Student
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @php $j++; @endphp
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
 <div class="modal fade" id="viewCertificate" tabindex="-1" aria-labelledby="viewCertificateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="viewCertificateLabel">Certificate Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Certificate Image -->
                    <div class="text-center mb-4">
                        <img src="" class="certificate_img" width="750px" height="650px"
                            class="img-fluid" alt="Certificate Image" />
                    </div>
    
                    <!-- Certificate Details -->
                    <div class="details-section ">
                        <h5 class="mb-3 fw-bold">Student Name: <span class="fw-normal student_name"></span></h5>
                        <h5 class="mb-3 fw-bold">Course Name: <span class="fw-normal course_name"></span></h5>
    
                        <div class="row mb-3">
                            <div class="col-4">
                                <h5 class="fw-bold">Transaction Id  : <span class="fw-normal transaction_id"></span></h5>
                            </div>
                            {{-- <div class="col-8">
                                <h5 class="fw-bold">Account No: <span class="fw-normal to">1238762345</span></h5>
                            </div> --}}
                        </div>
    
                        <!-- Send Certificate Section -->
                        <form class="transferData extra_content">  
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <label for="accountNoInput" class="me-2 fw-normal text-primary fw-bold" style="white-space: nowrap">Send To:</label>
                                <input type="text" name="student_address" id="student_address" value="" class="form-control me-2 " placeholder="Student Address" style="max-width: 250px;">
                                
                                 <input type="text" name="student_id" id="student_id" hidden value="">
                                 <input type="text" name="nftID" id="nftID" hidden value="">
                                  <button class="btn btn-primary transfer" type="button">Send</button>
                            </div>
                            
                        </div>
                         <small id="student_address_error" class="text-danger" style="display: none"><i>Provide Student Address e.g 0xabcd123...</i></small>
                        </form>
                    </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</main>






{{-- <script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>


<script type="module">
    // Ethereum Configuration
    const RpcUrl = "{{ env('ETHEREUM_RPC_URL') }}"; 
    const smartContractAddress = "{{ env('CONTRACT_ADDRESS') }}";
    const initOwner = "{{ env('INIT_OWNER') }}";
    const privateKey = "{{ env('PRIVATE_KEY') }}";
    const web3 = new Web3(new Web3.providers.HttpProvider(RpcUrl));
    const abi = await fetch("{{asset('admin/js/eascencia_abi.json')}}").then((res) => res.json());
    const contract = new web3.eth.Contract(abi, smartContractAddress);

    // Certificate Functions
    async function deployCert(mtdataUri) {
        const account = web3.eth.accounts.privateKeyToAccount(privateKey);
        web3.eth.accounts.wallet.add(account);
        web3.eth.defaultAccount = account.address;

        const gas = await contract.methods.safeMint(account.address, mtdataUri).estimateGas({
            from: account.address,
        });
        
        const tx = await contract.methods.safeMint(account.address, mtdataUri).send({
            from: account.address,
            gas: 500000,
        }); 
        
        return new Promise((resolve) => {
            setTimeout(() => resolve(tx), 1000);
        });
    }

    async function transfer(recipientAddress, nftID) {
        try {
            const gasPrice = await web3.eth.getGasPrice();
            const gas = await contract.methods.safeTransferFrom(initOwner, recipientAddress, nftID).estimateGas({
                from: initOwner,
            });
    
            const maxPriorityFeePerGas = web3.utils.toWei("2", "gwei");
            const maxFeePerGas = parseInt(gasPrice) + parseInt(maxPriorityFeePerGas);
            const transferData = contract.methods
                .safeTransferFrom(initOwner, recipientAddress, nftID)
                .encodeABI();
                
            const tx = {
                from: initOwner,
                to: smartContractAddress,
                data: transferData,
                gas: 500000,
                maxPriorityFeePerGas,
                maxFeePerGas,
            };
            
            const signedTx = await web3.eth.accounts.signTransaction(tx, privateKey);
            const receipt = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);
            
            return new Promise((resolve) => {
                setTimeout(() => resolve(receipt.transactionHash), 1000);
            });
        } catch (error) {
            console.error("Transfer error:", error);
            throw error;
        }
    }

    // Event Handlers
    $(document).ready(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        
        // Deploy Certificate
        $('.developed').on("click", function() {
            const ipfsHash = $(this).data("ipfs");
            const student_id = $(this).data("student_id");
            
            swal({
                title: "Deploy on Ethereum Blockchain?",
                text: "Are you sure you want to deploy? This cannot be undone!",
                icon: "warning",
                buttons: ["Cancel", "Deploy"],
                dangerMode: true,
            }).then(async (result) => {
                if (result) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");
                    
                    try {
                        const deployRes = await deployCert(atob(ipfsHash));
                        
                        $.ajax({
                            url: "{{ route('metaData')}}",
                            type: "POST",
                            data: { 
                                student_id: student_id, 
                                tnResp: deployRes
                            },
                            headers: { "X-CSRF-TOKEN": csrfToken },
                        }).done(function(response) {
                            $(".save_loader").addClass("d-none").removeClass("d-block");
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(() => {
                                const stepIndex = 1;
                                goToStep(stepIndex);
                                localStorage.setItem('currentStep', stepIndex);
                                window.location.reload();
                            });
                        });
                    } catch (error) {
                        $(".save_loader").addClass("d-none").removeClass("d-block");
                        console.error("Deployment error:", error);
                        swal("Error", "Failed to deploy certificate", "error");
                    }
                }
            });
        });

        // Transfer Certificate
        $(document).on("click", ".transfer", async function(e) {
            e.preventDefault();
            $("#student_address_error").hide();
            
            const student_id = $("#student_id").val();
            const student_address = $("#student_address").val();
            const nftID = $("#nftID").val();
            
            if (!student_address) {
                $("#student_address_error").show();
                return;
            }

            try {
                const exists = `{{ is_exist('certitficate_issue', ['student_course_master_id' => `+atob(student_id)+`, 'transferred_on' => null]) }}`;
                
                if (exists == 0) {
                    const result = await swal({
                        title: "Transfer to Student?",
                        text: "Are you sure you want to transfer? This cannot be undone!",
                        icon: "warning",
                        buttons: ["Cancel", "Transfer"],
                        dangerMode: true,
                    });
                    
                    if (result) {
                        $(".save_loader").removeClass("d-none").addClass("d-block");
                        const transferHash = await transfer(student_address, atob(nftID));
                        
                        $.ajax({
                            url: "{{ route('transferNft')}}",
                            type: "POST",
                            data: $(".transferData").serialize() + "&transfertnHash=" + transferHash,
                            headers: { "X-CSRF-TOKEN": csrfToken },
                        }).done(function(response) {
                            $(".save_loader").addClass("d-none").removeClass("d-block");
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(() => {
                                const stepIndex = 2;
                                goToStep(stepIndex);
                                localStorage.setItem('currentStep', stepIndex);
                                window.location.reload();
                            });
                        });
                    }
                } else {
                    swal("Error", "Certificate already transferred", "error");
                }
            } catch (error) {
                $(".save_loader").addClass("d-none").removeClass("d-block");
                console.error("Transfer error:", error);
                swal("Error", "Transfer failed", "error");
            }
        });
    });

    // DataTable Initialization
    $(function() {
        $('#certTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            dom: 'lrtip',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search certificate data..."
            }
        });

        $('#customSearch').on('keyup', function() {
            $('#certTable').DataTable().search(this.value).draw();
        });
    });

    // Stepper Initialization
    
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the stepper with non-linear navigation
        const stepperEl = document.querySelector('.bs-stepper');
        const stepper = new Stepper(stepperEl, {
            linear: false, // Allow non-linear navigation
        });

        // Go to Step 2 on 'Deploy' button click
        document.querySelectorAll('.generate-btn').forEach(button => {
            button.addEventListener('click', function () {
                stepper.to(2);
            });
        });

        // Go to Step 3 on 'Transfer' button click
        document.querySelectorAll('.transfer-btn').forEach(button => {
            button.addEventListener('click', function () {
                stepper.to(3);
            });
        });

        // Enable step tab clicking and navigation
        document.querySelectorAll('.step-trigger').forEach((trigger, index) => {
            trigger.classList.remove('disabled'); // ensure clickable
            trigger.addEventListener('click', function () {
                stepper.to(index + 1);
            });
        });
    });
</script> --}}





<script>
    function ViewCertificateModel(studentName, courseName,transaction_id,token_id,studentCourseMasterId,CID, showExtraContent){
        $('.student_name').text(atob(studentName));
        $('.course_name').text(atob(courseName));
        $('.transaction_id').text(transaction_id);
        $('#student_id').val(studentCourseMasterId);
        $('#nftID').val(token_id);
        const ipfc_url = "{{ env('PINATA_IPFS_VIEW_PATH') }}"; 
        $('.certificate_img').attr('src', ipfc_url+''+CID); // Update the src attribute

        if (showExtraContent) {
            $('.extra_content').show();
        } else {
            $('.extra_content').hide();
        }


        // Show the modal using Bootstrap
        $("#viewCertificate").modal('show');
    }

</script>



<script type="module">
    const RpcUrl = "{{ env('ETHEREUM_RPC_URL') }}"; 
    const smartContractAddress = "{{ env('CONTRACT_ADDRESS') }}";
    const initOwner = "{{ env('INIT_OWNER') }}";
    const privateKey = "{{ env('PRIVATE_KEY') }}";
    const web3 = new Web3(new Web3.providers.HttpProvider(RpcUrl));
    const abi = await fetch("{{asset('admin/js/eascencia_abi.json')}}").then((res) => res.json());
    const contract = new web3.eth.Contract(abi, smartContractAddress);
    async function deployCert(mtdataUri) {
        const account = web3.eth.accounts.privateKeyToAccount(privateKey);
        web3.eth.accounts.wallet.add(account);
        web3.eth.defaultAccount = account.address;


        const gas = await contract.methods.safeMint(account.address, mtdataUri).estimateGas({
            from: account.address,
        });
        const tx = await contract.methods.safeMint(account.address, mtdataUri).send({
        from: account.address,
            gas:500000,
        }); 
        const res =  new Promise((resolve) => {
            setTimeout(() => {
                resolve(tx);
            }, 1000);
            
        });
        return res;
    }
    async function transfer(recipientAddress, nftID) {
        try {
            // console.log("start transferring NFT:",nftID);
            const gasPrice = await web3.eth.getGasPrice();
    
            const gas = await contract.methods.safeTransferFrom(initOwner, recipientAddress, nftID).estimateGas({
                from: initOwner,
            });
    
            const maxPriorityFeePerGas = web3.utils.toWei("2", "gwei");
            const maxFeePerGas = parseInt(gasPrice) + parseInt(maxPriorityFeePerGas);
            const transferData = contract.methods
                .safeTransferFrom(initOwner, recipientAddress, nftID)
                .encodeABI();
            const tx = {
                from: initOwner,
                to: smartContractAddress,
                data: transferData,
                gas:500000,
                maxPriorityFeePerGas,
                maxFeePerGas,
            };
            const signedTx = await web3.eth.accounts.signTransaction(tx, privateKey);
            const receipt = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);
            const res =  new Promise((resolve) => {
                setTimeout(() => {
                    resolve(receipt.transactionHash);
                }, 1000);
                
            });
            // console.log("transferring NFT:", receipt.transactionHash);
            return res;
        } catch (error) {
            // console.error("Error transferring NFT:", error);
        }
    }
    window.deployCert = deployCert;
    window.transfer = transfer;
</script>

<script type="module">
    $(document).ready(async function () {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $('.developed').on("click", function() {
            var ipfsHash = $(this).data("ipfs");
            var student_id = $(this).data("student_id");
            swal({
            title: "Deploy on Ethereum Blockchain ?",
            text: "Are you sure you want to Deploy Blockchain ? It can not be Revoked again!!!",
            icon: "warning",
            buttons: ["Cancel", "OK"],
            dangerMode: true,
            }).then((result) => {
                if (result) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");
                    deployCert(atob(ipfsHash)).then((deployRes) => {
                        // if (result === true && studnent_id > 0 && deployRes != null) {
                        $.ajax({
                            url: "{{ route('metaData')}}",
                            type: "POST",
                            data: { student_id: student_id, tnResp: deployRes},
                            dataType: "json",
                            headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                $(".save_loader").addClass("d-none").removeClass("d-block");
                                localStorage.setItem("deployOnBlockChainTab", false);
                                localStorage.setItem("transferToStudentTab", true);
                                    swal({
                                    title: response.title,
                                    text: response.message,
                                    icon: response.icon,
                                }).then(function () {
                                    // const stepIndex = 1; // Index for the second stepper
                                    // goToStep(stepIndex); // Call your step navigation function

                                    // localStorage.setItem('currentStep', stepIndex);
                                    // Reload the page
                                    window.location.reload();
                                });
                                // return window.location.reload();
                            },
                        });
                    })
                    .catch((error) => {
                        $(".save_loader").addClass("d-none").removeClass("d-block");
                        console.error("Error:", error);
                    });
                }else {
                    // User clicked "Cancel" button, refresh the page
                    window.location.reload();
                }

                    // $(".save_loader").addClass("d-none").removeClass("d-block");
        
            });

            // 0x5F560eb19D1d8a57b9B6a5744a42C68A1DdEEbf2
        });

        $(document).on("click", ".transfer", function(e) {
            e.preventDefault();
            $("#student_address_error").hide();
            var form = $(".transferData").serialize();
            var student_id = $("#student_id").val();
            var student_address = $("#student_address").val();
            var nftID = $("#nftID").val();

            if (student_address === "") {
                $("#student_address_error").show('d-none');
                return;
            }

            $.ajax({
                url: "{{ route('check.certificate.exists') }}",
                type: "POST",
                data: {
                    student_course_master_id: atob(student_id),
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.exists) {
                        swal({
                            title: "Transfer to Student ?",
                            text: "Are you sure you want to Transfer ? It can not be Revoked again!!!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((result) => {
                            if (result === true) {
                                $(".save_loader").removeClass("d-none").addClass("d-block");
                                transfer(student_address, atob(nftID)).then((transfer) => {
                                    if (transfer) {
                                        var form = $(".transferData").serialize();
                                        var transfertn = "transfertnHash=" + transfer;
                                        form = form + "&" + transfertn;

                                        $.ajax({
                                            url: "{{ route('transferNft') }}",
                                            type: "POST",
                                            data: form,
                                            dataType: "json",
                                            headers: {
                                                "X-CSRF-TOKEN": csrfToken,
                                            },
                                            success: function (response) {
                                                $(".save_loader").addClass("d-none").removeClass("d-block");
                                                localStorage.setItem("deployOnBlockChainTab", false);
                                                localStorage.setItem("transferToStudentTab", true);
                                                swal({
                                                    title: response.title,
                                                    text: response.message,
                                                    icon: response.icon,
                                                }).then(function () {
                                                    window.location.reload();
                                                });
                                            },
                                        });
                                    } else {
                                        swal({
                                            title: "Something went wrong",
                                            text: "Try again to transfer",
                                            icon: "error",
                                        });
                                    }
                                });
                            } else {
                                $(".save_loader").addClass("d-none").removeClass("d-block");
                                swal({
                                    title: "Transfer cancelled",
                                    text: "You cancelled the transfer.",
                                    icon: "info",
                                });
                            }
                        });
                    } else {
                        swal({
                            title: "Already Transferred!",
                            text: "Can't transfer again",
                            icon: "error",
                        });
                    }
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function () {
        var table = $('#certTable').DataTable({ // ✅ assign here
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            dom: 'lrtip', // remove default search box
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search certificate data..."
            }
        });

        // ✅ connect custom search input
        $('#customSearch').on('keyup', function () {
            table.search(this.value).draw();
        });


        
        var tableStudent = $('#certStudent').DataTable({ // ✅ assign here
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            dom: 'lrtip', // remove default search box
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search certificate data..."
            }
        });

        // ✅ connect custom search input
        $('#customSearchStudent').on('keyup', function () {
            tableStudent.search(this.value).draw();
        });
    });


    // document.addEventListener('DOMContentLoaded', function () {
    //     // Initialize the stepper with non-linear navigation
    //     const stepperEl = document.querySelector('.bs-stepper');
    //     const stepper = new Stepper(stepperEl, {
    //         linear: false, // Allow non-linear navigation
    //     });

    //     // Go to Step 2 on 'Deploy' button click
    //     document.querySelectorAll('.generate-btn').forEach(button => {
    //         button.addEventListener('click', function () {
    //             stepper.to(2);
    //         });
    //     });

    //     // Go to Step 3 on 'Transfer' button click
    //     document.querySelectorAll('.transfer-btn').forEach(button => {
    //         button.addEventListener('click', function () {
    //             stepper.to(3);
    //         });
    //     });

    //     // Enable step tab clicking and navigation
    //     document.querySelectorAll('.step-trigger').forEach((trigger, index) => {
    //         trigger.classList.remove('disabled'); // ensure clickable
    //         trigger.addEventListener('click', function () {
    //             stepper.to(index + 1);
    //         });
    //     });
    // });

    // document.addEventListener('DOMContentLoaded', function () {
    //     const stepperEl = document.querySelector('.bs-stepper');
    //     const stepper = new Stepper(stepperEl, {
    //         linear: false, // Allow non-linear navigation
    //     });

    //     // Determine initial tab from localStorage
    //     const deployOnBlockChainTab = localStorage.getItem("deployOnBlockChainTab") === "true";
    //     const transferToStudentTab = localStorage.getItem("transferToStudentTab") === "true";

    //     let initialStep = 1; // Default is step 1 (Generate Certificate)

    //     if (deployOnBlockChainTab) {
    //         initialStep = 2; // Step 2: Deploy on Blockchain
    //     } else if (transferToStudentTab) {
    //         initialStep = 3; // Step 3: Transfer to Student
    //     }

    //     stepper.to(initialStep); // Move to the selected step

    //     // Go to Step 2 on 'Generate' button click
    //     document.querySelectorAll('.generate-btn').forEach(button => {
    //         button.addEventListener('click', function () {
    //             stepper.to(2);
    //         });
    //     });

    //     // Go to Step 3 on 'Transfer' button click
    //     document.querySelectorAll('.transfer-btn').forEach(button => {
    //         button.addEventListener('click', function () {
    //             stepper.to(3);
    //         });
    //     });

    //     // Enable tab clicking
    //     document.querySelectorAll('.step-trigger').forEach((trigger, index) => {
    //         trigger.classList.remove('disabled');
    //         trigger.addEventListener('click', function () {
    //             stepper.to(index + 1);
    //         });
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function () {
        const stepperEl = document.querySelector('.bs-stepper');
        const stepper = new Stepper(stepperEl, {
            linear: false,
        });

        // Read localStorage flags
        const deployOnBlockChainTab = localStorage.getItem("deployOnBlockChainTab") === "true";
        const transferToStudentTab = localStorage.getItem("transferToStudentTab") === "true";

        let initialStep = 1;
        if (deployOnBlockChainTab) {
            initialStep = 2;
        } else if (transferToStudentTab) {
            initialStep = 3;
        }

        // Delay step navigation slightly to avoid style/render issues
        setTimeout(() => {
            stepper.to(initialStep);
        }, 100); // 100ms delay

        // Step 2 on 'Generate' button
        document.querySelectorAll('.generate-btn').forEach(button => {
            button.addEventListener('click', function () {
                stepper.to(2);
            });
        });

        // Step 3 on 'Transfer' button
        document.querySelectorAll('.transfer-btn').forEach(button => {
            button.addEventListener('click', function () {
                stepper.to(3);
            });
        });

        // Enable step tab clicking
        document.querySelectorAll('.step-trigger').forEach((trigger, index) => {
            trigger.classList.remove('disabled');
            trigger.addEventListener('click', function () {
                stepper.to(index + 1);
            });
        });
    });


</script>



@endsection
