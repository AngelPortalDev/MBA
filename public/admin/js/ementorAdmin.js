$(document).ready(function () {

    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var warningIconPath = baseUrl+"/frontend/images/icons/exclamation mark.gif";
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    $("#ementor-create-modal").on("hidden.bs.modal", function () {
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();
        // Clear modal content to prepare for next load
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
        $("#mob_code").val("");
        $("#mobile").val("");
        $("#password").val("");
        $("#ConfirmPassword").val("");
    });

    $(".createEmentor").on("click", function (event) {
        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();

        var fname = $("#first_name").val();

        var lname = $("#last_name").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var ConfirmPassword = $("#ConfirmPassword").val();

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if (fname.length > 20) {
            $("#first_name_error").text(
                "First name should be less than 20 characters."
            );
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if (lname.length > 20) {
            $("#last_name_error").text(
                "Last name should be less than 20 characters."
            );
            $("#last_name_error").show();
            return;
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
        if (password.length > 20) {
            $("#password_error").text(
                "Password should be less than 20 characters."
            );
            $("#password_error").show();
            return;
        }
        if (ConfirmPassword === "") {
            $("#confirm_password_error").show();
            return;
        }
        if (ConfirmPassword.length > 20) {
            $("#confirm_password_error").text(
                "Confirm password should be less than 20 characters."
            );
            $("#confirm_password_error").show();
            return;
        }
        var form = $(".ementorData").serialize();
        $("#loader").fadeIn();
        if (this.reportValidity()) {
            $.ajax({
                url: baseUrl + "/admin/ementor-create",
                type: "post",
                data: form,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $("#loader").fadeOut();
                    if (response.code === 200 || response.code === 201) {
                        $(".errors").remove();
                        $("#ementor-create-modal").modal("hide");

                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        };
                        showModal(modalData);
                        
                        AllEmentorList("all");
                    }
                    if (response.code === 202) {
                        $(".errors").remove();

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
                },
            });
        }
    });
    $(document).on("click", ".deleteEmentor", function () {
        var myEmentorId = $(this).data("id");
        // $(".modal-body #ementorId").val(myEmentorId);
        var allVals = [];
        var source = $(this).data("source");
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
                title: `Delete ${source.charAt(0).toUpperCase() + source.slice(1)}`,
                message: `Are you sure you want to delete ${source.charAt(0) + source.slice(1)}?`,
                icon: warningIconPath,
            };
              
            showModal(modalData, true);

            // swal({
            //     title: `Delete ${
            //         source.charAt(0).toUpperCase() + source.slice(1)
            //     }`,
            //     text: `Are you sure you want to delete ${
            //         source.charAt(0) + source.slice(1)
            //     }?`,
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
                

                $("#modalCancel").on("click", function () {
                    $("#customModal").hide();
                });
                $("#modalOk").on("click", function () {
                    $("#customModal").hide();
                    // $(".save_loader").removeClass("d-none").addClass("d-block");
                    $("#processingLoader").fadeIn();
                    $.ajax({
                        url: baseUrl + "/admin/ementor-delete",
                        type: "post",
                        data: {
                            id: allVals,
                            status: btoa("delete"),
                            source: source,
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");

                            $("#processingLoader").fadeOut();
                                    
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };

                            var redirect = `/admin/${source}s`;

                            showModalWithRedirect(modalData, redirect);
                        
                            // showModal(modalData);
                            // return (window.location.href = `/admin/${source}s`);

                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // }).then(function () {
                                //     return (window.location.href = `/admin/${source}s`);
                                // });

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
            // });
        } else {
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

    $(document).on("click", ".statusEmentor", function (event) {
        var ementor_id = $(this).data("ementor_id");
        var status = $(this).data("status");
        $(".save_loader").removeClass("d-none").addClass("d-block");
        var source = $(this).data("source");
        $.ajax({
            url: baseUrl + "/admin/status-ementor",
            type: "post",
            data: { id: ementor_id, status: status, source: source },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").removeClass("d-block");
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // }).then(function () {
                //     return (window.location.href = `/admin/${source}s`);
                // });
                    
                const modalData = {
                    title: response.title,
                    message: response.message || "",
                    icon: response.icon,
                };

                var redirect = `/admin/${source}s`;

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

    $(".editEmentorProfile").on("click", function (event) {
        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();

        var fname = $("#first_name").val();

        var lname = $("#last_name").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
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
        // var form = $(".profileData").serialize();
        var form = new FormData($(".profileData")[0]);
        $("#loader").fadeIn();
        if (this.reportValidity()) {
            $.ajax({
                url: baseUrl + "/admin/e-mentors-profile-edit",
                type: "post",
                data: form,
                dataType: "json",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $("#loader").fadeOut();
                    if (response.code === 200 || response.code === 201) {
                        $(".errors").remove();
                        $("#ementor-create-modal").modal("hide");

                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        };
                        showModal(modalData);

                        // AllEmentorList("all");
                    }
                    if (response.code === 202) {
                        $(".errors").remove();

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
                                $("form").find(".address").after(errorDiv);
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
                },
            });
        }
    });

    $(".profileEmentorPic").on("change", function () {
        // $("#loader").fadeIn();
        var fileInput = $("#imageUpload_profile")[0];
        var file = fileInput.files[0];
        var currnetForm = $(this).closest("form");
        var currnetimg = $(this).closest("img");
        var formData = new FormData($(".profileImage")[0]);
        formData.append("image_file", file);

        $.ajax({
            url: baseUrl + "/admin/add-ementor-profile-image",
            type: "post",
            data: formData,
            dataType: "json",
            contentType: false,
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

    $("#deleteEmentor").on("click", function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr("data-id"));
        });
        if ($(this).attr("data-id") == undefined) {
            var deletevalue = $("#ementorId").val();
            if (deletevalue) {
                allVals.push(deletevalue);
            }
        }
        if (allVals.length <= 0) {
            $("#alert-modal").modal("show");
            return false;
        } else {
            var join_selected_values = allVals.join(",");
            $.ajax({
                url: baseUrl + "/admin/ementor-delete",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                data: "ementor_id=" + join_selected_values,
                success: function (response) {
                    if (response.code === 200 || response.code === 201) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     return (window.location.href = "/admin/e-mentors");
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
                },
            });
        }
    });
});