$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    
    $(".teacherCreate").on("click", function (event) {

        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#designation_error").hide();
        $("#file_error").hide();
        $("#email_error").hide();
        $("#about_teacher_error").hide();
        $("#category_error").hide();
        $("#resume_error").hide();

        var fname = $("#firstName").val();
        var lname = $("#lastName").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var confirm_password = $("#confirmPassword").val();
        var designation = $("#designation").val();
        var about_teacher = $("#aboutTeacher").val();
        var fileInput = $('#image_file')[0];
        var image_file = fileInput.files[0];
        var old_image_name = $("#old_img_name").val();
        var category_id = $("#category_id").val();
        var resume_file = $("#resume_file").val();
        var old_resume_name = $("#old_resume_name").val();
        var specialization= $("#specialization").val();


        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if(fname.length>20){
            $("#first_name_error").text("First name should be less than 20 characters");
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if(lname.length>20){
            $("#last_name_error").text("Last name should be less than 20 characters");
            $("#last_name_error").show();
            return;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(email != ''){
            if (!emailRegex.test(email)) {
                $('#email_error').show();
                return '';
            } 
        }
        if (designation === "") {
            $("#designation_error").show();
            return;
        }
        if(designation.length>100){
            $("#designation_error").text("Designation should be less than 100 characters");
            $("#designation_error").show();
            return;
        }
        if (category_id === "") {
            $("#category_error").show();
            return;
        }
        if (about_teacher === "") {
            $("#about_teacher_error").show();
            return;
        }
        if(old_image_name == undefined){
            if(image_file == undefined){
                $("#file_error").show();
                return;
            }
        }

        // if(old_resume_name == undefined || old_resume_name == ''){
        //     if(resume_file == undefined || resume_file == ''){
        //         alert("sdfsf");
        //         $("#resume_error").show();
        //         return;
        //     }
        // }
        // if (specialization === "") {
        //     $("#specialization_error").show();
        //     return;
        // }
        var formData = new FormData($(".TeacherForm")[0]);
        formData.append('image_file', image_file);   
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/teacher-create",
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
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/teacher";
                    // });
                        
                    const modalData = {
                        title: response.title,
                        message: response.message || "",
                        icon: response.icon,
                    };

                    var redirect = `/admin/teacher`;

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
                        }else if(key === 'image_file'){
                            var errorDiv = $(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                            $("form")
                                .find("[name='" + key + "']")
                                .after(errorDiv);
                            $("form")
                                .find("#file_error")
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
                    };
                    showModal(modalData);
                }
                
                
            },
        });
    });

    $(document).on("click", ".deleteTeacher", function (event) {
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
            //     title: "Delete Teacher",
            //     text: "Are you sure you want to delete teacher?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
            
            const modalData = {
                title: "Delete Teacher",
                message: "Are you sure you want to delete teacher?",
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
                        url: baseUrl + "/admin/delete-teacher",
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
                            //         "/admin/teacher");
                            // });

                            const modalData = {
                                title: response.title,
                                message: response.message,
                                icon: response.icon,
                            }
                            var redirect = "/admin/teacher";
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
    $(document).on("click", ".statusTeacher", function (event) {
        var teacher_id = $(this).data("teacher_id");
        var status = $(this).data("status");
       
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/delete-teacher",
            type: "post",
            data: { id: teacher_id,status: status},
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
                //         "/admin/teacher");
                // });
                
                const modalData = {
                    title: response.title,
                    message: response.message,
                    icon: response.icon,
                }
                var redirect = "/admin/teacher";
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

    $(".testimonalsCreate").on("click", function (event) {

        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#designation_error").hide();
        $("#file_error").hide();
        $("#feedback_error").hide();

        var fname = $("#first_name").val();
        var lname = $("#last_name").val();
        var designation = $("#designation").val();
        var feedback = $("#feedback").val();
        var fileInput = $('#image_file')[0];
        var image_file = fileInput.files[0];
        var old_image_name = $("#old_img_name").val();



        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if(fname.length>20){
            $("#first_name_error").text("First name should be less than 20 characters");
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if(lname.length>20){
            $("#last_name_error").text("Last name should be less than 20 characters");
            $("#last_name_error").show();
            return;
        }

        if (designation === "") {
            $("#designation_error").show();
            return;
        }
        if(designation.length>100){
            $("#designation_error").text("Designation should be less than 100 characters");
            $("#designation_error").show();
            return;
        }
     
        if (feedback === "") {
            $("#feedback_error").show();
            return;
        }
        if(old_image_name == undefined){
            if(image_file == undefined){
                $("#file_error").show();
                return;
            }
        }

        var formData = new FormData($(".TestimonialForm")[0]);
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/testimonials-create",
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
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/teacher";
                    // });
                        
                    const modalData = {
                        title: response.title,
                        message: response.message || "",
                        icon: response.icon,
                    };

                    var redirect = `/admin/testimonials`;

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
                        if(key === 'image_file'){
                            var errorDiv = $(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                            $("form")
                                .find("[name='" + key + "']")
                                .after(errorDiv);
                            $("form")
                                .find("#file_error")
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
                    };
                    showModal(modalData);
                }
                
                
            },
        });
    });

    $(document).on("click", ".deleteTestimonials", function (event) {
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

            const modalData = {
                title: "Delete Testimonials",
                message: "Are you sure you want to delete testimonials?",
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
                        url: baseUrl + "/admin/delete-testimonials",
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
                                message: response.message,
                                icon: response.icon,
                            }
                            var redirect = "/admin/testimonials";
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
    $(document).on("click", ".statusTestimonials", function (event) {
        var testimonial_id = $(this).data("testimonial_id");
        var status = $(this).data("status");
       
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/delete-testimonials",
            type: "post",
            data: { id: testimonial_id,status: status},
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
                var redirect = "/admin/testimonials";
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
});
