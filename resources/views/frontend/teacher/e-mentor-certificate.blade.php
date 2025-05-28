@extends('frontend.master')
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
            width: 16rem; 
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
        .dataTables_filter{
            display: none;;
        }



    </style>


    <main>
        <section class="pt-5 pb-5">
            <div class="container">

                <!-- Top Menubar -->
                @include('frontend.teacher.layout.e-mentor-common')

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">Certificate Management</h3>
                                <span>Generate, view, and Review your certificate with ease by following these simple steps.</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tab content -->

                    <!-- Tab pane -->
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div>
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- Step 1: Generate Certificate -->
                                        <div class="step" data-target="#generate-certificate-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="generate-certificate-part"
                                                id="generate-certificate-part-trigger">
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
                                        <div id="generate-certificate-part" class="content mt-3" role="tabpanel"
                                            aria-labelledby="generate-certificate-part-trigger">
                                            <div class="container">
                                                <div class="mb-3">
                                                    <input type="text" id="customSearch" class="form-control" placeholder="Search certificate data...">
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table mb-0 table-hover table-centered text-nowrap generate-certificate-data w-100">
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
                                                            {{-- @if(!empty($certData) && isset($certData))
                                                            @php $i=1;
                                                            @endphp
                                                            @foreach($certData as $data)
                                                            
                                                                <tr>
                                                                    <td>{{$i}}</td>
                                                                    <td><span class="text-primary">{{ isset($data['student_user_data']['name']) ? $data['student_user_data']['name'].' '.$data['student_user_data']['last_name']: '' }}</span></td>
                                                                    <td>{{ isset($data['student_courses']['course_title']) ? $data['student_courses']['course_title']: '' }}</td>
                                                                    <td><span class="text-primary">{{ isset($data['course_start_date']) ? $data['course_start_date']: '' }}</span></td>
                                                                    
                                                                    <td>
                                                                        @if(!empty($data['cert_file']) && isset($data['cert_file']))
                                                                            <a href="{{ env('PINATA_IPFS_VIEW_PATH') . (isset($data['student_certificate_issue']['cid']) ? $data['student_certificate_issue']['cid'] : '') }}" target="_blank" class="btn btn-success">View</button>
                                                                        @else
                                                                            <button class="btn btn-primary btn-sm genCert d-block" data-student_id="{{base64_encode($data['id'])}}" data-role="{{ Auth::user()->role }}">Proceed</button>
                                                                        @endif 
                                                                    </tr>
                                                            @php $i++; @endphp

                                                            @endforeach --}}
                                                          
                                                        
                                                        {{-- @endif --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2 Content: View Certificate -->
                                        <div id="view-certificate-part" class="content" role="tabpanel"
                                            aria-labelledby="view-certificate-part-trigger">
                                            <div class="container">
                                                <!-- Developed Certificate Section -->
                                                <div class="mt-3">
                                                    
                                                    <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate- Deployment On Blockchain
                                                        </label>
                                               
                                                    <div class="row certificate-deployment">
                                                        {{-- @if(!empty($certData) && isset($certData)) --}}
                                                        {{-- @foreach($certData as $data) --}}
                                                        {{-- @if(isset($data['student_certificate_issue']) && !empty($data['student_certificate_issue']))
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
                                                        @endif --}}
                                                        {{-- @else
                                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="card mt-3 developed_card" >
                                                                    {{"No Record Found"}}
                                                                </div>
                                                            </div>
                                                        @endif --}}
                                                        {{-- @endforeach --}}
                                                        {{-- @endif --}}
                                                    </div>
                                                   
                                                </div>

                                                <!-- In-progress Certificate Section -->
                                                <div class="mt-3">
                                                    <label for="" class="fs-3 text-primary mb-2 deploymnetTextonMobile" style="font-weight: 500">Certificate - Deployed On Blockchain
                                                        </label>
                                                    <div class="row certificate-deployed">
                                                        {{-- @if(!empty($certData) && isset($certData))
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
                                                            @endif --}}
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
                                                        {{-- @endif --}}
                                                        {{-- @endforeach --}}
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3 Content: Get Certificate -->
                                        <div id="get-certificate-part" class="content active" role="tabpanel"
                                            aria-labelledby="get-certificate-part-trigger">
                                            <div class="container">
                                                <div class="table-responsive mt-3 active">
                                                    <div class="mb-3">
                                                        <input type="text" id="customSearchStudent" class="form-control" placeholder="Search certificate data...">
                                                    </div>
                                                    <table class="table mb-0 table-hover table-centered text-nowrap w-100 transfer-student">
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
                                                            <!-- Add your certificate data here -->
                                                            {{-- <tr>
                                                                <td><span class="text-primary">John Doe</span></td>
                                                                <td>Award in recruitment and employee selections</td>
                                                                <td><a href="#" class="btn btn-primary d-block"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewCertificate">View Certificate
                                                                        <i class="bi bi-eye"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="text-primary">Jane Smith</span></td>
                                                                <td style="white-space: normal; max-width: 300px;">Masters
                                                                    of Arts in International Management and Global Business
                                                                </td>
                                                                <td><a href="#" class="btn btn-primary d-block"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewCertificate">View Certificate
                                                                        <i class="bi bi-eye"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="text-primary">Michael Johnson</span></td>
                                                                <td>Post Graduate Diploma in Human Resources Management</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary d-block"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewCertificate">View Certificate
                                                                        <i class="bi bi-eye"></i></a>
                                                                </td>
                                                            </tr> --}}
                                                            {{-- @if(!empty($certData) && isset($certData)) --}}
                                                            {{-- @php $i=1;  --}}
                                                               
                                                            {{-- @endphp
                                                            @foreach($certData as $data)
                                                                @if(isset($data['student_certificate_issue']) && !empty($data['student_certificate_issue']) && $data['student_certificate_issue']['deployed_on_blockchain'] != '') --}}
                                                                <!-- Add your certificate data here -->
                                                                    {{-- <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td><span class="text-primary">{{ isset($data['student_user_data']['name']) ? $data['student_user_data']['name'].' '.$data['student_user_data']['last_name']: '' }}</span></td>
                                                                        <td>{{ isset($data['student_courses']['course_title']) ? $data['student_courses']['course_title']: '' }}</td> --}}
                                                                        {{-- <td><span class="badge bg-success">Pass</span></td> --}}

                                                                        {{-- <td>
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
                                                            @php $i++; @endphp
                                                            @endforeach --}}
                                                            {{-- @if($totalPages > 1)
                                                            <tr> --}}
                                                                {{-- <td colspan="5" class="text-center">
                                                                    <nav>
                                                                        <ul class="pagination justify-content-center">
                                                                                <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                                                                                    <a class="page-link" href="?page={{ $page - 1 }}">&lt;</a>
                                                                                </li>
                                                
                                                                            @for($i = 1; $i <= $totalPages; $i++)
                                                                                <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                                                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                                                                </li>
                                                                            @endfor
                                                
                                                                            <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                                                                                <a class="page-link" href="{{ $page < $totalPages ? '?page=' . ($page + 1) : '#' }}" aria-disabled="{{ $page == $totalPages ? 'true' : 'false' }}">&gt;</a>
                                                                            </li>
                                                                        </ul>
                                                                    </nav>
                                                                </td> --}}
                                                            {{-- </tr> --}}
                                                            {{-- @endif --}}
                                                            {{-- @endif --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- <div class="button-container d-flex justify-content-end">
                                                <button class="btn btn-primary">Finish</button>
                                            </div> --}}
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
                                    <h5 class="fw-bold">Transaction Id: <span class="fw-normal transaction_id"></span></h5>
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
                url: "{{ route('ementor.check.certificate.exists') }}",
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

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
        // $('#customSearch').on('keyup', function () {
        //     table.search(this.value).draw();
        // });
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

        $("#processingLoader").fadeIn();
        var baseUrl = window.location.origin + "/";
        const pinataPath = "{{ env('PINATA_IPFS_VIEW_PATH') }}";
        const pinataViewPath = "{{ env('PINATA_IPFS_VIEW_PATH') }}";
            $.ajax({
                url: baseUrl + "ementor/e-mentor-certificate-data",
                method: "GET",
                success: function (data) {

                    // $(".generate-certificate-data").DataTable().destroy();
                    $("#processingLoader").fadeOut();
                    if ($.fn.DataTable.isDataTable(".generate-certificate-data")) {
                        $(".generate-certificate-data").DataTable().clear().destroy();
                    }

                    $(".generate-certificate-data").DataTable({
                        data: data, // Load the certData array into DataTable
                        columns: [
                            {
                                data: null,
                                render: function (data, type, row, meta) {
                                    return meta.row + 1; // Serial number
                                },
                                width: "10%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    // Format the student's name
                                    return data.student_user_data.name + ' ' + data.student_user_data.last_name;
                                },
                                width: "25%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    // Course title
                                    return data.student_courses.course_title;
                                },
                                width: "25%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    // Course start date
                                    return data.course_start_date;
                                },
                                width: "20%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    // Certificate action button
                                    if (data.cert_file) {
                                        const pinataViewPath = "{{ env('PINATA_IPFS_VIEW_PATH') }}";
                                        const certificateLink = pinataViewPath + (data.student_certificate_issue?.cid || '');
                                        return `<a href="${certificateLink}" target="_blank" class="btn btn-success">View</a>`;
        
                                        // var certificateLink = env('PINATA_IPFS_VIEW_PATH') + (data.student_certificate_issue.cid || '');
                                        // return '<a href="' + certificateLink + '" target="_blank" class="btn btn-success">View</a>';
                                        return "test";
                                    } else {
                                        return '<button class="btn btn-primary btn-sm genCert" data-student_id="' + btoa(data.id) + '" data-role="{{ Auth::user()->role }}">Proceed</button>';
                                    }
                                },
                                width: "20%"
                            }
                        ]
                    });



                    $('.certificate-deployment').empty();

                    data.forEach(function (data) {
                    const certIssue = data.student_certificate_issue;
                    if (certIssue && (!certIssue.deployed_on_blockchain || certIssue.deployed_on_blockchain === '')) {
                        const cid = certIssue.cid ?? '';
                        const imgSrc = pinataViewPath + cid;
                        const ipfsEncoded = btoa(pinataPath + cid);
                        const studentIdEncoded = btoa(data.id ?? '');

                        const name = (data.student_user_data?.name ?? '') + ' ' + (data.student_user_data?.last_name ?? '');
                        const courseTitle = data.student_courses?.course_title ?? '';

                        const cardHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card mt-3 developed_card">
                                    <img src="${imgSrc}" class="card-img-top" alt="not found">
                                    <div class="card-body p-3">
                                        <h5 class="card-title fw-semibold text-primary">${name}</h5>
                                        <p class="card-text">${courseTitle}</p>
                                        <span class="badge bg-warning">Pending</span>
                                        <button class="btn btn-primary d-block mt-1 developed generate-btn"
                                            data-ipfs="${ipfsEncoded}"
                                            data-student_id="${studentIdEncoded}">
                                            Deploy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('.certificate-deployment').append(cardHTML);
                        }

                    });
                    $('.certificate-deployed').empty();

                    data.forEach(function (data) {
                        if (
                            data.student_certificate_issue && // check it's not null or undefined
                            data.student_certificate_issue.deployed_on_blockchain !== '' // not an empty string
                        ) {
                            const cid = data.student_certificate_issue.cid ?? '';
                            const imgSrc = pinataPath + cid;

                            const name = btoa(data.student_user_data?.name ?? '');
                            const courseTitle = btoa(data.student_courses?.course_title ?? '');
                            const transactionHash = data.student_certificate_issue.transactionHash ?? '';
                            const tokenId = btoa(data.student_certificate_issue.tokenId ?? '');
                            const studentId = btoa(data.id ?? '');

                            const certHTML = `
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                                    <div class="box1 in-progress">
                                        <img src="${imgSrc}" alt="Developed Certificate" class="img-fluid">
                                    </div>
                                    <a href="#"
                                        class="btn btn-primary d-block mt-2"
                                        onclick="ViewCertificateModel('${name}', '${courseTitle}', '${transactionHash}', '${tokenId}', '${studentId}', '${cid}', false)">
                                        View Certificate <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            `;

                            $('.certificate-deployed').append(certHTML);
                        }
                    });

                    if ($.fn.DataTable.isDataTable(".transfer-student")) {
                        $(".transfer-student").DataTable().clear().destroy();
                    }
                    
                    $('.transfer-student').DataTable({
                        data: data.filter(item => item.student_certificate_issue && item.student_certificate_issue.deployed_on_blockchain !== ''),
                        columns: [
                            {
                                data: null,
                                render: function (data, type, row, meta) {
                                    return meta.row + 1; // serial number
                                }
                            },
                            {
                                data: null,
                                render: function (data) {
                                    let name = data.student_user_data?.name ?? '';
                                    let lastName = data.student_user_data?.last_name ?? '';
                                    return `<span class="text-primary">${name} ${lastName}</span>`;
                                }
                            },
                            {
                                data: 'student_courses.course_title',
                                defaultContent: ''
                            },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function (data) {
                                    const cid = data.student_certificate_issue?.cid;
                                    const tokenId = data.student_certificate_issue?.tokenId;
                                    const txHash = data.student_certificate_issue?.transactionHash;
                                    const smartContract = data.student_certificate_issue?.smartContract;
                                    const transferred = data.student_certificate_issue?.transferred_on;
                                    const studentId = data.id;
                                    const encodedName = btoa(data.student_user_data?.name ?? '');
                                    const encodedCourse = btoa(data.student_courses?.course_title ?? '');
                                    const encodedToken = btoa(tokenId ?? '');
                                    const encodedId = btoa(studentId);

                                    if (transferred) {
                                        return `
                                            <div class="d-flex flex-column flex-md-row gap-2 align-items-stretch">
                                                <a href="https://holesky.etherscan.io/nft/${smartContract}/${tokenId}" 
                                                class="btn btn-primary w-100 text-center" target="_blank">
                                                View Certificate On Blockchain <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-primary w-100 text-center"
                                                onclick="ViewCertificateModel('${encodedName}', '${encodedCourse}', '${txHash}', '${encodedToken}', '${encodedId}', '${cid}', false)">
                                                View Certificate <i class="bi bi-eye"></i>
                                                </a>
                                            </div>`;
                                    } else {
                                        return `
                                            <a href="#" class="btn btn-primary d-block"
                                            onclick="ViewCertificateModel('${encodedName}', '${encodedCourse}', '${txHash}', '${encodedToken}', '${encodedId}', '${cid}', true)">
                                            Transfer to Student <i class="bi bi-eye"></i>
                                            </a>`;
                                    }
                                }
                            }
                        ]
                    });

                    
                }
            });

    $('#customSearch').on('input', function() {
        var table = $('.generate-certificate-data').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('#customSearchStudent').on('input', function() {
        var table = $('.transfer-student').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
            
            

    
</script>
       
@endsection
