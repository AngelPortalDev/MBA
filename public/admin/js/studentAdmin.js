$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();
    // $('.mob_code').select2();

    $(".section-student-tab").on("click", function (event) {
        event.preventDefault();
        studentList($(this).data("cat"));
    });
    $('#searchInput').on('keyup', function() {
        var table = $('.studentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $(".updateProfile").on("click", function (event) {
        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#dob_error").hide();
        $("#gender_error").hide();
        $("#country_error").hide();
        $("#city_error").hide();
        $("#zip_error").hide();
        $("#nationality_error").hide();

        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var birth = $("#birth").val();
        var gender = $("#gender").val();
        var country = $("#country").val();
        var city = $("#city").val();
        var zip = $("#zip").val();
        var nationality = $("#nationality").val();

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if (birth === "") {
            $("#dob_error").show();
            return;
        }
        // if (gender === "") {
        //     $("#gender_error").show();
        //     return;
        // }
        if (country === "") {
            $("#country_error").show();
            return;
        }
        if (city === "") {
            $("#city_error").show();
            return;
        }
        // if (zip === "") {
        //     $("#zip_error").show();
        //     return;
        // }
        // if (nationality === "") {
        //     $("#nationality_error").show();
        //     return;
        // }
        var form = $(".ProfileData").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/student/profile-update",
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
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    });
                }
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);

                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".errors").remove();
                        $("form")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                }
            },
        });
    });
    $(".verifyDoc").on("click", function (event) {
        event.preventDefault();

        $("#name_error").hide();
        $("#id_name_error").hide();
        $("#doc_id_error").hide();
        $("#expiry_error").hide();
        $("#issuing_country_error").hide();
        $("#approval_error").hide();
        $("#doc_authority_error").hide();

        var name_person = $("#name_person").val();
        var proof_name = $("#proof_name").val();
        var doc_id_no = $("#doc_id_no").val();
        var expiry_date = $("#expiry_date").val();
        var country = $("#issue_country").val();
        var id_doc_status = $(".id_doc_status").val();
        var id_doc_status = "";
        var Authority = $("#Authority").val();

        if ($(".id_doc_status1").is(":checked")) {
            id_doc_status = $(".id_doc_status1").val();
        }
        if ($(".id_doc_status2").is(":checked")) {
            id_doc_status = $(".id_doc_status2").val();
        }       
        var status = id_doc_status === "1" ? "Approve" : "Reject";
        var status_text = id_doc_status === "1" ? "approve" : "reject";

        if (name_person === "") {
            $("#name_error").show();
            return;
        }
        if (proof_name === "") {
            $("#id_name_error").show();
            return;
        }
        if (doc_id_no === "") {
            $("#doc_id_error").show();
            return;
        }
        if(Authority === ""){
            $("#doc_authority_error").show();
            return;
        }
        if (expiry_date === "") {
            $("#expiry_error").show();
            return;
        }
        if (country === "") {
            $("#issuing_country_error").show();
            return;
        }
        if (id_doc_status === "") {
            $("#approval_error").show();
            return;
        }

        // swal({
        //     title: status,
        //     text: "Are you sure you want to " + status_text + "?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $(".save_loader").removeClass("d-none");
        
        const modalData = {
            title: "status",
            message: "Are you sure you want to " + status_text + "?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
                var form = $(".studentDoc").serialize();
                $.ajax({
                    url: baseUrl + "/admin/student-doc-verify",
                    type: "post",
                    data: form,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader").fadeOut();
                        $("#processingLoader").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return window.location.reload();
                            // });
                            const modalData = {
                                title: response.title,
                                message: response.message || '',
                                icon: response.icon,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        if (response.code === 202) {
                            var data = Object.keys(response.data);
                            var values = Object.values(response.data);
                            data.forEach(function (key) {
                                var value = response.data[key];
                                $(".errors").remove();
                                $("form")
                                    .find("[name='" + key + "']")
                                    .after(
                                        "<div class='invalid-feedback errors d-block'><i>" +
                                            value +
                                            "</i></div>"
                                    );
                            });
                        }
                    },
                });
        });
    });
    $(".verifyEduDoc").on("click", function (event) {
        event.preventDefault();

        $("#edu_level_error").hide();
        $("#specilization_error").hide();
        $("#eduStudentName_error").hide();
        $("#institue_name_error").hide();
        $("#passsingYear_error").hide();
        $("#eduDocName_error").hide();
        $("#eduDocId_error").hide();
        $("#eduGrade_error").hide();
        $("#eduRemark_error").hide();
        $("#edu_doc_status_error").hide();

        var edu_level = $("#edu_level").val();
        var specilization = $("#specilization").val();
        var eduStudentName = $("#eduStudentName").val();
        var institue_name = $("#institue_name").val();
        var passsingYear = $("#passsingYear").val();
        var eduDocName = $("#eduDocName").val();
        var eduDocId = $("#eduDocId").val();
        var eduGrade = $("#eduGrade").val();
        var eduRemark = $("#eduRemark").val();
        var edu_doc_status = "";
        if ($(".edu_doc_status1").is(":checked")) {
            edu_doc_status = $(".edu_doc_status1").val();
        }
        if ($(".edu_doc_status2").is(":checked")) {
            edu_doc_status = $(".edu_doc_status2").val();
        }
        var status = edu_doc_status === "1" ? "Approve" : "Reject";
        var status_text = edu_doc_status === "1" ? "approve" : "reject";


        if (edu_level == 0) {
            $("#edu_level_error").show();
            return;
        }
        if (specilization === "") {
            $("#specilization_error").show();
            return;
        }
        if (eduStudentName === "") {
            $("#eduStudentName_error").show();
            return;
        }
        if (institue_name === "") {
            $("#institue_name_error").show();
            return;
        }
        if (passsingYear === "") {
            $("#passsingYear_error").show();
            return;
        }
        if (eduDocName === "") {
            $("#eduDocName_error").show();
            return;
        }
        if (eduDocId === "") {
            $("#eduDocId_error").show();
            return;
        }
        if (eduGrade === "") {
            $("#eduGrade_error").show();
            return;
        }
        if (eduRemark === "") {
            $("#eduRemark_error").show();
            return;
        }
        if (edu_doc_status === "") {
            $("#edu_doc_status_error").show();
            return;
        }
        // swal({
        //     title: status ,
        //     text: "Are you sure you want to " + status_text + "?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $(".save_loader").removeClass("d-none");

        const modalData = {
            title: "status",
            message: "Are you sure you want to " + status_text + "?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
                var form = $(".studentEduDoc").serialize();
                $("#loader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/student-edu-doc-verify",
                    type: "post",
                    data: form,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader").fadeOut();
                        $("#processingLoader").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return window.location.reload();
                            // });

                            const modalData = {
                                title: response.title,
                                message: response.message || '',
                                icon: response.icon,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        if (response.code === 202) {
                            var data = Object.keys(response.data);
                            var values = Object.values(response.data);
                            data.forEach(function (key) {
                                var value = response.data[key];
                                $(".errors").remove();
                                $("form")
                                    .find("[name='" + key + "']")
                                    .after(
                                        "<div class='invalid-feedback errors d-block'><i>" +
                                            value +
                                            "</i></div>"
                                    );
                            });
                        }
                    },
                });
        });
    });
    $("#studentCreate").on("click", function (event) {
        event.preventDefault();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#password_error").hide();
        $("#confirm_password_error").hide();

        var fname = $("#fname").val();
        var lname = $("#LastName").val();
        var email = $("#email").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var ConfirmPassword = $("#ConfirmPassword").val();

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if(fname.length>20){
            $("#first_name_error").text("First name should be less than 20 characters.")
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if(lname.length>20){
            $("#last_name_error").text("Last name should be less than 20 characters.")
            $("#last_name_error").show();
            return;
        }
        if (email === "") {
            $("#email_error").show();
            return;
        }
        if (mob_code === "" || mobile === "") {
            $("#mobile_error").show();
            return;
        }
        if (password === "") {
            $("#password_error").show();
            return;
        }
        if (password.length > 20) {
            $("#password_error").text("Password should be less than 20 characters")
            $("#password_error").show();
            return;
        }
        if (ConfirmPassword === "") {
            $("#confirm_password_error").show();
            return;
        }
        if(ConfirmPassword.length>20){
            $("#confirm_password_error").text("Confirm password should be less than 20 characters")
            $("#confirm_password_error").show();
            return;
        }

        var form = $(".studentFrom").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/student-create",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#loader").fadeOut();
                if (response.code === 200) {
                    $("#create-modal").modal("hide");
                    $(".studentFrom")[0].reset();
                    $(".errors").remove();
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
                    studentList("all");
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
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // });
            },
        });
    });
    $(".deleteEntity").on("click", function () {
        var form = $(".actionData").serialize();
        swal({
            title: "Remove",
            text: "Are you sure you want to remove?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $("#process_loader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/student-delete",
                    type: "POST",
                    data: form,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    // dataType: "application/json",
                    success: function (response) {
                        if (response.code === 200) {
                            swal({
                                title: response.title,
                                text: "",
                                icon: response.icon,
                            });
                            $("#process_loader").fadeOut();
                            studentList("all").reload();
                        }
                        swal({
                            title: response.title,
                            text: "",
                            icon: response.icon,
                        });
                    },
                });
            }
        });
    });
    $(".image").on("change", function () {
        var currnetForm = $(this).closest("form");
        $("#img_size_error").hide();
        var logo = this.files[0];
        var size = logo.size / 1024;
        if (logo) {
            reader.onload = function (e) {
                img.src = e.target.result;
                e.preventDefault();
                currnetForm.find(".imageAdminPreview").attr("src", e.target.result);
            };
            reader.readAsDataURL(logo);
        }
    });
    $(".profileStudentPic").on("change", function () {
        // $("#loader").fadeIn();
        var fileInput = $('#imageUpload_profile')[0];
        var file = fileInput.files[0];
        var currnetForm = $(this).closest("form");
        var currnetimg = $(this).closest("img");
        var form = $(".proflilImage").serialize();     
        // form.append('image_file', file);   
         var formData = new FormData($(".proflilImage")[0]);
         formData.append('image_file', file);   
        $.ajax({
            url: baseUrl + "/admin/add-student-profile-image",
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

    // $(document).ready(function() {

    $("#printButton").click(function() {
        $(".header, .footer, .no-print").hide(); // Hide header, footer, and any non-print elements
        $("#invoice").addClass('print-card'); // Add class to format card for printing
        window.print(); // Initiate print
        $("#invoice").removeClass('print-card'); // Remove class after printing
        $(".header, .footer, .no-print").show(); // Show them again after printing
    });

    $(document).on("click", ".statusStudent", function (event) {
        var student_id = $(this).data("student_id");
        var status = $(this).data("status");
       
        var role = $(this).data("role");
     
 
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/status-student",
            type: "post",
            data: { id: student_id,status: status},
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
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // }).then(function () {
                //     return (window.location.href =
                //         "/admin/"+role);
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

    $(document).on("click", ".deleteStudent", function (event) {

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
            //     title: "Delete Student",
            //     text: "Are you sure you want to delete student?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

                const modalData = {
                    title: "Delete Student",
                    message: "Are you sure you want to delete student?",
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
                        url: baseUrl + "/admin/delete-student",
                        type: "post",
                        data: { id: allVals},
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
                            //         "/admin/students");
                            // });
                            
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };

                            var redirect = `/admin/students`;

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

    $(".verifyResearchDoc").on("click", function (event) {
        event.preventDefault();

        $("#research_doc_status_error").hide();

        var research_doc_status = "";
        if ($(".research_doc_status1").is(":checked")) {
            research_doc_status = $(".research_doc_status1").val();
        }
        if ($(".research_doc_status2").is(":checked")) {
            research_doc_status = $(".research_doc_status2").val();
        }
        if ($(".research_doc_status3").is(":checked")) {
            research_doc_status = $(".research_doc_status3").val();
        }
        // var status = research_doc_status === "1" ? "Approve" : "Reject";
        // var status_text = research_doc_status === "1" ? "Approve" : "reject";
        if(research_doc_status == '1'){
            var status = 'Approve';
            var status_text="Approve";
        }else if(research_doc_status == '0'){
            var status = 'Reject';
            var status_text="Reject";
        }else if(research_doc_status == '2'){
            var status = 'Reupload';
            var status_text="reupload";
        }

        const modalData = {
            title: "status",
            message: "Are you sure you want to " + status_text + " document ?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
                var form = $(".studentResearchDoc").serialize();
                $("#loader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/student-research-doc-verify",
                    type: "post",
                    data: form,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader").fadeOut();
                        $("#processingLoader").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return window.location.reload();
                            // });

                            const modalData = {
                                title: response.title,
                                message: response.message || '',
                                icon: response.icon,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        
                    },
                });
        });
    });

    
    
    $("#CoursePurchaseSubmit").on("click", function (event) {
        event.preventDefault(); //
        var student_id = $(".student_id").val();
        var course_id = $(".course_id").val();

        $.ajax({
            url: baseUrl + "/admin/student-course-purchase",
            type: "post",
            data: {
                'student_id':student_id,
                'course_id':course_id
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {

                console.log(response);
                $('#optionalCourseModal').modal('hide');
                $("#processingLoader").fadeOut();
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        });


    });
    // });
});
// Update My Profile info


