@extends('admin.layouts.main')
@section('content')
    <style>
        .service-item {
            padding: 30px;
            transition: 0.3s;
            border-radius: 5px;
            border: 1px solid #ddd; 
            cursor: pointer; 
        }

        .service-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .service-item.active {
            border: 1px solid #2b3990; 
        }

        .service-item .title {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .service-item .description {
            line-height: 24px;
            font-size: 14px;
            margin: 0;
        }

        .service-item img {
            height: 70px;
            width: 70px;
            margin-right: 25px;
        }

        .btn-submit {
            background-color: #2b3990;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #556270; 
        }

    </style>

    <section class="container-fluid p-4">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-12">
                <h1 class="mb-1 h2 fw-bold">Block Onboarding</span></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Onboarding</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container card mb-3 p-7 mt-5">
            <h1 class="text-center mb-5">Block Onboarding</h1>
            <div class="row">
                <div class="table-responsive">
                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                <thead>
                    <th></th>
                    <th>Register</th>
                    <th>Login</th>
                </thead>
                @php
                $paymentMethodData = getData('permission', ['status','institute','student','ementor','teacher'],[],'','');
                $studentRegister = ''; $studentLogin = '';$instituteLogin='';$instituteRegister=''; $ementorLogin=''; $teacherRegister='';
                @endphp
                @foreach($paymentMethodData as $key => $method)
                    @php
                        if ($method->status == 0) {
                            if($method->student == 'register'){ 
                                $studentRegister = 'checked';
                            }
                            if($method->student == 'login'){
                                $studentLogin = 'checked';
                            }
                            if($method->institute == 'register'){ 
                                $instituteRegister = 'checked';
                            }
                            if($method->institute == 'login'){
                                $instituteLogin = 'checked';
                            }
                            if($method->ementor == 'login'){
                                $ementorLogin = 'checked';
                            }
                            if($method->teacher == 'register'){ 
                                $teacherRegister = 'checked';
                            }

                        }
                    @endphp
                @endforeach
                <tbody>
                    <tr>
                       <td style="width:80px;">Student </td>
                       <td style="width:20px;"> 
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="stu_reg" {{$studentRegister}}>
                            </div>
                        </td>
                       <td style="width:20px;">
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="stu_log" {{$studentLogin}}> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:80px;">Ementor </td>
                        <td style="width:20px;"> 
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="emen_reg" checked style="pointer-events: none;">
                            </div>
                        </td>
                        <td style="width:20px;">
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="emen_log" {{$ementorLogin}}>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:80px;">Institute </td>
                        <td style="width:20px;"> 
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="inst_reg" {{$instituteRegister}}>
                            </div>
                        </td>
                        <td style="width:20px;">
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="inst_log" {{$instituteLogin}}>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:80px;">Teacher </td>
                        <td style="width:20px;"> 
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="teach_reg" {{$teacherRegister}} >
                            </div>
                        </td>
                        <td style="width:20px;">
                            <div class="form-check form-switch" style="">
                                <input class="form-check-input" type="checkbox" role="switch" data-content="teach_log"  checked style="pointer-events: none;">
                            </div>
                        </td>
                    </tr>
                </tbody>
            

             </table>
            </div>
            
        </div>

        
    </section>

    <script>
    
    
    $(document).on('click', '.form-check-input', function() {
            if ($(this).is(':checked')) {
                var status = "Active";
            }else{
                var status = "Inactive";
            }
            var content = $(this).data("content");      
            var baseUrl = window.location.origin;
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            // $(".save_loader").removeClass("d-none").addClass("d-block");
            $("#processingLoader").fadeIn();
            $.ajax({
                url: baseUrl + "/admin/save-boarding-permisssion",
                type: "POST",
                data: {
                    content : btoa(content),
                    status:btoa(status)
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: 'Block onboarding.',
                        //     text: `You selected ${status} onboarding.`,
                        //     icon: 'success',
                        //     buttons: {
                        //         cancel: {
                        //             text: "", // Text for the cancel button
                        //             value: null, // Return null if "Ok" is clicked
                        //             visible: false, // Ensure the button is visible
                        //             className: "", // Optional: add custom class
                        //             closeModal: true // Close the modal on click
                        //         },
                        //         confirm: {
                        //             text: "Ok", // Text for the confirmation button
                        //         }
                        //     },
                        //     });
                        
                        const modalData = {
                            title: 'Block onboarding',
                            message: `You selected ${status} onboarding.`,
                            icon: successIconPath,
                        }
                        showModal(modalData);
                    }
                }
            });

               
    });
    </script>
@endsection
