$(document).ready(function () {
    $("#exportButton").on("click", function(e) {
        e.preventDefault();
    
        $(".invalid-feedback").remove();
        $("input").removeClass("is-invalid");
    
        let startDate = $("input[name='start_date']").val();
        let endDate = $("input[name='end_date']").val();
        let hasError = false;
    
        if (!startDate) {
            $("input[name='start_date']").addClass("is-invalid").after('<div class="invalid-feedback">Start Date is required.</div>');
            hasError = true;
        }
        if (!endDate) {
            $("input[name='end_date']").addClass("is-invalid").after('<div class="invalid-feedback">End Date is required.</div>');
            hasError = true;
        }
    
        if (!hasError) {
            $("#loader").removeClass("d-none").addClass("d-block");
    
            setTimeout(function() {
                $(".save_loader").addClass("d-none").removeClass("d-block");
    
                var iframe = $("iframe");
                if (iframe.length > 0) {
                    iframe.remove();
                }
    
                $('#exportForm').submit();
            }, 3000);
        }
    });
    

    $('#exportButtonWithoutFilter').click(function(e) {
        e.preventDefault();
        $("#loader").removeClass("d-none").addClass("d-block");
        
        $('#exportFormWithoutFilter').submit();

        setTimeout(function() {
            $(".save_loader").addClass("d-none").removeClass("d-block")

            var iframe = $("iframe");
            if (iframe.length > 0) {
                iframe.remove();
            }

        }, 3000);
    });
});

