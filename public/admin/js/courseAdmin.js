$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    // AllCourseList();
    // awardCoursList();

    $(".section-course-tab").on("click", function (event) {
        AllCourseList($(this).data("cat"), $(this).data("action"));
    });

    function coursePreview(course_module_id) {
        $.ajax({
            url: baseUrl + "admin/load-course-videos/" + course_module_id,
            method: "GET",
            success: function (data) {
                // "    <div class='col-md-4'>
                //                                         <div class='card mb-3 mb-4'>
                //                                             <div class='p-1'>
                //                                                 <div class='d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover' style='background-image:url({{asset('admin/images/course/masters-human-resource-management.png') }});height:210px;'>
                //                                                     <a class='glightbox icon-shape rounded-circle btn-play icon-xl' href='https://www.youtube.com/watch?v=Nfzi7034Kbg'>
                //                                                         <i class='fe fe-play'></i>
                //                                                     </a>
                //                                                 </div>
                //                                             </div>
                //                                             <!-- Card body -->
                //                                             <div class='card-body p-1 ps-3'>
                //                                                 <!-- Price single page -->
                //                                                 <div class='mb-3'>
                //                                                     <h4 class='text-dark fw-bold'>1. Introduction to Module</h4>
                //                                                 </div>
                //                                             </div>
                //                                         </div>
                //                                     </div>"
            },
        });
    }

    // $("#trailor_vid").on("change", function (event) {
    //     var file = event.target.files[0];
    //     var fileType = file.type;
    //     $("#trailer_file_name").text(file.name);
    //     $("#thumbnail_file_name").text('');
    // });
    // $("#trailor_thumbnail").on("change", function (event) {
    //     var file = event.target.files[0];
    //     var fileType = file.type;
    //     $("#trailor_thumbnail_file_name").text(file.name);
    // });

    // $(".course_trailer").on("change", function (event) {
    //     var file = event.target.files[0];
    //     var fileType = file.type;
    //     $("#trailer_file_name").text(file.name);
    //     var fileType = file.type;
    //     var videoSrc = URL.createObjectURL(file);
    //       $(".video-preview-trailor")
    //             .removeClass("d-none")
    //             .attr("src", videoSrc)
    //             .addClass("d-block");
    // });

    $(".course_podcast").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        $("#podcast_file_name").text(file.name);
        var fileType = file.type;
        var videoSrc = URL.createObjectURL(file);
        $(".previouseVideoPodcast").addClass("d-none");
        $(".video-preview-podcast")
            .removeClass("d-none")
            .attr("src", videoSrc)
            .addClass("d-block");
    });

    $(".trailor_thumbnail").on("change", function (event) {
        var img = this.files[0];
        if (img) {
            reader.onload = function (e) {
                img.src = e.target.result;
                e.preventDefault();
                $(".image-preview-trailer")
                    .removeClass("d-none")
                    .attr("src", img.src)
                    .addClass("d-block");
                $("#trailor_thumbnail_file_name").text(img.name);
            };
            reader.readAsDataURL(img);
        }
        $("#trailor_thumbnail_file_name").text(img.name);
    });
    $(".podcast_thumbnail").on("change", function (event) {
        var img = this.files[0];
        if (img) {
            reader.onload = function (e) {
                img.src = e.target.result;
                e.preventDefault();
                $(".image-preview-podcast")
                    .removeClass("d-none")
                    .attr("src", img.src)
                    .addClass("d-block");
                $("#podcast_thumbnail_file_name").text(img.name);
            };
            reader.readAsDataURL(img);
        }
    });

    $(".imageprv").on("change", function () {
        //   $("#img_size_error").hide();
        var img = this.files[0];
        var size = img.size / 1024;
        if (img) {
            reader.onload = function (e) {
                img.src = e.target.result;
                e.preventDefault();
                $(".image-preview")
                    .removeClass("d-none")
                    .attr("src", img.src)
                    .addClass("d-block");
                $("#thumbnail_file_name").text(img.name);
            };
            reader.readAsDataURL(img);
        }
    });
    $(".updateCourseBasic").on("click", function (event) {
        event.preventDefault();

        $("#title_error").hide();
        $("#subheading_error").hide();
        $("#mqf_error").hide();
        $("#ects_error").hide();
        $("#total_module_error").hide();
        $("#total_lecture_error").hide();
        $("#total_learning_error").hide();
        $("#certifica_id_error").hide();
        $("#ementor_id_error").hide();
        $("#lecturer_id_error").hide();
        $("#final_price_error").hide();
        $("#thumbnail_error").hide();
        $("#trailor_percent_error").hide();
        $("#scholarship_percent_error").hide();
        $("#discord_joining_link_error").hide();
        $("#discord_channel_link_error").hide();
        // $("#module_name_error").hide();

        var courseTitle = $("#courseTitle").val();
        var subheading = $("#subheading").val();
        var mqf = $("#mqf").val();
        var ects = $("#ects").val();
        var total_module = $("#total_module").val();
        var total_lecture = $("#total_lecture").val();
        var total_learning = $("#total_learning").val();
        var certifica_id = $("#certifica_id").val();
        var ementor_id = $("#ementor_id_id").val();
        var lecturer_id = $("#lecturer_id").val();
        var final_price = $("#final_price_id").val();
        var scholarship_percent = $("#scholarship_percent_id").val();
        var thumbnail = $("#thumbnail").val();
        var trailor = $("#trailor").val();
        var discordToggle =
            document.getElementById("toggleDiscordLinks").checked;
        var discordJoiningLink = $("#discord_joining_link").val();
        var discordChannelLink = $("#discord_channel_link").val();
        // var module_name = $("#module_name").val();

        if (courseTitle === "") {
            $("#title_error").show();
            return;
        }

        if (discordToggle === true) {
            if (discordJoiningLink === "") {
                $("#discord_joining_link_error").show();
                return;
            }
            if (discordChannelLink === "") {
                $("#discord_channel_link_error").show();
                return;
            }
        }

        // if (subheading === "") {
        //     $("#subheading_error").show();
        //     return;
        // }
        // if (mqf === "") {
        //     $("#mqf_error").show();
        //     return;
        // }
        // if (ects === "") {
        //     $("#ects_error").show();
        //     return;
        // }
        // if (total_module === "") {
        //     $("#total_module_error").show();
        //     return;
        // }
        // if (total_lecture === "") {
        //     $("#total_lecture_error").show();
        //     return;
        // }
        // if (total_learning === "") {
        //     $("#total_learning_error").show();
        //     return;
        // }
        // if (certifica_id === null) {
        //     $("#certifica_id_error").show();
        //     return;
        // }
        // if (ementor_id === null) {
        //     $("#ementor_id_error").show();
        //     return;
        // }
        // if (lecturer_id === null) {
        //     $("#lecturer_id_error").show();
        //     return;
        // }
        // if (final_price === "") {
        //     $("#final_price_error").show();
        //     return;
        // }
        // if (module_name === "") {
        //     $("#module_name_error").show();
        //     return;
        // }
        // if (thumbnail === "") {
        //     $("#thumbnail_error").show();
        //     return;
        // }
        // if (trailor === "") {
        //     $("#trailor_error").show();
        //     return;
        // }
        // if (scholarship_percent === "") {
        //     $("#scholarship_percent_error").show();
        //     return;
        // }
        //   var form = $(".basicCourseForm").serialize();
        var form = new FormData($(".basicCourseForm")[0]);

        $(".save_loader").removeClass("d-none");

        $.ajax({
            url: baseUrl + "/admin/add-course",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").fadeOut();
                if (response.code === 200 || response.code === 201){
                    $(".course_id").val(response.data);
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        $("#basic-information-1")
                            .removeClass("active")
                            .addClass("dstepper-none");
                        $(
                            '.step[data-target="#basic-information-1"]'
                        ).removeClass("active");

                        $("#others-2")
                            .removeClass("dstepper-none")
                            .addClass("active");
                        $('.step[data-target="#others-2"]').addClass("active");
                    });
                    $(".errors").remove();
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
    $(".updateCourseOthers").on("click", function (event) {
        event.preventDefault();

        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var course_check = $(".course_id").val();
        // var editor = ;
        if (course_check != "") {
            $("#course_overview_error").hide();
            $("#programme_outcomes_error").hide();
            $("#entry_requirements_error").hide();
            $("#assessment_error").hide();
            var overview = $(".course_overview .ql-editor").html();
            var text = $(overview).text();
            var charCount = text.length;

            if (charCount > 1500) {
                $("#course_overview_error").val(
                    "Course overview must be between 5-1500 characters."
                );
                $("#course_overview_error").show(); // Show error message
                return "";
            }
            var programme_outcomes = $("#programme_outcomes .ql-editor").html();
            var text1 = $(programme_outcomes).text();
            var charCount1 = text1.length;
            if (charCount1 > 1500) {
                $("#programme_outcomes_error").val(
                    "Programme outcomes must be between 5-1500 characters."
                );
                $("#programme_outcomes_error").show(); // Show error message
                return "";
            }
            var entry_requirements = $("#entry_requirements .ql-editor").html();
            var text2 = $(entry_requirements).text();
            var charCount2 = text2.length;
            if (charCount2 > 1500) {
                $("#entry_requirements_error").val(
                    "Entry Requirement must be between 5-1500 characters."
                );
                $("#entry_requirements_error").show(); // Show error message
                return "";
            }
            var assessment = $("#assessment .ql-editor").html();
            var text3 = $(assessment).text();
            var charCount3 = text3.length;
            if (charCount3 > 500) {
                $("#assessment_error").val(
                    "Assessment must be between 5-500 characters."
                );
                $("#assessment_error").show(); // Show error message
                return "";
            }
            if (charCount == 0) {
                overview = "";
            }
            if (charCount1 == 0) {
                programme_outcomes = "";
            }
            if (charCount2 == 0) {
                entry_requirements = "";
            }
            if (charCount2 == 0) {
                assessment = "";
            }
            // if (overview == "") {
            //     $("#course_overview_error").show();
            //     return;
            // }
            // if (programme_outcomes == "") {
            //     $("#programme_outcomes_error").show();
            //     return;
            // }
            // if (entry_requirements == "") {
            //     $("#entry_requirements_error").show();
            //     return;
            // }
            // if (assessment == " ") {
            //     $("#assessment_error").show();
            //     return;
            // }

            // var form = $(".basicCourseOtherForm").serialize();
            var form = new FormData($(".basicCourseOtherForm")[0]);
            form.append("course_overview", overview);
            form.append("programme_outcomes", programme_outcomes);
            form.append("entry_requirements", entry_requirements);
            form.append("assessment", assessment);

            $(".save_loader").fadeIn();
            $.ajax({
                url: baseUrl + "/admin/add-course-others",
                type: "POST",
                data: form,
                dataType: "json",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").fadeOut();
                    if (response.code === 200) {
                        // $(".course_id").val(response.data);

                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            $("#others-2")
                                .removeClass("active")
                                .addClass("dstepper-none");
                            $('.step[data-target="#others-2"]').removeClass(
                                "active"
                            );

                            $("#course-media-3")
                                .removeClass("dstepper-none")
                                .addClass("active");
                            $('.step[data-target="#course-media-3"]').addClass(
                                "active"
                            );

                            $("#course-content-4")
                                .removeClass("dstepper-none")
                                .addClass("active");
                            $(
                                '.step[data-target="#course-content-4"]'
                            ).addClass("active");
                        });
                        $(".errors").remove();
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
        } else {
            swal({
                title: "Course Details Not Found",
                text: "Kindly start from beginning",
                icon: "warning",
            }).then(function () {
                $("#others-2").removeClass("active").addClass("dstepper-none");
                $('.step[data-target="#others-2"]').removeClass("active");
                $("#basic-information-1")
                    .removeClass("dstepper-none")
                    .addClass("active");
                $('.step[data-target="#basic-information-1"]').addClass(
                    "active"
                );
            });
        }
    });

    //ankita changes
    $(".updateCourseBasicAdd").on("click", function (event) {
        event.preventDefault();

        $("#category_id_error").hide();
        $("#title_error").hide();
        $("#subheading_error").hide();
        $("#mqf_error").hide();
        $("#certifica_id_error").hide();
        $("#ementor_id_error").hide();
        $("#lecturer_id_error").hide();
        $("#final_price_error").hide();

        var category_id = $("#category_id").val();
        var courseTitle = $("#course_title").val();
        var subheading = $("#subheading").val();
        var mqf = $("#mqf").val();
        var certifica_id = $("#certificate_id").val();
        var ementor_id = $("#ementor_id").val();
        var lecturer_id = $("#lecturer_id").val();
        var final_price = $("#final_price").val();
        var scholarship_percent = $("#scholarship_percent").val();

        if (category_id === "") {
            $("#category_id_error").show();
            return;
        }

        if (courseTitle === "") {
            $("#title_error").show();
            return;
        }

        // if (subheading === "") {
        //     $("#subheading_error").text("Please enter course subheading.").show();
        //     return;
        // }

        // // Check for Subheading Length
        // if (subheading.length > 400) {
        //     $("#subheading_error").text("Subheading should not be greater than 400 characters.").show();
        //     return;
        // }

        // if (subheading === "") {
        //     $("#subheading_error").show();
        //     return;
        // }
        // if (mqf === "") {
        //     $("#mqf_error").show();
        //     return;
        // }
        // if (certifica_id === "") {
        //     $("#certifica_id_error").show();
        //     return;
        // }
        // if (ementor_id === "") {
        //     $("#ementor_id_error").show();
        //     return;
        // }
        // if (lecturer_id === "") {
        //     $("#lecturer_id_error").show();
        //     return;
        // }
        // if (final_price === "") {
        //     $("#final_price_error").show();
        //     return;
        // }

        //   var form = $(".basicCourseForm").serialize();
        $(".save_loader").removeClass("d-none").addClass("d-block");
        var form = new FormData($(".basicCourseFormAdd")[0]);
        $.ajax({
            url: baseUrl + "/admin/add-course-main",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").removeClass("d-block");

                if (response.code === 200) {
                    $(".course_id").val(response.data);
                    $(".errors").remove();
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        $("#basic-information-1")
                            .removeClass("active")
                            .addClass("dstepper-none");
                        $(
                            '.step[data-target="#basic-information-1"]'
                        ).removeClass("active");

                        $("#others-2")
                            .removeClass("dstepper-none")
                            .addClass("active");
                        $('.step[data-target="#others-2"]').addClass("active");
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

    $(".previousCourseBasic").on("click", function (event) {
        event.preventDefault();

        $("#basic-information-1")
            .removeClass("dstepper-none")
            .addClass("active");
        $('.step[data-target="#basic-information-1"]').addClass("active");
        $("#others-2").removeClass("active").addClass("dstepper-none");
        $('.step[data-target="#others-2"]').removeClass("active");
    });
    $(".previousCourseOther").on("click", function (event) {
        event.preventDefault();
        $("#others-2").removeClass("dstepper-none").addClass("active");
        $('.step[data-target="#others-2"]').addClass("active");
        $("#course-content-4").removeClass("active").addClass("dstepper-none");
        $('.step[data-target="#course-content-4"]').removeClass("active");
    });
    // $(".previousCourseMedia").on("click", function (event) {
    //     event.preventDefault();
    //     $("#course-media-3").removeClass("dstepper-none").addClass("active");
    //     $('.step[data-target="#course-media-3"]').addClass("active");
    //     $("#course-content-4").removeClass("active").addClass("dstepper-none");
    //     $('.step[data-target="#course-content-4"]').removeClass("active");
    // });

    $(".previousOtherForm").on("click", function (event) {
        event.preventDefault();
        $("#others-2").removeClass("dstepper-none").addClass("active");
        $('.step[data-target="#others-2"]').addClass("active");
        $("#section-selection-3")
            .removeClass("active")
            .addClass("dstepper-none");
        $('.step[data-target="#section-selection-3"]').removeClass("active");
    });

    $(".sectionSelection").on("click", function (event) {
        event.preventDefault();
        $("#section-selection-3")
            .removeClass("dstepper-none")
            .addClass("active");
        $('.step[data-target="#section-selection-3"]').addClass("active");
        $("#course-content-4").removeClass("active").addClass("dstepper-none");
        $('.step[data-target="#course-content-4"]').removeClass("active");
    });

    $(".updateCourseMediaAdd").on("click", function (event) {
        event.preventDefault();

        var course_check = $(".course_id").val();
        if (course_check != "") {
            $("#thumbnail_error").hide();
            $("#trailor_error").hide();
            $("#podcast_error").hide();

            var course_thumbail = $("#thumbnail_img").val();
            var course_trailor = $("#course_trailor").val();
            var course_podcast = $("#course_podcast").val();

            if (course_thumbail == "") {
                $("#thumbnail_error").show();
                return;
            }
            if (course_trailor == "") {
                $("#trailor_error").show();
                return;
            }
            if (course_podcast == "") {
                $("#podcast_error").show();
                return;
            }

            //   var form = $(".basicCourseForm").serialize();
            var form = new FormData($(".CourseMediaForm")[0]);
            // $(".save_loader").fadeIn();
            $(".save_loader").removeClass("d-none").addClass("d-block");

            $.ajax({
                url: baseUrl + "/admin/add-course-media-main",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    if (response.code === 200) {
                        $(".course_id").val(response.data);
                        $(".errors").remove();
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            $("#course-media-3")
                                .addClass("dstepper-none")
                                .removeClass("active");
                            $(
                                '.step[data-target="#course-media-3"]'
                            ).removeClass("active");
                            $("#course-content-4")
                                .addClass("active")
                                .removeClass("dstepper-none");
                            $(
                                '.step[data-target="#course-content-4"]'
                            ).addClass("active");
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
        } else {
            swal({
                title: "Course Details Not Found",
                text: "Kindly start from beginning",
                icon: "warning",
            }).then(function () {
                $("#course-media-3")
                    .removeClass("active")
                    .addClass("dstepper-none");
                $('.step[data-target="#course-media-3"]').removeClass("active");
                $("#basic-information-1")
                    .removeClass("dstepper-none")
                    .addClass("active");
                $('.step[data-target="#basic-information-1"]').addClass(
                    "active"
                );
            });
        }
    });

    $(".UploadVideo").on("click", function (event) {
        event.preventDefault();
        $("#video_title_error").hide();
        var video_title = $("#videoTitle").val();

        var section_id =
            $(".section_id").val() !== undefined &&
            $(".section_id").val() !== ""
                ? $(".section_id").val()
                : "";
        if (video_title === "") {
            $("#video_title_error").show();
            return;
        }

        var fileInput = $(".video_file")[0];
        if (fileInput.files.length == 0) {
            $("#video_file_error").show();
            return;
        }

        const fileInputName = fileInput.files[0];
        var fileName = fileInputName.name;
        var fileExtension = fileName.split(".").pop().toLowerCase();
        var form = new FormData($(".CourseVideos")[0]);
        if (fileExtension != "pdf") {
            const video = document.createElement("video");
            video.addEventListener("loadedmetadata", function () {
                var duration = video.duration;
                form.append("video_duration", duration);
            });
        }
        $(".save_loader").removeClass("d-none").addClass("d-block");
        $.ajax({
            url: baseUrl + "/admin/add-course-video",
            type: "POST",
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").removeClass("d-block");
                if (response.code === 200) {
                    $(".errors").remove();
                    $(".CourseVideos")[0].reset();
                    $("#addLectureVideoModal").modal("hide");
                    // coursePreview(response.data).refresh();

                    $("#courseMediaButton")
                        .removeClass("d-none")
                        .addClass("d-block");
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    });
                    if (section_id !== "") {
                        $(".selectSectionId").trigger("change", [section_id]);
                    }
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

    //     event.preventDefault();

    //     $("#video_title_error").hide();
    //     $("#section_error").hide();

    //     var video_title = $("#videoTitle").val();
    //     var selectSectionId = $("#selectSectionId").val();
    //     var section_id =
    //         $(".section_id").val() !== undefined &&
    //         $(".section_id").val() !== ""
    //             ? $(".section_id").val()
    //             : "";

    //     if(selectSectionId === ""){
    //         $("#section_error").show();
    //         return;
    //     }
    //     if (video_title === "") {
    //         $("#video_title_error").show();
    //         return;
    //     }
    //     var fileInput = $(".video_file")[0];
    //     // if (fileInput.files.length == 0) {
    //     //     $("#video_file_error").show();
    //     //     return;
    //     // }
    //     $(".save_loader").removeClass("d-none").addClass("d-block");
    //     var form = new FormData($(".CourseVideos")[0]);
    //     videoUpload(form), section_id;

    //     // var csrfToken = $('meta[name="csrf-token"]').attr("content");

    //     // $.ajax({
    //     //     url: baseUrl + "/admin/add-course-video",
    //     //     type: "POST",
    //     //     data: form,
    //     //     cache: false,
    //     //     contentType: false,
    //     //     processData: false,
    //     //     dataType: "json",
    //     //     headers: {
    //     //         "X-CSRF-TOKEN": csrfToken,
    //     //     },
    //     //     success: function (response) {
    //     //         $(".save_loader").addClass("d-none").removeClass("d-block");
    //     //         if (response.code === 200) {
    //     //             $(".errors").remove();
    //     //             $(".CourseVideos")[0].reset();
    //     //             $("#addCourseVideoModal").modal("hide");
    //     //             $("#filUrl").html("Choose file...");
    //     //             // $(".thumbnail-edit").css(
    //     //             //     "background-image",
    //     //             //     "url(" +
    //     //             //         assets +
    //     //             //         "frontend/images/course/course-javascript.jpg)"
    //     //             // );
    //     //             // coursePreview(response.data).refresh();

    //     //             $("#courseMediaButton")
    //     //                 .removeClass("d-none")
    //     //                 .addClass("d-block");
    //     //             swal({
    //     //                 title: response.title,
    //     //                 text: response.message,
    //     //                 icon: response.icon,
    //     //             }).then(function () {
    //     //                 window.location.reload();
    //     //             });
    //     //             if (section_id !== "") {
    //     //                 $(".selectSectionId").trigger("change", [section_id]);
    //     //             }
    //     //         } else if (response.code === 202) {
    //     //             var data = Object.keys(response.data);
    //     //             var values = Object.values(response.data);

    //     //             data.forEach(function (key) {
    //     //                 var value = response.data[key];
    //     //                 $(".errors").remove();
    //     //                 $("form")
    //     //                     .find("[name='" + key + "']")
    //     //                     .after(
    //     //                         "<div class='invalid-feedback errors d-block'><i>" +
    //     //                             value +
    //     //                             "</i></div>"
    //     //                     );
    //     //             });
    //     //         } else {
    //     //             swal({
    //     //                 title: response.title,
    //     //                 text: response.message,
    //     //                 icon: response.icon,
    //     //             });
    //     //         }
    //     //     },
    //     // });
    // });

    $(".UploadCourseVideo").on("click", function (event) {
        event.preventDefault();

        $("#video_title_error").hide();
        $("#video_id_error").hide();
        $("#section_error").hide();

        var video_title = $("#videoTitle").val();
        var video_id = $("#videoId").val();
        var selectSectionId = $("#selectSectionId").val();
        var section_id =
            $(".section_id").val() !== undefined &&
            $(".section_id").val() !== ""
                ? $(".section_id").val()
                : "";

        if (selectSectionId === "") {
            $("#section_error").show();
            return;
        }
        if (video_title === "") {
            $("#video_title_error").show();
            return;
        }
        if (video_id === "") {
            $("#video_id_error").show();
            return;
        }

        // var fileInput = $(".video_file")[0];
        // if (fileInput.files.length == 0) {
        //     $("#video_file_error").show();
        //     return;
        // }

        // $(".save_loader").removeClass("d-none").addClass("d-block");
        
        $("#processingLoader").fadeIn();
        var form = new FormData($(".CourseVideos")[0]);
        videoUpload(form), section_id;
    });

    $(".UploadEditVideo").on("click", function (event) {
        event.preventDefault();
        $("#edit_video_title_error").hide();

        var video_title = $("#edit_video_title").val();
        var fileInput = $(".edit_video_file")[0];
        var section_id =
            $(".section_id").val() !== undefined &&
            $(".section_id").val() !== ""
                ? $(".section_id").val()
                : "";

        if (video_title === "") {
            $("#edit_video_title_error").show();
            return;
        }

        if (fileInput.files.length > 0) {
            const fileInputName = fileInput.files[0];
            var fileName = fileInputName.name;
            var fileExtension = fileName.split(".").pop().toLowerCase();
        }

        if (fileExtension == "pdf" || fileInput.files.length == 0) {
            var form = new FormData($(".EditCourseVideos")[0]);
            $(".save_loader").removeClass("d-none").addClass("d-block");
            $.ajax({
                url: baseUrl + "/admin/edit-course-video",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    if (response.code === 200) {
                        $(".errors").remove();
                        $(".CourseVideos")[0].reset();
                        $("#edit-video").modal("hide");
                        // coursePreview(response.data).refresh();

                        $("#courseMediaButton")
                            .removeClass("d-none")
                            .addClass("d-block");
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        });
                        if (section_id !== "") {
                            $(".selectSectionId").trigger("change", [
                                section_id,
                            ]);
                        }
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
        } else {
            if (fileInput.files.length > 0) {
                const fileInputName = fileInput.files[0];
                var fileName = fileInputName.name;
                var fileExtension = fileName.split(".").pop().toLowerCase();
                const file = fileInput.files[0];
                const video = document.createElement("video");
                const reader = new FileReader();
                reader.onload = function (e) {
                    video.src = e.target.result;
                    video.addEventListener("loadedmetadata", function () {
                        var duration = video.duration;
                        var form = new FormData($(".EditCourseVideos")[0]);
                        form.set("video_duration", duration);
                        $(".save_loader")
                            .removeClass("d-none")
                            .addClass("d-block");

                        $.ajax({
                            url: baseUrl + "/admin/edit-course-video",
                            type: "POST",
                            data: form,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                $(".save_loader")
                                    .addClass("d-none")
                                    .removeClass("d-block");
                                if (response.code === 200) {
                                    $(".errors").remove();
                                    $(".CourseVideos")[0].reset();
                                    $("#edit-video").modal("hide");
                                    // coursePreview(response.data).refresh();

                                    $("#courseMediaButton")
                                        .removeClass("d-none")
                                        .addClass("d-block");
                                    swal({
                                        title: response.title,
                                        text: response.message,
                                        icon: response.icon,
                                    });
                                    if (section_id !== "") {
                                        $(".selectSectionId").trigger(
                                            "change",
                                            [section_id]
                                        );
                                    }
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
                };

                reader.readAsDataURL(file);
            }
        }
    });

    $("#courseMediaButton").on("click", function (event) {
        $("#course-media-3").removeClass("active").addClass("dstepper-none");
        $('.step[data-target="#course-media-3"]').removeClass("active");

        $("#course-content-4").removeClass("dstepper-none").addClass("active");
        $('.step[data-target="#course-content-4"]').addClass("active");
    });
    $(".updateCourseContent").on("click", function (event) {
        event.preventDefault();
        var course_check = $(".course_id").val();
        if (course_check != "") {
            $("#course_podcast_error").hide();
            $("#course_about_module_error").hide();

            var video_file = $("#video_file").val();
            var about_module = $("#about_module").val();

            // if (video_file === "") {
            //     $("#course_podcast_error").show();
            //     return;
            // }
            // if (about_module === "") {
            //     $("#course_about_module_error").show();
            //     return;
            // }

            var form = new FormData($(".CourseContentForm")[0]);
            $(".save_loader").removeClass("d-none").addClass("d-block");
            $.ajax({
                url: baseUrl + "/admin/add-course-content",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    if (response.code === 200) {
                        $(".errors").remove();
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            window.location.href = baseUrl + "/admin/all-award";
                        });
                    }
                    if (response.code === 201) {
                        $(".errors").remove();
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            window.location.href = baseUrl + "/admin/all-award";
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
        } else {
            swal({
                title: "Course Details Not Found",
                text: "Kindly start from beginning",
                icon: "warning",
            }).then(function () {
                $("#course-content-4")
                    .removeClass("active")
                    .addClass("dstepper-none");
                $('.step[data-target="#course-content-4"]').removeClass(
                    "active"
                );
                $("#basic-information-1")
                    .removeClass("dstepper-none")
                    .addClass("active");
                $('.step[data-target="#basic-information-1"]').addClass(
                    "active"
                );
            });
        }
    });
    $(".CourseSubmitForm").on("click", function (event) {
        event.preventDefault();
        var course_check = $(".course_id").val();
        if (course_check != "") {
            var formData = $(".CourseModuleForm").serialize(); // Serialize the form data
            // $(".save_loader").removeClass("d-none").addClass("d-block");

            // // Add additional data from list items
            // $("#sortable li").each(function () {
            //     formData.push({
            //         name: "sorted_course_module_ids[]",
            //         value: $(this).data("courseid"),
            //     });
            // });
            $.ajax({
                url: baseUrl + "/admin/add-course-module-main",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    if (response.code === 200) {
                        const optionalTab = $("#optional-course-tab");
                        if (optionalTab.hasClass("active")) {
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                            }).then(function () {
                                window.location.href =
                                    baseUrl + "/admin/all-course";
                            });
                        } else {
                            swal({
                                title: response.title,
                                text: response.message,
                                icon: response.icon,
                                buttons: {
                                    cancel: {
                                        text: "Done", // Text for the cancel button
                                        value: "done", // Text for the cancel button,
                                        visible: true, // Make the button visible,
                                    },
                                    confirm: {
                                        text: "Go to optional", // Text for the confirmation button
                                        value: "optional", // Text for the cancel button
                                    },
                                },
                            }).then((value) => {
                                if (value === "done") {
                                    window.location.href =
                                        baseUrl + "/admin/all-course";
                                } else if (value === "optional") {
                                    $("#optional-course-tab")
                                        .removeClass("disabled")
                                        .attr("aria-disabled", "false")
                                        .attr("tabindex", "0")
                                        .attr("data-bs-toggle", "pill");
                                    $("#optional-course-tab").tab("show");
                                    $("#main-course-tab").addClass("disabled");
                                }
                            });
                        }
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
        } else {
            swal({
                title: "Course Details Not Found",
                text: "Kindly start from beginning",
                icon: "warning",
            }).then(function () {
                $("#course-content-4")
                    .removeClass("active")
                    .addClass("dstepper-none");
                $('.step[data-target="#course-content-4"]').removeClass(
                    "active"
                );
                $("#basic-information-1")
                    .removeClass("dstepper-none")
                    .addClass("active");
                $('.step[data-target="#basic-information-1"]').addClass(
                    "active"
                );
            });
        }
    });

    $(".course_trailer").on("change", function (event) {
        var file = event.target.files[0];
        // Check if file is selected
        if (file) {
            var videoSrc = URL.createObjectURL(file);
            $(".previouseVideo").addClass("d-none");
            $(".video-preview-trailor")
                .removeClass("d-none")
                .attr("src", videoSrc)
                .addClass("d-block");
            $("#trailer_file_name").text(file.name);
        }
    });
    $("#course_podcast").on("change", function (event) {
        var file = event.target.files[0];
        // Check if file is selected
        if (file) {
            var videoSrc = URL.createObjectURL(file);
            $(".previouseVideoPodcast").addClass("d-none");
            $(".video-preview-podcast")
                .removeClass("d-none")
                .attr("src", videoSrc)
                .addClass("d-block");
        }
    });

    $("#sectionAssign").on("click", function (event) {
        event.preventDefault();

        //  $("#section_title_error").hide();

        //  var section_title = $("#section_title").val();

        //  if (section_title === "") {
        //      $("#section_title_error").show();
        //      return;
        //  }
        var form = $("input[name='section[]']").serialize();
        $(".save_loader").removeClass("d-none").addClass("d-block");
        $.ajax({
            url: baseUrl + "/admin/assign-course-section",
            type: "POST",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").addClass("d-none").removeClass("d-block");
                if (response.code === 200) {
                    $(".errors").remove();
                    $("#sectionForm")[0].reset();
                    $("#addSectionModal").modal("hide");
                    // coursePreview(response.data).refresh();
                    sectionList();
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
                swal({
                    title: response.title,
                    text: response.message,
                    icon: response.icon,
                });
            },
        });
    });

    // Independent Section Creation
    $("#addSection").on("click", function (event) {
        event.preventDefault();

        $("#section_title_error").hide();

        var section_title = $("#section_title").val();

        if (section_title === "") {
            $("#section_title_error").show();
            return;
        }
        var form = $("#sectionForm").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-course-section",
            type: "POST",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();
                    $("#sectionForm")[0].reset();
                    $("#addSectionModal").modal("hide");
                    // coursePreview(response.data).refresh();
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
                    sectionList();
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

    $(document).on("click", ".videoEdit", function (event) {
        event.preventDefault();
        var video_id = $(this).data("video_id");
        var action = $(this).data("action");
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();

        $.ajax({
            url: baseUrl + "/admin/get-section-videos",
            type: "get",
            data: { id: video_id, action: action },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                // if (response.code === 200) {
                var data = response.data[0];
                // if (response.length > 0) {

                var videoTitle = data.video_title;
                var bunnyVideoId = data.bn_video_url_id;
                var videoUrl = data.video_file_name;
                var section_name = data.section_video[0].section_name;
                var section_id = btoa(data.section_video[0].id);
                var videoId = btoa(data.id);
                $("#videoTitle").attr("value", videoTitle);
                $("#videoId").attr("value", bunnyVideoId);
                $("#video_id").attr("value", btoa(data.id));
                $("#addCourseVideoModalLabel").html("Edit Video");
                $(".thumbnail-edit").removeClass("d-none").addClass("d-block");
                // $("#selectSectionId").append(
                //     "<option value=" +
                //         section_id +
                //         " selected=''>" +
                //         section_name +
                //         "</option>"
                // );
                $("#selectSectionId option[value='" + section_id + "']").prop(
                    "selected",
                    true
                );

                $("#filUrl").html(videoUrl);
                // baseUrl +
                //     "/admin/images/course/masters-human-resource-management.png";
                $("#videoPreview").append(
                    "<div class='col-md-4 col-lg-3 videoEach'><div class='card mb-2'><div class='p-1'><div class='d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover course-thumn-video' style='background-image:url(" +
                        img +
                        ");'><a class='glightbox icon-shape rounded-circle btn-play icon-lg' href='https://www.youtube.com/watch?v=Nfzi7034Kbg'><i class='fe fe-play'></i></a></div><i class='bi bi-x-circle-fill deleteVideo' data-delete_id='" +
                        videoId +
                        "'></i></div><div class='card-body p-1 ps-3'><div class='mb-3'><h5 class='text-dark fw-bold'>" +
                        videoTitle +
                        "</h5></div></div></div></div>"
                );
                $("#addCourseVideoModal").modal("show");
                var thumbnailUrl =
                    "https://vz-8beca12f-70b.b-cdn.net/" +
                    response.data[0].bn_video_url_id +
                    "/thumbnail.jpg";
                $(".thumbnail-edit").css({
                    "background-image": "url(" + thumbnailUrl + ")",
                });
                var videoUrl =
                    "https://iframe.mediadelivery.net/embed/253882/" +
                    response.data[0].bn_video_url_id +
                    "?autoplay=false&loop=false&muted=true&preload=false&responsive=true";
                $(".videoUrlLink").attr("href", videoUrl);

                $(".thumbnail-edit").css("visibility", "visible");
                $(".thumbnail-edit").css("height", "250px");
                $(".thumbnail-edit-pdf").css("height", "");
                // } else {
                //     $(".addVideo").removeClass("d-none").addClass("d-block");
                // }
                // }
            },
        });
    });

    $("#assginContent").on("click", function (event) {
        event.preventDefault();

        // $("#section_title_error").hide();

        // var section_title = $("#section_title").val();

        // if (section_title === "") {
        //     $("#section_title_error").show();
        //     return;
        // }
        var form = $("#sectionFormData").serialize();
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/assign-content-section",
            type: "POST",
            data: form,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();

                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href = baseUrl + "/admin/section";
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData, true);
                    $("#modalCancel").hide();
                    $("#modalOk").on("click", function () {
                        var referrer = document.referrer;
                        var searchString = "award-course-get-data";
                        if (referrer.includes(searchString)) {
                            redirect = referrer + "#section-selection-3";
                            showModalWithRedirect(modalData, redirect);
                        } else {
                            var redirect = "/admin/section";
                            showModalWithRedirect(modalData, redirect);
                        }
                    
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
    $(document).on("click", ".deleteVideo", function (event) {
        var video_id = $(this).data("delete_id");
        if (video_id == undefined) {
            var video_id = $(".modal-body .deleteId").val();
        }

        var section_id =
            $(".section_id").val() !== undefined &&
            $(".section_id").val() !== ""
                ? $(".section_id").val()
                : "";
        var video_type = $(".video_type").val();
        if (video_type == "") {
            video_type = "";
        }
        var video_types = atob($(".video_type").val());
        // if (video_types == "ORIENTATIOIN") {
        //     VideoTypes = "Orientation";
        //     TextVideoTypes = "orientation";
        //     Pagereturn = "/admin/orientation";
        // } else {
        //     VideoTypes = "Video";
        //     TextVideoTypes = "orientation";
        //     Pagereturn = "/admin/add-video";
        // }
        if (video_id != undefined) {
            // swal({
            //     title: "Delete Video",
            //     text: "Are you sure you want to delete video? Your Action will permanently remove it, and the content will be lost forever with no recovery option.",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Video",
                message: "Are you sure you want to delete video? Your Action will permanently remove it, and the content will be lost forever with no recovery option.",
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
                        url: baseUrl + "/admin/delete-course-video",
                        type: "POST",
                        data: { id: video_id, video_type: video_type },
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

                            //     .then(function () {
                            //     return (window.location.href = Pagereturn);
                            // });

                            if (response.code === 200) {
                                if (section_id !== "") {
                                    $(".selectSectionId").trigger("change", [
                                        section_id,
                                    ]);
                                }
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
    // Delete Section
    $(document).on("click", ".deleteSection", function (event) {
        var section_id = $(this).data("delete_id");

        if (section_id == undefined) {
            var section_id = $(".modal-body .deleteId").val();
        }
        if (section_id != undefined) {
            // swal({
            //     title: "Delete Section",
            //     text: "Are you sure you want to delete section? Your Action will permanently remove it, and the content will be lost forever with no recovery option.",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");

            const modalData = {
                title: "Delete Section",
                message: "Are you sure you want to delete section? Your Action will permanently remove it, and the content will be lost forever with no recovery option.",
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
                        url: baseUrl + "/admin/delete-course-section",
                        type: "POST",
                        data: { id: section_id },
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
                            //     return window.location.reload();
                            // });
                            const modalData = {
                                title: response.title,
                                message: response.message,
                                icon: response.icon,
                            }
                            
                            // showModal(modalData);
                            var redirect = `/admin/section`;
        
                            showModalWithRedirect(modalData, redirect);
                            //     .then(function () {
                            //     return (window.location.href = Pagereturn);
                            // });
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

    // Delete Section Content
    $(document).on("click", ".deleteContent", function (event) {
        var delete_id = $(this).data("delete_id");
        var content_type = $(this).data("content_type");
        var section_id =
            $(".section_id").val() !== undefined &&
            $(".section_id").val() !== ""
                ? $(".section_id").val()
                : "";

        swal({
            title: "Remove Section",
            text: "Are you sure you want to remove section content?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".save_loader").removeClass("d-none").addClass("d-block");
                $.ajax({
                    url: baseUrl + "/admin/unassign-section-content",
                    type: "POST",
                    data: { id: delete_id, content_type: content_type },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        $(".save_loader")
                            .addClass("d-none")
                            .removeClass("d-block");
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            return window.location.reload();
                        });
                        if (response.code === 200) {
                            if (section_id !== "") {
                                $(".selectSectionId").trigger("change", [
                                    section_id,
                                ]);
                            }
                        }
                    },
                });
            }
        });
    });
    // Add Journal Articles

    $("#inputLogo").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        $(".input-visible").text(file.name);
    });
    $(".addJournalDocs").on("click", function (event) {
        event.preventDefault();
        $("#section_id_error").hide();
        $("#journal_title_error").hide();
        $("#journal_file_error").hide();

        var section_id = $("#section_id").val();
        var journal_title = $("#journal_title").val();
        var article_id = $("#article_id").val();
        if (article_id == "") {
            if (section_id === "") {
                $("#section_id_error").show();
                return;
            }
            if (journal_title === "") {
                $("#journal_title_error").text("document title required.");
                $("#journal_title_error").show();
                return;
            }
            if (journal_title.length > 255) {
                $("#journal_title_error").text(
                    "document title should be less than 255 characters."
                );
                $("#journal_title_error").show();
                return;
            }
            var fileInput = $("#inputLogo")[0];

            if (fileInput.files.length == 0) {
                $("#journal_file_error").show();
                return;
            }
            $(".input-visible").text(fileInput.files[0].name);
        }

        var form = new FormData($(".courseDocsForm")[0]);
        $(".save_loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-journal-article",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $(".save_loader").fadeOut();
                if (response.code === 200 || response.code == 201) {
                    $(".errors").remove();
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     window.location.href =
                    //         baseUrl + "/admin/journal-articles";
                    // });

                    const modalData = {
                        title: response.title,
                        message: response.message || "",
                        icon: response.icon,
                    };

                    var redirect = `/admin/journal-articles`;

                    showModalWithRedirect(modalData, redirect);
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

    $(".orientationPdf").on("click", function (event) {
        pdfUrl = $(this).data("action");

        $("#pdfViewer").attr("src", pdfUrl);
        $("#orientation-pdf").modal("show");
    });

    $(".orientation-close").click(function () {
        $("#orientation-pdf").modal("hide");
    });

    $(".edit_video_file, .video_file").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        var videoSrc = URL.createObjectURL(file);
        if (fileType === "application/pdf") {
            $(".pdfvieweradd")
                .removeClass("d-none")
                .attr("src", videoSrc)
                .addClass("d-block");
            var frame = $("iframe");
            var contents = frame.contents();
            var body = contents
                .find("body")
                .attr("oncontextmenu", "return false");
            $(".video-preview-trailor").addClass("d-none");
            $(".thumbnail-edit-pdf").addClass("d-none");
            $(".thumbnail-edit").addClass("d-none");
            $(".input-visible").text(file.name);
        } else {
            // videoElement.src = videoSrc;

            $(".video-preview-trailor")
                .removeClass("d-none")
                .attr("src", videoSrc)
                .addClass("d-block");
            $(".previouseVideo").addClass("d-none");
            $(".video_file").closest(".pdfvieweradd").addClass("d-none");
            $(".video_file").closest(".video-preview").addClass("d-none");
            $(".video_file").closest(".thumbnail-edit-pdf").addClass("d-none");
            $(".video_file").closest(".thumbnail-edit").addClass("d-none");
            $(".video_file").closest(".input-visible").text(file.name);
            $(".thumbnail-edit").addClass("d-none");
            $(".input-visible").text(file.name);
            const videoPreview = document.querySelector(
                ".video-preview-trailor"
            );
            videoPreview.src = videoSrc;
            videoPreview.addEventListener("loadedmetadata", function () {
                const duration = videoPreview.duration; // Duration in seconds
                $(".video_duration").val(duration);
            });
        }
    });
    $(document).on("click", ".edit-orientation", function () {
        var orientationId = btoa($(this).data("id"));
        $(".modal-body #orientation_id").val(orientationId);

        var libraryId = $(".modal-body #library_id").val();
        var pullzoneId = $(".modal-body #pull_zone_id").val();
        $.ajax({
            url: baseUrl + "/admin/edit-orientation/",
            type: "POST",
            data: {
                id: orientationId,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.data[0].bn_collection_id == "") {
                    var pdfurl =
                        baseUrl +
                        "/storage/" +
                        response.data[0].bn_video_url_id;
                    $(".thumbnail-edit").css("visibility", "hidden");

                    $(".thumbnail-edit-pdf").css("visibility", "visible");
                    $(".thumbnail-edit-pdf").css("height", "210px");

                    $(".thumbnail-edit").css("height", "");
                    $(".pdfviewer").attr("src", pdfurl);
                } else {
                    var thumbnailUrl =
                        atob(pullzoneId) +
                        response.data[0].bn_video_url_id +
                        "/thumbnail.jpg";
                    var videoUrl =
                        "https://iframe.mediadelivery.net/embed/" +
                        atob(libraryId) +
                        "/" +
                        response.data[0].bn_video_url_id +
                        "?&loop=true&muted=true&preload=true&responsive=true";
                    $(".modal-body a").attr("href", videoUrl);
                    $(".thumbnail-edit").css({
                        "background-image": "url(" + thumbnailUrl + ")",
                    });
                    $(".thumbnail-edit-pdf").css("visibility", "hidden");
                    $(".thumbnail-edit").css("visibility", "visible");
                    $(".thumbnail-edit").css("height", "250px");
                    $(".thumbnail-edit-pdf").css("height", "");
                }
                $(".modal-body #edit_video_title").val(
                    response.data[0].video_title
                );
                $(".modal-body #video_duration").val(
                    response.data[0].video_duration
                );
                $("#video_file_name").text(response.data[0].video_file_name);
            },
        });
    });
    $("#updateSectionAssigned").on("click", function (event) {
        event.preventDefault();

        var course_check = $(".course_id").val();
        // var editor = ;
        if (course_check != "") {
            var form = $(".CourseMediaForm").serialize();
            $(".save_loader").removeClass("d-none").addClass("d-block");

            $.ajax({
                url: baseUrl + "/admin/add-section-course",
                type: "POST",
                data: form,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    if (response.code === 200) {
                        $(".errors").remove();
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            $("#section-selection-3")
                                .addClass("dstepper-none")
                                .removeClass("active");
                            $(
                                '.step[data-target="#section-selection-3"]'
                            ).removeClass("active");
                            $("#course-content-4")
                                .addClass("active")
                                .removeClass("dstepper-none");
                            $(
                                '.step[data-target="#course-content-4"]'
                            ).addClass("active");

                            $(".previouseVideo").addClass("d-none");
                            $(".video-preview-trailor")
                                .removeClass("d-none")
                                .attr("src", videoSrc)
                                .addClass("d-block");
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
        } else {
            swal({
                title: "Course Details Not Found",
                text: "Kindly start from beginning",
                icon: "warning",
            }).then(function () {
                $("#section-selection-3")
                    .removeClass("active")
                    .addClass("dstepper-none");
                $('.step[data-target="#section-selection-3"]').removeClass(
                    "active"
                );
                $("#basic-information-1")
                    .removeClass("dstepper-none")
                    .addClass("active");
                $('.step[data-target="#basic-information-1"]').addClass(
                    "active"
                );
            });
        }
    });

    $(document).on("click", ".statusCourse", function (event) {
        var course_id = $(this).data("course_id");
        var status = $(this).data("status");
        var role = $(this).data("role");
        var statusdec = atob(status);
        var courseall = $(this).data("courseall");
        // $(".save_loader").removeClass("d-none").addClass("d-block");
        if (statusdec == "course_status_unpublish") {
            $.ajax({
                url: baseUrl + "/admin/expired-course",
                type: "POST",
                data: { course_id: course_id },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    swal({
                        title: response.title,
                        content: {
                            element: "span",
                            attributes: {
                                innerHTML: response.message, // Use innerHTML to render the HTML tags properly
                            },
                        },
                        icon: response.icon,
                        buttons: ["Cancel", "Ok"], // Customize button names here
                    }).then(function (isConfirm) {
                        // $(".save_loader").addClass("d-none").removeClass("d-block");
                        if (isConfirm) {
                            $.ajax({
                                url: baseUrl + "/admin/status-course",
                                type: "post",
                                data: { id: course_id, status: status },
                                dataType: "json",
                                headers: {
                                    "X-CSRF-TOKEN": csrfToken,
                                },
                                success: function (response) {
                                    $(".save_loader")
                                        .addClass("d-none")
                                        .removeClass("d-block");
                                    swal({
                                        title: response.title,
                                        text: response.message,
                                        icon: response.icon,
                                    }).then(function () {
                                        if (courseall == "courseall") {
                                            return (window.location.href =
                                                "/admin/all-course");
                                        } else {
                                            return (window.location.href =
                                                "/admin/all-award");
                                        }
                                    });

                                    // if (response.code === 200) {
                                    //     if (section_id !== "") {
                                    //         $(".selectSectionId").trigger("change", [
                                    //             section_id,
                                    //         ]);
                                    //     }
                                    // }
                                },
                            });
                        }
                    });
                },
            });
        } else {
            $.ajax({
                url: baseUrl + "/admin/status-course",
                type: "post",
                data: { id: course_id, status: status },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $(".save_loader").addClass("d-none").removeClass("d-block");
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        if (courseall == "courseall") {
                            return (window.location.href = "/admin/all-course");
                        } else {
                            return (window.location.href = "/admin/all-award");
                        }
                    });

                    // if (response.code === 200) {
                    //     if (section_id !== "") {
                    //         $(".selectSectionId").trigger("change", [
                    //             section_id,
                    //         ]);
                    //     }
                    // }
                },
            });
        }
    });
    $(document).on("click", ".deleteCourse", function (event) {
        var allVals = [];
        var deletevalue = $(this).data("course_id");

        // swal({
        //     title: "Delete Course",
        //     text: "Are you sure you want to delete course?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        // $(".save_loader").removeClass("d-none").addClass("d-block");

        $.ajax({
            url: baseUrl + "/admin/expired-course",
            type: "POST",
            data: { course_id: deletevalue },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                swal({
                    title: response.title,
                    content: {
                        element: "span",
                        attributes: {
                            innerHTML: response.message, // Use innerHTML to render the HTML tags properly
                        },
                    },
                    icon: response.icon,
                    buttons: ["Cancel", "Ok"], // Customize button names here
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: baseUrl + "/admin/delete-course",
                            type: "POST",
                            data: { course_id: deletevalue },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                $(".save_loader")
                                    .addClass("d-none")
                                    .removeClass("d-block");

                                if (response.code === 200) {
                                    swal({
                                        title: response.title,
                                        text: response.message,
                                        icon: response.icon,
                                    }).then(function () {
                                        return (window.location.href =
                                            "/admin/all-award");
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
            },
        });
        // }
        // });
    });

    $("#searchMainCourse").keyup(function (event) {
        event.preventDefault();
        var current_query = $(this).val();
        var course_id = $(".course_id").val();
        var search_list = $(".search_course_list");
        var setCounter = $("#counter").val();
        search_list.empty();
        if (current_query !== "") {
            $.ajax({
                url: baseUrl + "/admin/course-search",
                type: "post",
                data: { search: current_query, course_id: course_id },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    search_list.empty();
                    if (response.length != 0) {
                        var data = response;
                        search_list.removeClass("d-none").addClass("d-block");
                        let counter = setCounter + 1;
                        data.forEach(function (item) {
                            search_list.append(
                                "<div class='list-group-item  rounded px-3 text-nowrap mb-1 searchContentCourse' id='developCourse'><input type='text' hidden  value='" +
                                    btoa(item.id) +
                                    "' name='main_course_id[]' ><div class='d-flex align-items-left justify-content-between'><h5 class='mb-0 selectionCoursestyle'><span class='align-left fs-4'> <i class='fe fe-menu me-1 align-left'></i> " +
                                    item.course_title +
                                    "</span></h5><div><a href='javascript:void(0)' id='link_" +
                                    item.id +
                                    "' onclick='appendCourse(\"" +
                                    btoa(item.id) +
                                    '","' +
                                    item.course_title +
                                    '","' +
                                    item.id +
                                    "\")' class='me-1 text-inherit'><span class='align-right addSpan" +
                                    +item.id +
                                    "' id='addStatus_" +
                                    item.id +
                                    "'>"
                            );

                            $.ajax({
                                url: baseUrl + "/admin/course-already-added",
                                type: "post",
                                data: {
                                    course_id: course_id,
                                    main_course_id: btoa(item.id),
                                },
                                dataType: "json",
                                headers: {
                                    "X-CSRF-TOKEN": csrfToken,
                                },
                                success: function (response) {
                                    if (response == true) {
                                        $("#addStatus_" + item.id).text(
                                            "Added"
                                        );
                                        $("#link_" + item.id)
                                            .removeAttr("onclick")
                                            .addClass("disabled")
                                            .css("pointer-events", "none")
                                            .css("opacity", "0.5");
                                    } else {
                                        $("#addStatus_" + item.id).text("Add");
                                    }
                                },
                            });
                            search_list.append("</span></a></div></div></div>");
                            counter++;
                        });
                        search_list.show();
                    }
                },
            });
        } else {
            $(".search_course_list")
                .addClass("d-none")
                .removeClass("d-block")
                .slideDown();
            $(".list-group li").show();
        }
    });
});
function appendCourse(course_id, course_title, counter) {
    const activeTab = $(".tab-wrapper .nav-link.active");
    const activeTabContentId = activeTab.attr("href").replace("#", "");
    const type = activeTabContentId === 'main-course' ? 'main' : 'optional';
    const listId = type === "main" ? "mainCourseLists" : "optionalCourseLists";
    const listIdApp = type === "main" ? "main_course_id" : "optional_course_id";

    $(".addSpan" + counter).remove();
    const list = $("#"+listId);
    console.log(list);
    list.append(
        " <div class='list-group-item rounded px-3 text-nowrap mb-1' id='courseID" +
            counter +
            "'><input type='hidden' name='" + listIdApp + "[]' value='" +
            course_id +
            "'><div class='d-flex align-items-center justify-content-between'><h5 class='mb-0 text-truncate'><a href='#' class='text-inherit'  onclick='return false;'><span class='align-middle fs-4'> <i class='fe fe-menu me-1 align-middle ' ></i>" +
            course_title +
            "</span></a></h5><div><a href='javascript:void(0)' onclick='removeCourse(this)' class='me-1 text-inherit' data-bs-toggle='tooltip' data-placement='top' aria-label='Delete' data-bs-original-title='Delete'><i class='fe fe-trash-2 fs-6'></i></a></div></div></div>"
    );
    $("#counter").val(counter + 1);
}
function removeCourse(course) {
    swal({
        title: "Removing Course?",
        text: "Are you sure you want to remove?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(course)
                .closest(".list-group-item")
                .slideUp(function () {
                    $(this).remove();
                });
        }
    });
}

$(function () {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight",
    });
    $("#sortable").disableSelection();
});

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function videoUpload(form, section_id) {
    var baseUrl = window.location.origin;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    // $(".save_loader").removeClass("d-none").addClass("d-block");
    $("#processingLoader").fadeIn();
    $.ajax({
        url: baseUrl + "/admin/add-course-video",
        type: "POST",
        data: form,
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
                $(".errors").remove();
                $(".CourseVideos")[0].reset();
                $("#addCourseVideoModal").modal("hide");
                $("#filUrl").html("Choose file...");
                // $(".thumbnail-edit").css(
                //     "background-image",
                //     "url(" +
                //         assets +
                //         "frontend/images/course/course-javascript.jpg)"
                // );
                // coursePreview(response.data).refresh();

                $("#courseMediaButton")
                    .removeClass("d-none")
                    .addClass("d-block");
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
                videoList()
                if (section_id !== "") {
                    $(".selectSectionId").trigger("change", [section_id]);
                }
            } else if (response.code === 202) {
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
                videoList()

            }
        },
    });
}
