$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var studentBaseUrl = window.location.origin + "/student";
    var reader = new FileReader();
    var img = new Image();
    // Update My Profile info
    $(".updateProfile").on("click", function (event) {
        event.preventDefault();

        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#dob_error").hide();
        $("#gender_error").hide();
        $("#country_error").hide();
        $("#city_error").hide();
        // $("#nationality_error").hide();
        $("#address_error").hide();
        $("#mob_code_error").hide();
        $("#mobile_error").hide();
        $("#zip_error").hide();
        $("#nationality_error").hide();
        // $("#charCountWarning").hide();

        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var birth = $("#birth").val();
        var gender = $("#gender").val();
        var country = $("#country").val();
        var city = $("#city").val();
        var nationality = $("#nationality").val();
        var address = $("#address").val();
        var mob_code = $("#mob_code").val();
        var mobile = $("#mobile").val();
        var zip = $("#zip").val();
        var nationality = $("#nationality").val();

        if (fname === "") {
            $("#first_name_error").show();
            return;
        }
        if(fname.length > 20){
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
        if (mob_code === "") {
            $("#mob_code_error").show();
            return;
        }
        if (mobile === "") {
            $("#mobile_error").show();
            return;
        }
        // if (gender === "") {
        //     $("#gender_error").show();
        //     return;
        // }
        // alert(country);
        if (country === "") {
            $("#country_error").show();
            return;
        }
        if (city === "") {
            $("#city_error").show();
            return;
        }
        if(city.length>50){
            $("#city_error").text("City should be less than 50 characters.");
            $("#city_error").show();
            return;
        }
        // if (nationality === "") {
        //     $("#nationality_error").show();
        //     return;
        // }
        // if (address === "") {
        //     $("#address_error").show();
        //     return;
        // }
        if(zip.length > 15){
            $("#zip_error").text("Postal code should be less than 15 characters.");
            $("#zip_error").show();
            return;
        }
        if(nationality.length > 50){
            $("#nationality_error").text("Nationality should be less than 50 characters.");
            $("#nationality_error").show();
            return;
        }
        if(address.length > 100){
            $("#address_error").text("Address should be less than 100 characters.");
            $("#address_error").show();
            return;
        }

        var form = $(".ProfileData").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: studentBaseUrl + "/profile-update",
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

    // English Testing Submit
    $("#englishSubmit").on("click", function (event) {
        event.preventDefault();
        var formData = $(".englishTest").serialize();

        $(".save_loader").removeClass("d-none").fadeIn();
        $.ajax({
            url: studentBaseUrl + "/english-test-submit",
            type: "POST",
            data: formData,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").fadeOut();
                let title = response.title;
                let message = response.message;
                let code = response.code;
                let icon = response.icon;
                if (code === 200 && response.data.english_score < 10 && response.data.english_test_attempt == 1) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     $("#exampleModalToggle4").modal("hide");
                    //     $("#exampleModalToggle3").modal("hide");
                    //     $("#exampleModalToggle2").modal("hide");
                    //     $("#exampleModalToggle1").modal("hide");
                    //     $("#english_test_marks").val("<p class='text-primary fs-3'>Your Score:"+ response.data.english_score+"/20 <br> <span class='fs-4 text-success'> ["+response.data.score_level_text+"]</span></p>");
                    //     $("#english_test_marks").html("<p class='text-primary fs-3'>Your Score:"+ response.data.english_score+"/20 <br> <span class='fs-4 text-success'> ["+response.data.score_level_text+"]</span></p>");
                       
                    //     $("#FailModel").modal('show');
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        $("#exampleModalToggle4").modal("hide");
                        $("#exampleModalToggle3").modal("hide");
                        $("#exampleModalToggle2").modal("hide");
                        $("#exampleModalToggle1").modal("hide");
                        $("#english_test_marks").val("<p class='text-primary fs-3'>Your Score:"+ response.data.english_score+"/20 <br> <span class='fs-4 text-success'> ["+response.data.score_level_text+"]</span></p>");
                        $("#english_test_marks").html("<p class='text-primary fs-3'>Your Score:"+ response.data.english_score+"/20 <br> <span class='fs-4 text-success'> ["+response.data.score_level_text+"]</span></p>");
                       
                        $("#FailModel").modal('show');
                    }, 2000);
                }else if (code === 200) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     $("#exampleModalToggle4").modal("hide");
                    //     $("#exampleModalToggle3").modal("hide");
                    //     $("#exampleModalToggle2").modal("hide");
                    //     $("#exampleModalToggle1").modal("hide");
                    //     $("#mainTestId").hide();
                    //     $("#resultCard").show();
                    //     $("#instructionModal").modal('hide');
                    //     $("#english_score_value").val(response.data.english_score);
                    //     $("#english_score_value").html(response.data.english_score);
                    //     $("#english_score_level_text").val(response.data.score_level_text);
                    //     $("#english_score_level_text").html(response.data.score_level_text);
                    //     document.getElementById('resultCard').style.display = 'block';
                    //     document.getElementById('mainTestId').style.display='none';
                    //     document.getElementById('english-test-page').style.display='none';
                    //     // window.location.reload();
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        $("#exampleModalToggle4").modal("hide");
                        $("#exampleModalToggle3").modal("hide");
                        $("#exampleModalToggle2").modal("hide");
                        $("#exampleModalToggle1").modal("hide");
                        $("#mainTestId").hide();
                        $("#resultCard").show();
                        $("#instructionModal").modal('hide');
                        $("#english_score_value").val(response.data.english_score);
                        $("#english_score_value").html(response.data.english_score);
                        $("#english_score_level_text").val(response.data.score_level_text);
                        $("#english_score_level_text").html(response.data.score_level_text);
                        document.getElementById('resultCard').style.display = 'block';
                        document.getElementById('mainTestId').style.display='none';
                        document.getElementById('english-test-page').style.display='none';
                    }, 2000);
                } else {
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
    
    $("#englishTestForm").on("submit", function(e) {
        e.preventDefault();
        let passCode = $("#englist_test_pass_code").val().trim();
        let passCodeError = $("#englist_test_pass_code_error");

        passCodeError.text("").hide();

        // Validation: Must be exactly 6 digits
        if (!/^\d{6}$/.test(passCode)) {
            passCodeError.text("English Test Pass Code must be exactly 6 digits.").show();
            return;
        }

        let formData = $(this).serialize();

        $("#processingLoader").fadeIn();
        $.ajax({
            url: studentBaseUrl + "/verify-english-test-code",
            type: "POST",
            data: formData,
            success: function(response) {
                $("#processingLoader").fadeOut();
                
                if (response.code === 200) {
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                }
            },
            error: function(xhr) {
                const modalData = {
                    title: response.title,
                    message: response.message,
                    icon: response.icon,
                }
                showModal(modalData);
            }
        });
    });

    $("#FailSubmit").on("click", function (event) {
        return window.location.href=studentBaseUrl + '/student-my-learning';
    });
    // Update Social Profile Info
    $(".updateSocialProfile").on("click", function (event) {
        event.preventDefault();

        // $("#facebook_error").hide();
        // $("#insta_error").hide();
        // $("#linkedin_error").hide();
        // $("#twitter_error").hide();
        // $("#whatsapp_error").hide();

        var facebook = $(".facebook").val();
        var insta = $(".insta").val();
        var linkedin = $(".linkedin").val();
        var twitter = $(".twitter").val();
        var whatsapp = $(".whatsapp").val();
        var regEx = "/^(https?|ftp)://[^s/$.?#].[^s]*$/";
        // if (!regEx.test(facebook)) {
        //     $(".facebook_error").addClass("d-block");
        //     return;
        // }
        // if (!regEx.test(insta)) {
        //     $("#insta_error").show();
        //     return;
        // }
        // if (!regEx.test(linkedin)) {
        //     $("#linkedin_error").show();
        //     return;
        // }
        // if (!regEx.test(twitter)) {
        //     $("#twitter_error").show();
        //     return;
        // }

        var form = $(".socialProfileForm").serialize();

        $(".save_loader").removeClass("d-none").fadeIn();
        // if (facebook != "" || insta != "" || twitter != "" || linkedin != "") {
        $.ajax({
            url: studentBaseUrl + "/student-social-update",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").fadeOut();
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
        // } else {
        //     swal({
        //         title: "Kindly Provide Links",
        //         text: "",
        //         icon: "warning",
        //     });
        // }
    });

    $(".aboutMe").on("click", function (event) {
        event.preventDefault();

        var form = $(".aboutmeData").serialize();
        $(".save_loader").removeClass("d-none").fadeIn();
        $.ajax({
            url: studentBaseUrl + "/student-aboutme",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").fadeOut();
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

    $(".closeAccount").on("click", function (event) {
        event.preventDefault();
        var user_id = $("#user_id").val();
        swal({
            title: "Deactivate",
            text: "Are you sure you want to permanently deactivate your account?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {           
            if (willDelete) {
                $(".save_loader").removeClass("d-none").fadeIn();
                $.ajax({
                    url: studentBaseUrl + "/student-closeaccount",
                    type: "post",
                    data: {
                        user_id: user_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        $(".save_loader").addClass("d-none").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(function () {
                                window.location.href = baseUrl + "/";
                            });
                        }
                    },
                });
            }
        });
    });

    $(".learningVerified").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Verification Process",
            text: "Please click OK to upload your documents for verification and to proceed with the English Language Proficiency Test. Passing the English test and document verification will grant you access to your course.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.href =
                    baseUrl + "/student/student-document-verification";
            }
        });
    });
    $(".documentVerified").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Documents Under Review",
            text: "Your documents are under review. We will notify you soon. Meanwhile, feel free to explore your course materials.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "", // Text for the cancel button
                    value: null, // Return null if "Ok" is clicked
                    visible: false, // Ensure the button is visible
                    className: "", // Optional: add custom class
                    closeModal: true // Close the modal on click
                },
                confirm: {
                    text: "Ok", // Text for the confirmation button
                }
            },
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.refresh();
            }
        });
    });
    $(".documentRejected").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Documents Verification Failed",
            text: "Unfortunately, your documents could not be verified. You are no longer enrolled for the exam or certificate but can still access your course materials.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "", // Text for the cancel button
                    value: null, // Return null if "Ok" is clicked
                    visible: false, // Ensure the button is visible
                    className: "", // Optional: add custom class
                    closeModal: true // Close the modal on click
                },
                confirm: {
                    text: "Ok", // Text for the confirmation button
                }
            },
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.refresh();
            }
        });
    });
    $(".englishAttempt").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Your English Test has Failed",
            text: "All attempts have been used. You are no longer enrolled for the exam or certificate but can still access your course materials.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "", // Text for the cancel button
                    value: null, // Return null if "Ok" is clicked
                    visible: false, // Ensure the button is visible
                    className: "", // Optional: add custom class
                    closeModal: true // Close the modal on click
                },
                confirm: {
                    text: "Ok", // Text for the confirmation button
                }
            },
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.refresh();
            }
        });
    });
    $(".documentNotUploaded").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Verification Process",
            text: "Please click on verify now to upload your Documents for verification and to proceed with the English Language Proficiency Test.",
            icon: "warning",
            buttons: true,
            buttons: ["Do later", "Verify now"], // Customize button names here
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                var baseUrl = window.location.origin;
                window.location.href =
                    baseUrl + "/student/student-document-verification";
            }
        });
    });
    
    $(".englishVerified").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "English Test Failed",
            text: "You have one final attempt remaining to improve your score. Please review carefully and try again.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Do later", "Start English Test"], // Customize button names here
        }).then((willVerified) => {
            if (willVerified) {
                window.location.href =
                    baseUrl + "/student/english-test";
            }
        });
    });
    $(".trailattemptVerified").on("click", function (event) {
        event.preventDefault();
        $("#loader").fadeIn();
        swal({
            title: "Verification Attempts Exhausted",
            text: "Document verification attempts have been exhausted. Your refund will be processed within 5-10 days.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.href =
                    baseUrl + "/student/student-document-verification";
            }
        });
    });
    
});
function checkPasswordStrength() {
    const password = document.getElementById('newpassword').value;
    const strengthMessage = document.getElementById('strengthMessage');
    let strength = 0;

    // Regular expressions for password strength criteria
    const regexes = [
        /[a-z]/,  // Lowercase letters
        /[A-Z]/,  // Uppercase letters
        /[0-9]/,  // Digits
        /[@#$%!]/  // Special characters: @, #, $, %, !
    ];


    // Check each regex and increment strength if matched
    regexes.forEach(regex => {
        if (regex.test(password)) {
            strength++;
        }
    });

    // Check password length (length of at least 8 characters)
    if (password.length >= 8 && regexes[3].test(password)) {
        strength++;
        lengthMessage.textContent = ''; // Clear length message if condition is met

    } else {
        lengthMessage.textContent = 'Password must be at least 8 characters long';
    }

    // Determine the strength message
    let strengthClass;
    let strengthText;

    if (password.length >= 8) {
        lengthMessage.textContent = ''; // Clear length message if condition is met

        switch (strength) {
            case 0:
            case 1:
                strengthClass = 'weak';
                strengthText = 'Weak';
                break;
            case 2:
            case 3:
                strengthClass = 'medium';
                strengthText = 'Medium';
                break;
            case 4:
            case 5:
                strengthClass = 'strong';
                strengthText = 'Strong';
                break;
        }
    } else {
        strengthClass = 'weak';
        strengthText = 'Weak';
    }

    // Update the strength message
    strengthMessage.className = 'strength ' + strengthClass;
    strengthMessage.textContent = strengthText;
}

function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const togglePasswordText = document.querySelector('.toggle-password');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        togglePasswordText.textContent = 'Hide';
    } else {
        passwordField.type = 'password';
        togglePasswordText.textContent = 'Show';
    }
}

