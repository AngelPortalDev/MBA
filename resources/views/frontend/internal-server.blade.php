<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
    background-color: #f1f5f9;
    font-family: "Inter", sans-serif;
}
.error-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 2rem;
}
.error-content {
    text-align: center;
}
.error-content .lead {
    color: #64748b;
}
.error-content h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #2b3990;
    font-weight: bold;
}
.error-content p {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    font-weight: 500;
    color: #64748b;
}
.error-content .summary {
    font-size: 1rem;
    color: #64748b;
}
.error-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
}
.btn-primary {
    color: #ffffff;
    background-color: #2b3990;
    border: none;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}
.btn-primary:hover {
    background-color: #1e2a6f;
}
.btn-primary:focus, .btn-primary:active {
    box-shadow: none;
}
.error-section .lead{
            color: #64748b;
        }
        h1{
                color: #2b3990;
                font-size: 3rem;
                font-weight: bold;
        }
@media (max-width: 767.98px) {
    .error-content h1 {
        font-size: 2rem;
    }
    .error-content p {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <section class="error-section">
        <div class="container">
            <div class="row align-items-center text-center text-md-left">
                <!-- Image Column -->
                <div class="col-md-6 order-1 order-md-2">
                    <img src="{{ asset('frontend/images/InternalServer.png') }}" alt="Under Maintenance" class="img-fluid rounded-3">
                </div>
    
                <!-- Text Column -->
                <div class="col-md-6 order-2 order-md-1 mt-md-3 mt-0">
                    <h1 class="display-5 fw-bold mb-3">
                        500 Under Maintenance
                    </h1>
                    <p class="lead mb-4">
                        Something went wrong on our end. We're working to fix it as soon as possible. Please try again later.
                    </p>
                    <p class="mb-4 summary">
                        If you need immediate assistance, feel free to contact us at <a href="mailto:support@eascencia.mt" class="text-decoration-none">support@eascencia.mt</a>
                    </p>
                    {{-- <a href="{{ url('/') }}" class="btn btn-primary btn-md">Return to Homepage</a> --}}
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>