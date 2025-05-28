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
                <p style="font-weight: 700; color:#2b3990 !important;" class="mb-2 text-color subject-small">
                    Payment Failed for <br/><span style="color: #000 !important">[Student Name] – [Course Name] </span>
                </p>

            </div>
            <div style="text-align: center;">

                <img class="p-2 documentVerification" src="{{ asset('frontend/images/email/paymentfailed.png') }}" alt="E-Ascencia" style="width:60%; padding:10px">
                
            </div>

            <div class="col-md-12 ps-md-4 my-md-3 border-md-start">

                <p class="text-color">Dear Admin, </p>
                <p class="text-color">I hope this message finds you well.</p>

                <p class="text-color">Please find below the payment details for the student:</p>

                <p>Student Name: <strong> [Student Name] </strong></p>
                <p>Course Name:  <strong> [Course Name] </strong></p>
                <p>Amount Paid: <strong>€ [Amount]      </strong></p>
                <p>Payment Status: <strong><span class="badge text-bg-success">Success</span>/<span class="badge text-bg-danger">failed</span> </strong></p>


                <p class="text-color">If you have any questions or need assistance, feel free to reach out to us at  <strong><a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt</a></strong></p>

                <p class="mb-3 text-color"> Best regards, <br>
                    <strong>Claire</strong>
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
