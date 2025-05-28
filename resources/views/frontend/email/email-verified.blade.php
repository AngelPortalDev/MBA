<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Ascencia: Online Learning Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('frontend/js/sweetalert.min.js')}}"></script>
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
        .social-logo{
            width: 26px;
        }
    </style>
</head>
<body>
    <div class="container"> 
            <div class="row align-items-center justify-content-center">

                    <div class="col-md-7">

                        <img class="p-3 " src="{{ asset('frontend/images/email/email-verified.png')}}" alt="E-Ascencia" width="100%">

                    </div>

                    <div class="col-md-12 ps-md-4 my-md-4 border-md-start text-center">
                        

                        <h3 style="font-weight: 700;color: #2b3990 " class="mb-1">
                        Email Verified Successfully
                        </h3>
                        <p> Your email address has been verified. You can now access all features of your account.</p>
                        {{-- <a href="https://www.eascencia.mt" class="button my-2" target="_blank" style="background-color: #2b3990;color: #DAE137;font-weight: 600;">Start Learning</a> --}}
                        @if(session('statusEmail'))
                            @php 
                                $User = DB::table('users')->where('email',session('statusEmail'))->first(); 
                            @endphp
                            @if(!empty($User) && $User->email_verified_at != '')
                                <a style="cursor:pointer;background-color: #2b3990 !important;" data-checkemail="{{base64_encode(session('statusEmail'))}}" data-form_data ="{{base64_encode(json_encode(session('form_data')))}}" data-intended_action_cart="{{base64_encode(json_encode(session('intended_action_cart')))}}" data-intended_action_wishlist="{{base64_encode(json_encode(session('intended_action_wishlist')))}}" class="btn btn-primary emailVerfiedLogin">Start Learning</a>
                            @endif
                        @endif
                            
                    </div>
            </div>
    </div>  











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".emailVerfiedLogin").on('click',function(event){
        var baseUrl = window.location.origin;
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var email = $(this).data("checkemail");
        var form_data = $(this).data("form_data");
        var intended_action_cart = $(this).data("intended_action_cart");
        var intended_action_wishlist = $(this).data("intended_action_wishlist");

        $.ajax({
            url: baseUrl + "/student-login",
            type: "post",
            data: {
                email: email,
                status: 'emailverified',
                form_data : form_data,
                intended_action_cart:intended_action_cart,
                intended_action_wishlist:intended_action_wishlist
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success: function (response) {

                if(response.message){
                    swal({
                        title: response.message,
                        text: response.text,
                        icon: "success",
                    });
                }
                // $(".save_loader").addClass("d-none").fadeOut();
                window.open(response.data, '_self');
            },
        });
    });
    </script>

</body>
</html>
