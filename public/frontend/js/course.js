$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var baseUrl = window.location.origin;
    var studentBaseUrl = window.location.origin + "/student";
    var reader = new FileReader();
    var img = new Image();

    $(".addtocart").on("click", function (event) {
        var courseId = $(this).data("course-id");
        var action = $(this).data("action");
        var actions = atob($(this).data("action"));
        var withcart = ($(this).data("withcart"));
        
        if (actions == "wishlist") {
            var cartid = atob($(this).data("cart-id"));
        } else {
            var cartid = "";
        }
        if(withcart == "withcart"){
            $.ajax({
                url: baseUrl + "/store-intended-cart", // Route to store session data
                method: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"), // CSRF token for security
                    course_id: courseId,
                    action: action
                },
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = baseUrl + "/login";
                    }

                    // Redirect to the login page after storing the session data
                    // window.location.href = baseUrl + "/login";
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred:", error);
                }
            });
        }
        var removeid = $(this).data("id");  
        var Message = "";
        if(actions == "remove"){
            Message = "cart";
            Title_Message = "Cart";

        }
        if(actions == "wishlist_remove"){
            Title_Message = "wishlist";
            Message = "wishlist";

        }
        if (actions == "remove" || actions == "wishlist_remove") {
            // swal({
            //     title: "Remove  From " + Title_Message + "",
            //     text: "Are you sure you want to remove this course from your " + Message + "?",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
                    // CartFunction(courseId, action, removeid, cartid);
            //     }
            // });

            const modalData = {
                title: "Remove  From " + Title_Message + "",
                message: "Are you sure you want to remove this course from your " + Message + "?",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                $("#customModal").hide();
                CartFunction(courseId, action, removeid, cartid);
            });
        } else {
            var removeid = "";
            CartFunction(courseId, action, removeid, cartid);
        }
    });

    $(".ApplyPromo").on("click", function (event) {
        currentTabId = $(this).attr("id");
        var IdValue = currentTabId.split("-");
        var Id = IdValue[1];
        var CourseId = $(".course_id_" + Id).val();
        var CouponCode = btoa($(".promo_code_" + Id).val());
        var promo_code_id = "";
        $(".coupon_code_error_" + Id).hide();

        $("#ApplyPromo-" + Id).prop("disabled", true);

        if (CouponCode === "") {
            $("#ApplyPromo-" + Id).prop("disabled", false);
            $(".coupon_code_error_" + Id).show();
            return;
        }
        $.ajax({
            url: baseUrl + "/student/getcouponCode",
                type: "POST",
                data :{
                    coupon_code:CouponCode,
                    course_id:CourseId
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            success: function (response) {
                var total_old_price = atob($(".total_old_price_" + Id).val());
                // var DiscountCode = atob($(".discount_promo_" + Id).val());
                var DiscountCode = '';
                var promo_code_discount =
                    (total_old_price * DiscountCode) / 100;
                var DiscountTotal = $(".promo_code_discount").text();
                var overall_total = atob($(".overall_total").val());
                var overall_old_total = atob($(".overall_old_total").val());
                var promo_code_id = $(".promo_code_id").val();
                var full_price =
                    parseFloat(overall_total) - parseFloat(overall_old_total);
                if (response.code === 200) {
                    // var DiscountCode = atob($(".discount_promo_" + Id).val());
                    var DiscountCode = response.data.coupon_discount;
                    $(".discount_promo_" + Id).val(btoa(DiscountCode));
                    var total_old_price = atob(
                        $(".total_old_price_" + Id).val()
                    );
                    var promo_code_discount =
                        (total_old_price * DiscountCode) / 100;
                    $("#RemovePromo-" + Id)
                        .removeClass("d-none")
                        .addClass("d-block");
                    $("#ApplyPromo-" + Id).addClass("d-none");
                    $(".promo_code_discount").html(
                        parseFloat(DiscountTotal) +
                            parseFloat(promo_code_discount)
                    );
                    $("#ApplyPromo-" + Id).prop("disabled", false);

                    var DiscountOverAllTotal = $(".promo_code_discount").text();
                    if (DiscountOverAllTotal == "") {
                        var DiscountOverAllTotal = promo_code_discount;
                    }
                    var full_total_price =
                        parseFloat(full_price) -
                        parseFloat(DiscountOverAllTotal);
                    $(".overall_full_total").html("€" + Math.round(full_total_price));
                    $(".promo_code_discount").html(DiscountOverAllTotal);
                    $(".promo_code_discounts").val(btoa(DiscountOverAllTotal));
                    $(".overall_full_totals").val(btoa(Math.round(full_total_price)));
                    if ($(".direct_checkout").val() == undefined) {
                        var promo_code_id =
                            response.data.coupon_id + "," + promo_code_id;
                    } else {
                        var promo_code_id = btoa(response.data.coupon_id);
                    }

                    $(".promo_code_id").val(promo_code_id);

                    //  swal({
                    //     title: "Promo Code Applied",
                    //     // text: "",
                    //     icon:"success",
                    // });
                    const modalData = {
                        title: 'Promo Code Applied',
                        message: "",
                        icon: successIconPath,
                    };
                    showModal(modalData);
                }
                if (response.code === 201) {
                    $("#ApplyPromo-" + Id).prop("disabled", false);
                    $(".coupon_code_error_" + Id).show();
                    $(".coupon_code_error_" + Id).val(response.data.Message);
                    $(".coupon_code_error_" + Id).text(response.data.Message);
                    var promo_code_discount = 0;
                    var DiscountOverAllTotal =
                        parseFloat(DiscountTotal) -
                        parseFloat(promo_code_discount);
                    $(".promo_code_discount").html(DiscountOverAllTotal);
                    var full_total_price =
                        parseFloat(full_price) -
                        parseFloat(DiscountOverAllTotal);
                    $(".overall_full_total").html("€" + Math.round(full_total_price));
                    $(".promo_code_discounts").val(btoa(DiscountOverAllTotal));
                    $(".overall_full_totals").val(btoa(Math.round(full_total_price)));
                }

                // var promo_code_discount = total_old_price * response.data[0].coupon_discount/100;
                // var overall_price = total_price - full_price - promo_code_discount;
                // $(".promo_code_name").html(atob(CouponCode));
                // $(".promo_code_discount").html('€'+promo_code_discount);
                // $(".promo_code_name").val(CouponCode);
                // $(".promo_code_discount").val(btoa(promo_code_discount));

                // $(".overall_total").html('€'+overall_price);
                // $(".overall_total").val(btoa(overall_price));

                // $("#coupon_code_error").show();
                // $("#coupon_code_error").html('Invalid Coupon Code');
                // $("#promo_code_name").html('');
                // $("#promo_code_discount").html(0);
                // $(".promo_code_name").val('');
                // $(".promo_code_discount").val(0);
                // $("#overall_total").html('€'+total_price);
                // $(".overall_total").val(btoa(total_price));
                // swal({
                //     title: response.title,
                //     text: response.message,
                //     icon: response.icon,
                // });
                // }
            },
        });
    });

    // function fetchQuizAndAppend(QuizId) {
    //     $(".addSteps").remove();
    //     $(".addedPane").remove();

    //     // $("#loader").fadeIn();
    //     $.ajax({
    //         url: baseUrl + "/admin/get-quiz",
    //         type: "GET",
    //         dataType: "json",
    //         data: {
    //             quiz_id: QuizId,
    //         },
    //         headers: {
    //             "X-CSRF-TOKEN": csrfToken,
    //         },
    //         success: function (res) {
    //             if (res.code === 200) {
    //                 $("#quiz").collapse("show");
    //                 var questions = res.content.quiz_question;
    //                 var addPane = "";
    //                 var addQuestion = "";
    //                 questions.forEach((data, index) => {
    //                     addPane += `<div class='step addSteps' data-target='#test-l-${
    //                         index + 1
    //                     }'><button type='button' class='step-trigger' role='tab' aria-controls='test-l-${
    //                         index + 1
    //                     }' id='courseFormtrigger${index + 1}'></button></div>`;

    //                     addQuestion += `<div id='test-l-${
    //                         index + 1
    //                     }' role='tabpanel' class='bs-stepper-pane addedPane fade'
    //                         aria-labelledby='courseFormtrigger${index + 1}'>
    //                         <div class='card mb-4'>
    //                             <div class='card-body'>
    //                                 <div
    //                                     class='d-flex justify-content-between align-items-center border-bottom pb-3 mb-3'>
    //                                     <div class='d-flex align-items-center'>
    //                                         <a href=''><img src=''
    //                                                 alt='course' class='rounded img-4by3-lg' /></a>
    //                                         <div class='ms-3'>
    //                                             <h3 class='mb-0'><a href='' class='text-inherit'>Human Resource Management Basic Quiz</a></h3>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                                 <div class='mt-3'>
    //                                     <div class='d-flex justify-content-between'>
    //                                         <span>Exam Progress:</span>
    //                                         <span>Question 1 out of 5</span>
    //                                     </div>
    //                                     <div class='mt-2'>
    //                                         <div class='progress' style='height: 6px'>
    //                                             <div class='progress-bar bg-success' role='progressbar'
    //                                                 style='width: 15%' aria-valuenow='15' aria-valuemin='0'
    //                                                 aria-valuemax='100'></div>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                                 <div class='mt-5'>
    //                                     <span>Question 1</span>
    //                                     <h3 class='mb-3 color-blue  mt-1'>Human
    //                                        ${data.question}
    //                                         ___.</h3>
    //                                     <div class='list-group'>
    //                                         <div class='list-group-item list-group-item-action' aria-current='true'>
    //                                             <div class='form-check'>
    //                                                 <input class='form-check-input' type='radio'
    //                                                     name='flexRadioDefault' id='flexRadioDefault1' />
    //                                                 <label class='form-check-label stretched-link'
    //                                                     for='flexRadioDefault1'>${
    //                                                         data.option1
    //                                                     }</label>
    //                                             </div>
    //                                         </div>
    //                                         <div class='list-group-item list-group-item-action' aria-current='true'>
    //                                             <div class='form-check'>
    //                                                 <input class='form-check-input' type='radio'
    //                                                     name='flexRadioDefault' id='flexRadioDefault2' />
    //                                                 <label class='form-check-label stretched-link'
    //                                                     for='flexRadioDefault2'>${
    //                                                         data.option2
    //                                                     }</label>
    //                                             </div>
    //                                         </div>
    //                                         <div class='list-group-item list-group-item-action' aria-current='true'>
    //                                             <div class='form-check'>
    //                                                 <input class='form-check-input' type='radio'
    //                                                     name='flexRadioDefault' id='flexRadioDefault3' />
    //                                                 <label class='form-check-label stretched-link'
    //                                                     for='flexRadioDefault3'>${
    //                                                         data.option3
    //                                                     }</label>
    //                                             </div>
    //                                         </div>
    //                                         <div class='list-group-item list-group-item-action' aria-current='true'>
    //                                             <div class='form-check'>
    //                                                 <input class='form-check-input' type='radio'
    //                                                     name='flexRadioDefault' id='flexRadioDefault4' />
    //                                                 <label class='form-check-label stretched-link'
    //                                                     for='flexRadioDefault4'>${
    //                                                         data.option4
    //                                                     }</label>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                         <div class='mt-3 d-flex justify-content-end'>
    //                             <button class='btn btn-primary color-green nextButton' type='button' onclick='nextStep()'>Next
    //                                 <i class='fe fe-arrow-right'></i></button>
    //                         </div>
    //                     </div>`;
    //                 });
    //                 $("#custom_stepers").append(addPane);
    //                 $("#quizForm").append(addQuestion);
    //                 $(".nextButton").on("click", function () {
    //                     nextStep();
    //                 });
    //             }
    //         },
    //     });
    // }
    // $(document).on("click", ".quizCheck", function () {
    //     var QuizId = $(this).data("quiz_id");
    //     console.log(QuizId);
    //     $("#resource").collapse("hide");
    //     $("#course-project").collapse("hide");
    //     // $("#first_step").nextAll(".step").remove();
    //     // $("#test-start").nextAll(".bs-stepper-pane").remove();
    //     fetchQuizAndAppend(QuizId);
    // });

    $(".RemovePromo").on("click", function (event) {
        currentTabId = $(this).attr("id");
        var IdValue = currentTabId.split("-");
        var Id = IdValue[1];
        var CouponCode = btoa($(".promo_code_" + Id).val());
        var CourseId = $(".course_id_" + Id).val();

        $.ajax({
            url: baseUrl + "/student/getcouponCode",
                type: "POST",
                data :{
                    coupon_code:CouponCode,
                    course_id:CourseId
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            success: function (response) {  
                
                if($(".direct_checkout").val() == undefined){
                    var csv = $(".promo_code_id").val();
                    let valuesArray = csv.split(",");
                    let valueToRemove = "" + response.data.coupon_id + "";
                    let result = removeValueFromArray(
                        valuesArray,
                        valueToRemove
                    );
                    $(".promo_code_id").val(result);
                } else {
                    $(".promo_code_id").val("");
                }
                // swal({
                //     title: "Promo Code Removed",
                //     // text: "",
                //     icon:"success",
                // });
                const modalData = {
                    title: 'Promo Code Removed',
                    message: "",
                    icon: successIconPath,
                };
                showModal(modalData);
            },
        });
        currentTabId = $(this).attr("id");
        var IdValue = currentTabId.split("-");
        var Id = IdValue[1];
        $(".promo_code_" + Id).val("");
        var total_old_price = atob($(".total_old_price_" + Id).val());
        var DiscountCode = atob($(".discount_promo_" + Id).val());
        var promo_code_discount = (total_old_price * DiscountCode) / 100;
        var DiscountTotal = $(".promo_code_discount").text();
        var overall_total = atob($(".overall_total").val());
        var overall_old_total = atob($(".overall_old_total").val());
        var full_price =
            parseFloat(overall_total) - parseFloat(overall_old_total);
        var DiscountOverAllTotal =
            parseFloat(DiscountTotal) - parseFloat(promo_code_discount);
        var full_total_price =
            parseFloat(full_price) - parseFloat(DiscountOverAllTotal);

        $(".promo_code_discount").html(DiscountOverAllTotal);
        $(".overall_full_total").html("€" +  Math.round(full_total_price));
        $(".promo_code_discounts").val(btoa(DiscountOverAllTotal));
        $(".overall_full_totals").val(btoa(Math.round(full_total_price)));

        // var full_total_price = parseFloat(full_price ) - parseFloat(DiscountOverAllTotal);
        $("#ApplyPromo-" + Id)
            .removeClass("d-none")
            .addClass("d-block");
        $("#RemovePromo-" + Id).addClass("d-none");
        $(".promo_code_" + Id).removeAttr("disabled");
    });

    $(".openVideoModal").on('click',function(event){
        $(".save_loader").addClass("d-none").fadeOut();
        var videourl = $(this).data("videourl");
        $('.videoOpen').modal({
            backdrop: 'static',
            keyboard: false
        });
        $(".save_loader").addClass("d-none").fadeOut();
        $(".videoOpen").modal('show');
        // $('.videoFrame').attr('src', videourl);
        const videoFrame = document.querySelector(".videoFrame");

        if (videoFrame) {
            // Set the src attribute of the iframe
            videoFrame.src = videourl; // Replace with your video URL
            const player = new playerjs.Player(videoFrame);
            const icons = document.querySelectorAll('.plyr__control svg');
    
            icons.forEach(icon => {
                icon.style.width = '10px';
                icon.style.height = '10px';
            });

            player.on('ready', () => {
                // Set CSS variable for icon size
                document.documentElement.style.setProperty('--plyr-control-icon-size', '10px');
                // Adjust the size of control icons
                const icons = document.querySelectorAll('.plyr__control svg');
    
                icons.forEach(icon => {
                    icon.style.width = '10px';
                    icon.style.height = '10px';
                });
            });
        }

    });
    $(".couser-detail-modal-close-button").on('click',function(event){
        const src =  $('.videoFrame').attr('src');

        const videoFrame = document.querySelector(".videoFrame");
           
            // Initialize the player with the iframe
            // const player = new playerjs.Player(videoFrame);
            const player = new playerjs.Player(videoFrame);
            player.pause();
            player.on('ready', () => {
                console.log("ready");
            });

            player.pause();
            player.on('pause', () => {
                console.log("Player is paused");
            });
       

    });
    
    $(".addwishlist").on("click", function (event) {
        var courseId = $(this).data("course-id");
        var action = ($(this).data("action"));
        var withwishlist = $(this).data("withwishlist");
        if(withwishlist == "withwishlist"){
            $.ajax({
                url: baseUrl + "/store-intended-wishlist", // Route to store session data
                method: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"), // CSRF token for security
                    course_id: courseId,
                    action: action
                },
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = baseUrl + "/login";
                    }

                    // Redirect to the login page after storing the session data
                    // window.location.href = baseUrl + "/login";
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred:", error);
                }
            });
        }else{
            $.ajax({
                    url: baseUrl + "/student/addwishlist/",
                    type: "POST",
                    data: {
                        courseid: courseId,
                        action: action,
                    },
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
                        
                    },
                });
            }
          
    });
});

function removeValueFromArray(array, valueToRemove) {
    // Convert the string to an array
    return array.filter((value) => value !== valueToRemove);
}

$(".addassignment").on("click", function (event) {
    event.preventDefault();
    $("#question_error").hide();
    var question = $("#question").val();
    var editsection = $("#editsection").val();
    var assignment_title = $("#assignment_title").val();
    var assignment_percentage = $("#assignment_percentage").val();
    var assignment_mark = $("#assignment_mark").val();

    if (editsection === null) {
        $("#editsection_error").show();
        return;
    }
    if (assignment_title === null) {
        $("#assignment_title_error").show();
        return;
    }
    if (question === "") {
        $("#question_error").show();
        return;
    }

    var formData = new FormData($(".assignment")[0]);
    formData.append("editsection", editsection);
    formData.append("assignment_title", assignment_title);
    formData.append("assignment_percentage", assignment_percentage);
    formData.append("assignment_mark", assignment_mark);
    formData.append("question", question);

    $("#loader").fadeIn();
    $.ajax({
        url: baseUrl + "/admin/addassignment",
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            $("#addQuestion").modal("hide");
            swal({
                title: response.title,
                text: response.message,
                icon: response.icon,
            });
    },
    });
});




function CartFunction(courseId, action, removeid='', cartid='') {
    var baseUrl = window.location.origin;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (courseId) {
        $.ajax({
            url: baseUrl + "/course/addtocart/",
            type: "POST",
            data: {
                courseid: courseId,
                action: action,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.code === 201) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     return (window.location.href = "/login");
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.href = "/login";
                    }, 2000);
                } else {
                    var CountCourse = $(".CourseItems").text();
                    $(".CourseItems").html(CountCourse - 1);
                    if (
                        atob(action) == "remove" ||
                        atob(action) == "wishlist"
                    ) {
                        if (atob(action) == "remove") {
                            $(".course_" + atob(courseId)).css(
                                "display",
                                "none"
                            );
                        } else {
                            $(".course_" + cartid).css("display", "none");
                        }
                        var Id = removeid;

                        $(".promo_code_" + Id).val("");
                        if($(".total_old_price_" + Id).val() != undefined){
                            var total_old_price = atob(
                                $(".total_old_price_" + Id).val()
                            );
                            var total_price = atob($(".total_price_" + Id).val());
                        }
                        if($(".discount_promo_" + Id).val() != undefined){
                            // var DiscountCode = atob(
                            //     $(".discount_promo_" + Id).val()
                            // );
                            var DiscountCode = '';
                        }
                        var promo_code_discount =
                            (total_old_price * DiscountCode) / 100;
                        var DiscountTotal = $(".promo_code_discount").text();
                        if (DiscountTotal == 0) {
                            promo_code_discount = 0;
                        }
                        if($(".overall_total" + Id).val() != undefined){
                            var overall_total = atob($(".overall_total").val());
                            var overall_old_total = atob(
                                $(".overall_old_total").val()
                            );
                        }
                        var full_price =
                            parseFloat(overall_total) -
                            parseFloat(overall_old_total);
                        var DiscountOverAllTotal =
                            parseFloat(DiscountTotal) -
                            parseFloat(promo_code_discount);
                        var full_total_price =
                            parseFloat(full_price) -
                            parseFloat(DiscountOverAllTotal);
                        $(".promo_code_discount").html(DiscountOverAllTotal);
                        $(".overall_full_total").html("€" + full_total_price);
                        $(".promo_code_discounts").val(
                            btoa(DiscountOverAllTotal)
                        );
                        $(".overall_full_totals").val(btoa(full_total_price));
                        var total_price_last = $(".total_price_last").text();

                        $(".total_price_last").html(
                            parseFloat(total_price_last) -
                                parseFloat(total_price)
                        );
                        var full_price_last = $(".full_price_last").text();
                        // alert(full_price_last);
                        // alert(total_price);
                        // alert(total_old_price);
                        // alert(parseFloat(total_price) - parseFloat(total_old_price));
                        $(".full_price_last").html(
                            parseFloat(full_price_last) -
                                (parseFloat(total_price) -
                                    parseFloat(total_old_price))
                        );

                        var CountCourse = $(".CourseItemscount").text();
                        // alert(CountCourse);
                        $(".CourseItems").html(CountCourse - 1 + " Items");
                    }
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
    } else {
        swal({
            title: "Something Went Wrong",
            text: "Please Try Again",
            icon: "error",
        });
    }
}
