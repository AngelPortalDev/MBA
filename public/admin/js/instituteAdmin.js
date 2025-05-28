$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    
    $(".instituteCreate").on("click", function (event) {

        event.preventDefault();
        $("#university_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#password_error").hide();


        var universityname = $("#university_name").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
    
        if (universityname === "") {
            $("#university_name_error").show();
            return;
        }
        if(universityname.length<4){
            $("#university_name_error").text("Institute name should be at least 4 characters.");
            $("#university_name_error").show();
            return;
        }

        if(universityname.length > 255){
            $("#university_name_error").text("Institute name should be less than 255 characters.");
            $("#university_name_error").show();
            return;
        }

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(email != ''){
            if (!emailRegex.test(email)) {
                $('#email_error').text('Please enter valid e-mail format');
                $('#email_error').show();
                return '';
            } 
        }
        if (email === "") {
            $("#email_error").show();
            return;
        }
        if (mob_code === "") {
            $("#mob_code_error").show();
            return;
        }
        if (mobile === "") {
            $("#mob_code_error").show();
            return;
        }
        if (password === "") {
            $("#password_error").show();
            return;
        }
        if(password.length>20){
            $("#password_error").text("Password should be less than 20 characters.");
            $("#password_error").show();
            return;
        }
        if (confirm_password === "") {
            $("#confirm_password_error").show();
            return;
        }
        if(confirm_password.length>20){
            $("#confirm_password_error").text("Confirm password should be less than 20 characters.");
            $("#confirm_password_error").show();
            return;
        }

        var formData = new FormData($(".universityForm")[0]);
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/institute-create",
            type: "post",
            data: formData,
            dataType: "json",
            contentType:false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#loader").fadeOut();

                if (response.code === 200) {
                    $("#create-institute-modal").modal('hide');
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/institute";
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    var redirect = "/admin/institute";
                    showModalWithRedirect(modalData, redirect);
                }
                if (response.code === 202) {
                    $(".errors").remove();
                    $("#create-modal").show();
                var data = Object.keys(response.data);
                    var values = Object.values(response.data);

                    data.forEach(function (key) {
                        var value = response.data[key];

                        // $(".errors").remove();
                        if (key === "mobile" || key == "mob_code") {
                            var errorDiv = $(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                            $("form")
                                .find("[name='" + key + "']")
                                .after(errorDiv);
                            $("form")
                                .find(".mobile-with-country-code")
                                .after(errorDiv);
                        } else {
                            $("form")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                        }
                    });
                }
                if(response.code === 201){
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                }
                
                
            },
        });
    });

    $('#create-institute-modal').on('show.bs.modal', function (event) {
        
        $(".universityForm")[0].reset();
        
        $("#university_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();
    
    });

    
    $(".editInstituteProfile").on("click", function (event) {

        event.preventDefault();
        $("#university_name_error").hide();
        $("#website_error").hide();
        $("#address_error").hide();
        $("#billing_city_error").hide();
        $("#billing_state_error").hide();
        $("#billing_country_error").hide();
        $("#contact_person_name_error").hide();
        $("#contact_person_email_error").hide();
        $("#contact_person_mob_code_error").hide();
        $("#contact_person_mobile_error").hide();
        $("#contact_person_designation_error").hide();

        var universityname = $("#university_name").val();
        var website = $("#website").val();
        // var address = $("#address_error").val();
        var address_new = $("#textarea-input").val();
        var billing_city = $("#billing_city").val();
        var billing_state = $("#billing_state").val();
        var billing_country = $("#billing_country").val();
        var contact_person_name = $("#contact_person_name").val();
        var contact_person_email = $("#contact_person_email").val();
        var contact_person_mob_code = $("#contact_person_mob_code").val();
        var contact_person_mobile = $("#contact_person_mobile").val();
        var contact_person_designation = $("#contact_person_designation").val();


        if (universityname === "") {
            $("#university_name_error").show();
            return;
        }
        
        if(website === ""){
            $("#website_error").show();
            return;
        }

        var addressCount = address_new.trim().split(/\s+/).length;

        if(billing_city === ""){
            $("#billing_city_error").show();
            return;
        }

        if(billing_state === ""){
            $("#billing_state_error").show();
            return;
        }

        if(billing_country === ""){
            $("#billing_country_error").show();
            return;
        }


        if (address_new === "") {
            $("#address_error").text("Address is required.");
            $("#address_error").show();
            return;
        }

        if(addressCount>100){
            $("#address_error").text("Address should be less than 100 words.");
            $("#address_error").show();
            return;
        }

        if(contact_person_name === ""){
            $("#contact_person_name_error").show();
            return;
        }

        if(contact_person_email === ""){
            $("#contact_person_email_error").show();
            return;
        }

        if(contact_person_mob_code === ""){
            $("#contact_person_mob_code_error").show();
            return;
        }

        if(contact_person_mobile === ""){
            $("#contact_person_mobile_error").show();
            return;
        }

        if(contact_person_designation === ""){
            $("#contact_person_designation_error").show();
            return;
        }

        let isValid = true;

        if (!$("#photo_id").length || ($("#photo_id")[0].files.length === 0 && !$("a.btn-primary:contains('View Photo ID')").length)) {
            $("#photo_id_error").show();
            isValid = false;
        } else {
            $("#photo_id_error").hide();
        }
        
        // Check if License is required
        if (!$("#licence").length || ($("#licence")[0].files.length === 0 && !$("a.btn-primary:contains('View License')").length)) {
            $("#licence_error").show();
            isValid = false;
        } else {
            $("#licence_error").hide();
        }

        if (!isValid) {
            event.preventDefault();
            return 
        }
        
        // if (!$("#photo_id").length || ($("#photo_id")[0].files.length === 0 && $(".btn-primary").length === 0)) {
        //     $("#photo_id_error").show();
        //     return;
        // } else {
        //     $("#photo_id_error").hide();
        // }
        
        // if (!$("#licence").length || ($("#licence")[0].files.length === 0 && $(".btn-primary").length === 0)) {
        //     $("#licence_error").show();
        //     return;
        // } else {
        //     $("#licence_error").hide();
        // }

        var formData = new FormData($(".universityForm")[0]);
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/institute-create",
            type: "post",
            data: formData,
            dataType: "json",
            contentType:false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $("#loader").fadeOut();
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/institute";
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    var redirect = "/admin/institute";
                    showModalWithRedirect(modalData, redirect);
                }

                if (response.code === 202) {
                    $(".errors").remove();
                    $("#create-modal").show();
                var data = Object.keys(response.data);
                    var values = Object.values(response.data);

                    data.forEach(function (key) {
                        var value = response.data[key];

                        // $(".errors").remove();
                        if (key === "mobile" || key == "mob_code") {
                            var errorDiv = $(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                            $("form")
                                .find("[name='" + key + "']")
                                .after(errorDiv);
                            $("form")
                                .find(".mobile-with-country-code")
                                .after(errorDiv);
                        } else {
                            $("form")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                        }
                    });
                }
                if(response.code === 201){
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message || "",
                        icon: response.icon,
                    }
                    showModal(modalData);
                }
                
                
            },
        });
    });
    $(document).on("click", ".deleteInstitute", function () {
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
            //     title: "Delete Institute",
            //     text: "Are you sure you want to delete institute?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Institute",
                message: "Are you sure you want to delete institute?",
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
                        url: baseUrl + "/admin/institute-delete",
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
                            $("#processingLoader").fadeOut();

                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return (window.location.href =
                            //         "/admin/institute");
                            // });

                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };

                            var redirect = `/admin/institute`;

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
            //     text: "Please select at least one record",
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
    $(document).on("click", ".statusInstitute", function (event) {
        var institute_id = $(this).data("institute_id");
        var status = $(this).data("status");
       
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/status-institute",
            type: "post",
            data: { id: institute_id,status: status},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader")
                //     .addClass("d-none")
                //     .removeClass("d-block");
                $("#processingLoader").fadeOut();
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // }).then(function () {
                //     return (window.location.href =
                //         "/admin/institute");
                // });

                const modalData = {
                    title: response.title,
                    message: response.message,
                    icon: response.icon,
                }
                var redirect = "/admin/institute";
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
    $(".profileInstitutePic").on("change", function () {
        // $("#loader").fadeIn();
        var fileInput = $('#imageUpload_profile')[0];
        var file = fileInput.files[0];
        var currnetForm = $(this).closest("form");
        var currnetimg = $(this).closest("img");
         var formData = new FormData($(".profileImage")[0]);
         formData.append('image_file', file);   

        $.ajax({
            url: baseUrl + "/admin/add-institute-profile-image",
            type: "post",
            data: formData,
            dataType: "json",
            contentType:false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $("#loader").fadeOut();

                if (response.code == 200) {
                    currnetForm.find(".curr_img").prop("value", +response.new);
                    // swal({
                    //     title: response.message,
                    //     text: response.text,
                    //     icon: "success",
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModal(modalData);
                } else {
                    currnetimg
                        .find(".imagePreview")
                        .prop("src", baseUrl + "/storage/" + response.old);
                    // swal({
                    //     title: response.message,
                    //     text: response.text,
                    //     icon: "error",
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModal(modalData);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                $("#result").html("An error occurred.");
            },
        });
    });


    
});
