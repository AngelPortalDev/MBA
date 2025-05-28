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

        /* Style for the video link */
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

    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 text-center border-bottom pb-2 mb-4">
                <img class="logo-1 mb-2" src="{{ asset('frontend/images/brand/logo/logo.svg') }}" alt="E-Ascencia Logo">
            </div>

            <div class="col-md-12 text-center">
                <h2 style="font-weight: 700;font-size: 24px;" class="my-2">Your <span style="font-weight: 700;color: #2b3990">Blockchain Certificate</span> is Ready!</span></h2>
            </div>
            <div class="col-md-6">
                <img class="" src="{{ asset('frontend/images/email/blockchain-certificate.png') }}" alt="E-Ascencia"
                    width="100%">
            </div>

            <div class="col-md-12 ps-md-4 my-md-3 border-md-start" style="margin-top: 10px;">
                <p>Dear #Name#, </p>

                <p> <strong> Congratulations on successfully completing your course! 🎓 </strong></p>

                <p>Your certificate has been securely generated and is now available in your <strong>Meta Mask wallet.</strong>
                    To learn how to access your Meta Mask wallet certificate, please watch our step-by-step instructional video by clicking the link below:</p>

                <!-- Video link styled as a button -->
                <a href="https://iframe.mediadelivery.net/play/364822/48d210d1-d6b2-4e1e-a2f7-7bf91d2174ed" target="_blank" class="video-link">
                    Watch the Instructional Video
                </a>

                <p>You can also directly check your blockchain certificate through <a href="https://basescan.org/" target="_blank"> www.basescan.org.</a></p>
                <p style="margin-bottom: 5px;">Your NFTs credentials:</p>
                <p style="margin-bottom: 0px;">Address:</p>
                <p>Token Id:</p>
                <p>If you need assistance, feel free to reach out to us.</p>
                <p>Thank you for choosing E-Ascencia Malta for your learning journey.</p>

                <p class="mb-3">Best regards, <br>
                    <strong>The E-Ascencia Team</strong>
                </p>

                <a href="https://www.facebook.com/people/E-Ascencia-Malta/61559646792486/" target="_blank"><img class="social-logo mb-2"
                    src="https://www.eascencia.mt/frontend/images/social/social-media-01.png" alt="social logo"></a>
                <a href="https://www.instagram.com/eascencia/" target="_blank"><img class="social-logo mb-2"
                        src="https://www.eascencia.mt/frontend/images/social/social-media-02.png" alt="social logo"></a>
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
