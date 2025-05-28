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
            font-family: "Inter", sans-serif;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        .logo-1 {
            width: 160px;
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
            margin-top: 20px;
            color: #777;
        }

        .social-logo {
            width: 26px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 text-center border-bottom pb-2 mb-4">
                <img class="logo-1 mb-2" src="{{ asset('frontend/images/brand/logo/logo.svg') }}" alt="E-Ascencia Logo">
            </div>

            <div class="col-md-12 text-center">
                <h2 style="font-weight: 700;font-size: 24px; " class="my-2">Payment Confirmation and Receipt Attached</h2>

            </div>
            <div class="col-md-6">

                <img class="p-3 " src="{{ asset('frontend/images/email/payment-successful-email.png') }}" alt="E-Ascencia"
                    width="100%">

            </div>

            <div class="col-md-12 ps-md-4 my-md-3 border-md-start">

                
                <p>Dear #Name#, </p>

                <p>This email is to confirm that your payment for <strong>[#Course Name#]</strong> has been successfully processed. We are delighted to have you on board as a student of E-Ascencia.</p>

                <p> <strong>Payment Details:</strong></p>
                <ul>
                    <li><p class="mb-0"> <strong>Transaction ID:</strong> #XXXXXXXXXX#</p></li>
                    <li><p class="mb-0"><strong>Date of Payment:</strong> #DD/MM/YYYY#</p></li>
                    <li><p class="mb-0"><strong>Amount Paid:</strong>€ #500# </p></li>
                    <li><p class="mb-0"><strong>Course Name:</strong> #Course Name#</p></li>
                </ul>
                <h6 style="color: #2b3990; font-weight: bolder;">
                    <strong>Download your payment receipt using the link provided below.</strong>
                </h6>                
                <p><strong><a href=""class="text-wrap" style="overflow-wrap: break-word;">[hbGciOiJIUzUxMeyJpc3MiOiJodHRwczpcL1wvY3N0LmJyZ]</a></strong></p>
                <p> If you have any questions or need assistance, feel free to reach out to us at <strong><a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt.</a></strong></p>
                
                <p class="mb-3"> Best regards, <br>
                    <strong>The E-Ascencia Team</strong>
                </p>

                <a href="https://www.facebook.com/people/E-Ascencia-Malta/61559646792486/" target="_blank"><img class="social-logo mb-2 "
                    src="{{ asset('frontend/images/social/social-media-01.png') }}" alt="social logo"></a>
                <a href="https://www.instagram.com/eascencia/" target="_blank"><img class="social-logo mb-2 "
                        src="{{ asset('frontend/images/social/social-media-02.png') }}" alt="social logo"></a>
                <a href="https://www.linkedin.com/company/ascencia-malta-business-school/" target="_blank"><img class="social-logo mb-2 "
                        src="{{ asset('frontend/images/social/social-media-03.png') }}" alt="social logo"></a>
                <a href="https://x.com/eascenciamalta" target="_blank"><img class="social-logo mb-2 twitterLogoStyle"
                        src="{{ asset('frontend/images/social/social-media-09.png') }} " alt="social logo"></a>
                {{-- <a href="#" target="_blank" onclick="return false"><img class="social-logo mb-2 "
                        src="{{ asset('frontend/images/social/social-media-07.png') }}" alt="social logo"></a> --}}
                <a href="https://www.quora.com/profile/E-Ascencia-Malta" target="_blank"><img class="social-logo mb-2 "
                        src="{{ asset('frontend/images/social/social-media-08.png') }}" alt="social logo"></a>

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
