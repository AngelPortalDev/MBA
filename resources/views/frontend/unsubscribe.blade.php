<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unsubscribe Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Inter, sans-serif;
        }
        .logo {
            max-width: 200px;
        }
        .unsubscribe-icon {
            height: 150px;
            width: 150px;
        }
        .content {
            text-align: center;
            margin-top: 30px;
        }
        .content p{
            font-size: 18px;
        }
        .btn-primary {
            background-color: #2b3990;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mt-4">
            <img src="{{ asset('frontend/images/email-unsubscribe_new.svg')}}" alt="Unsubscribe" class="unsubscribe-icon"/>
        </div>
        <div class="content">
            <h1 class="mt-4 fw-bold">Unsubscribed Successfully!</h1>
            <p>You have been successfully unsubscribed from our mailing list.<br/>
            We’re sorry to see you go. You can always rejoin anytime.</p>
            {{-- <a href="/" class="btn btn-primary mt-3">Return to Home Page</a> --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
