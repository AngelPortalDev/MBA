<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ascencia: Online Learning Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://www.eascencia.mt/frontend/css/theme.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Rakkas&display=swap'); */
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
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            border: 1px solid #ddd;
        }

        .logo {
            width: 120px;
        }
        .logo-1 {
            width: auto;
            height: 40px;
        }

        p {
            font-size: 14px;
            margin-bottom: 10px;
            /* font-family: verdana; */
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
    </style>
</head>
<body>
    <div class="container" style="font-family: Tahoma;">
            <div class="row align-items-center justify-content-center">

                <!-- <div class="col-md-12 text-center border-bottom pb-2 mb-4">
                    <img class="logo-1 mb-2" src="https://www.eascencia.mt/frontend/images/brand/logo/logo.png" alt="E-Ascencia Logo" style="width: 135px; margin-bottom: 10px;">
                </div> -->
                <div style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                    <img src="https://www.eascencia.mt/frontend/images/brand/logo/logo_final.png" alt="E-Ascencia Logo" class="logo-1" style="height: 40px; width: auto;">
                </div>

                <div style="text-align: center;">
                    <h2 style="font-weight: 700;font-size: 28px; " class="my-2 text-color">&#127881; Welcome to 
                        <span style="color: #2b3990;"> E-Ascencia </span> Web Portal! &#127881;
                    </h2>
    
                </div>

                    <div style="text-align: center;">

                        <img class="p-2 " src="https://www.eascencia.mt/frontend/images/email/registration-successful_1.png" alt="E-Ascencia" style="width:50%; padding:10px">

                    </div>

                    <div class="col-md-12 ps-md-4 my-md-4 border-md-start pt-1">

                                       
                        <p class="text-color"> Dear #Name#, </p>
                        <p class="text-color"><strong style="color: #2b3990;"> Welcome to the E-Ascencia Web Portal!</strong> We are thrilled to have you join our online learning community. </p>
                        <p class="text-color"> <strong>Your login credentials are:</strong></p>
                            
                            <p style="font-size: 15px;color: #2b3990;"> <strong>Username: #Username#  </strong></p>
                                
                            <!-- <a href="https://www.eascencia.mt" class="button my-2" target="_blank" style="background-color: #2b3990;color: #DAE137;font-weight: 600;">Start Learning</a> -->
                            
                        <p class="text-color"> To access your account, simply visit <a href="https://www.eascencia.mt/" target="_blank"><strong>https://www.eascencia.mt </strong></a> and log in using the above credentials. </p>
                        <p class="text-color">If you have any questions or need assistance, feel free to reach out to us at  <strong><a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt</a></strong> or through our live chat support. </p>

                            <p class="text-color"><strong>Happy learning!</strong> </p>
                            <p class="text-color">Best regards,<br> <strong>The E-Ascencia Team </strong></p>

                            <a href="https://www.facebook.com/people/E-Ascencia-Malta/61559646792486/" target="_blank"><img class="social-logo mb-2 "
                                src="https://www.eascencia.mt/frontend/images/social/social-media-01.png" alt="social logo"></a>
                            <a href="https://www.instagram.com/eascencia/" target="_blank"><img class="social-logo mb-2 "
                                    src="https://www.eascencia.mt/frontend/images/social/social-media-02.png" alt="social logo"></a>

                            <div class="footer" style="margin-top: 10px !important">
                                <p class="text-color">
                                    If you no longer wish to receive emails, 
                                    <a href="{{route('unsubscribe'), ['email' => "#email#"]}}" target="_blank" class="text-decoration-none">
                                        click here to unsubscribe
                                    </a>.
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
