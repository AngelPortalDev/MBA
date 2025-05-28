<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Successful</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f6fb;
        }

        .container {
            text-align: center;
        }

        .successImg {
            width: 50%;
            margin-bottom: 20px;
        }

        .title {
            font-size: 2.5rem;
            color: #4b2aad;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .message {
            font-size: 1.1rem;
            color: #5a5a5a;
            margin-bottom: 30px;
        }

        .button {
            background-color: #4b2aad;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #3a2290;
        }

        @media screen and (max-width: 600px) {
            .successImg {
                width: 90% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('frontend/images/teacherRegiSuccess.png') }}" alt="Success Illustration" class="successImg">
        <div class="title">Registration Successful</div>
        <div class="message">Thank you for registering! We’ve received your details.</div>
        <a class="button" href="{{ url('/') }}">Return to Homepage</a>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>
