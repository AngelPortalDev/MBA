@extends('frontend.master')
@section('content')
    <style>
        .terms_and_condition_dialog{
            margin: 1.75rem auto;
            border-radius: 15px;
        }
        .terms_and_condition_body ul li{
            font-size: 13px;
        }
        
        /* Container Styles */
        .filepond--drop-label {
            color: #4c4e53;
            background: #f9fafb;
            border-style: dashed;
            border-color: #2b3990;
            border-width: 2px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 12em !important;
            text-align: center;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }

        /* Hover effect */
        .filepond--drop-label:hover {
            background-color: #e6f7ff;
            border-color: #4c90d1;
            cursor: pointer;
        }

        .filepond--drop-label i {
            font-size: 4rem;
            color: #2b3990;
            margin-bottom: 1rem;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .filepond--drop-label span {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
            line-height: 1.5;
            max-width: 300px;
            margin: 0 auto;
            cursor: pointer;
        }

        .filepond--drop-label:hover i {
            transform: scale(1.2);
        }

        .filepond--panel-root {
            border-radius: 15px;
            height: 1em;
        }

        .filepond--credits {
            display: none !important;
        }

        .filepond--label-action {
            display: block;
            text-decoration-color: #babdc0;
        }

        .filepond--list {
            margin-top: 1em !important;
        }

        .filepond--list.filepond--list {
            position: absolute !important;
            top: -6px !important;
            padding: 0 !important;
            list-style-type: none !important;
            will-change: transform !important;
        }

        .document-wrapper {
            position: relative;
            width: 400px;
            height: 200px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border:2px solid;
            border-style:dashed;
            margin-top: 20px;
        }
        .signature-pad1 {
            position: absolute;
            left: 0;
            top: 0;
            width:400px;
            height:200px;
        }

        #save, #clear {
             display: none;
        }
        #warning-message{
            font-style: italic !important;
        }

        .terms_and_condition_dialog .modal-body::-webkit-scrollbar {
            width: 9px; 
        }
        .terms_and_condition_dialog .modal-body::-webkit-scrollbar-track {
            background-color: transparent; 
        }

        /* Style the scrollbar thumb */
        .terms_and_condition_dialog .modal-body::-webkit-scrollbar-thumb {
            background-color: #888; 
            border-radius: 5%;
        }
        
    </style>

    <section class="pt-1 pb-4 bg-white">

        <div class="container text-center my-4">
            <!-- Heading Section -->
            <p class="lead mb-4 bg-primary p-3 rounded-3 text-white">
                <span class="text-uppercase fw-semibold text-light" style="letter-spacing: 1px;">
                    Welcome to the <span class="fw-bolder color-green">e-Mentor</span> Program!
                </span>
            </p>
        
            <!-- Introduction Text -->
            <p class="fs-5 mb-5 text-muted">
                Complete your orientation by uploading the required documents below. Please ensure that your submissions are accurate and follow the guidelines outlined.
            </p>
        
            <!-- Upload Instructions & Document List -->
            <div class="row justify-content-center g-4">
                <!-- Upload Instructions -->
                <div class="col-lg-5">
                    <div class="upload-instruction bg-white rounded-4 shadow-lg p-3">
                        <h3 class="text-primary fw-bold mb-3">Upload Instructions</h3>
                        <ul class="list-unstyled fs-5 text-start">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle text-success me-3"></i>
                                <span>Select documents in <strong>.JPG, .PNG, or .PDF</strong> format.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle text-success me-3"></i>
                                <span>Ensure the file size is <strong>less than 2MB</strong>.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle text-success me-3"></i>
                                <span>Upload the following required documents:</span>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <!-- Documents List -->
                <div class="col-lg-5">
                    <div class="doc-upload bg-white rounded-4 shadow-lg p-3">
                        <h3 class="text-primary fw-bold mb-3">Documents to Upload</h3>
                        <ul class="list-group fs-5 text-start">
                            <li class="list-group-item bg-light border-0 rounded-3 mb-3 shadow-sm">
                                <i class="bi bi-file-earmark-person text-primary me-3"></i><strong>ID or Passport <span
                                    class="text-danger">*</span></strong>
                            </li>
                            <li class="list-group-item bg-light border-0 rounded-3 mb-3 shadow-sm">
                                <i class="bi bi-file-earmark-text text-primary me-3"></i><strong>Curriculum Vitae (CV) <span
                                    class="text-danger">*</span></strong>
                            </li>
                            <li class="list-group-item bg-light border-0 rounded-3 mb-3 shadow-sm">
                                <i class="bi bi-award text-primary me-3"></i><strong>Highest Qualification Certificate <span
                                    class="text-danger">*</span></strong>
                            </li>
                            <li class="list-group-item bg-light border-0 rounded-3 mb-3 shadow-sm">
                                <i class="bi bi-shield-lock text-primary me-3"></i><strong>Police Conduct Certificate <span
                                    class="text-danger">*</span></strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        
            <!-- Confirmation Message -->
            <p class="fs-5 text-muted mt-4">
                Ensure all files are clear, legible, and scanned properly before uploading. If you need assistance or have any questions, feel free to contact us. Thank you for your cooperation! 😊
            </p>
        </div>

        @php
            $isSubmitted = false;
            
            $exists = is_exist('subementor_documents', ['sub_ementor_id' => Auth::user()->id]);

            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {
                $isSubmitted = true;
            }
        @endphp
        
        @if($isSubmitted == false)
            <div class="container">
                <div class="file_upload_container w-100 w-md-30 mx-auto">
                    <!-- FilePond Input with custom label -->
                    <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-files="4" data-label-id="custom-drop-label">
                </div>
                <div class="w-100 w-md-30 d-flex justify-content-end mx-auto mt-4">
                    {{-- <button class="btn btn-secondary d-none">Previous</button> --}}
                    {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openModal">Next</button> --}}
                    <button class="btn btn-primary" id="nextButton" style="display: none;" data-bs-toggle="modal" data-bs-target="#openModal">Next</button>
                </div>

            </div>


            <div class="modal fade " id="openModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable terms_and_condition_dialog rounded-lg">
                    <div class="modal-content border-0 rounded-md">
                        <div class="modal-header justify-content-center bg-blue text-uppercase" style="letter-spacing: 5px">
                            <h5 class="modal-title text-white text-center fs-3" id="exampleModalLabel">Terms of Service</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body terms_and_condition_body">
                            <h2>Terms and Conditions ("Terms")</h2>
                            <p>Please read these terms and conditions carefully before using Our Service.</p>
                            <h3>Acknowledgment</h3>
                            <p>These are the Terms and Conditions governing the use of this Service and the agreement that
                                operates
                                between You and the Company. These Terms and Conditions set out the rights and obligations of
                                all users
                                regarding the use of the Service.
                            </p>
                            <p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with
                                these
                                Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who
                                access or
                                use the Service.
                            </p>
                            <p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You
                                disagree
                                with any part of these Terms and Conditions then You may not access the Service.
                            </p>
                            <p>You represent that you are over the age of 18. The Company does not permit those under 18 to use
                                the
                                Service.
                            </p>
                            <p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance
                                with the
                                Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the
                                collection,
                                use and disclosure of Your personal information when You use the Application or the Website and
                                tells You
                                about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully
                                before
                                using Our Service.
                            </p>
                            <h3>User Accounts</h3>
                            <p>When You create an account with Us, You must provide Us information that is accurate, complete,
                                and
                                current at all times. Failure to do so constitutes a breach of the Terms, which may result in
                                immediate
                                termination of Your account on Our Service.
                            </p>
                            <p>You are responsible for safeguarding the password that You use to access the Service and for any
                                activities
                                or actions under Your password, whether Your password is with Our Service or a Third-Party
                                Social Media
                                Service.
                            </p>
                            <p>You agree not to disclose Your password to any third party. You must notify Us immediately upon
                                becoming
                                aware of any breach of security or unauthorized use of Your account.
                            </p>
                            <P>
                                You may not use as a username the name of another person or entity or that is not lawfully
                                available for
                                use, a name or trademark that is subject to any rights of another person or entity other than
                                You without
                                appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.
                            </P>
                            <h3>Content Restrictions</h3>
                            <P>The Company is not responsible for the content of the Service's users. You expressly understand
                                and
                                agree that You are solely responsible for the Content and for all activity that occurs under
                                your account,
                                whether done so by You or any third person using Your account.
                            </P>
                            <P>You may not transmit any Content that is unlawful, offensive, upsetting, intended to disgust,
                                threatening,
                                libelous, defamatory, obscene or otherwise objectionable. Examples of such objectionable Content
                                include,
                                but are not limited to, the following:
                            </P>
                            <ul>
                                <li>Unlawful or promoting unlawful activity</li>
                                <li>Defamatory, discriminatory, or mean-spirited content, including references or commentary
                                    about
                                    religion, race, sexual orientation, gender, national/ethnic origin, or other targeted
                                    groups.
                                </li>
                                <li>Spam, machine – or randomly – generated, constituting unauthorized or unsolicited
                                    advertising,
                                    chain letters, any other form of unauthorized solicitation, or any form of lottery or
                                    gambling.</li>
                                <li>Containing or installing any viruses, worms, malware, trojan horses, or other content that
                                    is
                                    designed or intended to disrupt, damage, or limit the functioning of any software, hardware
                                    or
                                    telecommunications equipment or to damage or obtain unauthorized access to any data or other
                                    information of a third person.
                                </li>
                                <li>Infringing on any proprietary rights of any party, including patent, trademark, trade
                                    secret, copyright,
                                    right of publicity or other rights.
                                </li>
                                <li>Impersonating any person or entity including the Company and its employees or
                                    representatives</li>
                                <li>Violating the privacy of any third person.</li>
                            </ul>
                            <h3>Your Right to Post Content</h3>
                            <p>These are the Terms and Conditions governing the use of this Service and the agreement that
                                operates
                                between You and the Company. These Terms and Conditions set out the rights and obligations
                                of all users
                                regarding the use of the Service.
                            </p>
                            <p>Your access to and use of the Service is conditioned on Your acceptance of and compliance
                                with these
                                Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who
                                access or
                                use the Service.
                            </p>
                            <p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You
                                disagree
                                with any part of these Terms and Conditions then You may not access the Service.
                            </p>
                            <p>You represent that you are over the age of 18. The Company does not permit those under 18 to
                                use the
                                Service.
                            </p>
                            <p>Your access to and use of the Service is also conditioned on Your acceptance of and
                                compliance with the
                                Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on
                                the collection,
                                use and disclosure of Your personal information when You use the Application or the Website
                                and tells You
                                about Your privacy rights and how the law protects You. Please read Our Privacy Policy
                                carefully before
                                using Our Service.
                            </p>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="tnc" id="agreeCheck" required >
                                <label class="form-check-label" for="agreeCheck">
                                    <span class="fw-semibold">
                                        I reviewed and accept the
                                        above terms of service and privacy policy.
                                    </span>
                                </label>
                            </div>

                            <div class="document-wrapper" style="display: none">
                                <canvas id="signature-pad" class="signature-pad1" width=400 height=200></canvas>
                            </div>
                            <small id="placeholder_message" style="display: none">Please write your signature here.</small>
                            <p id="warning-message" class="text-danger mt-2 font-italic" style="display: none">Please write your signature.</p>

                            <div class="mt-2">
                                <button id="save" class="btn btn-primary">Submit</button>
                                <button id="clear" class="btn btn-outline-primary">Clear</button>
                            </div>
                        </div>

                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endif


    </section>

    <!-- FilePond CSS -->

    <link href="{{ asset('frontend/libs/filepond/filepond-plugin-image-preview.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('frontend/libs/filepond/filepond.min.css')}}" rel="stylesheet" /> 

    <!-- FilePond JS and Plugins -->

    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-encode.min.js')}}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-exif-orientation.min.js')}}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-size@2.2.8/dist/filepond-plugin-file-validate-size.min.js"></script>

    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond.min.js')}}"></script>

    <script src="{{ asset('frontend/js/vendors/signature_pad.umd.min.js')}}"></script>


    {{-- <script>
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateType,
            // FilePondPluginImagePreview
        );

        // const pond = FilePond.create(
        //     document.querySelector('input[type="file"]')
        // );

        const pond = FilePond.create(
            document.querySelector('input[type="file"]'), {
                maxFileSize: '2MB',   
                maxFiles: 4,          
                allowReorder: true,   
                acceptedFileTypes: ['application/pdf', 'image/jpeg', 'image/png'], 
            }
        );

        pond.setOptions({
            labelIdle: `
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-cloud-arrow-up mb-2 fs-1"></i>
                    <span>Drag & drop to upload your files <br/>or <br/>click to browse</span>
                </div>
            `,
            // Accept only PDF, JPG, and PNG files
        acceptedFileTypes: ['application/pdf', 'image/jpeg', 'image/png'],
        maxFileSize: '2MB', 
        });


        let selectcheckbox = document.querySelector('input[type="checkbox"]');
        let selectdoc = document.querySelector('.document-wrapper');  
        var saveButton = document.querySelector('#save');
        var clearButton = document.querySelector('#clear');
        var warningmessage = document.querySelector('#warning-message');

        saveButton.style.display = 'none';
        clearButton.style.display = 'none';

        selectcheckbox.addEventListener('change', () => {
            if (selectcheckbox.checked) {
                selectdoc.style.display = 'block';
                saveButton.style.display = 'inline-block';
                clearButton.style.display = 'inline-block';
            }else{
                selectdoc.style.display = 'none';
                saveButton.style.display = 'none';
                clearButton.style.display = 'none';
                warningmessage.style.display = 'none';
            }
        })
        

        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });

        saveButton.addEventListener('click',function(){
            if(signaturePad.isEmpty()){
                warningmessage.style.display = 'block';
            }else{
                signaturePad.clear();
                warningmessage.style.display = 'none';
                alert("Thank you...")
            }
        })

        clearButton.addEventListener('click', () =>{
            signaturePad.clear();
            warningmessage.style.display = 'none';
        })
       
    </script> --}}

    <script>
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );
    
        const pond = FilePond.create(
            document.querySelector('input[type="file"]'), {
                maxFileSize: '2MB',   
                maxFiles: 4,          
                allowReorder: true,   
                acceptedFileTypes: ['application/pdf', 'image/jpeg', 'image/png'], 
            }
        );
        pond.setOptions({
            labelIdle: `
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-cloud-arrow-up mb-2 fs-1"></i>
                    <span>Drag & drop to upload your files <br/>or <br/>click to browse</span>
                </div>
            `,
            acceptedFileTypes: ['application/pdf', 'image/jpeg', 'image/png'],
            maxFileSize: '2MB',
            maxFiles: 4
        });
    
        const nextButton = document.querySelector('#nextButton');
        nextButton.style.display = 'none';

        const updateNextButtonVisibility = () => {
            const allFilesWithinSizeLimit = pond.getFiles().length === 4 && pond.getFiles().every(fileItem => fileItem.file.size <= 2 * 1024 * 1024);

            nextButton.style.display = allFilesWithinSizeLimit ? 'inline-block' : 'none';
        };
    
        pond.on('addfile', updateNextButtonVisibility);
        pond.on('removefile', updateNextButtonVisibility);
    
        nextButton.addEventListener('click', () => {
            const uploadedFiles = pond.getFiles().map(fileItem => fileItem.file);
        });
    
        const selectcheckbox = document.querySelector('input[type="checkbox"]');
        const selectdoc = document.querySelector('.document-wrapper');  
        const saveButton = document.querySelector('#save');
        const clearButton = document.querySelector('#clear');
        const warningmessage = document.querySelector('#warning-message');
        const placeholdermessage = document.querySelector('#placeholder_message');
    
        selectdoc.style.display = 'none';
        saveButton.style.display = 'none';
        clearButton.style.display = 'none';
        warningmessage.style.display = 'none';
        placeholdermessage.style.display = 'none';
    
        selectcheckbox.addEventListener('change', () => {
            const isChecked = selectcheckbox.checked;
            selectdoc.style.display = isChecked ? 'block' : 'none';
            saveButton.style.display = isChecked ? 'inline-block' : 'none';
            clearButton.style.display = isChecked ? 'inline-block' : 'none';
            placeholdermessage.style.display = isChecked ? 'inline-block' : 'none';
            if (!isChecked) warningmessage.style.display = 'none';
        });
    
        const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
    
        saveButton.addEventListener('click', function() {
            if (signaturePad.isEmpty()) {
                warningmessage.style.display = 'block';
                placeholdermessage.style.display = 'none'; 
            }
        });
    
        clearButton.addEventListener('click', () => {
            signaturePad.clear();
            warningmessage.style.display = 'none';
            placeholdermessage.style.display = 'block';
        });

        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        const baseUrl = window.location.origin;

        async function getFileBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = function() {
                    resolve(reader.result);
                };
                reader.onerror = function() {
                    reject(new Error("Error reading file"));
                };
                reader.readAsDataURL(file);
            });
        }

        async function submitFilesAndSignature() {
            const formData = new FormData();
            const documentFiles = pond.getFiles();

            try {
                for (let i = 0; i < documentFiles.length; i++) {
                    const base64File = await getFileBase64(documentFiles[i].file);
                    formData.append(`files_${i + 1}`, base64File);
                }

                const signatureData = signaturePad.toDataURL('image/png');
                formData.append("signature", signatureData);

                formData.append("_token", csrfToken);
                formData.append("terms_accepted", selectcheckbox.checked);
                swal({
                    title: 'Are you sure?',
                    text: "You are about to submit your document. Do you want to proceed?",
                    icon: 'warning',
                    buttons: ['Cancel', 'Yes, Submit!'],
                    dangerMode: true
                }).then((willSubmit) => {
                    if (willSubmit) {
                        $.ajax({
                            url: baseUrl + "/upload-subementor-document",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                
                                swal({
                                    title: response.title,
                                    text: response.message,
                                    icon: response.icon,
                                }).then(function () {
                                    // window.location.href = response.redirect;
                                    window.location.assign(response.redirect);
                                });
                            },
                            error: function(response) {
                                swal({
                                    title: response.title,
                                    text: response.message,
                                    icon: response.icon,
                                })
                            }
                        });
                    } else {
                        swal({
                            title: 'Cancelled',
                            text: 'Your submission was cancelled',
                            icon: 'info',
                        })
                    }
                });

            } catch (error) {
                console.error("Error processing files:", error);
            }
        }

        
        saveButton.addEventListener('click', function() {
            if (signaturePad.isEmpty()) {
                warningmessage.style.display = 'block';
            } else {
                warningmessage.style.display = 'none';
                submitFilesAndSignature(); 
            }
        });
    </script>
    
    
    
@endsection
