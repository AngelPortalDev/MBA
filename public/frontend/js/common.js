$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();
    // Profile Pic Upload

    $(".studentLogin").on("click", function () {
        var email = $(this).data("email");
        $.ajax({
            url: baseUrl + "/student-login",
            type: "POST",
            dataType: "json",
            data: {
                email:email
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if(response.message){
                    swal({
                        title: response.message,
                        text: response.text,
                        icon: "success",
                    });
                }
            },
           
        });
    });

    $(".studentVerified").on("click", function () {
        var email = $(this).data("verified");
        var message = "Verify your email if unverified.";
        var checkemail = $(this).data("checkemail");
        if(checkemail == ''){
            // swal({
            //     title: message,
            //     text: '',
            //     icon: "warning",
            // }).then(function () {
                $.ajax({
                    url: baseUrl + "/student-email-verified",
                    type: "POST",
                    dataType: "json",
                    data: {
                        email:email
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        if(response.code == 201){
                            swal({
                                title: response.message,
                                text: response.text,
                                icon: "warning",
                            });
                        }else{
                            if(response.message){
                                swal({
                                    title: response.message,
                                    text: response.text,
                                    icon: "success",
                                });
                            }
                            window.open(response.data, '_self');
                        }
                    },
                
                });
            // });
        }else{
            $.ajax({
                url: baseUrl + "/student-email-verified",
                type: "POST",
                dataType: "json",
                data: {
                    email:email
                },
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    if(response.code == 201){
                        swal({
                            title: response.message,
                            text: response.text,
                            icon: "success",
                        });
                    }else{
                        if(response.message){
                            swal({
                                title: response.message,
                                text: response.text,
                                icon: "success",
                            });
                        }
                        window.open(response.data, '_self');
                    }
                },
            
            });
        }
    });


    $(".image").on("change", function () {
        var currnetForm = $(this).closest("form");
        $("#img_size_error").hide();
        var logo = this.files[0];
        var size = logo.size / 1024;
        if (logo) {
            reader.onload = function (e) {
                img.src = e.target.result;
                // img.onload = function () {
                //     var width = img.width;
                //     var height = img.height;

                //     if (width < 199 && height < 199) {
                //         $("#img_size_error").show();
                //         $("#ProfileSubmit").prop("disabled", true);
                //         return;
                //     } else {
                //         $("#ProfileSubmit").prop("disabled", false);
                //     }
                //     if (size > 3072) {
                //         $("#img_size_error").show();
                //         $("#ProfileSubmit").prop("disabled", true);
                //         return;
                //     } else {
                //         $("#ProfileSubmit").prop("disabled", false);
                //     }
                // };
                e.preventDefault();
                currnetForm.find(".imagePreview").attr("src", e.target.result);
            };
            reader.readAsDataURL(logo);
        }
    });
   

       $(".profilePic").on("change", function () {
           // $("#loader").fadeIn();

           var currnetForm = $(this).closest("form");
           var currnetimg = $(this).closest("img");
           var form = new FormData(currnetForm[0]);
           // var old_img = $(".curr_img").val();
           $.ajax({
               url: baseUrl + "/add-profile-image",
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
                       currnetForm
                           .find(".curr_img")
                           .prop("value", +response.new);
                    //    swal({
                    //        title: response.message,
                    //        text: response.text,
                    //        icon: "success",
                    //    });
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: successIconPath,
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
                           message: response.message,
                           icon: errorIconPath,
                       }
                       showModal(modalData);
                   }
                   if (response.code === 203) {
                    //    swal({
                    //        title: response.message,
                    //        text: response.text,
                    //        icon: "error",
                    //    }).then(function () {
                    //        window.location.reload();
                    //    });

                       const modalData = {
                           title: response.title,
                           message: response.message,
                           icon: errorIconPath,
                       }
                       showModal(modalData);
                       setTimeout(() => {
                           window.location.reload();
                       }, 2000);
                   }
               },
               error: function (xhr, status, error) {
                   // Handle errors
                   console.error(error);
                   $("#result").html("An error occurred.");
               },
           });
       });
       $(".tog").click(function () {
           $(this).find("i").toggleClass("fe-eye fe-eye-off");
           var input = $($(this).attr("toggle"));
           if (input.attr("type") == "password") {
               input.attr("type", "text");
           } else {
               input.attr("type", "password");
           }
       });

       var emailLoginErrorElement =
           document.getElementsByClassName("invalid-feedback")[0];
       if (emailLoginErrorElement) {
           $(".invalid-feedback-error").text(
               "Please check your credentials and try again."
           );
           $(".alert-danger").css("display", "block");
       }

       var statusMessageElement = document.getElementById("statusMessage");
       if (statusMessageElement) {
           var statusMessage = statusMessageElement.dataset.status;
       }
       if (statusMessage) {
           var resetPassword =
               document.getElementById("ResetPassword").dataset.reset;
           if (resetPassword == "reset_password") {
               swal({
                   title: statusMessage,
                   text: "",
                   icon: "success",
               }).then(function () {
                   return (window.location.href = "/login-view");
               });
           } else {
               swal({
                   title: statusMessage,
                   text: "",
                   icon: "success",
               }).then(function () {
                   return (window.location.href = "/forget-password");
               });
           }
       }
       // $(".image").on("change", function () {
       //     $("#img_size_error").hide();
       //     var logo = this.files[0];
       //     var size = logo.size / 1024;
       //     if (logo) {
       //         reader.onload = function (e) {
       //             img.src = e.target.result;
       //             img.onload = function () {
       //                 var width = img.width;
       //                 var height = img.height;

    //                 if (width < 199 && height < 199) {
    //                     $("#img_size_error").show();
    //                     //   $("#ProfileSubmit").prop("disabled", true);
    //                     return;
    //                 } else {
    //                     //   $("#ProfileSubmit").prop("disabled", false);
    //                 }
    //                 if (size > 3072) {
    //                     $("#img_size_error").show();
    //                     //   $("#ProfileSubmit").prop("disabled", true);
    //                     return;
    //                 } else {
    //                     //   $("#ProfileSubmit").prop("disabled", false);
    //                 }
    //             };
    //             e.preventDefault();
    //             $(".imagePreview").attr("src", e.target.result);
    //         };
    //         reader.readAsDataURL(logo);
    //     }
    // });
    $(".idDoc").on("change", function () {
        var docType = $(this).data("doctype");
        var form = [];
        if (docType == "UkVTVU1F") {
            var form = new FormData($(".resumeDoc")[0]);
        }else if(docType == 'UkVTRUFSQ0hfUFJPUE9TQUw='){
            var form = new FormData($(".researchProposalDoc")[0]);
        } else {
            var form = new FormData($(".identityDoc")[0]);
        }
        // var old_img = $(".curr_img").val();
        $(".document_loader").removeClass("d-none").fadeIn();
        $.ajax({
            url: baseUrl + "/student/user-doc-verification",
            type: "POST",
            dataType: "json",
            data: form,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".document_loader").addClass("d-none").fadeOut();
                if (response.code === 200) {
                    var data = response.records;
                    // For Passport
                    if (data.doc_type === "passport") {
                        $(".identityDoc").remove();
                        $(".docDetails").removeClass("d-none").slideDown();
                        $("#docType").prop("value", data.doc_type);
                        $("#docName").prop(
                            "value",
                            data.fist_name + " " + data.last_name
                        );
                        $("#docId").prop("value", data.passport_no);
                        $("#docExp").prop("value", data.expiryDate);
                        $(".idDoc").prop("disabled", true);
                        $(".statusText").html(response.title);
                    }
                    // For Other National ID
                    if (
                        data.doc_type != "passport" &&
                        data.doc_type != "RESUME"
                    ) {
                        $(".identityDoc").remove();
                        $(".docDetails").removeClass("d-none").slideDown();
                        $(".otherDoc").removeClass("d-none").slideDown();
                        $("#docType").prop("value", data.doc_type);
                        $("#docName").prop(
                            "value",
                            data.first_name_of_person +
                                " " +
                                data.last_name_of_person
                        );
                        $("#docId").prop("value", data.id_card_number);
                        $("#docissue").prop("value", data.issuing_authority);
                        $(".idDoc").prop("disabled", true);
                        $(".statusText").html(response.title);
                    }
                    if (data.doc_type === "RESUME") {
                        $(".resume").show();
                    }

                    // $(".idDoc").prop("disabled", true);
                }
                if (response.code === 201) {
                    $(".sendforVerfiy").show();
                }
                if (response.code === 202) {
                    $(".docDetails").removeClass("d-none").slideDown();
                }
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.remark,
                // }).then(function () {
                //     // if (response.redirect) {
                //     //     window.location.href = baseUrl+'/student/'+response.redirect;
                //     // }else{
                //         return window.location.reload();
                //     // }
                // });
                
                const modalData = {
                    title: response.title,
                    message: response.message || "",
                    icon: response.icon,
                };
                showModal(modalData);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function (xhr, status, error) {
                // Handle errors
                // console.error(error);
                $("#result").html("An error occurred.");
            },
        });
    });
    $(".eduDocUpload").on("change", function () {
        var docType = $(this).data("doctype");
        var form = new FormData($(".eudDoc")[0]);
        // var old_img = $(".curr_img").val();
        $(".document_loader").removeClass("d-none").fadeIn();
        $.ajax({
            url: baseUrl + "/student/user-doc-verification",
            type: "POST",
            dataType: "json",
            data: form,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                var data = response.records;
                $(".document_loader").addClass("d-none").fadeOut();
                if (response.code === 200) {
                    var data = response.records;
                    // For Education
                    if (data.doc_type === "Edu") {
                        $(".eduDocDetails").removeClass("d-none").slideDown();
                        $("#institue_name").prop("value", data.institute_name);
                        $("#eduDocName").prop("value", data.certificate_name);
                        $("#passsingYear").prop("value", data.completion_date);
                        $("#eduStudentName").prop("value", data.student_name);
                        $("#eduDocId").prop("value", data.certificate_id);
                        $("#eduRemark").prop("value", data.pass_fail_remark);
                        $("#eduGrade").prop("value", data.grade);
                        $(".eduDoc_type").html(response.title);
                        $(".verifiedStatus")
                            .append("Verified")
                            .addClass("text-success");
                        $(".eudDoc").remove();
                    }
                } else if (data.doc_type === "Edu" && response.code === 202) {
                    $(".eduDocDetails").removeClass("d-none").slideDown();
                    $("#institue_name").prop("value", data.institute_name);
                    $("#eduDocName").prop("value", data.certificate_name);
                    $("#passsingYear").prop("value", data.completion_date);
                    $("#eduStudentName").prop("value", data.student_name);
                    $("#eduDocId").prop("value", data.certificate_id);
                    $("#eduRemark").prop("value", data.pass_fail_remark);
                    $("#eduGrade").prop("value", data.grade);
                    $(".verifiedStatus")
                        .append("Pending for Approval")
                        .addClass("text-warning");
                    $(".eduFieldset").prop("disabled", "disabled");
                }
                if (response.code === 202) {
                    $(".eduDocDetails").removeClass("d-none").slideDown();
                }
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.remark,
                // }).then(function () {
                //     $(".eduDocDetails").removeClass("d-none").slideDown();
                //     $("#institue_name").prop("value", data.institute_name);
                //     $("#eduDocName").prop("value", data.certificate_name);
                //     $("#passsingYear").prop("value", data.completion_date);
                //     $("#eduStudentName").prop("value", data.student_name);
                //     $("#eduDocId").prop("value", data.certificate_id);
                //     $("#eduRemark").prop("value", data.pass_fail_remark);
                //     $("#eduGrade").prop("value", data.grade);
                //     $(".verifiedStatus")
                //         .append("Pending for Approval")
                //         .addClass("text-warning");
                //     $(".eduFieldset").prop("disabled", "disabled");
                //     // return window.location.reload();
                //     // if (response.redirect) {
                //     //     window.location.href = baseUrl+'/student/'+response.redirect;
                //     // }else{
                //         return window.location.reload();
                //     // }
                // });
                
                const modalData = {
                    title: response.title,
                    message: response.message || "",
                    icon: response.icon,
                };
                showModal(modalData);
                setTimeout(() => {
                    $(".eduDocDetails").removeClass("d-none").slideDown();
                    $("#institue_name").prop("value", data.institute_name);
                    $("#eduDocName").prop("value", data.certificate_name);
                    $("#passsingYear").prop("value", data.completion_date);
                    $("#eduStudentName").prop("value", data.student_name);
                    $("#eduDocId").prop("value", data.certificate_id);
                    $("#eduRemark").prop("value", data.pass_fail_remark);
                    $("#eduGrade").prop("value", data.grade);
                    $(".verifiedStatus")
                        .append("Pending for Approval")
                        .addClass("text-warning");
                    $(".eduFieldset").prop("disabled", "disabled");
                    return window.location.reload();
                }, 2000);
            },
            error: function (xhr, status, error) {
                $(".save_loader").addClass("d-none").fadeOut();
                $(".verifiedStatus").html("Pending for Approval");
                $(".eduFieldset").prop("disabled", "disabled");
                $(".document_loader").addClass("d-none").fadeOut();

                // swal({
                //     title: "Send to Approval",
                //     text: "It will be approved or rejected within 1-2 working days...",
                //     icon: "warning",
                // }).then(function () {
                //     return $(".eduDocDetails")
                //         .removeClass("d-none")
                //         .slideDown();
                // });

                const modalData = {
                    title: "Send to Approval",
                    message: "It will be approved or rejected within 1-2 working days...",
                    icon: warningIconPath,
                };
                showModal(modalData);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
        });
    });
    $(".changePasswordSave").on("click", function (event) {
        event.preventDefault();
        $("#curpassword_error").removeClass("d-block");
        $("#newpassword_error").removeClass("d-block");
        $("#newpassword2_error").removeClass("d-block");
        $("#confirmpassword_error").removeClass("d-block");
        $("#confirmpassword2_error").removeClass("d-block");

           var currentpassword = $("#currentpassword").val();
           var newpassword = $("#newpassword").val();
           var confirmpassword = $("#confirmpassword").val();
           var passwordRegex =
               /^(?=.[A-Z])(?=.[a-z])(?=.[0-9])(?=.[!@#$%^&])[A-Za-z0-9!@#$%^&]{8,}$/;

           if (currentpassword === "") {
               $("#curpassword_error").addClass("d-block");
               return;
           }
           if (newpassword === "") {
               $("#newpassword_error").addClass("d-block");
               return;
           }
           if (!passwordRegex.test(newpassword)) {
               $("#newpassword2_error").addClass("d-block");
               return;
           }
           if (confirmpassword === "") {
               $("#confirmpassword_error").addClass("d-block");
               return;
           }
           if (newpassword != confirmpassword) {
               $("#confirmpassword2_error").addClass("d-block");
               return;
           }
       });
       // Create a PlayerJS instance with the 'bunny-stream-embed' element

       // const videoFrame = $('#videoFrame')[0];
       // let userHasInteracted = false;
       // console.log(videoFrame);
       // // Function to handle messages from the iframe
       // function handleMessage(event) {
       //     // Ensure that the message is from the expected iframe
       //     if (event.originalEvent.source === videoFrame.contentWindow) {
       //         const message = event.originalEvent.data;
       //         if (message === 'play') {
       //             if (!userHasInteracted) {
       //                 console.log('User has started playing the video for the first time.');
       //                 userHasInteracted = true;
       //                 // Additional actions when the user starts playing the video
       //             }
       //         } else if (message === 'ended') {
       //             console.log('User has completed watching the video.');
       //             // Additional actions when the video has been fully completed
       //         }
       //     }
       // }

       // // Add event listener to handle messages from the iframe using jQuery
       // $(window).on('message', handleMessage);
       // console.log("cvbcvb");
       // });

       // document.addEventListener('DOMContentLoaded', function() {
       // $('.tab-link').on('click', function (e) {

       //     const player = new Plyr('#bunny-stream-embed');

       //     console.log("dfsdfs");
       //     // window.addEventListener('message', function(event) {
       //         // if (event.data === 'play') {
       //             player.play();
       //             console.log(player.play());
       //         // }
       //     });
       // // });

       $(".contactformSubmit").on("click", function (event) {
           event.preventDefault();
           $("#first_name_error").hide();
           $("#last_name_error").hide();
           $("#email_error").hide();
           $("#phone_error").hide();
           $("#contact_role_error").hide();
           $("#message_error").hide();

           var fname = $("#first_name").val();
           var lname = $("#last_name").val();
           var email = $("#email").val();
           var mob_code = $("#mob_code").val();
           var phone = $("#phone").val();
           var contact_role = $("#contact_role").val();
           var message = $("#message").val();
           if (fname === "") {
               $("#first_name_error").show();
               return;
           }
           if (lname === "") {
               $("#last_name_error").show();
               return;
           }

           var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
           if (email === "") {
               $("#email_error").show();
               if (!emailRegex.test(email)) {
                   $("#email_error").show();
                   return;
               }
           }
           if (mob_code === "" || phone === "") {
               $("#phone_error").show();
               return;
           }
           if (contact_role === "") {
               $("#contact_role_error").show();
               return;
           }
           if (message === "") {
               $("#message_error").show();
               return;
           }

           var formData = new FormData($(".contactForm")[0]);

        //    $(".save_loader").removeClass("d-none").addClass("d-block");
           $("#processingLoader").fadeIn();
           $.ajax({
               url: baseUrl + "/add-contact-form",
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
                   if (response.code === 200 || response.code === 201) {
                       // $("#addpromo-modal").modal('hide');
                        //    swal({
                        //        title: response.title,
                        //        text: response.message,
                        //        icon: response.icon,
                        //    }).then(function () {
                        //        window.location.reload();
                        //    });
                        
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
                       $(".errors").remove();
                       var data = Object.keys(response.data);
                       var values = Object.values(response.data);
                       data.forEach(function (key) {
                           var value = response.data[key];
                           if (key === "phone" || key == "mob_code") {
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
       });
});
function handleSearchInput(searchInputId,clearCallback){
    const searchInput = document.getElementById(searchInputId);
    if(!searchInput) return;
    searchInput.addEventListener('input',()=>{
        if(searchInput.value === ''){
            clearCallback();
        }
    })
}


// Toggle Eye Icon

document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector(togglePassword.getAttribute('toggle'));
    const togglePasswordIcon = document.querySelector('.toggle-password-eye');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        togglePasswordIcon.classList.toggle('bi-eye');
        togglePasswordIcon.classList.toggle('bi-eye-slash');
    });
});


// Add Reverse Tabnabbing  Secuirity Features

$(document).ready(function() {
    $('a[target="_blank"]').attr('rel', 'noopener noreferrer');
});

$(document).on("input", "input[type='number']", function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});



// Testinonials

// document.addEventListener("DOMContentLoaded", function () {
//     var swiper = new Swiper(".mySwiper", {
//         loop: true,
//         slidesPerView: 3,
//         spaceBetween: 30,
//         centeredSlides: true,
//         centerInsufficientSlides: true,
//         navigation: {
//             nextEl: ".swiper-button-next",
//             prevEl: ".swiper-button-prev",
//         },
//         observer: true,
//         observeParents: true,

//         breakpoints: {
//             0: {
//                 slidesPerView: 1,
//                 centeredSlides: false,
//                 spaceBetween: 10,
//             },
//             576: {
//                 slidesPerView: 1,
//                 centeredSlides: false,
//                 spaceBetween: 15,
//             },
//             768: {
//                 slidesPerView: 2,
//                 centeredSlides: false,
//                 spaceBetween: 20,
//             },
//             992: {
//                 slidesPerView: 3,
//                 centeredSlides: true,
//                 spaceBetween: 30,
//             }
//         }
//     });

//     setTimeout(() => {
//         swiper.update();
//     }, 100);
// });

