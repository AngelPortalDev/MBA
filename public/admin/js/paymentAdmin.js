$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    $(".promoadd").on("click", function (event) {
        event.preventDefault();
        // $(".promo_name_error").hide();
        $(".promo_code_error").hide();
        $(".promo_discount_error").hide();
        $(".expiry_date_error").hide();
        $(".course_id_error").hide();
        $(".errors").hide();

        var coupon_name = $(".promo_code_name").val();
        var coupon_code = $(".promo_code").val();
        var coupon_discount = $(".discount").val();
        var coupon_validity = $(".expiry_date").val();   
        var course_id = $(".course_id").val();   
        if (course_id === "") {
            $(".course_id_error").show();
            return;
        }
        if (coupon_code === "") {
            $(".promo_code_error").show();
            return;
        }
        if (coupon_code.length > 10) {
            $(".promo_code_error").text("Promo code length must be less than 10 characters.");
            $(".promo_code_error").show();
            return;
        }
    
        if (coupon_discount === "") {
            let regex = /^[a-zA-Z]+$/;
            if(regex.test(coupon_discount) == false){

                $(".promo_discount_error").val('Please enter a number.');
                $(".promo_discount_error").html('Please enter a number.');
                $(".promo_discount_error").show();

            }else{
                $(".promo_discount_error").show();
            }
            return;
        }
        if (coupon_validity === "") {
            $(".expiry_date_error").show();
            return;
        }

    
        var formData = new FormData($(".addpromo")[0]);
            $("#loader").fadeIn();
            $.ajax({
                url: baseUrl + "/admin/add-course-promo",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    if (response.code === 200 || response.code === 201 ) {
                        $("#addpromo-modal").modal('hide');
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     window.location.reload();
                        // }); 
                        const modalData = {
                            title: response.title,
                            message: response.message || "",
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                    if (response.code === 202) {
                        $(".errors").remove();
                        var data = Object.keys(response.data);
                        var values = Object.values(response.data);
                        data.forEach(function (key) {
                            var value = response.data[key];
                            $("form")
                                .find("[name='" + key + "']")
                                .after(
                                    "<div class='invalid-feedback errors d-block'><i>" +
                                        value +
                                        "</i></div>"
                                );
                        });
                    }
                }
            });
    });

    $(document).on("click", "#editpromocode", function () {
        var promocodeId = $(this).data('id');
        $.ajax({
            url: baseUrl + "/admin/promocode-get-data/"+promocodeId+'/edit',
            type: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#addpromo-modal").modal('show');
                $(".promoadd").text("Edit");
                $(".coupon_id").val(btoa(response[0].id));
                $(".promo_code_name").val(response[0].coupon_code);
                $(".promo_code").val(response[0].coupon_name);
                $(".discount").val(response[0].coupon_discount);
                $(".expiry_date").val(response[0].coupon_validity);
                // $(".course_id").val(btoa('0'));
                selectCourse(response[0].institute_id,'institute');
                selectCourse(response[0].course_id,'course'); // Example: Select course with ID 49
            }
        });
    });
    function selectCourse(courseId,selection) {
        if(courseId != null){
            var encodedValue = btoa(courseId.toString());
            if(selection == 'institute'){
                var courseSelect = $(".institute_id");
                courseSelect.val(encodedValue);
            }
            if(selection == 'course'){
                var courseSelect = $(".course_id");
                courseSelect.val(encodedValue);
            }
        }
    }
    $('#addpromo-modal').on('hidden.bs.modal', function() {
        $(".promo_code_error").hide();
        $(".promo_discount_error").hide();
        $(".expiry_date_error").hide();
        $(".course_id_error").hide();
        $(".institute_id_error").hide();

        // Clear modal content to prepare for next load
        $('.promo_code_name').val('');
        $('.coupon_id').val('');
        $(".course_id").val('');
        $('.promo_code').val('');
        $('.discount').val('');
        $('.expiry_date').val('');
        $(".institute_id").val('');
        $(".promoadd").text("Create");

    });

    $(document).on("click", ".deletePromoCode", function (event) {
        // var promo_id = $(this).data("delete_id");
        var status = $(this).data("status");
        var allVals= [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr("data-deletes_id"));
        });
        if ($(this).attr("data-deletes_id") == undefined) {
            var deletevalue = $(this).data("delete_id");
            if (deletevalue) {
                allVals.push(deletevalue);
            }
        }
        if (allVals.length != 0) {
            // swal({
            //     title: "Delete Promo Code",
            //     text: "Are you sure you want to delete promo code?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Promo Code",
                message: "Are you sure you want to delete promo code?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                    $.ajax({
                        url: baseUrl + "/admin/delete-course-promocode",
                        type: "post",
                        data: { id: allVals,status: btoa('delete')},
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return (window.location.href =
                            //         "/admin/promo-code");
                            // });
                            
                            $("#processingLoader").fadeOut();
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };

                            var redirect = `/admin/promo-code`;

                            showModalWithRedirect(modalData, redirect);

                            // if (response.code === 200) {
                            //     if (section_id !== "") {
                            //         $(".selectSectionId").trigger("change", [
                            //             section_id,
                            //         ]);
                            //     }
                            // }
                        },
                    });
            });
        }else{
            // swal({
            //     title: "",
            //     text: "Please select at least one record.",
            //     icon: "warning",
            //     buttons: true,
            // });

            const modalData = {
                title: '',
                message: "Please select at least one record",
                icon: warningIconPath,
            };
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                $("#customModal").hide();
            });
        }
    });

    $(document).on("click", ".statusPromoCode", function (event) {
        var promo_id = $(this).data("promo_id");
        var status = $(this).data("status");
       
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/delete-course-promocode",
            type: "post",
            data: { id: promo_id,status: status},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader")
                //     .addClass("d-none")
                //     .removeClass("d-block");
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // }).then(function () {
                //     return (window.location.href =
                //         "/admin/promo-code");
                // });

                $("#processingLoader").fadeOut();
                const modalData = {
                    title: response.title,
                    message: response.message || "",
                    icon: response.icon,
                };

                var redirect = `/admin/promo-code`;

                showModalWithRedirect(modalData, redirect);


                // if (response.code === 200) {
                //     if (section_id !== "") {
                //         $(".selectSectionId").trigger("change", [
                //             section_id,
                //         ]);
                //     }
                // }
            },
        });
        
    });

    $(document).on("click", ".refund", function (event) {
        // var promo_id = $(this).data("delete_id");
        var payment_id = $(this).data("payment_id");   
        var payment_refund_id =  $(this).data("payment_refund_id");   
            swal({
                title: "Refundable Amount",
                text: "Are you sure you want to refund amount?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");
                    $.ajax({
                        url: baseUrl + "/admin/payment-refund",
                        type: "post",
                        data: { 
                            payment_id: payment_id,
                            payment_refund_id:payment_refund_id
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            $(".save_loader")
                                .addClass("d-none")
                                .removeClass("d-block");
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(function () {
                                return (window.location.href =
                                    "/admin/payment");
                            });

                            // if (response.code === 200) {
                            //     if (section_id !== "") {
                            //         $(".selectSectionId").trigger("change", [
                            //             section_id,
                            //         ]);
                            //     }
                            // }
                        },
                    });
                }
            });
     
    });
    $("#generatePaymentLink").on("click", function (event) {
        event.preventDefault();
        // $(".promo_name_error").hide();
        $("#user_name_error").hide();
        $("#course_name_error").hide();
        $("#payment_amount_error").hide();
        var user_id = $(".user_id").val();
        var course_id = $(".course_id").val();
        var amount = $(".amount").val();
        if (user_id === "") {
            $("#user_name_error").show();
            return;
        }
        if (course_id === "") {
            $("#course_name_error").show();
            return;
        }
        if (amount === "") {
            $("#payment_amount_error").show();
            return;
        }

        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        var formData = new FormData($(".paymentForm")[0]);
        $.ajax({
            url: baseUrl + "/admin/generate-payment-link",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();

                if(response.code === 202){  

                    console.log(response.message);
                    $("#payment-link").modal('show');
                    $("#payment_amount_error").text(response.message);
                    $("#payment_amount_error").show();

                }
                if (response.code === 200) {
                    $("#payment-link").modal('show');
                    $(".modal-body .FormData").addClass("d-none")
                    $(".modal-body .SumbitUrl").removeClass("d-none");
                    $(".modal-body #pay_url").val(response.data);

                }
                if(response.code === 201){
                    $("#payment-link").modal('hide');

                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
                    // }); 

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
                // if (response.code === 202) {
                //     $(".errors").remove();
                //     var data = Object.keys(response.data);
                //     var values = Object.values(response.data);
                //     data.forEach(function (key) {
                //         var value = response.data[key];
                //         $("form")
                //             .find("[name='" + key + "']")
                //             .after(
                //                 "<div class='invalid-feedback errors d-block'><i>" +
                //                     value +
                //                     "</i></div>"
                //             );
                //     });
                // }
            }
        });
    });
    
});