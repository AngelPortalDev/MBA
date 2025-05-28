$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();
    // $('.mob_code').select2();
    $(".addipblock").on("click", function (event) {
        event.preventDefault();
        $("#ipaddress_error").hide();
        var ipaddress = $("#ipaddress").val();
        const ipPattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        if (!ipPattern.test(ipaddress)) {
            $("#ipaddress_error").html('Please enter a valid IP address.')
            $("#ipaddress_error").show();
            return false;
        }
        if (ipaddress === "") {
            $("#ipaddress_error").show();
            return;
        }
        var form = $(".ipblockData").serialize();
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-ipblock",
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
                    $("#userblock-create-modal").modal('hide');
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
                    AllblockList('all');
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

    
    $(document).on("click", ".unblockList", function (event) {
        var ipaddress = $(this).data("ipaddress");
        // swal({
        //     title: "Delete",
        //     text: "Are you sure you want to unblock the ip address?",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((willDelete) => {
        //     if (willDelete) {
        //         $("#process_loader").fadeIn();
        
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
            // $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/admin/unblock-ipadd",
                    type: "POST",
                    data: {
                        ipaddress:ipaddress
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    dataType: "json",
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
                        AllblockList('all');
                        
                    },
                });
        });
    });

    $(".addticket").on("click", function (event) {
        event.preventDefault();
        $("#subject_error").hide();
        $("#error_type_error").hide();
        $("#assigned_to_error").hide();        
        $("#error_details_error").hide();
        $("#priority_error").hide();

        var subject = $("#subject").val();
        var error_type = $("#error_type").val();
        var assigned_to = $("#assigned_to").val();
        var error_details = $("#error_details .ql-editor").html();
        var text1 = $(error_details).text();
        var charCount = text1.length;
 
        var priority = $("#priority").val();

        if (subject === "") {
            $("#subject_error").show();
            return;
        }
        if (error_type === "") {
            $("#error_type_error").show();
            return;
        }
        if (assigned_to === "") {
            $("#assigned_to_error").show();
            return;
        }
        if(charCount == ''){
            $("#error_details_error").show();
            return ;
        }
        if (priority === "") {
            $("#priority_error").show();
            return;
        }
        var form = new FormData($(".ticketData")[0]);
        form.append("error_details", error_details);
        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/add-ticket",
            type: "post",
            data:form,
            dataType: "json",
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#loader").fadeOut();
                if (response.code === 200 || response.code === 201) {
                    $(".errors").remove();
                    $("#ticket-create-modal").modal('hide');
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
                    AllticketList('all');                
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
    $(document).on("click", ".statusTicket", function (event) {
        var ticket_id = $(this).data("ticket_id");
        var status = $(this).data("status");
        // swal({
        //     title: 'Closed Ticket.',
        //     content: {
        //         element: "span",
        //         attributes: {
        //             innerHTML: "Are you sure want to closed this ticket ?"
        //         },
        //     },
        //     icon: 'warning',
        //     buttons: ["Cancel", "Ok"], // Customize button names here
        // }).then(function (isConfirm) {
        //     if (isConfirm) {
        
        const modalData = {
            title: "Closed Ticket",
            message: "Are you sure want to closed this ticket ?",
            icon: warningIconPath,
        }
        showModal(modalData, true);
        $("#modalCancel").on("click", function () {
            $("#customModal").hide();
        });
        $("#modalOk").on("click", function () {
            $("#customModal").hide();
                $.ajax({
                    url: baseUrl + "/admin/status-ticket",
                    type: "post",
                    data: { ticket_id: ticket_id},
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // swal({
                        //     title: response.title,
                        //     text: response.message,
                        //     icon: response.icon,
                        // }).then(function () {
                        //     return (window.location.href =
                        //             "/admin/tickets");
                            
                        // });

                        const modalData = {
                            title: response.title,
                            message: response.message || "",
                            icon: response.icon,
                        };
    
                        var redirect = `/admin/tickets`;
    
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

    $(document).on("click", ".ticket_view", function (event) {
        var ticket_id = $(this).data("ticket_id");
        $.ajax({
            url: baseUrl +'/admin/get-tickets/'+ticket_id,
            type: "get",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                var data = response[0];
                console.log(data.status);
                $("#ticket_status").text("(" + data.status + ")");
                $(".ticket_title").text(data.subject);
                var decodedErrorDetails = htmlspecialchars_decode(data.error_details);
                $("#ticket_details").html(decodedErrorDetails);

                var file = data.error_screenshot ? baseUrl + '/storage/' +  data.error_screenshot : '';
                console.log(file);
                $(".error_screenshot_display").css('display','block');
                $(".error_screenshot_display").attr("src", file).css({
                    "width": "700px",
                    "height": "400px"
                });
                if(data.error_screenshot == ''){
                    $(".error_screenshot_display").css('display','none');
                }
                $("#ticket-view-modal").modal("show");
            }
        });
    });
    function htmlspecialchars_decode(text) {
        var textArea = document.createElement('div');
        textArea.innerHTML = text;
        return textArea.textContent || textArea.innerText || "";
    }
});