$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var successIconPath = baseUrl+"/frontend/images/icons/Shield Check.gif";
    var errorIconPath = baseUrl+"/frontend/images/icons/Shield Cross.gif";
    var warningIconPath = baseUrl+"/frontend/images/icons/exclamation mark.gif";
    var studentBaseUrl = baseUrl + "/student";
    var reader = new FileReader();
    var img = new Image();

    // Submit Quiz
    $(document).on("click", ".quizFinalSubmit", function (event) {
        event.preventDefault();
        // var formData = $(this).closest(".quizForm").serialize();
        var formData = $("#quizForm").serialize();
        var quiz_id = atob($(this).data("quizid"));
        var course_id = $(this).data("courseid");
        var progress_count_total =  $(this).data("progress_count_total");
        $("#loader").fadeIn();

        
        $.ajax({
            url: studentBaseUrl + "/quiz-submit",
            type: "POST",
            data: formData,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                let title = response.title;
                let message = response.message;
                let code = response.code;
                let icon = response.icon;
                let score = response.score;
                if (code === 200) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {

                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        $.ajax({
                            url: studentBaseUrl + "/student-watchprogess-check/",
                            type: "post",
                            data: {
                                course_id:course_id,
                                watch_content:"qu_"+quiz_id
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                if(response.data == "FALSE"){
                                    var watch_content = "qu_"+quiz_id
                                    if(response.count == '0'){
                                        var total_progress_display_count = 1;
                                    }else{
                                        var total_progress_display_count = Number(response.count) + 1;
                                    }
                
                                    var total_progress_display =  (total_progress_display_count/progress_count_total)*100;
                                    $(".total_progress_display_value").css('width', total_progress_display.toFixed(0)+"%");
                                    $('.total_progress_display_value').attr('value', total_progress_display_count);
                                    document.querySelector('.total_progress_display_complete').textContent =  total_progress_display.toFixed(0) + '% Completed';
                
                                    
                                    var progress_bar = $('.progress_bar').attr('value');
                                    
                                    var studentBaseUrl = window.location.origin + "/student";
                                    var csrfToken = $('meta[name="csrf-token"]').attr("content");
                                    $.ajax({
                                        url: studentBaseUrl + "/student-watchprogess",
                                        type: "post",
                                        data: {
                                            progress_bar:total_progress_display.toFixed(0),
                                            total_progress_display_value:watch_content,
                                            total_progress_display_count:total_progress_display_count,
                                            course_id:course_id
                                        },
                                        dataType: "json",
                                        headers: {
                                            "X-CSRF-TOKEN": csrfToken,
                                        },
                                        success: function (response) {
                                            var iconElement = document.getElementById("play-pause-icon-" + quiz_id);
                                            if (iconElement) {
                                                iconElement.classList.remove('fe', 'fe-help-circle');
                                                iconElement.classList.add('bi', 'bi-check2');
                                            } 
                                        },
                                    });
                
                
                                }
                            },
                        });
                        $("#quizHeader").find(".newAddedStep").remove();
                        $("#quizForm").find(".newAddedPane").remove();
                        $("#test-last").addClass(
                            "bs-stepper-block fade active"
                        );
                        $("#test-last")
                            .find(".score")
                            .html("Your score is : " + score + "%");
                    }, 2000);

                   
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     return window.location.reload();
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
    });

   
    // Submit Mock Content Upload
    $(".mockContentUpload").on("click", function (event) {
        event.preventDefault();

        // var form = $(".quizForm").serialize();
        // // $(this).closest(".mockUploadContent");
        // // var $form = $(this).closest("form");

        // //   var formData = new FormData($form[0]);
        // //   $(".save_loader").fadeIn();
          // $(this).closest(".mockUploadContent");
        var $form = $(this).closest("form");
        var formData = new FormData($form[0]);
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        $.ajax({
            url: baseUrl + "/student/mock-content-upload",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();

                if (response.code === 200 || response.code === 201) {
                    $("#test-last").addClass("bs-stepper-block active");
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
                }
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);

                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".errors").remove();
                        $form
                            .find(".mock-interview-custom")
                            .after(
                                "<br><div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                }
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error("Upload failed:", error);
            },
        });
    });

    $(".submitMockExam").on("click", function (event) {
        event.preventDefault();
        var index = $(this).data("index");
        var courseId = $(this).data("course_id");
        var instruction = $(this).attr("data-instruction");
        
        var formData = $("#mockExamFormData-"+ courseId + "-"  + index).serialize() + "&has_accepted_exam_instructions=" + encodeURIComponent(instruction);
        
        

        // $("#loader").fadeIn();
        $(".invalid-feedback").css('display','none');
        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");

        // const modalData = {
        //     title: "Are you sure?",
        //     message: "After submission you cannot change.",
        //     icon: warningIconPath,
        // }
        // showModal(modalData, true);
        // $("#modalCancel").on("click", function () {
        //     $("#customModal").hide();
        // });
        // $("#modalOk").on("click", function () {
            
            $(this).prop("disabled", true);
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
            $.ajax({
                url: studentBaseUrl + "/mock-interview-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                            $("#modalOk").prop("disabled", false);
                        });
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
        // });
    });
    $("#eportfolio_title_error").hide();
    $(".submitEportfolio").on("click", function (event) {
        
    // $(document).on("click", ".submitEportfolio", function (event) {
        event.preventDefault();
        $("#eportfolio_title_error").hide();
        var courseId = $(this).data("course_id");
        // alert(courseId);

        // Find the closest form to the clicked button
        // var currentForm = $(this).closest("form");

        var currentForm = $("#portfolioForm-"+ courseId);

        // Hide any previous error messages
        currentForm.find(".invalid-feedback").css('display', 'none');
        
        // Validate eportfolio_title
        var eportfolio_title = currentForm.find("#eportfolioTitle").val(); // Use closest form to find the input field
        if (eportfolio_title === "") {
            currentForm.find("#eportfolio_title_error").show(); // Show the error message within the closest form
            return; // Stop further execution
        }
    
        var instruction = $(this).attr("data-instruction");
        // alert(instruction);
        // If validation passes, continue with the form submission
        var formData = currentForm.serialize() + "&has_accepted_exam_instructions=" + encodeURIComponent(instruction);; // Get the form data
    
        // $(".submitEportfolio").prop("disabled", true);
        
        $(".invalid-feedback").css('display','none');

        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot edit.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");
        
        // const modalData = {
        //     title: "Are you sure?",
        //     message: "After submission you cannot edit.",
        //     icon: warningIconPath,
        // }
        // showModal(modalData, true);
        // $("#modalCancel").on("click", function () {
        //     $("#customModal").hide();
        // });
        // $("#modalOk").on("click", function () {
            
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
                $.ajax({
                    url: studentBaseUrl + "/e-portfolio-submit",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {

                        $("#processingLoader").fadeOut();
                        if (response.code === 202) {
                            // $(".save_loader").removeClass("d-block").addClass("d-none");
                            $(".errors").remove();
                            var data = Object.keys(response.data);
                            var values = Object.values(response.data);
                            data.forEach(function (key) {

                                var value = response.data[key];
                                if (key === "title") {
                                    $("#eportfolio_limit_error").css('display','block');
                                }else{

                                    let parts = key.split('.');
                                    let index = parts[1];
                                    if(parts[0] == 'answer'){
                                        var value = response.data[key];
                                        $("#eportfolio_limit_error").css('display','none');
                                        $("#eportfolio_title_error").hide();
                                        $("#eportfolio_answer_error_"+index).css('display','block');
                                    }
                                }
                                
                            });

                        } else if (response.code === 200) {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     $("#content3").addClass('show active');
                            //     document.querySelector('.portfolioForm').reset();
                            //     location.reload();
                            // });
                            
                            const modalData = {
                                title: response.title,
                                message: response.message,
                                icon: response.icon,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                // $("#content").addClass('show active');
                                document.querySelector('#portfolioForm-'+ courseId).reset();
                                let url = window.location.href;
                                let updatedUrl = url.replace(/\/test#$/, ""); // Remove '/test#' from the end
                                window.history.replaceState(null, null, updatedUrl);
                                window.location.reload();
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
        // });
    });
    $(".submitAssignExam, .draftAssignmentExam").on("click", function (event) {
        event.preventDefault();
        // var formData = $(".assignExamFormData").serialize();

        // var formData = new FormData($(".assignExamFormData")[0]); 
        
        const actionType = $(this).data("action");
        var index = $(this).data("index");
        var courseId = $(this).data("course-id");
        
        var form = $("#assignExamFormData-"+ courseId + "-" + index);
        var formData = new FormData(form[0]);

        var instruction = $(this).attr("data-instruction");
        formData.append("has_accepted_exam_instructions", instruction);
        formData.append("actionType", actionType);

        // $(".save_loader").removeClass("d-none").addClass("d-block");
            $("#processingLoader").fadeIn();
            $(".invalid-feedback").css('display','none');

            $.ajax({
                url: studentBaseUrl + "/assignment-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType:false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        localStorage.removeItem('examStartTime');
                        $('.finalsubmitTime').prop('disabled', false);

                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     // window.removeEventListener("beforeunload", handleBeforeUnload);
                            
                        //     if (typeof handleBeforeUnload === 'function') {
                        //         window.removeEventListener("beforeunload", handleBeforeUnload);
                        //     }
                        //     if (response.redirect) {
                        //         window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                        //         window.close();
                        //     }else{
                        //         return window.location.reload();
                        //     }
                        //     // $("#content1").addClass('show active');
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            // $("#content3").addClass('show active');
                            // document.querySelector('.portfolioForm').reset();
                            
                            if (typeof handleBeforeUnload === "function") {
                                window.removeEventListener("beforeunload", handleBeforeUnload);
                            }
                        
                            // Handle redirection or reload
                            if (response.redirect) {
                                window.location.href = `${studentBaseUrl}/exam/${response.redirect}`;
                                window.close(); // Optional, depending on your use case
                            } else {
                                window.location.reload();
                            }
                        
                            // Clean up event listener if defined
                        }, 2000);
                    }
                    if (response.code === 202) {

                        $(".errors").remove();
                        var data = Object.keys(response.data);
                        var values = Object.values(response.data);
                        data.forEach(function (key) {
                            let parts = key.split('.');
                            let index = parts[1];
                            var value = response.data[key];
                            $("#answer_error_"+index).css('display','block');
                            $('.finalsubmitTime').prop('disabled', false);
                        });
                    }
                    if (response.code === 201  || response.code === 404) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    // if (response.code === 200) {

                    //     swal({
                    //         title: response.title,
                    //         text: response.message,
                    //         icon: response.icon,
                    //     }).then(function () {
                    //         $("#content1").addClass('show active');
                    //     });
                    // }else{

                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // });
                    // }
                    
                },
            });
    });
    
    // Submit Vlog Content Upload
    $(".submitVlogExam").on("click", function (event) {
        event.preventDefault();
        var index = $(this).data("index");
        var courseId = $(this).data("course_id");
        var formData = new FormData($("#vlogExamFormData-"+ courseId + "-" + index)[0]);
        var instruction = $(this).attr("data-instruction");
        formData.append("has_accepted_exam_instructions", instruction);
        pond.getFiles().forEach(function(fileItem) {
            formData.append('instruction_file', fileItem.file);
        });

        if (pond.getFiles().length === 0) {
            const modalData = {
                title: "Please Select File",
                message: "",
                icon: errorIconPath
            }
            showModal(modalData);
            return; 
        }
        
        // pondInstances.forEach(function(pondInstance) {
        //     pondInstance.getFiles().forEach(function(fileItem) {
        //         formData.append('instruction_file[]', fileItem.file);
        //     });
        // });
        // document.querySelectorAll('input[type="file"].custom-file-input').forEach(function(fileInput) {
        //     const pondInstance = FilePond.find(fileInput);
            
        //     pondInstance.getFiles().forEach(function(fileItem) {
        //         formData.append('instruction_file[]', fileItem.file);
        //     });
        // });
        
        
     
        // $("#loader").fadeIn();
        $(".invalid-feedback").css('display','none');
        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willSubmit) => {
        //     if (willSubmit) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");

        // const modalData = {
        //     title: "Are you sure?",
        //     message: "After submission you cannot change.",
        //     icon: warningIconPath,
        // }
        // showModal(modalData, true);
        // $("#modalCancel").on("click", function () {
        //     $("#customModal").hide();
        // });
        // $("#modalOk").on("click", function () {
            
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
            $.ajax({
                url: studentBaseUrl + "/vlog-submit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => { 
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
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
                error: function (xhr, status, error) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.instruction_file) {
                            // swal({
                            //     title: "Error",
                            //     text: "Invalid file type selected",
                            //     icon: "error"
                            // });
                            
                            const modalData = {
                                title: "Error",
                                message: "Invalid file type selected",
                                icon: "error"
                            }
                            showModal(modalData);
                        }
                    }
                }
            });
        // });
    });
    
    $(".submitPeerReviewExam, .draftPeerReviewExam").on("click", function (event) {
        event.preventDefault();
        var index = $(this).data("index");
        var courseId = $(this).data("course_id");
        var instruction = $(this).attr("data-instruction");
        var formData = $("#peerReviewExamFormData-"+ courseId+ "-" + index).serialize() + "&has_accepted_exam_instructions=" + encodeURIComponent(instruction);
        const actionType = $(this).data("action");
        
        var formData = formData + '&actionType=' + actionType;
        $("#feedback_error").hide();

        var feedback = $("textarea[name='answer']").val().trim();

        var wordCount = feedback.split(/\s+/).filter(function(word) {
            return word.length > 0; 
        }).length;

       
        if(wordCount > 1500){
            $("#feedback_error").text("Feedback must be less than 1500 words.").css("color", "red").show();
            // $("#feedback_error").show();
            // $(".save_loader").addClass("d-none").removeClass("d-block"); 
            return;
        }
        // if (actionType === 'submit') {
            // swal({
            //     title: "Are you sure?",
            //     text: "After submission you cannot change.",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willSubmit) => {
            //     if (willSubmit) {

            // const modalData = {
            //     title: "Are you sure?",
            //     message: "After submission you cannot change.",
            //     icon: warningIconPath,
            // }
            // showModal(modalData, true);
            // $("#modalCancel").on("click", function () {
            //     $("#customModal").hide();
            // });
            // $("#modalOk").on("click", function () {
            //     $("#customModal").hide();
            //     $("#processingLoader").fadeIn();
        executeAjax();
            // });
        // } else {
            // executeAjax();
        // }
        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {

        function executeAjax() {
            // $(".save_loader").removeClass("d-none").addClass("d-block");
            // $("#processingLoader").fadeIn();

            $(".invalid-feedback").css('display', 'none');

            $.ajax({
                url: studentBaseUrl + "/peer-review-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    if (response.code === 202) {

                        $(".errors").remove();
                        var data = Object.keys(response.data);
                        var values = Object.values(response.data);
                    }
                    if (response.code === 201  || response.code === 404) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => { 
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    
                },
            });
        }
    });

    // Submit Reflective Journal
    $(".submitReflectiveJournalAnswer").on("click", function (event) {
        
        event.preventDefault();
        var $form = $(this).closest("form");
        var index = $(this).data("index");
        var formData = $(this).closest("form").serialize();
        formData += "&index=" + encodeURIComponent(index);

        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {

        //         $(".save_loader").removeClass("d-none").addClass("d-block");

        const modalData = {
            title: "Are you sure?",
            message: "After submission you cannot change.",
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
                url: baseUrl + "/student/submit-reflective-journal-answer",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
        
                    if (response.code === 200 || response.code === 201) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (response.redirect) {
                        //         window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                        //     }else{
                        //         return window.location.reload();
                        //     }
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => { 
                            if (response.redirect) {
                                window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                            }else{
                                return window.location.reload();
                            }
                        }, 2000);
                    }
                    
            
                    if (response.code === 202) {
                        $(".errors").remove();
        
                        // Display new errors
                        Object.keys(response.data).forEach(function (key) {
                            var value = response.data[key];
        
                            // Use closest() to find the error message element within the same form context
                            var errorElement = $form.find(`#answer_error`);
        
                            // Show error messages
                            errorElement.text(value[0]).addClass("d-block"); // Display the error message
                        });
                    }
                    
                },
                error: function (xhr, status, error) {
                    $("#processingLoader").fadeOut();
                    console.error("Submission failed:", error);
                },
            });
        });
    });
    
    $(".submitReflectiveJournal").on("click", function (event) {
        event.preventDefault();
        
        var index = $(this).data("index");
        var courseId = $(this).data("course_id");
        var instruction = $(this).attr("data-instruction");
        var formData = $("#reflectiveJournalformData-"+ courseId+ "-" + index).serialize() + "&has_accepted_exam_instructions=" + encodeURIComponent(instruction);
        
        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");

        // const modalData = {
        //     title: "Are you sure?",
        //     message: "After submission you cannot change.",
        //     icon: warningIconPath,
        // }
        // showModal(modalData, true);
        // $("#modalCancel").on("click", function () {
        //     $("#customModal").hide();
        // });
        // $("#modalOk").on("click", function () {
            
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
            $(".invalid-feedback").css('display','none');
            $.ajax({
                url: studentBaseUrl + "/reflective-journal-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (response.redirect) {
                        //         window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                        //     }else{
                        //         return window.location.reload();
                        //     }
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => { 
                            if (response.redirect) {
                                window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                            }else{
                                return window.location.reload();
                            }
                        }, 2000);
                    }
                    if (response.code === 202) {

                        $(".errors").remove();
                        var data = Object.keys(response.data);
                        var values = Object.values(response.data);
                        data.forEach(function (key) {
                            let parts = key.split('.');
                            let index = parts[1];
                            var value = response.data[key];
                            $("#answer_error_"+index).css('display','block');
                        });
                    }
                    if (response.code === 201  || response.code === 404) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => { 
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    
                },
            });
        // });
    });
    
    // Submit Mcq
    $(document).on("click", ".mcqFinalSubmit", function (event) {
        event.preventDefault();
        var mcq_id = $(this).data("mcqid");
        var course_id = btoa($(this).data("courseid"));
        var index = $(this).data("index");
        var key = $(this).data("key");

        var form = $("#mcqForm-" + index + "-" + key);
        var formData = form.serialize();

        form.append(`<input type="hidden" name="mcq_id" value="${mcq_id}">`);
        form.append(`<input type="hidden" name="course_id" value="${course_id}">`);
        formData = form.serialize();


        // $('#mcqForm').append(`<input type="hidden" name="mcq_id" value="${mcq_id}">`);
        // $('#mcqForm').append(`<input type="hidden" name="course_id" value="${course_id}">`);

        // var formData = $("#mcqForm").serialize();
        
        // $(".save_loader").removeClass("d-none").addClass("d-block");

        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        
        $.ajax({
            url: studentBaseUrl + "/mcq-submit",
            type: "POST",
            data: formData,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                let title = response.title;
                let message = response.message;
                let code = response.code;
                let icon = response.icon;
                let score = response.score;
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (code === 200 ) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     // window.removeEventListener("beforeunload", handleBeforeUnload);
                    //     if (typeof handleBeforeUnload === 'function') {
                    //         window.removeEventListener("beforeunload", handleBeforeUnload);
                    //     }
                    //     if (response.redirect) {
                    //         window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                    //         window.close();
                    //     }else{
                    //         return window.location.reload();
                    //     }
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        if (typeof handleBeforeUnload === 'function') {
                            window.removeEventListener("beforeunload", handleBeforeUnload);
                        }
                        if (response.redirect) {
                            window.location.href = studentBaseUrl+'/exam/'+response.redirect;
                            window.close();
                        }else{
                            return window.location.reload();
                        }
                    }, 2000);

                
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     return window.location.reload();
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        return window.location.reload();
                    },2000);
                }
            },
        });
    });
    
    // Submit Survey
    $(".submitSurveyExam").on("click", function (event) {
        event.preventDefault();
        var index = $(this).data("index");
        // var formId = `#surveyExamFormData-${index}`;
        var courseId = $(this).data("course_id");
        var instruction = $(this).attr("data-instruction");
        var formData = new FormData($("#surveyExamFormData-" + courseId+ "-" + index)[0]);
        var instruction = $(this).attr("data-instruction");
        formData.append("has_accepted_exam_instructions", instruction);
        // var isValid = true;
        // // var formData = new FormData($(".surveyExamFormData")[0]);

        // $(formId).find(":input[required]").each(function () {
        //     if (!$(this).val() || ($(this).is(":file") && this.files.length === 0)) {
        //         isValid = false;
        //         let fieldId = $(this).attr("id");
                
        //         let errorContainer = $("#" + fieldId);
        //         if (errorContainer.length > 0) {
        //             console.log(fieldId);
        //             errorContainer.text("This field is required").css("display", "block");
        //         } else {
                    
        //             console.log(fieldId);
        //             $(this).after(
        //                 `<p class="errors text-danger">This field is required</p>`
        //             );
        //         }
        //     } else {
        //         $("#" + $(this).attr("id")).text("").css("display", "none");
        //     }   
        // });
        // if (!isValid) {
        //     return false;
        // }


        filesAdded = false;
        
        filePondInstances.forEach((pondInstance) => {
            const inputElement = pondInstance.element;
            
            if (!inputElement.hasAttribute('data-id')) {
                inputElement.setAttribute('data-id', pondInstance.element.id.split('-').pop()); // Set the ID dynamically
            }
        });

        filePondInstances.forEach(pondInstance => {
            if (pondInstance.getFiles().length > 0) {
                pondInstance.getFiles().forEach(fileItem => {
                    const configId = pondInstance.element.dataset.id;
                    let key = `survey_file[${configId}]`;
                    formData.append(key, fileItem.file);
                    filesAdded = true;
                });
            }
        });

        if (!filesAdded) {
            // swal({
            //     title: "Please Select File",
            //     icon: "warning",
            // });
            const modalData = {
                title: "Please Select File",
                message: '',
                icon: warningIconPath,
            }
            showModal(modalData);
            return;
        }

     
        $("#loader").fadeIn();
        $(".invalid-feedback").css('display','none');
        // swal({
        //     title: "Are you sure?",
        //     text: "After submission you cannot change.",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willSubmit) => {
        //     if (willSubmit) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");

        // const modalData = {
        //     title: "Are you sure?",
        //     message: "After submission you cannot change.",
        //     icon: warningIconPath,
        // }
        // showModal(modalData, true);
        // $("#modalCancel").on("click", function () {
        //     $("#customModal").hide();
        // });
        // $("#modalOk").on("click", function () {
            
            $("#customModal").hide();
            $("#processingLoader").fadeIn();
            $.ajax({
                url: studentBaseUrl + "/survey-submit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    
                    // if (response.code === 202) {

                    //     $(".errors").remove();
                    //     var data = Object.keys(response.data);
                    //     var values = Object.values(response.data);
                    //     data.forEach(function (key) {
                    //         let parts = key.split('.');
                    //         let index = parts[1];
                    //         var value = response.data[key];
                    //         $("#answer_errors_"+index).css('display','block');
                    //     });
                    // }

                    if (response.code === 202) {
                        $(".errors").remove();
                        
                        if(response.data){
                            var data = Object.keys(response.data);
                            data.forEach(function (key) {
                                let parts = key.split('.');
                                let index = parts[1];
                                $("#answer_errors_" + index).css('display', 'block');
                            });
                        }
                    
                        Object.keys(response.errors).forEach(function (key) {
                            let errorMessage = response.errors[key][0];
                            let fieldId = key.replace(/\[|\]/g, '_').replace(/_$/, '');
                            let errorContainer = $("#" + fieldId);
                            if (errorContainer.length > 0) {
                                errorContainer.text(errorMessage).css('display', 'block');
                            } else {
                                $(`#${fieldId}`).after(
                                    `<span class="errors text-danger">${errorMessage}</span>`
                                );
                            }
                        });

                    }
                    if (response.code === 201  || response.code === 404) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     if (window.location.href.includes('test#')) {
                        //         const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                        //         window.history.replaceState({}, document.title, cleanUrl);
                        //     }
                        //     window.location.reload();
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            if (window.location.href.includes('test#')) {
                                const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                                window.history.replaceState({}, document.title, cleanUrl);
                            }
                            window.location.reload();
                        }, 2000);
                    }
                    
                },
                error: function (xhr, status, error) {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.instruction_file) {
                            // swal({
                            //     title: "Error",
                            //     text: "Invalid file type selected",
                            //     icon: "error"
                            // });

                            const modalData = {
                                title: "Error",
                                message: "Invalid file type selected",
                                icon: errorIconPath,
                            }
                            showModal(modalData);
                        }
                    }
                }
            });
        // });
    });
    
    // Submit Artificial Intelligence
    $(".submitArtificialIntelligenceExam").on("click", function (event) {
        event.preventDefault();
        
        var index = $(this).data("index");
        var courseId = $(this).data("course-id");
        
        var form = $("#artificialIntelligenceExamFormData-"+ courseId + "-" + index);
        var formData = new FormData(form[0]);

        var instruction = $(this).attr("data-instruction");
        formData.append("has_accepted_exam_instructions", instruction);

        $("#processingLoader").fadeIn();
        $(".invalid-feedback").css('display','none');

        $.ajax({
            url: studentBaseUrl + "/artificial-intelligence-submit",
            type: "POST",
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
                    showModal(modalData);
                    setTimeout(() => {
                        if (window.location.href.includes('test#')) {
                            const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                            window.history.replaceState({}, document.title, cleanUrl);
                        }
                        window.location.reload();
                    }, 2000);
                }
                if (response.code === 202) {

                    $(".errors").remove();
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        let parts = key.split('.');
                        let index = parts[1];
                        var value = response.data[key];
                        $("#answer_error_"+index).css('display','block');
                        $('.finalsubmitTime').prop('disabled', false);
                    });
                }
                if (response.code === 201) {
                    $("#processingLoader").fadeOut();
                    // Hide previous error messages
                    $(".invalid-feedback").hide();
                    // Remove any error styling from inputs
                    $(".form-control").removeClass("is-invalid");

                    if (response.errors && (response.errors.link || response.errors.pdf_file || response.errors.requirement_file)) {
                        if (response.errors.link) {
                            $("#link_error").text(response.errors.link[0]).show();
                        }
                        if (response.errors.pdf_file) {
                            $("#pdf_file_error").text(response.errors.pdf_file[0]).show();
                            $("#pdf_file").addClass("is-invalid");
                        }
                        if (response.errors.requirement_file) {
                            $("#requirement_file_error").text(response.errors.requirement_file[0]).show();
                            $("#requirement_file").addClass("is-invalid");
                        }
                    } else {
                        const modalData = {
                            title: response.title,
                            message: response.message,
                            icon: response.icon,
                        };
                        showModal(modalData);
                    }
                    
        
                    // Display new error messages
                    // if (response.errors.pdf_file) {
                    //     $("#pdf_file_error").text(response.errors.pdf_file[0]).show();
                    //     $("#pdf_file").addClass("is-invalid");
                    // }
                    // if (response.errors.requirement_file) {
                    //     $("#requirement_file_error").text(response.errors.requirement_file[0]).show();
                    //     $("#requirement_file").addClass("is-invalid");
                    // }
        
                    // // Show the modal with error details
                    // const modalData = {
                    //     title: response.title,
                    //     message: response.message,
                    //     icon: response.icon,
                    // }
                    // showModal(modalData);
                }
                if (response.code === 404) {
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        if (window.location.href.includes('test#')) {
                            const cleanUrl = window.location.href.split('#')[0].replace('/test', '');
                            window.history.replaceState({}, document.title, cleanUrl);
                        }
                        window.location.reload();
                    }, 2000);
                }
            },
        });
    });
});
