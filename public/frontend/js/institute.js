
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var instituteBaseUrl = window.location.origin + "/institute";
    var reader = new FileReader();
    var img = new Image();
    $(".updateInstituteProfile").on("click", function (event) {
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
        
        var university_name = $("#university_name").val();
        var website = $("#website").val();
        var address_new = $("#textarea-input").val();
        var billing_city = $("#billing_city").val();
        var billing_state = $("#billing_state").val();
        var billing_country = $("#billing_country").val();
        var contact_person_name = $("#contact_person_name").val();
        var contact_person_email = $("#contact_person_email").val();
        var contact_person_mob_code = $("#contact_person_mob_code").val();
        var contact_person_mobile = $("#contact_person_mobile").val();
        var contact_person_designation = $("#contact_person_designation").val();

        if (university_name === "") {
            $("#university_name_error").show();
            return;
        }
        if (website === "") {
            $("#website_error").show();
            return;
        }


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
        
        var addressCount = address_new.trim().split(/\s+/).length;
        
        if(addressCount>100){
            $("#address_error").text("Address should be less than 100 words.");
            $("#address_error").show();
            return;
        }

        if (address_new === "") {
            $("#address_error").text("Address is required.");
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


        var form = new FormData($(".instituteProfileData")[0]);

        $.ajax({
            url: instituteBaseUrl + "/institute-profile-update",
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
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(() => {
                    //     location.reload();
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

    $(".instituteprofilePic").on("change", function () {
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
    
});