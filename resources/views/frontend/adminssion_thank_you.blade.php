
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ascencia </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets_admissions/imgs/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/responsive.css">
    <link rel="stylesheet" href="">

<style>
    *,
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
    /* background-color: #f1f5f9; */
    font-family: Inter, sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    overflow-x: hidden
}



.thankyouText{
    font-size: 40px;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 60px;
    color: #191913;
    margin-top: 10rem;
    text-align: center;
}


.subText{
    font-size: 29px;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 40px;
    text-align: center;
    color: #2b3990;

}

.wish{
    text-align: center;
}


@media only screen and (max-width: 992px) {
    .thankyouText{
        font-size: 28px;
        margin-top: 5rem;
    }
    .subText{
        font-size: 22px;
    }
}

</style>
</head>

<body>
    <section class="main_contaniner">
        {{-- <img src="{{ asset('frontend/images/bg-thankyou.jpg')}}" alt="not found" class="img-fluid eascencia_logo bg-white" /> --}}
        <div style="text-align: center;margin-top: 4rem">
            <img src="https://www.eascencia.mt/frontend/images/brand/logo/logo_final.png" alt="E-Ascencia Logo" class="logo-1" style="height: 50px; width: auto;">
        </div>
        <p class="thankyouText">Thank You</p>
        <p class="subText">Your data have been Submitted!</p>
        <p class="wish">We are eager to give you best education and style!</p>
    
        
    </section>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>