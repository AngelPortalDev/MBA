@extends('frontend.master')
@section('content')

    <style>
        /* Loader container styles */
        /* Loader container styles */
.sidenav.navbar .navbar-nav .sp-3>.nav-link {
    color: #2b3990 !important;
     background-color: rgb(235 233 255);
}


.stylenumber {
    display: inline-block;
    width: 30px; 
    height: 30px; 
    border-radius: 50%; 
    background-color: #fff; 
    color: #2b3990; 
    text-align: center; 
    line-height: 28px; 
    font-weight: bold; 
    border: 1px solid #2b3990;
    margin-right: 5px;
}

.accordion-item.active .stylenumber {
    background-color: #2b3990; 
    color: #fff;
}

.accordion-item:not(.active) .stylenumber {
    background-color: #fff; 
}

    </style>

    <main>
        <section class="pt-5 pb-5 doc-verification-page">
            <div class="container">
                <!-- User info -->
                @include('frontend.student.layout.student-common')
                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Document Verification</h3>
                            <p class="mb-0">Please follow the following instructions to upload scanned photographs of your
                                documents for a smooth and secure verification process.</p>
                        </div>
                        <div class="container">

                            @php
                            $docVerified = isset($studentData['identity_is_approved']) &&  $studentData['identity_is_approved'] == 'Approved' ? 'disabled' : '';
                            @endphp
                            <div class="accordion accordion-flush" id="accordionExample" >
                                    <div class="border p-3 rounded-3 mb-2 mt-2 accordion-item" id="upload_id">
                                                <h3 class="mb-0 fs-4 student_upload_id">
                                                    <a href="#" class="d-flex align-items-center justify-content-between text-inherit"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"  aria-expanded="{{ isset($studentData['identity_trail_attempt']) &&  $studentData['identity_doc_file'] == '' || $studentData['english_test_attempt'] == '0' && $studentData['identity_is_approved'] != 'Approved' ? 'true' : 'false' }}"
                                                        aria-controls="collapseOne"  style="{{ isset($docVerified) && $docVerified == 'disabled' ? 'pointer-events: none; ' : '' }}">
                                                        <label class="form-label mb-0" style="cursor: pointer"><span class="stylenumber">1</span> Upload Identity Proof <span class="text-danger">*</span>
                                                                        @if (isset($studentData['identity_is_approved']))
                                                                            @if ($studentData['identity_is_approved'] === 'Pending')
                                                                                <small class="text-warning upload_id_status">(Pending for Admin Approval)</small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Reject')
                                                                                <small class="text-danger upload_id_status">(Rejected) </small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Approved')
                                                                                <small class="text-success upload_id_status">(Verified) </small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Unverified')
                                                                                <small class="text-danger upload_id_status">(Unverified) </small>
                                                                            @endif
                                                                        @endif
                                                                    </label>
                                                        @if(isset($docVerified) && $docVerified == '')
                                                        <span class="collapse-toggle ms-4">
                                                            <i class="fe fe-chevron-down"></i>
                                                        </span>
                                                        @endif
                                                    </a>
                                                </h3>
            
                                                <div id="collapseOne" class="collapse {{ isset($studentData['identity_trail_attempt']) &&  $studentData['identity_doc_file'] == '' || $studentData['english_test_attempt'] == '0' && $studentData['identity_is_approved'] != 'Approved' ? 'show' : '' }}" aria-labelledby="upload_id"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="pt-2">
                                                        @if (!empty($studentData))
                                                            <!-- Form -->
                                                            <form class="row gx-3 needs-validation identityDoc" novalidate>
                                                                <!-- id proof -->
                                                                <div class="col-12 col-md-12">
                                                                    <div class="mb-3">
                                                                        {{-- <label class="form-label color-blue">Upload Identity Proof <span class="text-danger">*</span>
                                                                        @if (isset($studentData['identity_is_approved']))
                                                                            @if ($studentData['identity_is_approved'] === 'Pending')
                                                                                <small class="text-warning">(Pending for Admin Approval)</small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Reject')
                                                                                <small class="text-danger">(Rejected) </small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Approved')
                                                                                <small class="text-success">(Verified) </small>
                                                                            @elseif ($studentData['identity_is_approved'] === 'Unverified')
                                                                                <small class="text-danger">(Unverified) </small>
                                                                            @endif
                                                                        @endif
                                                                    </label> --}}
                                                                        <p class="mb-3">Upload a valid passport for document
                                                                            verification. If you don't have a passport, upload a
                                                                            government-issued national ID. <br>
                                                                            <strong>Priority:</strong> 1. Upload a passport, 2. National
                                                                            ID
                                                                        </p>
                                                                        @if (isset($studentData['identity_is_approved']) && $studentData['identity_is_approved'] != 'Approved')
                                                                            <div class="input-group mb-1">
                                                                                @if ($studentData['identity_is_approved'] === 'Approved')
                                                                                    <input type="text" class="form-control"
                                                                                        value="{{ $studentData['doc_file_name'] }}"
                                                                                        disabled>
                                                                                @elseif (
                                                                                    $studentData['identity_is_approved'] === 'Pending' ||
                                                                                        ($studentData['identity_is_approved'] === 'Reject' && $studentData['identity_trail_attempt'] <= 0))
                                                                                    <input type="text" class="form-control"
                                                                                        value="{{ $studentData['doc_file_name'] }}"
                                                                                        disabled>
                                                                                @else
                                                                                    <input type="file" class="form-control idDoc"
                                                                                        name="document" id="idDoc">
                                                                                @endif
                                                                                <input type="text" class="form-control"
                                                                                    id="doc_type" name="doc_type"
                                                                                    value="{{ base64_encode('ID') }}" hidden>
                                                                                <label class="input-group-text statusText"
                                                                                    for="idDoc">Upload</label>
                                                                            </div>
                                                                            <small>(Documents must be in .pdf, .jpg, or .png format and
                                                                                should be less than 3MB in size.)</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </form>
            
                                                            @php
                                                                $stuDoc = 'd-none';
                                                                if (
                                                                    $studentData['identity_is_approved'] === 'Pending' ||
                                                                    ($studentData['identity_is_approved'] === 'Approved' &&
                                                                        $studentData['identity_is_deleted'] === 'No')
                                                                ) {
                                                                    $stuDoc = '';
                                                                }
                                                            @endphp
                                                            <div class="row docDetails {{ $stuDoc }}">
                                                                <div class="mb-3 col-12 col-md-4">
                                                                    <label class="form-label" for="">Document Type</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ isset($studentData['identity_doc_type']) ? $studentData['identity_doc_type'] : '' }}"
                                                                        id="docType" disabled>
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-8">
                                                                    <label class="form-label" for="">Name as per Document
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ isset($studentData['name_on_identity_card']) ? $studentData['name_on_identity_card'] : '' }}"
                                                                        id="docName" disabled>
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-6">
                                                                    <label class="form-label" for="">Document ID Number</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ isset($studentData['identity_doc_number']) ? htmlspecialchars_decode($studentData['identity_doc_number']) : '' }}"
                                                                        id="docId" disabled>
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-6">
                                                                    <label class="form-label" for="">Document Expiry</label>
                                                                    <input type="date" class="form-control"
                                                                        value="{{ isset($studentData['identity_doc_expiry']) ? $studentData['identity_doc_expiry'] : '' }}"
                                                                        id="docExp" disabled>
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-6 otherDoc">
                                                                    <label class="form-label text-nowrap" for="">Document
                                                                        Issuing Authority</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ isset($studentData['identity_doc_authority']) ? htmlspecialchars_decode($studentData['identity_doc_authority']) : '' }}"
                                                                        id="docissue" disabled>
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-6 otherDoc">
                                                                    <label class="form-label" for="">Document Issuing
                                                                        Country</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ isset($studentData['identity_doc_country']) ? $studentData['identity_doc_country'] : '' }}"
                                                                        id="docissue" disabled>
                                                                </div>
                                                            </div>
            
                                                            @if (!empty($studentData['identity_doc_comments']) && $studentData['identity_is_approved'] === 'Reject')
                                                                <div class="mb-3 col-12 col-md-3">
                                                                    <label class="form-label" for="">Admin Remark</label>
                                                                    <input type="text" class="form-control" id="eduRemark"
                                                                        value="{{ isset($studentData['identity_doc_comments']) ? $studentData['identity_doc_comments'] : '' }}"
                                                                        disabled>
                                                                </div>
                                                            @endif
            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    @if (isset($studentData['identity_is_approved']) && $studentData['identity_is_approved'] === 'Pending')
                                                                        <h4 class="text-red blink-soft color-orange">(Pending for Admin
                                                                            Approval)</h4>
                                                                    @endif
                                                                    @if ($studentData['identity_is_approved'] != 'Approved')
                                                                        <h5 class="text-red ">
                                                                            <label class="form-label text-danger">Reminder: You have
                                                                                @if (isset($studentData['identity_trail_attempt']))
                                                                                    {{ $studentData['identity_trail_attempt'] }}
                                                                                @endif
                                                                                attempts remaining for identity proof verification.
                                                                            </label>
                                                                        </h5>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
            
            
                                                </div>
                                    </div>
                                    @php
                                    $edudocVerified = isset($studentData['edu_is_approved']) &&  $studentData['edu_is_approved'] == 'Approved' ? 'disabled' : '';
                                    @endphp
                                    <div class="border p-3 rounded-3 mb-2 accordion-item" id="headingTwo">
                                                <h3 class="mb-0 fs-4 student_education_details">
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between text-inherit active"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="{{ isset($studentData['identity_trail_attempt']) && ($studentData['identity_trail_attempt'] < 3 && $studentData['identity_doc_file'] != '' && $studentData['edu_doc_file'] == '' || $studentData['english_test_attempt'] == '0' && $studentData['edu_is_approved'] != 'Approved' ) ? 'true' : 'false' }}" style="{{ isset($edudocVerified) && $edudocVerified == 'disabled' ? 'pointer-events: none; ' : '' }}"
                                                        aria-controls="collapseTwo">
                                                        <label class=" verifiedStatus" style="cursor: pointer"><span class="stylenumber">2</span> Education Details<span
                                                                class="text-danger">*</span>
                                                            @if (isset($studentData['edu_is_approved']) && $studentData['edu_is_approved'] === 'Pending')
                                                                <small class="text-warning education_upload_status">(Pending for Admin Approval)</small>
                                                            @elseif ($studentData['edu_is_approved'] === 'Reject')
                                                                <small class="text-danger education_upload_status">(Rejected)</small>
                                                            @elseif ($studentData['edu_is_approved'] === 'Approved')
                                                                <small class="text-success education_upload_status">(Verified)</small>
                                                            @elseif ($studentData['edu_is_approved'] === 'Unverified')
                                                                <small class="text-danger education_upload_status">(Unverified)</small>
                                                            @endif
                                                        </label>
                                                        @if(isset($edudocVerified) && $edudocVerified == '')
                                                        <span class="collapse-toggle ms-4">
                                                            <i class="fe fe-chevron-down"></i>
                                                        </span>
                                                        @endif
                                                    </a>
                                                </h3>
            
                                                <div id="collapseTwo" class="collapse {{ isset($studentData['identity_trail_attempt']) && ($studentData['identity_trail_attempt'] < 3 &&  $studentData['identity_doc_file'] != '' && $studentData['edu_doc_file']  == '' || $studentData['english_test_attempt'] == '0'  && $studentData['edu_is_approved'] != 'Approved') ? 'show' : '' }}" aria-labelledby="headingTwo"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="pt-2">
                                                        @if (isset($studentData['edu_is_approved']) && $studentData['edu_is_approved'] != 'Approved')
                                                            <p class="mb-4">Enter your Higher Education Details</p>
                                                            <!-- Gender -->
                                                            <form class="eudDoc">
                                                                <div class="col-12 col-md-12">
                                                                    <div class="mb-4">
                                                                        <label class="form-label color-blue">Upload Highest Education
                                                                            Certificate</label>
                                                                        <p>Upload your highest education certificate for education
                                                                            verification.</p>
                                                                        <div class="input-group mb-1">
                                                                            @if (isset($studentData['edu_is_approved']) && $studentData['edu_is_approved'] === 'Approved')
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $studentData['edu_doc_file_name'] }}"
                                                                                    disabled>
                                                                            @elseif (isset($studentData['edu_is_approved']) &&
                                                                                    ($studentData['edu_is_approved'] === 'Pending' ||
                                                                                        ($studentData['edu_is_approved'] === 'Reject' && $studentData['edu_trail_attempt'] <= 0)))
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $studentData['edu_doc_file_name'] }}"
                                                                                    disabled>
                                                                            @else
                                                                                <input type="file"
                                                                                    class="form-control eduDocUpload"
                                                                                    data-doctype="{{ base64_encode('EDU') }}"
                                                                                    name="document">
                                                                                <input type="text" class="form-control eduDoc_type"
                                                                                    name="doc_type"
                                                                                    value="{{ base64_encode('EDU') }}" hidden>
                                                                            @endif
                                                                            <label class="input-group-text"
                                                                                for="eduDocUpload">Upload</label>
                                                                        </div>
                                                                        <small>(Documents must be in .pdf, .jpg, or .png format and
                                                                            should be less than 3MB in size.)</small>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endif
            
                                                        @php
                                                            $stueduDoc = 'd-none';
                                                            if (
                                                                $studentData['edu_is_approved'] === 'Pending' ||
                                                                ($studentData['edu_is_approved'] === 'Approved' &&
                                                                    $studentData['identity_is_deleted'] === 'No')
                                                            ) {
                                                                $stueduDoc = '';
                                                            }
                                                        @endphp
            
                                                        <div class="row eduDocDetails {{ $stueduDoc }}">
                                                            <div class="mb-3 col-12 col-md-8">
                                                                <label class="form-label" for="">Name of Institution or
                                                                    University</label>
                                                                <input type="text" class="form-control" id="institue_name"
                                                                    value="{{ isset($studentData['university_name_on_edu_doc']) ? htmlspecialchars_decode($studentData['university_name_on_edu_doc']) : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for="specilization">Specialization</label>
                                                                <input type="text" class="form-control" id="specilization"
                                                                    name="specilization"
                                                                    value="{{ isset($studentData['edu_specialization']) ? htmlspecialchars_decode($studentData['edu_specialization']) : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-8">
                                                                <label class="form-label" for="">Name of Course of
                                                                    Degree</label>
                                                                <input type="text" class="form-control" id="eduDocName"
                                                                    value="{{ isset($studentData['degree_course_name']) ? htmlspecialchars_decode(htmlspecialchars_decode($studentData['degree_course_name'])) : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for="">Document ID Number</label>
                                                                <input type="text" class="form-control" id="eduDocId"
                                                                    value="{{ isset($studentData['education_doc_number']) ? htmlspecialchars_decode($studentData['education_doc_number']) : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                                                <label class="form-label" for="">Name as per Document</label>
                                                                <input type="text" class="form-control" id="eduStudentName"
                                                                    value="{{ isset($studentData['name_on_education_doc']) ? $studentData['name_on_education_doc'] : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-6 col-lg-3">
                                                                <label class="form-label" for="">Year of Passing</label>
                                                                <input type="date" class="form-control" id="passsingYear"
                                                                    value="{{ isset($studentData['passing_year']) ? $studentData['passing_year'] : '' }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-6 col-lg-3">
                                                                <label class="form-label" for="">Remark</label>
                                                                <input type="text" class="form-control" id="eduRemark"
                                                                    value="{{ isset($studentData['remark_on_edu_doc']) ? $studentData['remark_on_edu_doc'] : '' }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
            
                                                        @if (!empty($studentData['comments_on_edu_doc']) && $studentData['edu_is_approved'] === 'Reject')
                                                            <div class="mb-3 col-12 col-md-3">
                                                                <label class="form-label" for="">Admin Remark</label>
                                                                <input type="text" class="form-control" id="eduRemark"
                                                                    value="{{ isset($studentData['comments_on_edu_doc']) ? $studentData['comments_on_edu_doc'] : '' }}"
                                                                    disabled>
                                                            </div>
                                                        @endif
            
                                                        @if (isset($studentData['edu_trail_attempt']) &&
                                                                $studentData['edu_trail_attempt'] < 3 &&
                                                                $studentData['edu_trail_attempt'] >= 0 &&
                                                                $studentData['edu_is_approved'] != 'Approved')
                                                            <div class="col-12 col-md-12">
                                                                <label class="form-label text-danger">Reminder: You have
                                                                    {{ isset($studentData['edu_trail_attempt']) ? $studentData['edu_trail_attempt'] : '0' }}
                                                                    attempts remaining for highest education verification.</label>
                                                            </div>
                                                        @endif
            
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if (isset($studentData['edu_is_approved']) && $studentData['edu_is_approved'] === 'Pending')
                                                                    <h4 class="text-red blink-soft color-orange">(Pending for Admin
                                                                        Approval)</h4>
                                                                @endif
                                                                <p>
                                                                    <strong>Important: </strong>The verification process may take up to
                                                                    1-2 days. You can check your verification status on the Document
                                                                    Verification page by logging back into the portal. We will also
                                                                    inform you of your document verification status via your registered
                                                                    email. <br>
                                                                    Thank you for your submission!
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    @php
                                    $resumeFile = isset($studentData['resume_file']) &&  $studentData['resume_file'] != '' ? 'disabled' : '';
                                    @endphp
                                    <div class="border p-3 rounded-3 mb-2 accordion-item" id="headingThree">
                                                <h3 class="mb-0 fs-4 student_resume">
                                                    <span class="d-flex position-relative align-items-center">
                                                    <a href="#" class="d-flex align-items-center justify-content-between text-inherit active mb-0"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="{{ isset($studentData['edu_doc_file_name']) && $studentData['resume_file_name'] == ''  ? 'true' : 'false' }}" aria-controls="collapseThree" style="{{ isset($resumeFile) && $resumeFile == 'disabled' ? 'pointer-events: none; ' : '' }}">
                                                        <span class="me-auto" style="cursor: pointer"> <span class="stylenumber">3</span> Latest Resume <span
                                                        class="text-danger">*</span>
                                                        @if (isset($studentData['resume_file']) && $studentData['resume_file'] != '')
                                                        <a href="{{ asset('storage/' . $studentData['resume_file']) }}"
                                                            class=" ms-2 resume resume-btn" style="cursor: pointer;"
                                                            download='My Resume'>Download Resume <i class="bi bi-download ms-2"></i></a>
                                                        @endif

                                                        </span>
                                                        @if(isset($resumeFile) && $resumeFile == '')
                                                        <span class="collapse-toggle ms-4" style="position: absolute; right: 0;">
                                                            <i class="fe fe-chevron-down" style="cursor: pointer"></i>
                                                        </span>
                                                        @endif 
                                                    </a>
                                                    </span>
                                                </h3>
                                        
                                                <div id="collapseThree" class="collapse {{ isset($studentData['edu_doc_file_name']) && $studentData['resume_file_name'] == ''   ? 'show' : '' }}" aria-labelledby="headingThree"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="pt-2">
                                                        <div class="mb-3">
                                                            <form class="resumeDoc">
                                                                <p>Upload your latest resume for skill verification.</p>
                                                                <div class="input-group mb-1">
                                                                    @if (isset($studentData['resume_file_name']) && $studentData['resume_file_name'])
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $studentData['resume_file_name'] }}" disabled>
                                                                    @else
                                                                        <input type="file" class="form-control idDoc"
                                                                            id="inputLogo" accept=".jpg,.png,.pdf"
                                                                            data-doctype="{{ base64_encode('RESUME') }}"
                                                                            name="document">
                                                                    @endif
                                                                    <label class="input-group-text">Upload</label>
                                                                    <input type="text" class="form-control" name="doc_type"
                                                                        value="{{ base64_encode('RESUME') }}" hidden>
                                                                </div>
                                                                <small>(Documents must be in .pdf, .jpg, or .png format and should be
                                                                    less than 3MB in size.)</small>
                                                            </form>
                                                        </div>
            
                                                        @if (isset($studentData['resume_file']))
                                                            <a href="{{ asset('storage/' . $studentData['resume_file']) }}"
                                                                class="resume @if (isset($studentData['resume_file']) && !empty($studentData['resume_file'])) {{ 'd-block' }} @else {{ 'd-none' }} @endif"
                                                                download='My Resume'> Click to Download your Last Resume</a>
                                                        @endif
                                                    </div>
                                                </div>
                                    </div>
                                    @php
                                    $englishTest = isset($studentData['english_test_attempt']) && ($studentData['english_test_attempt'] == 1 && $studentData['english_score'] >= '10') || $studentData['english_test_attempt'] == '0' ? 'disabled' : '';
                                    @endphp
                                    <div class="border p-3 rounded-3 mb-2 accordion-item" id="headingFour">
                                                <h3 class="mb-0 fs-4 student_english_test">
                                                    <a href="#" class="d-flex align-items-center text-inherit active"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded=" {{ isset($studentData['resume_file_name'])  && $studentData['english_test_attempt'] != '0' && $studentData['identity_doc_file'] != '' ? 'true' : 'false' }}" aria-controls="collapseFour" style="{{ isset($englishTest) && $englishTest == 'disabled' ? 'pointer-events: none; ' : '' }}">
                                                        <span class="me-auto" style="cursor: pointer"> <span class="stylenumber">4</span> English Test <span class="text-danger">*</span>
                                                            @if (is_exist('student_course_master',['user_id'=> Auth::user()->id]) > 0)
                                                                @if (is_exist('orders',['user_id'=>Auth::user()->id,'status'=>'0']) > 0)
                                                                    @php 
                                                                        $getPur  = getData('student_course_master',['purchased_on'],['user_id' => Auth::user()->id],'1','id','ASC');
                                                                        $purchaseDate = new DateTime($getPur[0]->purchased_on);
                                                                        $formattedPurchaseDate = $purchaseDate->format('Y-m-d H:i:s');
                                                                        $datePlus14Days = clone $purchaseDate;
                                                                        $datePlus14Days->modify('+14 days');
                                                                        $formattedDatePlus14Days = $datePlus14Days->format('Y-m-d H:i:s');
                                                                        $today = new DateTime();
                                                                        $formattedToday = $today->format('Y-m-d H:i:s');
                                                                        $english_score = $studentData['english_score'];
                                                                        $english_level = $studentData['english_level_view'];
                                                                        $english_test_submitted_on = $studentData['english_test_submitted_on'];
                                                                        $english_test_attempt = $studentData['english_test_attempt'];
                                                                        if($english_score < 10){
                                                                            $english_text = "Fail";
                                                                        }else if($english_score >= 10){
                                                                            $english_text = "Pass";
                                                                        }else{
                                                                            $english_text = "Fail";
                                                                        } 
                                                                    @endphp
                                    
                                                                    @if($formattedToday <= $formattedDatePlus14Days)
                                                                    
                                                                        @if(($english_test_attempt == 1 && $english_text == 'Pass') || $english_test_attempt == 0)
                                                                            {{-- <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default; padding:6px 12px; white-space:nowrap;">English Test : {{$english_text}}/{{$english_score}}  </button> --}}
                                                                            
                                                                            @if(Auth::user()->passed_via_english_code == '1')
                                                                                <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default;padding:6px 12px;white-space:nowrap">English Test: {{$english_text}}  </button>
                                                                            @else
                                                                                <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default;padding:6px 12px;white-space:nowrap">English Test: {{$english_text}}/{{$english_score}}  </button>
                                                                            @endif
                                                                        @else
                                                                            @if(($english_test_attempt == 1 && $english_text == 'Fail'))
                                                                                <p class="ms-2 mt-3 mt-md-0 badge text-bg-danger">English Test First Attempt : {{$english_text}}/{{$english_score}}  </p>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if(($english_test_attempt == 1 && $english_text == 'Pass') || $english_test_attempt == 0)
                                                                            <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default;padding:6px 12px;white-space:nowrap">English Test: {{$english_text}}/{{$english_score}}  </button>
                                                                        @else
                                                                            @if(($english_test_attempt == 1 && $english_text == 'Fail'))
                                                                                <p class="ms-2 mt-3 mt-md-0 badge text-bg-danger">English Test First Attempt : {{$english_text}}/{{$english_score}}  </p>
                                                                            @endif
                                                                        @endif
                                                                        
                                                                    @endif
                                                                @endif
                                                            @else
                                                                {{-- @if(Auth::user()->apply_dba == 'Yes') --}}
                                                                    @php  
                                                                        $english_score = $studentData['english_score'];
                                                                        $english_level = $studentData['english_level_view'];
                                                                        $english_test_submitted_on = $studentData['english_test_submitted_on'];
                                                                        $english_test_attempt = $studentData['english_test_attempt'];
                                                                        if($english_score < 10){
                                                                            $english_text = "Fail";
                                                                        }else if($english_score >= 10){
                                                                            $english_text = "Pass";
                                                                        }else{
                                                                            $english_text = "Fail";
                                                                        } 
                                                                    @endphp 
                                                                    @if(($english_test_attempt == 1 && $english_text == 'Pass') || $english_test_attempt == 0)
                                                                        @if(Auth::user()->passed_via_english_code == '1')
                                                                            <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default;padding:6px 12px;white-space:nowrap">English Test: {{$english_text}}  </button>
                                                                        @else
                                                                            <button type="button" class="btn btn-primary mt-2 mt-sm-0 ms-2 english_test_btn" style="cursor: default;padding:6px 12px;white-space:nowrap">English Test: {{$english_text}}/{{$english_score}}  </button>
                                                                        @endif
                                                                    @else
                                                                        @if(($english_test_attempt == 1 && $english_text == 'Fail'))
                                                                            <p class="ms-2 mt-3 mt-md-0 badge text-bg-danger">English Test First Attempt : {{$english_text}}/{{$english_score}}  </p>
                                                                        @endif
                                                                    @endif
                                                                {{-- @endif --}}
                                                            @endif
                                                        {{-- @endif --}}

                                                        </span>
                                                        @if(isset($englishTest) && $englishTest == '')
                                                        <span class="collapse-toggle ms-4">
                                                            <i class="fe fe-chevron-down"></i>
                                                        </span>
                                                        @endif
                                                    </a>
                                                </h3>
            
                                                <div id="collapseFour" class="collapse {{ isset($studentData['resume_file_name'])  && $studentData['english_test_attempt'] != 0 && $studentData['identity_doc_file'] != '' ? 'show' : '' }}" aria-labelledby="headingFour"
                                                    data-bs-parent="#accordionExample" style="{{ isset($englishTest) && $englishTest == 'disabled' ? 'display: none; ' : '' }}" >
                                                    <div class="pt-2">
                                                            @if (is_exist('student_course_master',['user_id'=> Auth::user()->id]) > 0)
                                                                @if (is_exist('orders',['user_id'=>Auth::user()->id,'status'=>'0']) > 0)
                                                                    @php 
                                                                        $getPur  = getData('student_course_master',['purchased_on'],['user_id' => Auth::user()->id],'1','id','ASC');
                                                                        $purchaseDate = new DateTime($getPur[0]->purchased_on);
                                                                        $formattedPurchaseDate = $purchaseDate->format('Y-m-d H:i:s');
                                                                        $datePlus14Days = clone $purchaseDate;
                                                                        $datePlus14Days->modify('+14 days');
                                                                        $formattedDatePlus14Days = $datePlus14Days->format('Y-m-d H:i:s');
                                                                        $today = new DateTime();
                                                                        $formattedToday = $today->format('Y-m-d H:i:s');
                                                                        $english_score = $studentData['english_score'];
                                                                        $english_level = $studentData['english_level_view'];
                                                                        $english_test_submitted_on = $studentData['english_test_submitted_on'];
                                                                        $english_test_attempt = $studentData['english_test_attempt'];
                                                                        if($english_score < 10){
                                                                            $english_text = "Fail";
                                                                        }else if($english_score >= 10){
                                                                            $english_text = "Pass";
                                                                        }else{
                                                                            $english_text = "Fail";
                                                                        } 
                                                                    @endphp
                                    
                                                                    @if($formattedToday <= $formattedDatePlus14Days)
                                                                        @if(($english_test_attempt == 1 && $english_text == 'Pass') || $english_test_attempt == 0)
                                                                            <button type="button" class="btn btn-primary ms-2" style="cursor: default">English Test : {{$english_text}}/{{$english_score}}  </button>
                                                                        @else
                                                                            {{-- @if(($english_test_attempt == 1 && $english_text == 'Fail'))
                                                                                <p class="ms-2 mt-3 mt-md-0 text-danger">English Test First Attempt : {{$english_text}}/{{$english_score}}  </p>
                                                                            @endif --}}
                                                                            {{-- <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div> --}}
                                                                            @if(Auth::user()->university_code != '')
                                                                                <form id="englishTestForm">
                                                                                    @csrf
                                                                                    <div>
                                                                                        <label for="englist_test_pass_code">University English Test Code</label>
                                                                                        <input type="text" name="englist_test_pass_code" id="englist_test_pass_code" placeholder="Enter 6-digit Code" class="form-control" maxlength="6" inputmode="numeric">
                                                                                        <span id="englist_test_pass_code_error" class="text-danger" style="display: none;"></span>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                                                                </form>
                                                                                Or
                                                                                <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>

                                                                            @else
                                                                                <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if(($english_test_attempt == 1 && $english_text == 'Pass') || $english_test_attempt == 0)
                                                                            <button type="button" class="btn btn-primary ms-2" style="cursor: default">English Test: {{$english_text}}/{{$english_score}}  </button>
                                                                        @else
                                                                            {{-- <p class="ms-2 mt-3 mt-md-0 text-danger">English Test First Attempt : {{$english_text}}/{{$english_level}}  </p> --}}
                                                                            {{-- <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div> --}}
                                                                            
                                                                            @if(Auth::user()->university_code != '')
                                                                                <form id="englishTestForm">
                                                                                    @csrf
                                                                                    <div>
                                                                                        <label for="englist_test_pass_code">University English Test Code</label>
                                                                                        <input type="text" name="englist_test_pass_code" id="englist_test_pass_code" placeholder="Enter 6-digit Code" class="form-control" maxlength="6" inputmode="numeric">
                                                                                        <span id="englist_test_pass_code_error" class="text-danger" style="display: none;"></span>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                                                                </form>
                                                                                Or
                                                                                <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>
                                                                            @else
                                                                                <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>
                                                                            @endif
                                                                        @endif
                                                                    @endif 
                                
                                                                @endif
                                                            @else
                                                                @if(Auth::user()->university_code != '')
                                                                    <form id="englishTestForm">
                                                                        @csrf
                                                                        <div>
                                                                            <label for="englist_test_pass_code">University English Test Code</label>
                                                                            <input type="text" name="englist_test_pass_code" id="englist_test_pass_code" placeholder="Enter 6-digit Code" class="form-control" maxlength="6" inputmode="numeric">
                                                                            <span id="englist_test_pass_code_error" class="text-danger" style="display: none;"></span>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                                                    </form>
                                                                    Or
                                                                    <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>
                                                                @else
                                                                    <div><a href="{{ route('english-test') }}"><button type="button" class="btn btn-primary ms-2">Start English Test </button></a></div>
                                                                @endif
                                                            @endif
                                                    </div>
                                                </div>
                                    </div>
                                    {{-- @if($studentData['user']['apply_dba'] == 'Yes') --}}
                                    @php
                                        $researchFile = isset($studentData['research_proposal_file']) &&  $studentData['research_proposal_file'] != '' ? 'disabled' : '';
                                        $reseachVerified = isset($studentData['proposal_is_approved']) &&  $studentData['proposal_is_approved'] == 'Approved' &&  $studentData['proposal_is_approved'] == 'Approved'? 'disabled' : '';
                                    @endphp
                                  {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            $("#englist_test_pass_code").on("input", function() {
                this.value = this.value.replace(/\D/g, "").slice(0, 6); // Allow only numbers & limit to 6 digits
            });
        });


    //        document.addEventListener('DOMContentLoaded', function () {
    //         const accordions = document.querySelectorAll('.accordion-item a');

    //         accordions.forEach(accordion => {
    //             accordion.addEventListener('click', function () {
    //                 event.preventDefault();
    //                 const parentAccordion = this.closest('.accordion-item');
    //                 const isActive = parentAccordion.classList.contains('active');

    //                 document.querySelectorAll('.accordion-item').forEach(item => {
    //                     item.classList.remove('active');
    //                     item.querySelector('.stylenumber').classList.remove('active');
    //                 });

    //                 if (!isActive) {
    //                     parentAccordion.classList.add('active');
    //                     parentAccordion.querySelector('.stylenumber').classList.add('active');
    //                 }
    //             });
    //         });
    // });
    </script>
@endsection
