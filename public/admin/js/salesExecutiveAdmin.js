$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    
    $(".salesExecutiveCreate").on("click", function (event) {

        event.preventDefault();
        $("#name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#password_error").hide();


        var name = $("#name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
    
        if (name === "") {
            $("#name_error").show();
            return;
        }
        if (last_name === "") {
            $("#last_name_error").show();
            return;
        }

        if(name.length < 3){
            $("#name_error").text("First name should be greater than 2 characters.");
            $("#name_error").show();
            return;
        }

        if(name.length > 255){
            $("#name_error").text("First name should be less than 255 characters.");
            $("#name_error").show();
            return;
        }
        
        if(mobile.length > 255){
            $("#mobile_error").text("Mobile should be atleast 6 characters.");
            $("#mobile_error").show();
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

        var formData = new FormData($(".salesExecutiveForm")[0]);
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/sales-executive-create",
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

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    var redirect = "/admin/sales-executive";
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

    $('#create-sales-executive-modal').on('show.bs.modal', function (event) {
        
        $(".salesExecutiveForm")[0].reset();
        
        $("#name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();
    
    });

    
    $(".editSalesExecutive").on("click", function (event) {

        event.preventDefault();
        $("#name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();

        var name = $("#name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        
        if (name === "") {
            $("#name_error").show();
            return;
        }

        if (last_name === "") {
            $("#last_name_error").show();
            return;
        }
        
        if(email === ""){
            $("#email_error").show();
            return;
        }

        if(mob_code === ""){
            $("#mob_code_error").show();
            return;
        }

        if(mobile === ""){
            $("#mobile_error").show();
            return;
        }

        var formData = new FormData($(".salesExecutiveForm")[0]);
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/sales-executive-create",
            type: "post",
            data: formData,
            dataType: "json",
            contentType:false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (response.code === 200) {

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    var redirect = "/admin/sales-executive";
                    showModalWithRedirect(modalData, redirect);
                }

                if (response.code === 202) {
                    $(".errors").remove();
                    $("#create-modal").show();
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);

                    data.forEach(function (key) {
                        var value = response.data[key];
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

    $(document).on("click", ".deleteSalesExecutive", function () {
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
            const modalData = {
                title: "Delete Sales Executive",
                message: "Are you sure you want to delete sales executive?",
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
                    url: baseUrl + "/admin/sales-executive-delete",
                    type: "post",
                    data: { id: allVals,status: btoa('delete')},
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        $("#processingLoader").fadeOut();

                        const modalData = {
                            title: response.title,
                            message: response.message || "",
                            icon: response.icon,
                        };

                        var redirect = `/admin/sales-executive`;

                        showModalWithRedirect(modalData, redirect);
                    },
                });
            });
        }else{
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


    $(document).on("click", ".statusSalesExecutive", function (event) {
        var id = $(this).data("id");
        var status = $(this).data("status");
       
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/status-sales-executive",
            type: "post",
            data: { id: id,status: status},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                const modalData = {
                    title: response.title,
                    message: response.message,
                    icon: response.icon,
                }
                var redirect = "/admin/sales-executive";
                showModalWithRedirect(modalData, redirect);
            },
        });
        
    });    
});
