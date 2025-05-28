$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var assets = window.location.origin + "/assets/";
    var reader = new FileReader();
    var img = new Image();
    $(".cretModal").on("click", function (event) {
        $(".certTempData")[0].reset();
        $("#certCat .addedOpt").remove();
        $("#certName").val("");
        $("#certFile").val("");
        $("#existing_file").val("");
        $("#imgpreview").removeAttr("src");
        $(".errors").hide();
    });
    $(".addCert").on("click", function (event) {
        event.preventDefault();
        $("#certCat_error").hide();
        $("#certName_error").hide();
        $("#certFile_error").hide();

        var certCat = $("#certCat").val();
        var certName = $("#certName").val();
        var existing_file = $("#existing_file").val();
        var certFile = $("#certFile")[0];
        if (certCat === null) {
            $("#certCat_error").show();
            return;
        }
        if (certName === "") {
            $("#certName_error").show();
            return;
        }
        console.log(existing_file);
        // if (
        //     certFile.files &&
        //     certFile.files.length > 0 &&
        //     existing_file == ""
        // ) {
        //     $("#certFile_error").show();
        //     return;
        // }
        var formData = new FormData($(".certTempData")[0]);

        // $("#loader").fadeIn();
        // if (this.reportValidity()) {
        $.ajax({
            url: baseUrl + "/admin/temp-cert-upload",
            type: "POST",
            data: formData,
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
                    $("#create-modal").modal("hide");
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    });
                    // AllAdminList("all");
                }
                if (response.code === 202) {
                    $(".errors").remove();
                    var data = Object.keys(response.data);
                    var values = Object.values(response.data);
                    data.forEach(function (key) {
                        var value = response.data[key];
                        $(".certTempData")
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
        // }
    });
    $(document).on("click", ".updateModel", function (event) {
        event.preventDefault();
        // $(".certTempData")[0].reset();
        // $("#certCat .addedOpt").remove();
        // $("#certName").val("");
        // $("#certFile").val("");
        // $("#imgpreview").removeAttr("src");
        // $(".errors").hide();
        var certid = $(this).data("certid");

        $("#loader").fadeIn();
        $.ajax({
            url: baseUrl + "/admin/get-temp-cert-data/" + certid,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                var data = response.data[0];
                if (response.code == 200) {
                    $("#certCat").append(
                        `<option class="addedOpt" selected="" value="` +
                            btoa(data.category.id) +
                            `">` +
                            data.category.category_name +
                            `</option>`
                    );
                    $(".certTempData").append(
                        `<input type="hidden" value="` +
                            btoa(data.id) +
                            `" name="certid">`
                    );
                    $("#certName").attr("value", data.certificate_name);
                    $("#existing_file").attr("value", data.certificate_file);
                    $("#imgpreview").attr(
                        "src",
                        baseUrl + `/storage/` + data.certificate_file
                    );
                    $("#taskModalLabel").html("Edit Certificate");
                    $(".addCert").html("Edit Certificate");
                    $("#create-modal").modal("show");
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
    $(document).on("click", ".deleteCertTemp", function (event) {
        var delete_id = $(this).data("delete_id");
        if (delete_id != undefined) {
            swal({
                title: "Delete Certificate Template",
                text: "Are you sure you want to delete Certificate Template? Your Action will permanently remove it, and the content will be lost forever with no recovery option.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(".save_loader").removeClass("d-none").addClass("d-block");
                    $.ajax({
                        url: baseUrl + "/admin/delete-cert-template",
                        type: "POST",
                        data: { id: delete_id },
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
