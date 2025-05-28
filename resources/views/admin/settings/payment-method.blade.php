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
                <h1 class="mb-1 h2 fw-bold">Payment Methods <span class="fs-5">({{ isset($data['totalStudentsCount']) ? $data['totalStudentsCount'] : 0 }})</span></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Payments Method</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container card mb-3 p-7 mt-5">
            <h1 class="text-center mb-5">The Best Payment Methods</h1>
            <div class="row">
                @php
                $paymentMethodData = getData('payment_methods', ['method_type'],['status' => '0']);
                @endphp
                <div class="col-md-6 mb-3">
                    <div class="service-item d-flex position-relative h-100 {{ isset($paymentMethodData[0]->method_type) && $paymentMethodData[0]->method_type == 'flywire' ? 'active' : '' }}">
                        <img src="{{ asset('admin/images/svg/flywire_logo.svg') }}" alt="Flywire" class="img-fluid" />
                        <div class="payment-methods">
                            <h4 class="title"><p class="stretched-link" aria-label="Learn more about Flywire">Flywire</p></h4>
                            <p class="description">Flywire is an easy-to-use payment solution that provides international payers with a streamlined payment experience.</p>
                            <div class="form-check form-switch" style="position: absolute; top:10px; right:0px">
                                <input class="form-check-input" type="checkbox" role="switch" id="flywireSwitch" {{ isset($paymentMethodData[0]->method_type) && $paymentMethodData[0]->method_type == 'flywire' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="service-item d-flex position-relative h-100 {{ isset($paymentMethodData[0]->method_type) && $paymentMethodData[0]->method_type == 'stripe' ? 'active' : '' }}">
                        <img src="{{ asset('admin/images/svg/stripe_logo.svg') }}" alt="Stripe" class="img-fluid" />
                        <div class="payment-methods">
                            <h4 class="title"><p class="stretched-link" aria-label="Learn more about Stripe">Stripe</ap></h4>
                            <p class="description">Stripe's payments platform lets you accept credit cards, debit cards, and popular payment methods around the world.</p>
                            <div class="form-check form-switch" style="position: absolute; top:10px; right:0px">
                                <input class="form-check-input" type="checkbox" role="switch" id="paymentSwitch"  {{ isset($paymentMethodData[0]->method_type) && $paymentMethodData[0]->method_type == 'stripe' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-main d-flex justify-content-center mt-3">
                <button class="btn btn-primary btn-submit" id="submitButton">Submit</button>
            </div>
        </div>

        
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serviceItems = document.querySelectorAll('.service-item');
            const submitButton = document.getElementById('submitButton');
    
            let unsavedChanges = false;
    
            serviceItems.forEach(item => {
                item.addEventListener('click', function () {
                    const switchElement = this.querySelector('.form-check-input');
    
                    serviceItems.forEach(sibling => {
                        sibling.classList.remove('active');
                        sibling.querySelector('.form-check-input').checked = false;
                    });
    
                    this.classList.add('active');
                    switchElement.checked = true;
    
                    unsavedChanges = true;
                });
            });
    
            window.addEventListener('beforeunload', function (e) {
                if (unsavedChanges) {
                    const message = 'You have unsaved changes. Are you sure you want to leave?';
                    e.preventDefault();
                    e.returnValue = message; 
                    return message; 
                }
            });
    
            submitButton.addEventListener('click', function () {
                const activeItem = document.querySelector('.service-item.active');
                if (activeItem) {
                    // const title = activeItem.querySelector('.title p').textContent;
                    // title = title.toLowerCase();
                    const titleElement = activeItem.querySelector('.title p').textContent;
                    const title = titleElement.toLowerCase();
                    // swal({
                    //     title: 'Payment Method Selected',
                    //     text: `You selected ${title} payment.`,
                    //     icon: 'success',
                    //     buttons: true,
                    // });
                        var baseUrl = window.location.origin;
                        var csrfToken = $('meta[name="csrf-token"]').attr("content");
                        // $(".save_loader").removeClass("d-none").addClass("d-block");
                        $("#processingLoader").fadeIn();
                        $.ajax({
                            url: baseUrl + "/admin/save-payment-method",
                            type: "POST",
                            data: {
                                title : btoa(title)
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
                                    //     title: 'Payment method selected',
                                    //     text: `You selected ${title} payment.`,
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
                                    //     }).then(function () {
                                    //     window.location.href = baseUrl + "/admin/payment-method";
                                    // });
                                    
                                    const modalData = {
                                        title: 'Payment method selected',
                                        message: `You selected ${title} payment.`,
                                        icon: successIconPath,
                                    }
                                    var redirect = "/admin/payment-method";
                                    showModalWithRedirect(modalData, redirect);
                                }
                            }
                            });
                    unsavedChanges = false;
                } else {
                    // swal({
                    //     title: "No Selection",
                    //     text: "Please select a payment method before submitting.",
                    //     icon: "warning",
                    //     buttons: true,
                    // });

                    const modalData = {
                        title: 'No Selection',
                        message: "Please select a payment method before submitting.",
                        icon: warningIconPath,
                    };
                    showModal(modalData);
                }
            });
        });
    </script>
    

    <script src="{{ asset('admin/js/export.js') }}"></script>
@endsection
