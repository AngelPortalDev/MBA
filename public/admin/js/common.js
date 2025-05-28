$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();

    var pathname = window.location.pathname;
    // if (pathname == "/admin/admin") {
    //     AllAdminList("all");
    // }
    // AllAdminList('all');

    $(".createAdmin").on("click", function (event) {
        event.preventDefault();
        var form = $(".adminData").serialize();
        $("#loader").fadeIn();
        $("#first_name_error").hide();
        $("#last_name_error").hide();
        $("#email_error").hide();
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
        if (mob_code === "" || mobile === "") {
            $("#mobile_error").show();
            return;
        }
        if (password === "") {
            $("#password_error").show();
            return;
        }
        if (ConfirmPassword === "") {
            $("#confirm_password_error").show();
            return;
        }

        // if (this.reportValidity()) {
            $.ajax({
                url: baseUrl + "/admin/admin-create",
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
                        $("#create-modal").modal("hide");

                        const modalData = {
                            title: response.title,
                            message: response.message || "",
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
        // }
    });

    $(".editAdmin").on("click", function (event) {
        event.preventDefault();
        if (this.reportValidity()) {
            var form = $(".editadminData").serialize();
            $.ajax({
                url: baseUrl + "/admin/admin-update",
                type: "POST",
                data: form,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    $("#loader").fadeOut();
                    if (response.code === 200 || response.code === 201) {
                        $(".errors").remove();
                        const modalData = {
                            title: response.title,
                            message: response.message || "",
                            icon: response.icon,
                        };
                        source = 'admin';
    
                        var redirect = `/admin/${source}`;
    
                        showModalWithRedirect(modalData, redirect);
                    }
                    if (response.code === 202) {
                        $(".errors").remove();
                        var data = Object.keys(response.data);
                        var values = Object.values(response.data);
                        data.forEach(function (key) {
                            var value = response.data[key];
                            if (key === "mobile" || key === "mob_code") {
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

$("#deleteAdmin").on("click", function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr("data-id"));
        });
        if ($(this).attr("data-id") == undefined) {
            var deletevalue = $("#adminId").val();
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
                url: baseUrl + "/admin/admin-deleteall",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                data: "admin_ids=" + join_selected_values,
                success: function (response) {
                    if (response.code === 200 || response.code === 201) {
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        });
                        AllAdminList("all");
                    }
                },
            });
        }
    });
    // Delete Any Entry
    $(document).on("click", ".deleteEntry", function (event) {
        event.preventDefault();
        var section_type = $(this).data("section_type");
        var delete_id = $(this).data("delete_id");
        // swal({
        //     title: "Delete",
        //     text: "Are you sure you want to delete?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {

        const modalData = {
            title: "Delete",
            message: "Are you sure you want to delete?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
                $("#loader").fadeIn();
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-entry",
                    type: "POST",
                    data: { id: delete_id, type: section_type },
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
                        // });
                        const modalData = {
                            title: response.title,
                            message: response.message || "",
                            icon: response.icon,
                        };
                        showModal(modalData);
                        if (atob(section_type) === "article") {
                            list("all").reload().fadeIn();
                        }
                    },
                });
        });
    });
    // Delete Multiple Entries

    $(document).on("click", ".deleteEntries", function (event) {
        var form = $(".actionData").serialize();
        var section_type = $(this).data("section");
        // swal({
        //     title: "Delete",
        //     text: "Are you sure you want to delete?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {

        const modalData = {
            title: "Delete",
            message: "Are you sure you want to delete?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
                $("#customModal").hide();
                $("#processingLoader").fadeIn();
                $("#process_loader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/delete-entires",
                    type: "POST",
                    data: form,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    // dataType: "application/json",
                    success: function (response) {
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
                        
                        if (atob($('.action').val()) === "section") {
                            sectionList().reload().fadeIn();
                        }
                        if (atob(section_type) === "article") {
                            list("all").reload().fadeIn();
                        }
                        
                    },
                });
        });
    });
    $(document).on("click", ".deleteAdmin", function () {
        var myAdminId = $(this).data("id");
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
            //     title: "Delete Admin",
            //     text: "Are you sure you want to delete admin?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         $(".save_loader").removeClass("d-none").addClass("d-block");
            
            const modalData = {
                title: "Delete Admin",
                message: "Are you sure you want to delete admin?.",
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
                        url: baseUrl + "/admin/admin-deleteall",
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
                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function () {
                            //     return (window.location.href =
                            //         "/admin/admin");
                            // });
    
                            $("#processingLoader").fadeOut();
                            const modalData = {
                                title: response.title,
                                message: response.message || "",
                                icon: response.icon,
                            };
        
                            var redirect = `/admin/admin`;
        
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

    $(".profileAdminPic").on("change", function () {
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
            url: baseUrl + "/admin/add-admin-profile-image",
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
                        message: response.message,
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
                        message: response.message,
                        icon: errorIconPath,
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
    $(".importAdmin").on("click", function (event) {
        event.preventDefault();
        var formData = new FormData($("#importFile")[0]);
        // $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/admin-import",
            type: "post",
            data: formData,
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
                    $("#import-admin-modal").modal("hide");
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        window.location.href = baseUrl + "/admin/admin";
                    });
                }
                if (response.code === 202) {
                    $(".errors").remove();

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
                }
            },
        });
    });

    $(".CourseUpload").on("click", function (event) {
        event.preventDefault();
        debugger;
        // var formData = $(".coursevideofile").serialize();
        var formData = new FormData($(".coursevideofile")[0]);
        $.ajax({
            url: baseUrl + "/admin/upload",
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
            },
        });
    });

    // var statusToggle = document.getElementById("status-toggle");
    //     statusToggle.addEventListener("change", function() {
    $("#status-toggle").on("change", function (event) {
        var status = this.checked ? "active" : "inactive";
        // });
        // $(".deleteEntity").on("click", function () {
        //     var form = $(".actionData").serialize();

        //     swal({
        //         title: "Delete ?",
        //         text: "Are you sure you want to delete ?",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     }).then((willDelete) => {
        //         if (willDelete) {
        //             $("#process_loader").fadeIn();
        //             $.ajax({
        //                 url: baseUrl + "/admin/student-delete",
        //                 type: "POST",
        //                 data: form,
        //                 headers: {
        //                     "X-CSRF-TOKEN": csrfToken,
        //                 },
        //                 // dataType: "application/json",
        //                 success: function (response) {
        //                     if (response.code === "200") {
        //                         $("#process_loader").fadeOut();
        //                     }
        //                     swal({
        //                         title: response.title,
        //                         text: "",
        //                         icon: response.icon,
        //                     });
        //                 },
        //             });
        //         }
        //     });
        // });
    });
    $("#searchInput").on("keyup", function () {
        var table = $(".all_admin_list").DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $("#search").keyup(function (event) {
        event.preventDefault();
        var current_query = $(this).val();
        var course_id = $(".course_id").val();
        var search_list = $(".search_list");
        var setCounter = $("#counter").val();

        search_list.empty();
        if (current_query !== "") {
            $.ajax({
                url: baseUrl + "/admin/section-search",
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
                                "<div class='list-group-item  rounded px-3 text-nowrap mb-1 searchContent' id='development'><input type='text' hidden  value='" +
                                    btoa(item.id) +
                                    "' name='section_id[]' ><div class='d-flex align-items-left justify-content-between'><h5 class='mb-0 selectionSectionstyle'><span class='align-left fs-4'> <i class='fe fe-menu me-1 align-left'></i> " +
                                    item.section_name +
                                    "</span></h5><div><a href='javascript:void(0)' id='link_" + item.id + "' onclick='appendSection(\"" +
                                    btoa(item.id) +
                                    '","' +
                                    item.section_name +
                                    '","' +
                                    item.id +
                                    "\")' class='me-1 text-inherit'><span class='align-right addSpan" +
                                    + item.id + "' id='addStatus_" + item.id + "'>");

                                    $.ajax({
                                        url: baseUrl + "/admin/section-already-added",
                                        type: "post",
                                        data: { course_id: course_id,section_id:btoa(item.id)},
                                        dataType: "json",
                                        headers: {
                                            "X-CSRF-TOKEN": csrfToken,
                                        },
                                        success: function (response) {
                                            if (response == true) {
                                                $('#addStatus_' + item.id).text("Added");
                                                $('#link_' + item.id).removeAttr('onclick').addClass('disabled').css('pointer-events', 'none').css('opacity', '0.5');
                                            } else {
                                                $('#addStatus_' + item.id).text("Add");
                                            }
                                        }
                                    })
                                    search_list.append("</span></a></div></div></div>");
                                
                            counter++;
                        });
                        search_list.show();
                    }
                },
            });
        } else {
            $(".search_list")
                .addClass("d-none")
                .removeClass("d-block")
                .slideDown();
            $(".list-group li").show();
        }
    });
});
function appendSection(section_id, section_name, counter) {
    var parent = $("#courseOne");

    $(".addSpan" + counter).remove();
    parent.append(
        " <div class='list-group-item rounded px-3 text-nowrap mb-1' id='sectionID" +
            counter +
            "'><input type='hidden' name='section_id[]' value='" +
            section_id +
            "'><div class='d-flex align-items-center justify-content-between'><h5 class='mb-0 text-truncate'><a href='#' class='text-inherit'  onclick='return false;'><span class='align-middle fs-4'> <i class='fe fe-menu me-1 align-middle ' ></i>" +
            section_name +
            "</span></a></h5><div><a href='javascript:void(0)' onclick='removeSection(this)' class='me-1 text-inherit' data-bs-toggle='tooltip' data-placement='top' aria-label='Delete' data-bs-original-title='Delete'><i class='fe fe-trash-2 fs-6'></i></a></div></div></div>"
    );
    $("#counter").val(counter + 1);
}
function removeSection(section) {
    swal({
        title: "Removing Section?",
        text: "Are you sure you want to remove?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(section)
                .closest(".list-group-item")
                .slideUp(function () {
                    $(this).remove();
                });
        }
    });
}

function handleSearchInput(searchInputId,clearCallback){
    const searchInput = document.getElementById(searchInputId);
    if(!searchInput) return;

    searchInput.addEventListener('input',()=>{
        if(searchInput.value === ''){
            clearCallback();
        }
    })
}

function goBack(){
    window.history.back();
}

// allow only number and skip characters

$('#mobile').on('input', function(e){
    this.value = this.value.replace(/[^0-9]/g, '');
})
$("#marks").on('input', function(){
    this.value = this.value.replace(/[^0-9]/g, '');
})

$('#percentage, #marks_edit, #percentage_edit, #mark, #assignment_percentage,#assignment_mark,#assignment_answer_limit').on('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});


// Add Reverse Tabnabbing  Secuirity Features

$(document).ready(function() {
    $('a[target="_blank"]').attr('rel', 'noopener noreferrer');
});

// Toggle Icon Changes

// document.addEventListener('click', function() {
//     const togglePassword = document.querySelector('.toggle-password');
//     const passwordInput = document.querySelector(togglePassword.getAttribute('toggle'));
//     const togglePasswordIcon = document.querySelector('.toggle-password-eye');

//     togglePassword.addEventListener('click', function () {
//         const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
//         passwordInput.setAttribute('type', type);

//         togglePasswordIcon.classList.toggle('bi-eye');
//         togglePasswordIcon.classList.toggle('bi-eye-slash');
//     });
// });

$(document).on("input", "input[type='number']", function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});

