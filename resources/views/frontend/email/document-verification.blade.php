<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ascencia: Online Learning Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Tahoma !important;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            /* text-align: center; */
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            border: 1px solid #ddd;
        }


        .logo-1 {
            width: auto;
            height: 40px;
        }

        p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            padding: 7px 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .footer {
            margin-top: 10px;
            color: #777;
        }
        .social-logo{
            width: 26px;
        }
        .text-color{
            color: #212529 !important
        }
        .subject{
            font-size: 24px !important
        }
        @media only screen and (max-width: 600px) {
        .assignmentSubmitIcon {
            width: 100% !important;
        }
        .subject{
            font-size: 1.25rem !important;
        }
}
    </style>
</head>
<body>
    <div class="container" style="font-family: Tahoma;"> 
            <div class="row align-items-center justify-content-center">
                <div style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                    <img src="https://www.eascencia.mt/frontend/images/brand/logo/logo_final.png" alt="E-Ascencia Logo" class="logo-1" style="height: 40px; width: auto;">
                </div>
                <div style="text-align: center;">
                    <p style="font-weight: 700;color: #2b3990 " class="mb-3 subject">
                        Submit Your Documents for Verification Process 
                    </p>
                        <img class="p-3 assignmentSubmitIcon" src="https://www.eascencia.mt/frontend/images/email/document-submit.png" alt="E-Ascencia" style="width:85%; padding:10px">

                    </div>

                    <div class="col-md-12 ps-md-4 my-md-4 border-md-start">
                        

                     
                
                        <p class="text-color"> Dear #Name#, <br></p>
                        <p class="text-color">I hope this message finds you well.</strong> </p>
                        <p class="text-color"><strong> We noticed that you have not yet uploaded and verified your documents.</strong> Document verification is required to complete your enrollment and receive certification. </p>
                        <p style="color: #000; font-weight: bold">List of Required documents:</p>
                        <ol>
                            <li style="font-size: 15px; font-weight: bold">Proof of Identity</li>
                            <li style="font-size: 15px; font-weight: bold">Proof of Education</li>
                            <li style="font-size: 15px; font-weight: bold">Resume</li>
                        </ol>

                        <p style="margin-bottom: 16px">Please upload your documents for verification using the button below:</p>
                        <a href="#Link#" style="background:#2b3990; color:#DAE137; border-radius:4px; padding:8px 16px;font-weight: bold; font-size:14px;text-decoration: none">Upload Your Documents</a>
                       
                        <p style="margin-top: 16px">If the button above isn’t working, please follow these steps for document verification:</p>
                        <ol>
                            <li style="font-size: 15px; font-weight: bold">Visit <a href="https://www.eascencia.mt/" target="_blank">eascencia.mt</a></li>
                            <li style="font-size: 15px; font-weight: bold">Log in to your profile</li>
                            <li style="font-size: 15px; font-weight: bold">Go to "Profile Picture"</li>
                            <li style="font-size: 15px; font-weight: bold">Click on "Profile"</li>
                            <li style="font-size: 15px; font-weight: bold">Click on "Document Verification" to upload your documents.</li>

                        </ol>
                            <p class="text-color">If you have any questions or face difficulties during the document verification process, feel free to reach out to us at <strong><a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt</a></strong> <br> </p>
                            <p class="text-color">Thank you for your prompt attention to this matter.</p>
                            
                            <p class="mb-3 text-color">Best regards, <br>
                            <strong>The E-Ascencia Team</strong></p>
                            
                        

                            <a href="https://www.facebook.com/people/E-Ascencia-Malta/61559646792486/" target="_blank"><img class="social-logo mb-2 "
                                src="https://www.eascencia.mt/frontend/images/social/social-media-01.png" alt="social logo"></a>
                            <a href="https://www.instagram.com/eascencia/" target="_blank"><img class="social-logo mb-2 "
                                    src="https://www.eascencia.mt/frontend/images/social/social-media-02.png" alt="social logo"></a>
                          
                            <div class="footer" style="margin-top: 10px !important">
                                <p class="text-color">
                                    If you no longer wish to receive emails, <a href="#unsubscribeRoute#" target="_blank" class="text-decoration-none">click here to unsubscribe</a>.
                                </p>
                            </div>

                    </div>
            </div>
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
