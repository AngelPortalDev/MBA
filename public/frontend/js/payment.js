$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var studentBaseUrl = window.location.origin + "/student";
    var reader = new FileReader();
    var img = new Image();

    $("#checkout-live-button").on('click',function(){
        $("#first_name_error").hide();
        $("#last_name_error").hide();   
        $("#address_error").hide();
        $("#town_error").hide();
        $("#country_error").hide(); 

      
       
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var address = $("#address").val();
        var town = $("#town").val();
        var country = $("#country_id").val();
        var form = new FormData($(".courseDocsForm")[0]);
        if (first_name === "") {
            $("#first_name_error").show();
            return;
        }
        if(first_name.length > 20){
            $("#first_name_error").text("First name should not greater 20 characters.");
            $("#first_name_error").show();
            return;
        }
        if (last_name === "") {
            $("#last_name_error").show();
            return;
        }
        if(last_name.length > 20){
            $("#last_name_error").text("Last name should not greater 20 characters.");
            $("#last_name_error").show();
            return;
        }
        if (address === "") {
            $("#address_error").show();
            return;
        }
        if(address.length>100){
            $("#address_error").text("Address should not greater 100 characters.");
            $("#address_error").show();
            return;
        }
        if (town === "") {
            $("#town_error").show();
            return;
        }
        if (country === "") {
            $("#country_error").show();
            return;
        }
        $(".save_loader").removeClass("d-none").addClass("d-block");

        var form = new FormData($("#paymentprocess")[0]);
            $.ajax({
            url: baseUrl + "/student/paymentProcess",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            success: function (response) {

                if(response.code === 201){
                    $(".save_loader").addClass("d-none").removeClass("d-block");

                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }); 

                }else{  
                    if(response.data == 'payment-promo'){
                        $(".save_loader").addClass("d-none").removeClass("d-block");

                        window.open(response.url, '_self');
                    }else{
                        $(".save_loader").addClass("d-none").removeClass("d-block");

                        window.open(response.data, '_self');
                    }
                }
            }
        });
    // }
    });
 

});


