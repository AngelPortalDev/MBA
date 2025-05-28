
<!-- Left Menubar IMP div  -->
</div>

<!-- Script -->
@yield('js')
<!-- Libs JS -->
<script src="{{ asset('admin/libs/%40popperjs/core/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('admin/libs/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Theme JS -->
<script src="{{ asset('admin/js/theme.min.js')}}"></script>

<script src="{{ asset('admin/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{ asset('admin/js/vendors/chart.js')}}"></script>
<script src="{{ asset('admin/libs/flatpickr/dist/flatpickr.min.js')}}"></script>
<script src="{{ asset('admin/js/vendors/flatpickr.js')}}"></script>
{{-- <script src="{{ asset('admin/js/vendors/flatpickr.js')}}"></script> --}}


<script src="{{ asset('admin/js/common.js') }}"></script>
<script src="{{ asset('frontend/js/common.js') }}"></script>
{{-- <script src="https://js.stripe.com/v3/"></script> --}}
<script src=" {{ asset('admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src=" {{ asset('admin/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src=" {{ asset('admin/libs/pdfmake/build/pdfmake.min.js')}}"></script>
{{-- <script src=" {{ asset('admin/js/vendors/datatables.js')}}"></script> --}}

{{-- <script src="{{ asset('admin/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="{{ asset('admin/js/vendors/validation.js')}}"></script>
<script src="{{ asset('admin/js/vendors/dropzone.js')}}"></script> --}}


<script src="{{ asset('admin/libs/file-upload-with-preview/dist/file-upload-with-preview.iife.js')}}"></script>
<script src="{{ asset('admin/libs/%40yaireo/tagify/dist/tagify.min.js')}}"></script>

<script src="{{ asset('admin/libs/quill/dist/quill.min.js')}}"></script>
<script src="{{ asset('admin/libs/dragula/dist/dragula.min.js')}}"></script>

<script src="{{ asset('admin/libs/bs-stepper/dist/js/bs-stepper.min.js')}}"></script>
<script src="{{ asset('admin/js/vendors/beStepper.js')}}"></script>
<script src="{{ asset('admin/js/vendors/customDragula.js')}}"></script>
<script src="{{ asset('admin/js/vendors/editor.js')}}"></script>
{{-- <script src="{{ asset('admin/js/vendors/select2.min.js')}}"></script> --}}

<script src="{{ asset('admin/libs/glightbox/dist/js/glightbox.min.js')}}"></script>
<script src="{{ asset('admin/js/vendors/glight.js')}}"></script>
<script src="{{ asset('admin/js/certificateAdminJs.js') }}"></script>
<script src="{{ asset('admin/js/studentAdmin.js') }}"></script>
<script src="{{ asset('admin/js/teacherAdmin.js') }}"></script>
<script src="{{ asset('admin/js/courseAdmin.js') }}"></script>
<script src="{{ asset('admin/js/examCommon.js') }}"></script>
<script src="{{ asset('admin/js/paymentAdmin.js') }}"></script>
<script src="{{ asset('admin/js/ementorAdmin.js') }}"></script>
<script src="{{ asset('admin/js/settingAdmin.js') }}"></script>
<script src="{{ asset('admin/js/instituteAdmin.js') }}"></script>
<script src="{{ asset('admin/js/salesExecutiveAdmin.js') }}"></script>
<script src="{{ asset('frontend/js/ementor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>



{{-- <script src="{{ asset('admin/js/vendors/file-upload.js') }}"></script> --}}


    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <script>
    function isNumberKey(event) {
      var charCode = event.which || event.keyCode;
      // Allow numbers (0-9), backspace (8), delete (46), and arrow keys (37-40)
      if (charCode >= 48 && charCode <= 57 || charCode === 8 || charCode === 46 || (charCode >= 37 && charCode <= 40)) {
          return true;
      }
      return false;
    }
    function validateNumberInput(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
    
    var base_url = window.location.origin;
    var successIconPath = base_url+"/frontend/images/icons/Shield Check.gif";
    var errorIconPath = base_url+"/frontend/images/icons/Shield Cross.gif";
    var warningIconPath = base_url+"/frontend/images/icons/exclamation mark.gif";

    function showModal(response, showButtons = false) {
      const modal = $("#customModal");
      const modalIcon = $("#modalIcon");
      const modalTitle = $("#modalTitle");
      const modalMessage = $("#modalMessage");

      modalIcon.html(`<img src="${response.icon}" alt="icon" style="width: 80px;">`);
      modalTitle.text(response.title);
      modalMessage.text(response.message);

      if (showButtons) {
        $("#modalOk").show();
        $("#modalCancel").show();
      } else {
        $("#modalOk").hide();
        $("#modalCancel").hide();
        setTimeout(function () {
          modal.hide();
        }, 2000);
      }

      modal.css("display", "flex");

      modal.on("click", function (event) {
        if ($(event.target).is(modal)) {
          modal.css("display", "none");
        }
      });

      $("#modalClose").on("click", function () {
        modal.css("display", "none");
      });
    }

    function showModalWithRedirect(modalData, redirect) {
      showModal(modalData);
      setTimeout(function() {
          window.location.href =  redirect;
      }, 2000);
    }





  </script>

</body>

</html>


