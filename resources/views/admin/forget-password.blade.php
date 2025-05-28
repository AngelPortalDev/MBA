<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="E-Ascencia" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="assets/images/favicon/favicon.png">


    <!-- Libs CSS -->
    <link href="  assets/fonts/feather/feather.css" rel="stylesheet" />
    <link href="  assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="  assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="canonical" href="sign-in.html">
    <title>E-Ascencia | Dashboard</title>
</head>

<body>
    <!-- Page content -->
    <main>
        <section class="container d-flex flex-column pt-5">
            <div class="row align-items-center justify-content-center g-0 py-8">
                <div class="col-lg-5 col-md-8 ">
                    <!-- Card -->
                    <div class="card shadow">
                        <!-- Card body -->
                        <div class="card-body p-md-6 p-4">
                            <div class="mb-4">
                                <a href="../index.html"><img src="assets/images/brand/logo/logo-icon.svg" class="mb-4" alt="logo-icon" width="175px" /></a>
                                <h1 class="mb-1 fw-bold">Forgot Password</h1>
                                <p>Fill the form to reset your password.</p>
                            </div>
                            <!-- Form -->
                            <form class="needs-validation" novalidate>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email " required />
                                    <div class="invalid-feedback">Please enter valid email.</div>
                                </div>
                                <!-- Button -->
                                <div class="mb-3 d-grid">
                                    <button type="submit" class="btn btn-primary">Send Resest Link</button>
                                </div>
                                <span>
                                    Return to
                                    <a href="log-in.php">Log in</a>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="position-absolute bottom-0 m-4">
            <div class="dropdown">
                <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                    <i class="bi theme-icon-active"></i>
                    <span class="visually-hidden bs-theme-text">Toggle theme</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                            <i class="bi theme-icon bi-sun-fill"></i>
                            <span class="ms-2">Light</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                            <i class="bi theme-icon bi-moon-stars-fill"></i>
                            <span class="ms-2">Dark</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                            <i class="bi theme-icon bi-circle-half"></i>
                            <span class="ms-2">Auto</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <!-- Scroll top -->
    <div class="btn-scroll-top">
        <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
            <path d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
        </svg>

        <!-- Footer import -->
        <?php
        include "layout/footer.php";  ?>