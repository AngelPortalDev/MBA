$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var successIconPath = baseUrl+"/frontend/images/icons/Shield Check.gif";
    var errorIconPath = baseUrl+"/frontend/images/icons/Shield Cross.gif";
    var warningIconPath = baseUrl+"/frontend/images/icons/exclamation mark.gif";
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    // Add Assignment
    $("#addAssig").on("click", function (event) {
        event.preventDefault();
        $("#assignment_tittle_error").hide();
        $("#assignment_award_error").hide();

        var form = $("#addAssignData").serialize();
        var assignment_title = $("#assignment_tittle").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#assignment_award_error").show();
            return;
        }
        if (assignment_title === "") {
            $("#assignment_tittle_error").show();
            return;
        }
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-assignment",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addAssignData")[0].reset();
                    $("#addAssignment").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addAssignData")[0].reset();
                    $("#addAssignment").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    $(".updateAssignment").on("click", function (event) {
        event.preventDefault();
        $("#assignment_title_error").hide();
        $("#assignment_percentage_error").hide();
        $("#programme_outcomes_error").hide();
        var assignment_title = $("#assignment_title").val();
        var assignment_percentage = $("#assignment_percentage").val();
        var programme_outcomes = $("#instruction .ql-editor").html();
        var text = $(programme_outcomes).text();
        var charCount = text.length;

        // var instructions = $(programme_outcomes).text();
        if (assignment_title === "") {
            $("#assignment_title_error").show();
            return;
        }
        if (assignment_percentage === "") {
            $("#assignment_percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#programme_outcomes_error").show();
            return;
        }
        if ($("#enable_duration").is(":checked")) {
            let hours = $("#exam_duration_hours").val();
            let minutes = $("#exam_duration_minutes").val();

            // Separate error messages for hours and minutes
            if (hours === "") {
                $("#exam_duration_hours_error").show(); // Show error if hours is not selected
            }
            if (minutes === "") {
                $("#exam_duration_minutes_error").show(); // Show error if minutes is not selected
            }
            if (hours === "" || minutes === "") {
                return; // Stop submission if either hours or minutes are empty
            } else {
                // Combine hours and minutes into a single value (if needed)
                let duration = hours + ":" + minutes;

                // Add the duration to a hidden input or FormData as needed
                $("#exam_duration_hidden").val(duration);
            }
        }

        var formData = new FormData($(".AssignmetFormData")[0]);
        formData.append("instruction", programme_outcomes);
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-assignment",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".AssignmetFormData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/assignment";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message || "",
                        icon: response.icon,
                    };
                    source = 'assignment';

                    var redirect = `/admin/${source}`;

                    showModalWithRedirect(modalData, redirect);
                }
            },
        });
    });
    $("#editsection").on("change", function () {
        var id = $(this).val();
        $.ajax({
            url: baseUrl + "/admin/assignmentdata/" + id,
            type: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                EditData = "";
                response.data.forEach((user) => {
                    var Editdata =
                        '<div id="courseOne"><div class="list-group-item rounded px-3 text-nowrap mb-1" id="development"><div class="d-flex align-items-center justify-content-between"><h5 class="mb-0 text-truncate"><a href="#" class="text-inherit"><span class="align-middle fs-4"> <i class="bi bi-question-circle"></i>' +
                        user.question +
                        '</span> </a></h5><div><a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal" data-bs-target="#editQuestion"></i></a><a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete"><i class="fe fe-trash-2 fs-5" data-bs-toggle="modal" data-bs-target="#delete-modal"></i></a></div></div></div></div>';

                    EditData += Editdata;
                });
                $("#QuestionList").html(EditData);
            },
        });
    });

    $(".add-quiz-section").on("click", function (event) {
        event.preventDefault();
        $("#section_error").hide();
        $("#quiz_tittle_error").hide();

        var section_id = $("#section_id ").val();
        var quiz_tittle = $("#quiz_tittle").val();

        if (section_id === "") {
            $("#section_error").show();
            return;
        }
        if (quiz_tittle === "") {
            $("#quiz_tittle_error").show();
            return;
        }
        var formData = new FormData($(".quiz-section")[0]);

        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/addquiz",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".quiz-section")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#addQuiz").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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

    $(".addQuestion").on("click", function (event) {
        event.preventDefault();
        var formData = $(this).closest(".quiz").serialize();
        $(".save_loader").removeClass("d-none").addClass("d-block");

        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/addQuizQuestion",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").removeClass("d-block");
                $(".errors").remove();
                if (response.code === 202) {
                    $("#addQuestion").modal("show");
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $("form")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#addQuestion").modal("hide");
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        window.location.reload();
                    });
                }
            },
        });
    });
    let quill;
    $(".addAssignQuestionOpen").on("click", function (event) {
        event.preventDefault();
        

        $("#question").val("");
        $("#assignment_mark").val("");
        $("#question_id").val("");
        $("#assignment_answer_limit").val("");
        $("#AssignQuestionModelLabel").html("Add Question");
        $("#editButton").html("Add Question");
        
        if (!quill) {
            quill = new Quill('#question', {
                theme: 'snow'
            });
    
            quill.on('text-change', function() {
                var content = quill.root.innerHTML;
                $('#questionData').val(content);
            });
        }

        $("#AssignQuestionModel").modal("show");
    });
    
    $("#inputGroupFile04").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        $(".input-visible").text(file.name);
    });
    $(".addAssignQuestion").on("click", function (event) {
        event.preventDefault();
        $("#question_error").hide();
        $("#assignment_mark_error").hide();
        $("#assignment_answer_limit_error").hide();

        var question = $("#questionData").val();
        var assignment_mark = $("#assignment_mark").val();
        var assignment_answer_limit = $("#assignment_answer_limit").val();

        if (question === "") {
            $("#question_error").show();
            return;
        }
        var question = $("#question .ql-editor").html();
        var text1 = $(question).text();
        var charCount1 = text1.length;
        // if (charCount1 < 3 || charCount1>255) {
            
        //     $("#question_error").text("Question title must be between 3 to 255 characters.");
        //     $("#question_error").show();
        //     return;
        // }        
        
        if (assignment_mark === "") {
            $("#assignment_mark_error").show();
            return;
        }
        if (assignment_answer_limit === "") {
            $("#assignment_answer_limit_error").show();
            return;
        }
        var formData = $(".assignmentQuestions").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-assignment-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();

                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".assignmentQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#AssignQuestionModel").modal("hide");

                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    function decodeHTMLEntities(text) {
        var textArea = document.createElement('textarea');
        textArea.innerHTML = text;
        return textArea.value;
    }
    
    $(".editViewAssignQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        // alert(questionID);
        $(".assignmentQuestions")[0].reset();
        $("#processingLoader").fadeIn();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-assignment-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (!quill) {
                    quill = new Quill('#question', {
                        theme: 'snow'
                    });
    
                    quill.on('text-change', function() {
                        var content = quill.root.innerHTML;
                        $('#questionData').val(content);
                    });

                }
                  
                  
                if (response.code == 200) {
                    $("#question").attr("value", response.data.question);
                    
                    let question = response.data.question || '';
                    var decodedContent = decodeHTMLEntities(question);
                    quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    
                    $('#question').val(decodedContent);

                    $("#assignment_answer_limit").attr(
                        "value",
                        response.data.answer_limit
                    );
                    $("#assignment_mark").attr(
                        "value",
                        response.data.assignment_mark
                    );
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#assign_id").attr(
                        "value",
                        btoa(response.data.assignments_id)
                    );
                    $("#AssignQuestionModelLabel").html("Edit Question");
                    $("#editButton").html("Edit Question");
                    $("#AssignQuestionModel").modal("show");
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
                    // setTimeout(() => {
                    //     window.location.reload();
                    // }, 2000);
                }
            },
        });
    });
    $(document).on("click", ".deleteAssingQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
                const modalData = {
                    title: "Delete Question",
                    message: "Are you sure you want to delete question?",
                    icon: warningIconPath,
                };
                
                showModal(modalData, true);
                
                $("#modalCancel").on("click", function () {
                    $("#customModal").hide();
                });
                $("#modalOk").on("click", function () {
                    $("#customModal").hide();
                    $("#processingLoader").fadeIn();
                    // $(".save_loader").removeClass("d-none").addClass("d-block");
                    $.ajax({
                        url: baseUrl + "/admin/delete-assignment-question",
                        type: "POST",
                        data: { id: question_id },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            $("#processingLoader").fadeOut();
                            if (response.code === 200) {
                                deleteElement.slideUp();
                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // });
                                const modalData = {
                                    title: response.title,
                                    message: response.message,
                                    icon: successIconPath,
                                };
                                
                                showModal(modalData);
                            } else {
                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // });
                                
                                const modalData = {
                                    title: response.title,
                                    message: response.message,
                                    icon: errorIconPath,
                                };
                                
                                showModal(modalData);
                            }
                        },
                    });
                });
            //     }
            // });
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            };
            
            showModal(modalData);
        }
    });
    $(document).on("click", ".deleteAssginment", function (event) {
        var assign_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var course_id = $(this).data("course_id");

        if (assign_id != "") {
            // swal({
            //     title: "Delete Assignment",
            //     text: "Are you sure you want to delete assignment?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: 'Delete Assignment',
                message: "Are you sure you want to delete assignment?",
                icon: warningIconPath,
            };
            
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader").removeClass("d-none").addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-assignment",
                    type: "POST",
                    data: { id: assign_id, course_id: course_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // });
                            
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };
                            showModal(modalData);
                        } else {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // });
                            
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };
                            showModal(modalData);
                        }
                    },
                });
            });

            //     }
            // });
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: response.icon,
            };
            showModal(modalData);
        }
    });
    $(".editquestionquiz").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("qestionid");
        // alert(questionID);

        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/editQuizQuestion",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.code == 200) {
                    var ans_id = response.data.answer;
                    function decode(html) {
                        var input = $("<input>").html(html).text();
                        return input;
                    }
                    $(".question").attr(
                        "value",
                        decode(response.data.question)
                    );
                    $(".option1").attr("value", decode(response.data.option1));
                    $(".option2").attr("value", decode(response.data.option2));
                    $(".option3").attr("value", decode(response.data.option3));
                    $(".option4").attr("value", decode(response.data.option4));
                    $(".quiz_id").attr("value", btoa(response.data.quiz_id));
                    $(".question_id").attr("value", btoa(response.data.id));
                    $(".answer" + ans_id).prop("checked", true);
                    $("#addQuestion").modal("hide");
                } else {
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    });
                }
            },
        });
    });

    
    $(document).on("click", ".deleteQuizQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".accordion-item");
        if (question_id != "") {
            swal({
                title: "Delete Question",
                text: "Are you sure you want to delete question?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");
                    $.ajax({
                        url: baseUrl + "/admin/delete-quiz-question",
                        type: "POST",
                        data: { id: question_id },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            
                            $(".save_loader")
                                .addClass("d-none")
                                .removeClass("d-block");
                            if (response.code === 200) {
                                deleteElement.slideUp();
                                swal({
                                    title: response.title,
                                    text: response.message,
                                    icon: response.icon,
                                });
                            } else {
                                swal({
                                    title: response.title,
                                    text: response.message,
                                    icon: response.icon,
                                });
                            }
                        },
                    });
                }
            });
        } else {
            swal({
                title: "Something Went Wrong",
                text: "Please Try Again",
                icon: "error",
            });
        }
    });
    $(document).on("click", ".deleteQuiz", function (event) {
        var question_id = $(this).data("question_id");
        var allVals= [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr("data-question_id"));
        });
        if ($(this).data("question_id") != undefined) {
            var deletevalue = $(this).data("question_id");
            if (deletevalue) {
                allVals.push(deletevalue);
            }
        }
        if (allVals.length != 0) {
            // swal({
            //     title: "Delete Quiz",
            //     text: "Are you sure you want to delete quiz?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
            
            const modalData = {
                title: "Delete Quiz",
                message: "Are you sure you want to delete quiz?.",
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
                        url: baseUrl + "/admin/delete-quiz",
                        type: "POST",
                        data: { id: allVals },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            $("#processingLoader").fadeOut();
                            if (response.code === 200) {
                                // deleteElement.slideUp();
                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // }).then(function () {
                                //     return (window.location.href =
                                //         "/admin/quiz");
                                // });
                                const modalData = {
                                    title: response.title,
                                    message: response.message || "",
                                    icon: response.icon,
                                };
            
                                var redirect = `/admin/quiz`;
            
                                showModalWithRedirect(modalData, redirect);
                            } else {
                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // });
                                const modalData = {
                                    title: response.title,
                                    message: response.message || "",
                                    icon: response.icon,
                                };
                                showModal(modalData);
                            }
                        },
                    });
            });
        } else {
            // swal({
            //     title: "",
            //     text: "Please Select At Least One Record",
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

    // Mock Interview Exam
    $("#addMockInter").on("click", function (event) {
        event.preventDefault();
        $("#interview_tittle_error").hide();
        $("#assignment_award_error").hide();

        var form = $("#addAssignData").serialize();
        var interview_title = $("#mockinterview_tittle").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#assignment_award_error").show();
            return;
        }
        if (interview_title === "") {
            $("#interview_tittle_error").show();
            return;
        }
        var form = $("#addMockData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-mock-interview",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addMockData")[0].reset();
                    $("#addMockInterview").modal("hide");
                    
                    const modalData = {
                        title: response.title,
                        message: response.message,
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
                    //     window.location.reload();
                    // });
                }
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addMockData")[0].reset();
                    $("#addMockInterview").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    $(".addMockQuestionOpen").on("click", function (event) {
        event.preventDefault();
        $("#question").val("");
        $("#assignment_mark").val("");
        $("#question_id").val("");
        $("#assignment_answer_limit").val("");
        $("#AssignQuestionModelLabel").html("Add Question");
        $("#AssignQuestionModel").modal("show");
    });
    $(".addMockQuestion").on("click", function (event) {

        event.preventDefault();
        $("#question_error").hide();
        $("#interview_mark_error").hide();
        $("#file_type_error").hide();
        $("#word_limit_error").hide(); 
        var question = $("#question").val();
        var interview_mark = $("#mark").val();
        var word_limit = $("#word_limit").val();
        var type = $("#type").val();

        if (question === "") {
            $("#question_error").show();
            return;
        }
        if(question.length<3 || question.length>255){
            $("#question_error").show();
            $("#question_error").text("Question should be between 3 and 255 characters long.");
            return;
        }
        if (interview_mark === "") {
            $("#interview_mark_error").show();
            return;
        }

        if (type === "final-thesis" && word_limit === "") {
            $("#word_limit").addClass("is-invalid");
            $("#word_limit_error").show().text("Word limit is required for final thesis.");
            return;
        } else {
            $("#word_limit").removeClass("is-invalid");
            $("#word_limit_error").hide();
        }

        var selectedFileType = $('input[name="file_type"]:checked').val();
        if (typeof selectedFileType === 'undefined') {
            $("#file_type_error").show();
            return;
        }
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        var formData = $(".MockQuestions").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-mock-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".MockQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#addQuestion").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    $(".editViewMockQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        // alert(questionID);
        $(".MockQuestions")[0].reset();
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-mock-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (response.code == 200) {
                    $("#question").attr("value", response.data.question);
                    $("#mark").attr("value", response.data.marks);
                    $("#word_limit").attr("value", response.data.word_limit);
                    var fietype = response.data.file_type;
                    if (fietype === "1") {
                        $("#filePdf").prop("checked", true);
                    } else if (fietype === "2") {
                        $("#fileVideo").prop("checked", true);
                    }
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#mock_id").attr(
                        "value",
                        btoa(response.data.mock_intr_id)
                    );
                    $("#AssignQuestionModelLabel").html("Edit Question");
                    $(".addMockQuestion").html("Update Question");
                    $("#addQuestion").modal("show");
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
    $(".updateMockInterview").on("click", function (event) {

        event.preventDefault();
        $("#mock_title_error").hide();
        $("#percentage_error").hide();
        $("#programme_outcomes_error").hide();
        $("#instruction_error").hide();
        var mock_title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#interview_instruction .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;

        // var instructions = $(programme_outcomes).text();
        if (mock_title === "") {
            $("#mock_title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        }


        var formData = new FormData($(".MockFormData")[0]);
        formData.append("instruction", instruction);
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-mock",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".MockFormData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/" + $("#redirect").val();
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/" + $("#redirect").val());
                }
            },
        });
    });
       $(".updateEmentor, .submitEmentor").on("click", function (event) {
           event.preventDefault();
           var type = $(this).data("type");
           var examtype = $(this).data("examtype");
           var actionType = $(this).hasClass("updateEmentor") ? "draft" : "submit";

           //    var formData = new FormData($("#examMarksForm")[0]);
           var form = $("#examMarksForm").serialize();
           var data = new URLSearchParams(form);
           
            var formData = form + '&actionType=' + actionType;
           $("#loader").fadeIn();
        //    swal({
        //        title: "Are you sure?",
        //        text: "",
        //        icon: "warning",
        //        buttons: true,
        //        dangerMode: true,
        //    }).then((willDelete) => {
        //        if (willDelete) {
                
        //             $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: 'Are you sure?',
                message: "",
                icon: warningIconPath,
            };
            
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader").removeClass("d-none").addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/ementor/check-submit",
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
                            //    swal({
                            //        title: response.title,
                            //        text: response.message,
                            //        icon: response.icon,
                            //    }).then(function () {
                            //         window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id')+ '/' + data.get('student_course_master_id');
                                    
                            //    });

                            const modalData = {
                                title: response.title,
                                message: response.message,
                                icon: response.icon,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id')+ '/' + data.get('student_course_master_id');
                            }, 2000);
                        } else {
                            //    swal({
                            //        title: response.title,
                            //        text: response.message,
                            //        icon: response.icon,
                            //    });

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
       });
       $(".deletePdfFile").on("click", function (event) {
           event.preventDefault();
           var file_id = $(this).data("file_id");
           var deleteElement = $(this).closest(".list-group-item");

           if (question_id != "") {
            //    swal({
            //        title: "Delete File",
            //        text: "Are you sure you want to delete File?",
            //        icon: "warning",
            //        buttons: true,
            //        dangerMode: true,
            //    }).then((willDelete) => {
                
                const modalData = {
                    title: "Delete File",
                    message: "Are you sure you want to delete File?",
                    icon: warningIconPath,
                }
                showModal(modalData, true);
                $("#modalCancel").on("click", function () {
                    $("#customModal").hide();
                });
                $("#modalOk").on("click", function () {
                    // $(".save_loader")
                    //     .removeClass("d-none")
                    //     .addClass("d-block");
                    $("#customModal").hide();
                    $("#processingLoader").fadeIn();
                    $.ajax({
                        url: baseUrl + "/admin/delete-pdf-file",
                        type: "POST",
                        data: { id: file_id },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            $("#processingLoader").fadeOut();
                            if (response.code === 200) {
                                // deleteElement.slideUp();
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
           } else {
            //    swal({
            //        title: "Something Went Wrong",
            //        text: "Please Try Again",
            //        icon: "error",
            //    });

                const modalData = {
                    title: "Something Went Wrong",
                    message: "Please Try Again",
                    icon: errorIconPath,
                }
               showModal(modalData);
           }
       });
       $(document).on("click", ".deleteMockQuestion", function (event) {
           event.preventDefault();
           var question_id = $(this).data("question_id");
           var deleteElement = $(this).closest(".list-group-item");

           if (question_id != "") {
            //    swal({
            //        title: "Delete Question",
            //        text: "Are you sure you want to delete question?",
            //        icon: "warning",
            //        buttons: true,
            //        dangerMode: true,
            //    }).then((willDelete) => {
            //        if (willDelete) {
                const modalData = {
                    title: "Delete File",
                    message: "Are you sure you want to delete File?",
                    icon: warningIconPath,
                }
                showModal(modalData, true);
                $("#modalCancel").on("click", function () {
                    $("#customModal").hide();
                });
                $("#modalOk").on("click", function () {
                    // $(".save_loader")
                    //     .removeClass("d-none")
                    //     .addClass("d-block");
                    $("#customModal").hide();
                    $("#processingLoader").fadeIn();
                    $.ajax({
                        url: baseUrl + "/admin/delete-mock-question",
                        type: "POST",
                        data: { id: question_id },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            $("#processingLoader").fadeOut();
                            if (response.code === 200) {
                                deleteElement.slideUp();
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
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            }
                        },
                    });
                });
           } else {
            //    swal({
            //        title: "Something Went Wrong",
            //        text: "Please Try Again",
            //        icon: "error",
            //    });
               
                const modalData = {
                    title: "Something Went Wrong",
                    message: "Please Try Again",
                    icon: errorIconPath,
                }
                showModal(modalData);
           }
       });
       $(document).on("click", ".deleteMock", function (event) {
           event.preventDefault();
           var mock_id = $(this).data("assign_id");
           var deleteElement = $(this).closest("tr");
           var course_id = $(this).data("course_id");

           if (mock_id != "") {
            //    swal({
            //        title: "Delete Mock Interview",
            //        text: "Are you sure you want to delete mock interview?",
            //        icon: "warning",
            //        buttons: true,
            //        dangerMode: true,
            //    }).then((willDelete) => {
            //        if (willDelete) {
            
                const modalData = {
                    title: "Delete Mock Interview",
                    message: "Are you sure you want to delete mock interview?",
                    icon: warningIconPath,
                }
                showModal(modalData, true);
                $("#modalCancel").on("click", function () {
                    $("#customModal").hide();
                });
                $("#modalOk").on("click", function () {
                    $("#customModal").hide();
                    $("#processingLoader").fadeIn();
                    // $(".save_loader")
                    //     .removeClass("d-none")
                    //     .addClass("d-block");
                    $.ajax({
                        url: baseUrl + "/admin/delete-mock-interview",
                        type: "POST",
                        data: { id: mock_id, course_id: course_id  },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            // $(".save_loader")
                            //     .addClass("d-none")
                            //     .removeClass("d-block");
                            $("#processingLoader").fadeOut();
                            if (response.code === 200) {
                                deleteElement.slideUp();
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
           } else {
            //    swal({
            //        title: "Something Went Wrong",
            //        text: "Please Try Again",
            //        icon: "error",
            //    });
               
               const modalData = {
                    title: "Something Went Wrong",
                    message: "Please Try Again",
                    icon: errorIconPath,
                }
                showModal(modalData);
           }
       });

       $(document).on("click", ".deleteFinalThesis", function (event) {
        event.preventDefault();
        var mock_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var course_id = $(this).data("course_id");

        if (mock_id != "") {
            // swal({
            //     title: "Delete Final Thesis",
            //     text: "Are you sure you want to delete final thesis?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {

            const modalData = {
                title: "Delete Final Thesis",
                message: "Are you sure you want to delete final thesis?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-mock-interview",
                    type: "POST",
                    data: { id: mock_id, course_id: course_id  },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // }); 

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
             }
             showModal(modalData);
        }
    });
       
    
    // Vlog Exam

    $(".addVlogQuestionOpen").on("click", function (event) {
        event.preventDefault();
        

        $("#question").val("");
        $("#assignment_mark").val("");
        $("#question_id").val("");
        $("#VlogQuestionModelLabel").html("Add Question");
        $("#editButton").html("Add Question");
        
        if (!quill) {
            quill = new Quill('#question', {
                theme: 'snow'
            });
    
            quill.on('text-change', function() {
                var content = quill.root.innerHTML;
                $('#questionData').val(content);
            });
        }

        $("#vlogQuestionModelOpen").modal("show");
    });

    $("#addVlogInter").on("click", function (event) {
        event.preventDefault();
        $("#vlog_title_error").hide();
        $("#vlog_award_error").hide();

        var form = $("#addVlogData").serialize();
        var vlog_title = $("#vlog_title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#vlog_award_error").show();
            return;
        }
        if (vlog_title === "") {
            $("#vlog_title_error").show();
            return;
        }
        var form = $("#addVlogData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-vlog",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addVlogData")[0].reset();
                    $("#vlogModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addVlogData")[0].reset();
                    $("#vlogModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".addVlogQuestion").on("click", function (event) {

        event.preventDefault();
        $("#question_error").hide();
        $("#vlog_mark_error").hide();
        // var question = $("#question").val();
        var interview_mark = $("#mark").val();
        // var question = $("#question").innerText();
        // alert(question);
     

        var question = $("#question .ql-editor").html();
        if (question === "") {
            $("#question_error").show();
            return;
        }
        var text1 = $(question).text();
        var charCount1 = text1.length;
        if (charCount1 < 3 || charCount1>255) {
            
            $("#question_error").text("Question title must be between 3 to 255 characters.");
            $("#question_error").show();
            return;
        }        
        if (interview_mark === "") {
            $("#vlog_mark_error").show();
            return;
        }
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        // var formData = $(".VlogQuestions").serialize();
        var formData = new FormData($(".VlogQuestions")[0]);
        formData.append("question", question);
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-vlog-question",
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
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".vlogQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#vlogQuestionModelOpen").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".editViewVlogQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        $(".vlogQuestions")[0].reset();
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-vlog-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // if (!quill) {
                //     quill = new Quill('#question', {
                //         theme: 'snow'
                //     });
    
                //     quill.on('text-change', function() {
                //         var content = quill.root.innerHTML;
                //         $('#questionData').val(content);
                //     });

                // }
                // debgge
                $("#processingLoader").fadeOut();
                if (response.code == 200) {
                    // $("#question").attr("value", response.data.question);
                    
                    // let question = response.data.question || '';
                    // var decodedContent = decodeHTMLEntities(question);
                    // quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    // $('#question').val(decodedContent);
                    // $("#mark").attr("value", response.data.marks);
                    // $("#question_id").attr("value", btoa(response.data.id));
                    // $("#vlog_id").attr(
                    //     "value",
                    //     btoa(response.data.vlog_id)
                    // );
                    $("#question").attr("value", response.data.question);
                    if (!quill) {
                        quill = new Quill('#question', {
                            theme: 'snow'
                        });
                
                        quill.on('text-change', function() {
                            var content = quill.root.innerHTML;
                            $('#question').val(content);
                        });
                    }
                    let question = response.data.question || '';
                    var decodedContent = decodeHTMLEntities(question);
                    quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    $('#question').val(decodedContent);
                    $("#mark").attr("value", response.data.marks);
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#vlog_id").attr(
                            "value",
                            btoa(response.data.vlog_id)
                        );
                    $("#vlogQuestionModelLabel").html("Edit Question");
                    $(".addVlogQuestion").html("Edit Question");
                    
                  
            
                    $("#vlogQuestionModelOpen").modal("show");
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
    
    $(document).on("click", ".deleteVlogQuestion", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
                    
            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-vlog-question",
                    type: "POST",
                    data: { id: question_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     window.location.reload();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    $(".updateVlog").on("click", function (event) {
        event.preventDefault();
        $("#vlog_title_error").hide();
        $("#percentage_error").hide();
        $("#programme_outcomes_error").hide();
        var vlog_title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#instruction_vlog .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;

        if (vlog_title === "") {
            $("#vlog_title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        }


        var formData = new FormData($(".VlogFormData")[0]);
        formData.append("instruction", instruction);
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-vlog",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".VlogFormData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/vlog";
                    // });
                    
            
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/vlog");
                }
            },
        });
    });
    
    $(".deleteVlogPdfFile").on("click", function (event) {
        event.preventDefault();
        var file_id = $(this).data("file_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete File",
            //     text: "Are you sure you want to delete File?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: "Delete File",
                message: "Are you sure you want to delete File?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-vlog-pdf-file",
                    type: "POST",
                    data: { id: file_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     window.location.reload();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    $(document).on("click", ".deleteVlog", function (event) {
        event.preventDefault();
        var vlog_id = $(this).data("assign_id");
        var award_id = $(this).data("course_id");
        var deleteElement = $(this).closest("tr");

        if (vlog_id != "") {
            // swal({
            //     title: "Delete Vlog",
            //     text: "Are you sure you want to delete vlog?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            const modalData = {
                title: "Delete Vlog",
                message: "Are you sure you want to delete vlog?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-vlog",
                    type: "POST",
                    data: { id: vlog_id, course_id: award_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
                                

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    // Peer Review Exam
    $("#addPeerReview").on("click", function (event) {
        event.preventDefault();
        $("#peer_review_award_error").hide();
        $("#peer_review_title_error").hide();

        var form = $("#addPeerReviewData").serialize();
        var peer_review_title = $("#peer_review_title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#peer_review_award_error").show();
            return;
        }
        if (peer_review_title === "") {
            $("#peer_review_title_error").show();
            return;
        }
        var form = $("#addPeerReviewData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-peer-review",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addPeerReviewData")[0].reset();
                    $("#peerreview").modal("hide");

                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addPeerReviewData")[0].reset();
                    $("#peerreview").modal("hide");

                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updatePeerReview").on("click", function (event) {
        event.preventDefault();
        $("#peer_review_title_error").hide();
        $("#percentage_error").hide();
        $("#programme_outcomes_error").hide();
        $("#journal_file_error").hide();
        var peer_review_title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#instruction_peer_review .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;
        if (peer_review_title === "") {
            $("#peer_review_title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        } 

        var formData = new FormData($(".PeerReviewFormData")[0]);
        formData.append("instruction", instruction);
        
        var hasInstructionFile = false; 
        pond.getFiles().forEach(function(fileItem) {
            
            formData.append('instruction_file', fileItem.file);
            hasInstructionFile = true;
        });
        
        if (!hasInstructionFile && !hasInstructionFileUploaded) {
            // swal({
            //     title: "Warning!",
            //     text: "Please upload an video file.",
            //     icon: "warning",
            // });
            
            const modalData = {
                title: "Warning!",
                message: "Please upload an video file.",
                icon: warningIconPath,
            }
            showModal(modalData);
            return;
        }
        
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn()
        // $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-peer-review",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut()
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".PeerReviewFormData")
                            .find("[name='" + key + "']")
                            .after("<div class='invalid-feedback errors d-block'><i>" + value + "</i></div>");
                    });
                } else {
                    // $(".save_loader").addClass("d-none").removeClass("d-block");
                    // $("#processingLoader").fadeOut()
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/peer-review";
                    // });
                    
            
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/peer-review");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut()
                // swal({
                //     title: "Error",
                //     text: "There was a problem processing your request. Please try again later.",
                //     icon: "error",
                // });
                
                const modalData = {
                    title: "Error",
                    text: "There was a problem processing your request. Please try again later.",
                    icon: errorIconPath,
                }
                showModal(modalData);
            }
            
        });
        
    });
    
    $(document).on("click", ".deletePeerReview", function (event) {
        event.preventDefault();
        var peer_review_id = $(this).data("assign_id");
        var award_id = $(this).data("course_id");
        var deleteElement = $(this).closest("tr");

        if (peer_review_id != "") {
            // swal({
            //     title: "Delete Peer Review",
            //     text: "Are you sure you want to delete peer review?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: "Delete Peer Review",
                message: "Are you sure you want to delete peer review?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-peer-review",
                    type: "POST",
                    data: { id: peer_review_id, course_id: award_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
                        } else {
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    // forum leadership
    $("#addDiscord").on("click", function (event) {
        event.preventDefault();
        $("#discord_award_error").hide();
        $("#percentage_error").hide();
        $("#marks_error").hide();

        var form = $("#addDiscordData").serialize();
        var award_id = $("#award_id").val();
        var percentage = $("#percentage").val();
        var marks = $("#marks").val();

        if (award_id === "") {
            $("#discord_award_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (marks === "") {
            $("#marks_error").show();
            return;
        }
        var form = $("#addDiscordData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $('#processingLoader').fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-discord",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $('#processingLoader').fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addDiscordData")[0].reset();
                    $("#discordView").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addDiscordData")[0].reset();
                    $("#discordView").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updateDiscord").on("click", function (event) {
        event.preventDefault();
        $("#marks_error").hide();
        $("#percentage_error").hide();
        var percentage = $("#percentage_edit").val();
        var marks = $("#marks_edit").val();

        if (marks === "") {
            $("#marks_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }

        var formData = new FormData($(".discordFormData")[0]);
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-discord",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".discordFormData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#editdiscordView").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/forum-leadership";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/forum-leadership");
                }
            },
        });
    });

    $(document).on("click", ".deleteForumLeadership", function (event) {
        event.preventDefault();
        var vlog_id = $(this).data("assign_id");
        var award_id = $(this).data("course_id");
        var deleteElement = $(this).closest("tr");

        if (vlog_id != "") {
            // swal({
            //     title: "Delete Forum Leadership",
            //     text: "Are you sure you want to delete forum leadership?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: "Delete Forum Leadership",
                message: "Are you sure you want to delete forum leadership?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                    
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-discord",
                    type: "POST",
                    data: { id: vlog_id, course_id: award_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                            
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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

                        } else {

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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
                           
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    // reflective journals Exam
    $("#addReflectiveJournals").on("click", function (event) {
        event.preventDefault();
        $("#reflective_journals_award_error").hide();
        $("#reflective_journals_title_error").hide();

        var form = $("#addReflectiveJournalsData").serialize();
        var reflective_journals_title = $("#reflective_journals_title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#reflective_journals_award_error").show();
            return;
        }
        if (reflective_journals_title === "") {
            $("#reflective_journals_title_error").show();
            return;
        }
        var form = $("#addReflectiveJournalsData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-reflective-journal",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addReflectiveJournalsData")[0].reset();
                    $("#reflectiveJournals").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addReflectiveJournalsData")[0].reset();
                    $("#reflectiveJournals").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updateReflectiveJournal").on("click", function (event) {

        event.preventDefault();
        $("#reflective_journals_title_error").hide();
        $("#percentage_error").hide();
        $("#instruction_error").hide();
        var title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#refletive_journals_instruction .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;
        if (title === "") {
            $("#reflective_journals_title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        }


        var formData = new FormData($(".reflectiveJournalData")[0]);
        formData.append("instruction", instruction);
        // $("#loader").fadeIn();
        
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-reflective-journal",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".reflectiveJournalData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/reflective-journals";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/reflective-journals");
                }
            },
        });
    });
    
    $(".deleteReflectiveJournalPdfFile").on("click", function (event) {
        event.preventDefault();
        var file_id = $(this).data("file_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (file_id != "") {
            // swal({
            //     title: "Delete File",
            //     text: "Are you sure you want to delete File?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: "Delete File",
                message: "Are you sure you want to delete File?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-reflective-journal-pdf-file",
                    type: "POST",
                    data: { id: file_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                            
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     window.location.reload();
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
                        } else {
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
             
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
            
        }
    });
    
    $(".addReflectiveJournalQuestionOpen").on("click", function (event) {
        event.preventDefault();
        
        if (!quill) {
            quill = new Quill('#question', {
                theme: 'snow'
            });
    
            quill.on('text-change', function() {
                var content = quill.root.innerHTML;
                $('#questionData').val(content);
            });
        }

        $("#question").val("");
        $("#marks").val("");
        $("#question_id").val("");
        $("#answer_limit").val("");
        $("#questionModelLabel").html("Add Question");
        $("#editButton").html("Add Question");

        $("#questionModel").modal("show");
    });
    
    $(".addReflectiveJournalQuestion").on("click", function (event) {
        event.preventDefault();
        $("#question_error").hide();
        $("#mark_error").hide();
        $("#answer_limit_error").hide();

        // var question = $("#question").val();
        var mark = $("#marks").val();
        var answer_limit = $("#answer_limit").val();
        var question = $("#questionData").val();

        if (question === "") {
            $("#question_error").show();
            return;
        }
        var question = $("#question .ql-editor").html();
        var text1 = $(question).text();
        var charCount1 = text1.length;

        if(charCount1 === ""){
            $("#question_error").show();
            return;
        }
        if (charCount1 < 3 || charCount1>255) {
            
            $("#question_error").text("Question should be between 3 and 255 characters long.");
            $("#question_error").show();
            return;
        } 
        // if(question.length<3 || question.length>255){
        //     $("#question_error").text("Question should be between 3 and 255 characters long.");
        //     $("#question_error").show();
        //     return;
        // }
        if (mark === "") {
            $("#mark_error").show();
            return;
        }
        if (answer_limit === "") {
            $("#answer_limit_error").show();
            return;
        }
        var formData = $(".reflectiveJournalQuestions").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-reflective-journal-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $("#processingLoader").fadeOut();

                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".reflectiveJournalQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#questionModel").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".editViewReflectiveJournalQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        $(".reflectiveJournalQuestions")[0].reset();
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-reflective-journal-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (!quill) {
                    quill = new Quill('#question', {
                        theme: 'snow'
                    });
    
                    quill.on('text-change', function() {
                        var content = quill.root.innerHTML;
                        $('#questionData').val(content);
                    });

                }
                  
                  
                if (response.code == 200) {
                    $("#question").attr("value", response.data.question);
                    
                    let question = response.data.question || '';
                    var decodedContent = decodeHTMLEntities(question);
                    quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    
                    $('#question').val(decodedContent);

                    $("#answer_limit").attr(
                        "value",
                        response.data.answer_limit
                    );
                    $("#marks").attr(
                        "value",
                        response.data.marks
                    );
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#assign_id").attr(
                        "value",
                        btoa(response.data.assignments_id)
                    );
                    $("#questionModelLabel").html("Edit Question");
                    $("#editButton").html("Edit Question");
                    $("#questionModel").modal("show");
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

    $(document).on("click", ".deleteReflectiveJournalQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
                    
            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-reflective-journal-question",
                    type: "POST",
                    data: { id: question_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    $(document).on("click", ".deleteReflectiveJournal", function (event) {
        var assign_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var award_id = $(this).data("course_id");

        if (assign_id != "") {
            // swal({
            //     title: "Delete Reflective Journal",
            //     text: "Are you sure you want to delete reflective journal?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
            
            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-reflective-journal",
                    type: "POST",
                    data: { id: assign_id, course_id: award_id  },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                text: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    // MCQ
    $("#addMcq").on("click", function (event) {
        event.preventDefault();
        $("#award_error").hide();
        $("#title_error").hide();

        var form = $("#multiplechoiceForm").serialize();
        var title = $("#title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#award_error").show();
            return;
        }
        if (title === "") {
            $("#title_error").show();
            return;
        }
        var form = $("#multiplechoiceForm").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-mcq",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#multiplechoiceForm")[0].reset();
                    $("#addMultipleChoice").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#multiplechoiceForm")[0].reset();
                    $("#addMultipleChoice").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updateMcq").on("click", function (event) {

        event.preventDefault();
        $("#title_error").hide();
        $("#percentage_error").hide();
        var title = $("#title").val();
        var percentage = $("#percentage").val();

        if (title === "") {
            $("#title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }

        if ($("#enable_duration").is(":checked")) {
            let hours = $("#exam_duration_hours").val();
            let minutes = $("#exam_duration_minutes").val();

            // Separate error messages for hours and minutes
            if (hours === "") {
                $("#exam_duration_hours_error").show();
            }
            if (minutes === "") {
                $("#exam_duration_minutes_error").show();
            }
            if (hours === "" || minutes === "") {
                return;
            } else {
                let duration = hours + ":" + minutes;
                $("#exam_duration_hidden").val(duration);
            }
        }

        var formData = new FormData($(".mcqData")[0]);
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-mcq",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".mcqData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/multiple-choice";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/multiple-choice");
                }
            },
        });
    });
    
    $(".addMcqQuestion").on("click", function (event) {
        event.preventDefault();
        var formData = $(this).closest(".mcq").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        var modalType = $(this).data("modal");
        
        $("#processingLoader").fadeIn();

        // $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-mcq-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $("#processingLoader").fadeOut();
                
                $(".errors").remove();
                if (response.code === 202) {
                    $("#addQuestion").modal("show");
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $("form")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    if(modalType === 'add'){
                        $("#addQuestion").modal("hide");
                    }else if(modalType === 'edit'){
                        $("#editQuestion").modal("hide");
                    }
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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

    $(".editMcqQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("qestionid");
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-mcq-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (response.code == 200) {
                    
                    
                    var ans_id = response.data.answer;
                    function decode(html) {
                        var input = $("<input>").html(html).text();
                        return input;
                    }
                    $(".question").attr(
                        "value",
                        decode(response.data.question)
                    );
                    $(".option1").attr("value", decode(response.data.option1));
                    $(".option2").attr("value", decode(response.data.option2));
                    $(".option3").attr("value", decode(response.data.option3));
                    $(".option4").attr("value", decode(response.data.option4));
                    $(".mark").attr("value", decode(response.data.mark));
                    $(".mcq_id").attr("value", btoa(response.data.mcq_id));
                    $(".question_id").attr("value", btoa(response.data.id));
                    $(".answer" + ans_id).prop("checked", true);
                    $("#addQuestion").modal("hide");
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
    
    $(document).on("click", ".deleteMcq", function (event) {
        var assign_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var award_id = $(this).data("course_id");

        if (assign_id != "") {
            // swal({
            //     title: "Delete Multiple Choice",
            //     text: "Are you sure you want to delete multiple choice?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
                    
            const modalData = {
                title: "Delete Multiple Choice",
                message: "Are you sure you want to delete multiple choice?",
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
                    url: baseUrl + "/admin/delete-mcq",
                    type: "POST",
                    data: { id: assign_id, course_id: award_id  },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                                            
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
                    
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    $(document).on("click", ".deleteMcqQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block"); 

            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-mcq-question",
                    type: "POST",
                    data: { id: question_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");

                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    // survey Exam
    $("#addSurvey").on("click", function (event) {
        event.preventDefault();
        $("#award_error").hide();
        $("#title_error").hide();

        var form = $("#addSurveyData").serialize();
        var title = $("#title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#award_error").show();
            return;
        }
        if (title === "") {
            $("#title_error").show();
            return;
        }
        var form = $("#addSurveyData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-survey",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addSurveyData")[0].reset();
                    $("#surveyModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addSurveyData")[0].reset();
                    $("#surveyModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updateSurvey").on("click", function (event) {
        event.preventDefault();
        $("#title_error").hide();
        $("#percentage_error").hide();
        $("#instruction_error").hide();
        var title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#survey_instruction .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;

        if (title === "") {
            $("#title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        }


        var formData = new FormData($(".surveyData")[0]);
        formData.append("instruction", instruction);
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-survey",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".surveyData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/survey";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/survey");

                }
            },
        });
    });
    
    $(".deleteSurveyPdfFile").on("click", function (event) {
        event.preventDefault();
        var file_id = $(this).data("file_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (file_id != "") {
            // swal({
            //     title: "Delete File",
            //     text: "Are you sure you want to delete File?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader")
            //             .removeClass("d-none")
            //             .addClass("d-block");

            const modalData = {
                title: "Delete File",
                message: "Are you sure you want to delete File?",
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
                    url: baseUrl + "/admin/delete-survey-pdf-file",
                    type: "POST",
                    data: { id: file_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");

                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     window.location.reload();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    $(".addSurveyQuestionOpen").on("click", function (event) {
        event.preventDefault();
        

        $("#question").val("");
        $("#marks").val("");
        $("#question_id").val("");
        $("#answer_limit").val("");
        $("#surveyQuestionModelLabel").html("Add Question");
        $("#editButton").html("Add Question");
        
        if (!quill) {
            quill = new Quill('#question', {
                theme: 'snow'
            });
    
            quill.on('text-change', function() {
                var content = quill.root.innerHTML;
                $('#questionData').val(content);
            });
        }

        // $("#surveyQuestionModel").modal("show");
    });

    $("#surveyQuestionModel").on('show.bs.modal', function(event){

        $('.surveyQuestions')[0].reset();
        $("#question").val("");

        $("#survey_id").hide();
        $('#questionData').hide();
        $('#marks_error').hide();
        $('#answer_limit_error').hide();
    })
    
    $(".addSurveyQuestion").on("click", function (event) {
        event.preventDefault();
        $("#question_error").hide();
        $("#marks_error").hide();
        $("#answer_limit_error").hide();

        var question = $("#questionData").val();
        var marks = $("#marks").val();
        var answer_limit = $("#answer_limit").val();

        if (question === "") {
            $("#question_error").show();
            return;
        }
        if (answer_limit === "") {
            $("#answer_limit_error").show();
            return;
        }
        // var question = $("#question .ql-editor").html();
        // var text1 = $(question).text();
        // var charCount1 = text1.length;
        // if (charCount1 < 3 || charCount1>255) {
            
        //     $("#question_error").text("Question title must be between 3 to 255 characters.");
        //     $("#question_error").show();
        //     return;
        // }        
        
        if (marks === "") {
            $("#marks_error").show();
            return;
        }
        if (answer_limit === "") {
            $("#assignment_answer_limit_error").show();
            return;
        }
        var formData = $(".surveyQuestions").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-survey-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();

                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".surveyQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#surveyQuestionModel").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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

    $(".editViewSurveyQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        $(".surveyData")[0].reset();
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-survey-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (!quill) {
                    quill = new Quill('#question', {
                        theme: 'snow'
                    });
    
                    quill.on('text-change', function() {
                        var content = quill.root.innerHTML;
                        $('#questionData').val(content);
                    });

                }
                  
                  
                if (response.code == 200) {
                    $("#question").attr("value", response.data.question);
                    
                    let question = response.data.question || '';
                    var decodedContent = decodeHTMLEntities(question);
                    quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    
                    $('#question').val(decodedContent);
                
                    $("#answer_limit").attr(
                        "value",
                        response.data.answer_limit
                    );
                    $("#mark").attr(
                        "value",
                        response.data.marks
                    );
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#survey_id").attr(
                        "value",
                        btoa(response.data.survey_id)
                    );
                    $("#surveyQuestionModelLabel").html("Edit Question");
                    $("#editButton").html("Edit Question");
                    $("#surveyQuestionModel").modal("show");
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
    
    $(document).on("click", ".deleteSurveyQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-survey-question",
                    type: "POST",
                    data: { id: question_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");

                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    $(document).on("click", ".deleteSurvey", function (event) {
        var assign_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var award_id = $(this).data("course_id");

        if (assign_id != "") {
            // swal({
            //     title: "Delete Survey",
            //     text: "Are you sure you want to delete survey?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Survey",
                message: "Are you sure you want to delete survey?",
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
                    url: baseUrl + "/admin/delete-survey",
                    type: "POST",
                    data: { id: assign_id, course_id: award_id  },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
    
    $(document).on("click", ".addViewInputFieldConfiguration", function (event) {
        event.preventDefault();
        
        let mode = $(this).data("mode");
        let question_id = $(this).data("question_id");
        let id = $(this).data("id");

        $(".manageInputFieldForm")[0].reset(); 
        $("#questionId").val(question_id);
        
        $("#manageInputFieldLabel").text(mode === "add" ? "Add Input Field Configuration" : "Edit Input Field Configuration");
        $("#saveInputFieldButton").text(mode === "add" ? "Add" : "Update");

        if (mode === "edit") {
            // $("#loader").fadeIn();
            $("#processingLoader").fadeIn();
            $.ajax({
                url: baseUrl + "/admin/get-input-field-configurations",
                type: "GET",
                dataType: "json",
                data: { 
                    id: btoa(id)
                },
                headers: { "X-CSRF-TOKEN": csrfToken },
                success: function (response) {
                   
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        data = response.data[0];
                        $("#label_name").val(data.label_name);
                        // $("#mimes").val(data.mimes);
                        var selectedMimes = data.mimes.split(',');
                        selectedMimes.forEach(function(mime) {
                            $("#" + mime).prop("checked", true);
                        });
                        $("#max_size").val(data.max_size);
                        $("#is_required").val(data.is_required ? "1" : "0");
                        $("#questionId").val(btoa(data.question_id));
                        $("#id").val(btoa(data.id));
                        if (data.is_required == 1) {
                            $("#is_required").val(1);
                        } else {
                            $("#is_required").val(0);
                        }

                        
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
                    $("#loader").fadeOut();
                },
                error: function () {
                    $("#processingLoader").fadeOut();
                    // swal({
                    //     title: "Error",
                    //     text: "Something went wrong. Please try again.",
                    //     icon: "error",
                    // });
                    const modalData = {
                        title: "Error",
                        message: "Something went wrong. Please try again.",
                        icon: response.icon,
                    }
                    showModal(modalData);
                    // $("#loader").fadeOut();
                }
            });
        }

        // Show the modal
        $("#inputFieldConfigurationModal").modal("show");
    });

    
    $(".addInputField").on("click", function (event) {
        event.preventDefault();
        
        var formData = $(".manageInputFieldForm").serialize();
    
    
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
    
        $.ajax({
            url: baseUrl + "/admin/add-input-field-configuration",
            type: "POST",
            dataType: "json",
            data: formData, 
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    // swal({
                    //     title: "Success",
                    //     text: response.message,
                    //     icon: "success",
                    // });
                    
                    const modalData = {
                        title: "Success",
                        message: response.message,
                        icon: successIconPath,
                    }
                    showModal(modalData);
    
                    $(".manageInputFieldForm")[0].reset();
    
                    $("#inputFieldConfigurationModal").modal("hide");
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
            error: function () {
                $("#processingLoader").fadeOut();
                // swal({
                //     title: "Error",
                //     text: "Something went wrong. Please try again.",
                //     icon: "error",
                // });

                const modalData = {
                    title: "Error",
                    message: "Something went wrong. Please try again.",
                    icon: response.icon,
                }
                showModal(modalData);
            },
        });
    });

    $(".getInputFieldConfiguration").on("click", function (event) {
        event.preventDefault();
    
        var question_id = $(this).data("question_id");
        var exam_id = $(this).data("exam_id");
        var exam_type = $(this).data("exam_type");
        $("#questionId").val(question_id);
    
        $("#inputFieldListTable tbody").empty();
        $("#processingLoader").fadeIn();
    
        $.ajax({
            url: baseUrl + "/admin/get-input-field-configurations",
            type: "GET",
            dataType: "json",
            data: {
                question_id: question_id,
                exam_id: exam_id,
                exam_type: exam_type
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    if (response.data.length > 0) {
                        response.data.forEach(function(item) {
                            var row = `<tr data-id="${item.id}">
                                <td>${item.label_name}</td>
                                <td><pre>${item.mimes}</pre></td>
                                <td><pre>${item.max_size}</pre></td>
                                <td>${item.is_required == 1 ? 'Yes' : 'No'}</td>
                                <td>

                                    <!-- Edit Button -->
                                    <a href="javascript:void(0);" 
                                        class="addViewInputFieldConfiguration" 
                                        data-id="${item.id}" 
                                        data-question_id="${item.question_id}" 
                                        data-exam_id="${item.exam_id}" 
                                        data-exam_type="${item.exam_type}" 
                                        data-mode="edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#inputFieldConfigurationModal">
                                        <i class="fa fa-edit me-2"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <a href="javascript:void(0);" 
                                        class="deleteInputFieldConfiguration" 
                                        data-id="${item.id}">
                                        <i class="fa fa-trash me-2"></i> Delete
                                    </a>


                                </td>
                            </tr>`;
                            $("#inputFieldListTable tbody").append(row);
                        });
                    } else {
                        var noDataRow = `
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr>
                        `;
                        $("#inputFieldListTable tbody").append(noDataRow);
                    }
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
            error: function () {
                // swal({
                //     title: "Error",
                //     text: "Something went wrong. Please try again.",
                //     icon: "error",
                // });

                $("#processingLoader").fadeOut();
                const modalData = {
                    title: "Error",
                    message: "Something went wrong. Please try again.",
                    icon: errorIconPath,
                }
                showModal(modalData);
            }
        });
    });

    $(document).on("click", ".deleteInputFieldConfiguration", function (event) {
        event.preventDefault();
        
        let itemId = $(this).data("id");
        
        // swal({
        //     title: "Are you sure?",
        //     text: "You are about to delete this input field configuration!",
        //     icon: "warning",
        //     buttons: {
        //         cancel: {
        //             text: "Cancel",
        //             value: null,
        //             visible: true,
        //             className: "btn btn-secondary",
        //             closeModal: true
        //         },
        //         confirm: {
        //             text: "Delete",
        //             value: true,
        //             visible: true,
        //             className: "btn btn-danger",
        //             closeModal: true
        //         }
        //     }
        // }).then((willDelete) => {
        //     if (willDelete) {
        
        const modalData = {
            title: "Are you sure?",
            message: "You are about to delete this input field configuration!",
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
                url: baseUrl + "/admin/delete-input-field-configuration",
                type: "POST",
                dataType: "json",
                data: { id: btoa(itemId) },
                headers: { "X-CSRF-TOKEN": csrfToken },
                success: function (response) {
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
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
                        // $("#item-row-" + itemId).remove();
                        $(`#inputFieldListTable tbody tr[data-id="${itemId}"]`).fadeOut(300, function() {
                            $(this).remove();
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
                error: function () {
                    // swal({
                    //     title: "Error",
                    //     text: "Something went wrong. Please try again.",
                    //     icon: "error",
                    // });

                    const modalData = {
                        title: "Error",
                        message: "Something went wrong. Please try again.",
                        icon: errorIconPath,
                    }
                    showModal(modalData);
                }
            });
        });
    });
    
    // Final Thesis Exam
    $("#addFinalThesis").on("click", function (event) {
        event.preventDefault();
        $("#title_error").hide();
        $("#award_error").hide();

        var form = $("#addFinalThesisData").serialize();
        var title = $("#title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#award_error").show();
            return;
        }
        if (title === "") {
            $("#title_error").show();
            return;
        }
        var form = $("#addFinalThesisData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        $.ajax({
            url: baseUrl + "/admin/add-final-thesis",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addFinalThesisData")[0].reset();
                    $("#finalThesisModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addFinalThesisData")[0].reset();
                    $("#finalThesisModal").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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

    
    // artificial intelligence Exam
    $("#addArtificialIntelligence").on("click", function (event) {
        event.preventDefault();
        $("#artificial_intelligence_award_error").hide();
        $("#artificial_intelligence_title_error").hide();

        var form = $("#addArtificialIntelligenceData").serialize();
        var title = $("#title").val();
        var award_id = $("#award_id").val();

        if (award_id === "") {
            $("#artificial_intelligence_award_error").show();
            return;
        }
        if (title === "") {
            $("#artificial_intelligence_title_error").show();
            return;
        }
        var form = $("#addArtificialIntelligenceData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-artificial-intelligence",
            type: "post",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $("#processingLoader").fadeOut();
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#addArtificialIntelligenceData")[0].reset();
                    $("#artificialIntelligence").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
                if (response.code === 404) {
                    $(".errors").remove();
                    $("#addArtificialIntelligenceData")[0].reset();
                    $("#artificialIntelligence").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".updateArtificialIntelligence").on("click", function (event) {

        event.preventDefault();
        $("#artificial_intelligence_title_error").hide();
        $("#percentage_error").hide();
        $("#instruction_error").hide();
        var title = $("#title").val();
        var percentage = $("#percentage").val();
        var instruction = $("#artificial_intelligence_instruction .ql-editor").html();
        var text = $(instruction).text();
        var charCount = text.length;
        if (title === "") {
            $("#artificial_intelligence_title_error").show();
            return;
        }
        if (percentage === "") {
            $("#percentage_error").show();
            return;
        }
        if (charCount == 0) {
            $("#instruction_error").show();
            return;
        }


        var formData = new FormData($(".artificialIntelligenceData")[0]);
        formData.append("instruction", instruction);
        // $("#loader").fadeIn();
        
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/update-artificial-intelligence",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".errors").remove();
                $("#processingLoader").fadeOut();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".artificialIntelligenceData")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/reflective-journals";
                    // });
                    
                    const modalData = {
                        title: response.title,
                        message: response.message || '',
                        icon: response.icon,
                    }
                    showModalWithRedirect(modalData, baseUrl + "/admin/artificial-intelligence");
                }
            },
        });
    });
    
    $(".deleteArtificialIntelligencePdfFile").on("click", function (event) {
        event.preventDefault();
        var file_id = $(this).data("file_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (file_id != "") {
            // swal({
            //     title: "Delete File",
            //     text: "Are you sure you want to delete File?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            
            const modalData = {
                title: "Delete File",
                message: "Are you sure you want to delete File?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                // $(".save_loader")
                //     .removeClass("d-none")
                //     .addClass("d-block");
                
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-artificial-intelligence-pdf-file",
                    type: "POST",
                    data: { id: file_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                            
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     window.location.reload();
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
                        } else {
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
             
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
            
        }
    });
    
    $(".addArtificialIntelligenceQuestionOpen").on("click", function (event) {
        event.preventDefault();
        
        if (!quill) {
            quill = new Quill('#question', {
                theme: 'snow'
            });
    
            quill.on('text-change', function() {
                var content = quill.root.innerHTML;
                $('#questionData').val(content);
            });
        }

        $("#question").val("");
        $("#marks").val("");
        $("#question_id").val("");
        $("#answer_limit").val("");
        $("#questionModelLabel").html("Add Question");
        $("#editButton").html("Add Question");

        $("#questionModel").modal("show");
    });
    
    $(".addArtificialIntelligenceQuestion").on("click", function (event) {
        event.preventDefault();
        $("#question_error").hide();
        $("#mark_error").hide();

        // var question = $("#question").val();
        var mark = $("#marks").val();
        var question = $("#questionData").val();

        if (question === "") {
            $("#question_error").show();
            return;
        }
        var question = $("#question .ql-editor").html();
        var text1 = $(question).text();
        var charCount1 = text1.length;

        if(charCount1 === ""){
            $("#question_error").show();
            return;
        }
        if (charCount1 < 3 || charCount1>255) {
            
            $("#question_error").text("Question should be between 3 and 255 characters long.");
            $("#question_error").show();
            return;
        } 
        // if(question.length<3 || question.length>255){
        //     $("#question_error").text("Question should be between 3 and 255 characters long.");
        //     $("#question_error").show();
        //     return;
        // }
        if (mark === "") {
            $("#mark_error").show();
            return;
        }
        var formData = $(".artificialIntelligenceQuestions").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        // $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-artificial-intelligence-question",
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                
                $("#processingLoader").fadeOut();

                $(".errors").remove();
                if (response.code === 202) {
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".artificialIntelligenceQuestions")
                            .find("[name='" + key + "']")
                            .after(
                                "<div class='invalid-feedback errors d-block'><i>" +
                                    value +
                                    "</i></div>"
                            );
                    });
                } else {
                    $("#questionModel").modal("hide");
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.reload();
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
    
    $(".editViewArtificialIntelligenceQuestion").on("click", function (event) {
        event.preventDefault();
        var question_id = $(this).data("question_id");
        $(".artificialIntelligenceQuestions")[0].reset();
        $("#loader").fadeIn();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/edit-view-artificial-intelligence-question",
            type: "POST",
            dataType: "json",
            data: {
                question_id: question_id,
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#processingLoader").fadeOut();
                if (!quill) {
                    quill = new Quill('#question', {
                        theme: 'snow'
                    });
    
                    quill.on('text-change', function() {
                        var content = quill.root.innerHTML;
                        $('#questionData').val(content);
                    });

                }
                  
                  
                if (response.code == 200) {
                    $("#question").attr("value", response.data.question);
                    
                    let question = response.data.question || '';
                    var decodedContent = decodeHTMLEntities(question);
                    quill.clipboard.dangerouslyPasteHTML(decodedContent);
                    
                    $('#question').val(decodedContent);

                    $("#marks").attr(
                        "value",
                        response.data.marks
                    );
                    $("#question_id").attr("value", btoa(response.data.id));
                    $("#assign_id").attr(
                        "value",
                        btoa(response.data.assignments_id)
                    );
                    $("#questionModelLabel").html("Edit Question");
                    $("#editButton").html("Edit Question");
                    $("#questionModel").modal("show");
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

    $(document).on("click", ".deleteArtificialIntelligenceQuestion", function (event) {
        var question_id = $(this).data("question_id");
        var deleteElement = $(this).closest(".list-group-item");

        if (question_id != "") {
            // swal({
            //     title: "Delete Question",
            //     text: "Are you sure you want to delete question?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
                    
            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-artificial-intelligence-question",
                    type: "POST",
                    data: { id: question_id },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
                            
                            window.location.reload();

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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                message: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    $(document).on("click", ".deleteArtificialIntelligence", function (event) {
        var assign_id = $(this).data("assign_id");
        var deleteElement = $(this).closest("tr");
        var award_id = $(this).data("course_id");

        if (assign_id != "") {
            // swal({
            //     title: "Delete Reflective Journal",
            //     text: "Are you sure you want to delete reflective journal?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
            
            const modalData = {
                title: "Delete Question",
                message: "Are you sure you want to delete question?",
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
                    url: baseUrl + "/admin/delete-artificial-intelligence",
                    type: "POST",
                    data: { id: assign_id, course_id: award_id  },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");
                        
                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });
            
            const modalData = {
                title: "Something Went Wrong",
                text: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });
       
    // ementor eportfolio
    $(".updateEportfolioEmentor, .submitEportfolioEmentor").on("click", function (event) {
        event.preventDefault();
        var actionType = $(this).hasClass("updateEmentor") ? "draft" : "submit";

        var form = $("#examEportfolioMarksForm").serialize();
        var data = new URLSearchParams(form);
        var formData = form + '&actionType=' + actionType;

        $("#loader").fadeIn();
        // swal({
        //     title: "Are you sure?",
        //     text: "",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {

        const modalData = {
            title: "Are you sure?",
            message: "",
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
                url: baseUrl + "/ementor/eportfolio/check-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $("#processingLoader").fadeOut();

                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //      window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id') + '/' + data.get('student_course_master_id');
                        // });
                        
                        const modalData = {
                            title: response.title,
                            message: response.message || '',
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id') + '/' + data.get('student_course_master_id');
                        }, 2000);
                    } else {
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
    });
    
    // without question submit
    $(".updateExam, .submitExam").on("click", function (event) {
        event.preventDefault();
        var type = $(this).data("type");
        var examtype = $(this).data("examtype");
        var actionType = $(this).hasClass("updateExam") ? "draft" : "submit";
        var form = $("#examMarksForm").serialize();
        var data = new URLSearchParams(form);
        
        var formData = form + '&actionType=' + actionType;
        $("#loader").fadeIn();
        // swal({
        //     title: "Are you sure?",
        //     text: "",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
             
        //          $(".save_loader").removeClass("d-none").addClass("d-block");

        const modalData = {
            title: "Are you sure?",
            message: "",
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
                url: baseUrl + "/ementor/without-question/check-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    //  $(".save_loader").addClass("d-none").removeClass("d-block");
                    $("#processingLoader").fadeOut();
                    if (response.code === 200) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     //  window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('course_id');
                        //         window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id')+ '/' + data.get('student_course_master_id');
                                
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message || '',
                            icon: response.icon,
                        }
                        showModal(modalData);
                        setTimeout(() => {
                            window.location.href = baseUrl + "/ementor/e-mentor-students-exam-details/" + data.get('student_id') + '/' + data.get('actual_course_id')+ '/' + data.get('student_course_master_id');
                        }, 2000);
                    } else {
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
    });

    // get Course Exam List
    $(".getCourseExamList").off("change").on("change", function (event) {
        event.preventDefault();
        
        var courseId = $('#course_id').val();
        $("#processingLoader").fadeIn();
    
        if (courseId) {
            $.ajax({
                url: baseUrl + "/admin/get-course-exam-list/" + courseId,
                type: "GET",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $("#processingLoader").fadeOut();
                    $('#exam_type').val('');
                    var examSelect = $('#exam_id'); 
                    examSelect.empty();
                    if (response.exams) {
                        
                        examSelect.append('<option value="">Select Exam</option>');
                        
                        if (response.exams && response.exams.length > 0) {
                            response.exams.forEach(function(exam) {
                                examSelect.append('<option value="' + btoa(exam.exam_id) + '" data-type="' + btoa(exam.exam_type) + '">' + exam.title + '</option>');
                            });
                        } else {
                            examSelect.append('<option value="">No exams available</option>');
                        }
                        examSelect.on('change', function() {
                            var selectedExam = $(this).find('option:selected');
                            var examType = selectedExam.data('type');
                            $('#exam_type').val(examType);
                        });
                    } else {
                        // swal({
                        //     title: "Error",
                        //     text: "No exams found for this course.",
                        //     icon: "error",
                        // });

                        const modalData = {
                            title: "Error",
                            message: "No exams found for this course.",
                            icon: errorIconPath,
                        }
                        showModal(modalData);
                    }
                },
                error: function (error) {
                    $("#processingLoader").fadeout();
                    // swal({
                    //     title: "Error",
                    //     text: "There was an error while fetching exams. Please try again later.",
                    //     icon: "error",
                    // });

                    const modalData = {
                        title: "Error",
                        message: "There was an error while fetching exams. Please try again later.",
                        icon: errorIconPath,
                    }
                    showModal(modalData);
                }
            });
    
        }
    });

    // add exam amount
    $("#addExamAmount").on("click", function (event) {
        event.preventDefault();
        $(".invalid-feedback").hide();
        $(".form-control, .form-select").removeClass("is-invalid");
    
        var isValid = true;
    
        var courseId = $("#course_id").val();
        if (!courseId) {
            isValid = false;
            $("#course_id").addClass("is-invalid");
            $("#course_error").show();
        }
    
        var examId = $("#exam_id").val();
        if (!examId) {
            isValid = false;
            $("#exam_id").addClass("is-invalid");
            $("#exam_error").show();
        }
    
        var amount = $("#amount").val();
        if (!amount || amount <= 0) {
            isValid = false;
            $("#amount").addClass("is-invalid");
            $("#amount_error").show();
        }
    
        if (isValid) {
            var formData = $("#addExamAmountData").serialize();
            $("#loader").fadeIn();
            // swal({
            //     title: "Are you sure?",
            //     text: "",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
                
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
                    
            const modalData = {
                title: "Are you sure?",
                message: "",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").off("click").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").off("click").on("click", function () {
                $("#customModal").hide();
                $("#processingLoader").fadeIn();

                $.ajax({
                    url: baseUrl + "/admin/add-exam-amount",
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
    
                            //     $("#addExamAmountData")[0].reset();  
                
                            //     $("#examAmountView").modal("hide");
                            //     window.location.reload();
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

                        } else {
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
        }
    });

    // edit exam amount
    $("#editExamAmount").on("click", function (event) {
        event.preventDefault();
        $(".invalid-feedback").hide();
        $(".form-control, .form-select").removeClass("is-invalid");
    
        var isValid = true;
    
        // Validate amount
        var amount = $("#amount-edit").val();
        if (!amount || amount <= 0) {
            isValid = false;
            $("#amount-edit").addClass("is-invalid");
            $("#amount_edit_error").show();
        }
    
        // Proceed only if the form is valid
        if (isValid) {
            var id = $('#id').val();
            
            var formData = $("#editExamAmountData").serialize();
            // $("#loader").fadeIn();
            // swal({
            //     title: "Are you sure?",
            //     text: "",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
                
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Are you sure?",
                message: "",
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
                    url: baseUrl + "/admin/edit-exam-amount/" + id,
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
                            //     window.location.reload();
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
                        } else {
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
        }
    });
    
    // delete Exam Amount
    $(document).on("click", ".deleteExamAmount", function (event) {
        var id = $(this).data("exam-amount-id");
        var deleteElement = $(this).closest("tr");

        if (id != "") {
            // swal({
            //     title: "Delete Exam Amount",
            //     text: "Are you sure you want to delete exam amount?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Exam Amount",
                message: "Are you sure you want to delete exam amount?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").off("click").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").off("click").on("click", function () {
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-exam-amount",
                    type: "POST",
                    data: { id: id},
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // $(".save_loader")
                        //     .addClass("d-none")
                        //     .removeClass("d-block");

                        $("#processingLoader").fadeOut();
                        if (response.code === 200) {
                            deleteElement.slideUp();
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
                            setTimeout(() => {
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
                                message: response.message || '',
                                icon: response.icon,
                            }
                            showModal(modalData);
                        }
                    },
                });
            });
        } else {
            // swal({
            //     title: "Something Went Wrong",
            //     text: "Please Try Again",
            //     icon: "error",
            // });

            const modalData = {
                title: "Something Went Wrong",
                text: "Please Try Again",
                icon: errorIconPath,
            }
            showModal(modalData);
        }
    });

    // approve Exam
    $(document).on('click', '.ApproveExam', function() {
        var scmId = $('#scmId').val();
        var amount = $('#amount').val();
        // swal({
        //     title: "Approve Exam",
        //     text: "Are you sure you want to approve this exam with the entered amount?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willApprove) => {
        //     if (willApprove) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Approve Exam",
                message: "Are you sure you want to approve this exam with the entered amount?",
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
                    url: "/ementor/approve-exam",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    data: {
                        scmId: scmId,
                        amount: amount,
                    },
                    success: function(response) {
                        // $(".save_loader").addClass("d-none").removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.success) {
                            // swal("Success!", "The exam has been approved.", "success");
                            const modalData = {
                                title: "Success!",
                                message: "The exam has been approved.",
                                icon: successIconPath,
                            }
                            showModal(modalData);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                            $('#approveExamModal').modal('hide');
                            var table = $(".pendingExamList").DataTable();
                            table.rows().every(function() {
                                var row = this;
                                var rowData = row.data();
                                console.log(scmId);
                                if (rowData.id == scmId) {
                                    row.remove();
                                }
                            });
                            table.draw();
                            
                        } else {
                            // swal("Error!", "There was an issue approving the exam.", "error");
                            const modalData = {
                                title: "Error!",
                                text: "There was an issue approving the exam.",
                                icon: errorIconPath,
                            }
                            showModal(modalData);
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        // $(".save_loader").addClass("d-none").removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        // swal("Error!", "Something went wrong. Please try again.", "error");
                        const modalData = {
                            title: "Error!",
                            text: "Something went wrong",
                            icon: errorIconPath,
                        }
                        showModal(modalData);
                    }
                });
        });
    });

    // reject Exam
    $(document).on('click', '#rejectExam', function() {
        var scmId = $('#student_course_master_id').val();
        var rejectReason = $('#rejectReason').val();
        if (!rejectReason.trim()) {
            // swal("Error", "Rejection reason cannot be empty.", "error");
            const modalData = {
                title: "Error!",
                text: "Rejection reason cannot be empty.",
                icon: errorIconPath,
            }
            showModal(modalData);
            return;
        }
        // swal({
        //     title: "Reject Exam",
        //     text: "Are you sure you want to reject this exam?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willReject) => {
        //     if (willReject) {
        //         $(".save_loader").removeClass("d-none").addClass("d-block");
        
        const modalData = {
            title: "Reject Exam ",
            message: "Are you sure you want to reject exam?",
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
                url: "/ementor/reject-exam",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                data: {
                    scmId: scmId,
                    reason: rejectReason,
                },
                success: function(response) {
                    $("#processingLoader").fadeOut();
                    if (response.success) {
                        // swal("Rejected!", "The exam has been rejected successfully.", "success");
                        const modalData = {
                            title: "Rejected!",
                            text: "The exam has been rejected successfully.",
                            icon: successIconPath,
                        }
                        showModal(modalData);
                        $('#rejectExamModal').modal('hide');

                        let examRow = $('button[data-exam-id="' + response.scmId + '"]').closest('tr');
                        examRow.find('button[data-bs-toggle="modal"][data-bs-target="#rejectExamModal"]').hide();
                        
                    } else {
                        // swal("Error!", "There was an issue approving the exam.", "error");
                        const modalData = {
                            title: "Error!",
                            text: "There was an issue approving the exam.",
                            icon: errorIconPath,
                        }
                        showModal(modalData);
                    }
                },
                error: function(xhr, status, error) {
                    $("#processingLoader").fadeOut();
                    // swal("Error!", "Something went wrong. Please try again.", "error");
                    const modalData = {
                        title: "Error!",
                        text: "Something went wrong",
                        icon: errorIconPath,
                    }
                    showModal(modalData);
                }
            });
        });
    });

    
    
    
});
