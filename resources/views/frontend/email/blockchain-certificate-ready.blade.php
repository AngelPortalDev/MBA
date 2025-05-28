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
            font-family: verdana !important;
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

        .social-logo {
            width: 26px;
        }
        .subject {
            font-size: 1.75rem !important;
        }
        
        .subject-small {
            font-size: 1.5rem !important;
        }
        .subject_score {
            font-size: 1rem;
            font-weight: 700 !important;
            margin-bottom: 0px;
            margin-top: 4px;

        }
        .text-color{
            color: #212529 !important
        }
        .video-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            width: fit-content;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        /* Make the link responsive */
        .video-link:hover {
            background-color: #2980b9;
        }
        @media(max-width:600px){
            .documentVerification{
                width: 100% !important;
            }
            .subject-small{
                font-size: 1.2rem !important
            }
        }
        
    </style>
</head>

<body>
    <div class="container" style="font-family: Tahoma;">
        <div class="row align-items-center justify-content-center">
            <div style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                <img src="https://www.eascencia.mt/frontend/images/brand/logo/logo_final.png" alt="E-Ascencia Logo" class="logo-1" style="width: auto; height: 40px;">
            </div>

            <div style="text-align: center;">
                <p style="font-weight: 700;" class="mb-2 text-color subject-small">
                    Your <span style="color: #2b3990">Blockchain Certificate</span> is Ready!
                </p>


            </div>
            <div style="text-align: center;">
                
                <img class="p-2 documentVerification" src="{{ asset('frontend/images/email/certificate-ready.png')}}" alt="E-Ascencia" style="width:60%; padding:10px">

            </div>

            <div class="col-md-12 ps-md-4 my-md-3 border-md-start">

                <p class="text-color">Dear #Student Name#, </p>

                <p class="text-color"> <strong>Congratulations on successfully completing your course! &#127891;</strong></p>


                <p class="text-color">Your certificate has been securely generated and is now available in your Meta Mask wallet.</p>

                <p class="text-color">To learn how to access your Meta Mask wallet certificate, please watch our step-by-step instructional video by clicking the link below:
                </p>
                <a href="https://iframe.mediadelivery.net/play/364822/48d210d1-d6b2-4e1e-a2f7-7bf91d2174ed" target="_blank" class="video-link">
                    {{-- #Video Link# --}}
                    Watch Certificate Ready Video
                </a>
                <p>You can also directly check your blockchain certificate through: <a href="www.basescan.org.">www.basescan.org. </a></p>
                <p>Your NFTs credentials:</p>
                <p style="margin-bottom: 0px">Address: <span style="font-weight: bold">#Address#</span></p>
                <p>Token Id: <span style="font-weight: bold">#TokenId# </span></p>

                <p>If you have any questions or need assistance, feel free to reach out to us at  <strong><a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt.</a></strong></p>
                <P>Thank you for choosing E-Ascencia Malta for your learning journey.</P>
                <p class="mb-3 text-color"> Best regards, <br>
                    <strong>The E-Ascencia Team</strong>
                </p>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>
