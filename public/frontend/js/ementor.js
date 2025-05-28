
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var userRole = "{{ Auth::user()->role }}";
    if(userRole === 'sub-instructor'){
        var ementorBaseUrl = window.location.origin + "/sub-ementor";
    }else{
        var ementorBaseUrl = window.location.origin + "/ementor";
    }
    var reader = new FileReader();
    var img = new Image();
    $(".updateEmentorProfile").on("click", function (event) {
        event.preventDefault();

        var form = new FormData($(".ementorProfileData")[0]);
        
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#dob_error").hide();
        $("#gender_error").hide();
        $("#country_error").hide();
        $("#city_error").hide();
        $("#nationality_error").hide();
        $("#address_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();



        // if (gender === "") {
        //     $("#gender_error").show();
        //     return;
        // }
        // alert(country);
        // if (country === "") {
        //     $("#country_error").show();
        //     return;
        // }

        // if (nationality === "") {
        //     $("#nationality_error").show();
        //     return;
        // }
        // if (address === "") {
        //     $("#address_error").show();
        //     return;
        // }
    

        // var form = $(".ementorProfileData").serialize();
        // var form = new FormData($(".ementorProfileData")[0]);
        
        $("#highest_education_error").hide();
        $("#specialization_error").hide();
        $("#institution_name_error").hide();
        $("#ementor_resume_error").hide();
        

        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var birth = $("#birth").val();
        var gender = $("#gender").val();
        var country = $("#country").val();
        var nationality = $("#nationality").val();
        var address = $("#address").val();


        
        var highest_education = $("#highest_education").val();
        var specialization = $("#specialization").val();
        var institution_name = $("#institution_name").val();
        // var ementor_resume = $("#ementor_resume")[0].files[0];
        

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if(fname.length >20) {
            $("#first_name_error").text("First name should be less than 20 characters.");
            $("#first_name_error").show();
            return;
        }
        if (lname === "") {
            $("#last_name_error").show();
            return;
        }
        if(lname.length>20){
            $("#last_name_error").text("Last name should be less than 20 characters.");
            $("#last_name_error").show();
            return;
        }
        if (birth === "") {
            $("#dob_error").show();
            return;
        }
        if (gender === "") {
            $("#gender_error").show();
            return;
        }
        if (country === "") {
            $("#country_error").show();
            return;
        }
        if (nationality === "") {
            $("#nationality_error").show();
            return;
        }
        if(nationality.length>50){
            $("#nationality_error").text("Nationality should be less than 50 characters.");
            $("#nationality_error").show();
            return;
        }
        if (address === "") {
            $("#address_error").show();
            return;
        }
        if(address.length>100){
            $("#address_error").text("Address should be less than 100 characters.");
            $("#address_error").show();
            return;
        }
        if (highest_education === "") {
            $("#highest_education_error").show();
            return;
        }
        if (specialization === "") {
            $("#specialization_error").show();
            return;
        }
        if(specialization.length>50){
            $("#specialization_error").text("Specialization should be less than 50 characters.");
            $("#specialization_error").show();
            return;
        }
        if (institution_name === "") {
            $("#institution_name_error").show();
            return;
        }
        if(institution_name.length>50){
            $("#institution_name_error").text("Institution name should be less than 50 characters.");
            $("#institution_name_error").show();
            return;
        }
        var fileInput = $("#ementor_resume")[0];
        if (fileInput.files.length == 0) {
            $("#ementor_resume_error").show();
            return;
        }
        if (fileInput === "") {
            $("#ementor_resume_error").show();
            return;
        }

        $("#loader").fadeIn();
        swal({
            title: "Are you sure?",
            text: "Are you sure once submitted details not editable.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willSubmit) => {
            if (willSubmit) {
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: ementorBaseUrl + "/ementor-profile-update",
                    type: "post",
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        $("#loader").fadeOut();
                        $("#processingLoader").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(() => {
                                location.reload();
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
            }
        });
    });
    
    $("#ementor_resume").on("change", function (event) {
        var file = event.target.files[0];
        $(".input-visible").text(file.name);
    });


    $(".updateSocialProfile").on("click", function (event) {
        event.preventDefault();
        var facebook = $(".facebook").val();
        var instagram = $(".instagram").val();
        var linkedin = $(".linkedin").val();
        var twitter = $(".twitter").val();
        var form = $(".socialProfileForm").serialize();
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: ementorBaseUrl + "/ementor-social-update",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#loader").fadeOut();
                $("#processingLoader").fadeOut();
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModal(modalData);
                }
            },
        });
    });

    $(".ementorAboutSubmit").on("click", function (event) {
        event.preventDefault();

        var form = $(".ementorAboutme").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: ementorBaseUrl + "/ementor-aboutme",
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
            },
        });
    });

    $(".ementorprofilePic").on("change", function () {
        // $("#loader").fadeIn();

        var currnetForm = $(this).closest("form");
        var currnetimg = $(this).closest("img");
        var form = new FormData(currnetForm[0]);
        // var old_img = $(".curr_img").val();
        $.ajax({
            url: ementorBaseUrl + "/add-ementor-profile-image",
            type: "POST",
            dataType: "json",
            data: form,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $("#loader").fadeOut();

                if (response.code == 200) {
                    currnetForm.find(".curr_img").prop("value", +response.new);
                    swal({
                        title: response.message,
                        text: response.text,
                        icon: "success",
                    });
                } else {
                    currnetimg
                        .find(".imagePreview")
                        .prop("src", baseUrl + "/storage/" + response.old);
                    swal({
                        title: response.message,
                        text: response.text,
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(error);
                $("#result").html("An error occurred.");
            },
        });
    });

    $("#inputLogo").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        $(".input-visible").text(file.name);
    });
    $(document).on("click", ".genCert", function (event) {
        var student_id = $(this).data("student_id");
        const userRole = $(this).data('role');
        if (student_id != undefined) {
            swal({
                title: "Generate Certificate",
                text: "Are you sure you want to Generate Certificate ? It can not be Revoked.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");

                    const generateCertUrl = userRole === "superadmin"
                        ? `/admin/generate-cert`
                        : `/ementor/generate-cert`;
                    $.ajax({
                        url: baseUrl + generateCertUrl,
                        type: "POST",
                        data: { id: student_id },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            $(".save_loader")
                                .addClass("d-none")
                                .removeClass("d-block");
                                localStorage.setItem("deployOnBlockChainTab", true);
                                localStorage.setItem("transferToStudentTab", false);
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(function () {
                                return window.location.reload();
                            });
                            //     .then(function () {
                            //     return (window.location.href = Pagereturn);
                            // });
                        },
                    });
                }
            });
        } else {
            swal({
                title: "",
                text: "Please Select At Least One Record",
                icon: "warning",
                buttons: true,
            });
        }
    });
});