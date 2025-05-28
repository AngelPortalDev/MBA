<!-- Scripts -->
@if (Session::has('message'))
    <script>
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    </script>
@endif

<!-- template js files -->
<!-- Libs JS -->

{{-- <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,zh-CN,fr,es',
            autoDisplay: false
        }, 'google_translate_element');

        setTimeout(function() {
            var savedLang = localStorage.getItem("selectedLanguage") || "en";
            changeLanguage(savedLang, false);
        }, 500);
    }

    function changeLanguage(lang, showLoader = true) {
        if (showLoader) {
            $("#loader").fadeIn();
        }

        var select = document.querySelector(".goog-te-combo");
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event('change'));
        } else {
            console.warn("Google Translate dropdown not found!");
        }

        document.querySelectorAll(".language-option").forEach(btn => btn.classList.remove("active"));
        var activeBtn = document.querySelector(`.language-option[data-lang="${lang}"]`);
        if (activeBtn) {
            activeBtn.classList.add("active");
        }

        localStorage.setItem("selectedLanguage", lang);

        setTimeout(() => {
            if (showLoader) {
                $("#loader").fadeOut();
            }
        }, 2000);
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script> --}}





{{-- <script src="{{ asset('frontend/js/select2.min.js')}}"></script> --}}
<script src="{{ asset('frontend/libs/%40popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('frontend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/libs/simplebar/dist/simplebar.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('frontend/js/theme.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
<script type="text/javascript" src="//assets.mediadelivery.net/playerjs/player-0.1.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/player.js@0.1.0"></script> --}}
<script src="{{ asset('frontend/js/vendors/increment-value.js') }}"></script>
{{-- <script src="{{ asset('frontend/js/player-0.1.0.min.js') }}"></script> --}}


{{-- <script src="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.js') }}"></script> --}}


<script src="{{ asset('frontend/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>

<script src="{{ asset('frontend/libs/glightbox/dist/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/glight.js') }}"></script>


<script src="{{ asset('frontend/libs/bs-stepper/dist/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/beStepper.js') }}"></script>

{{-- <script src="{{ asset('frontend/libs/apexcharts/dist/apexcharts.min.js') }}"></script> --}}
<script src="{{ asset('frontend/js/vendors/chart.js') }}"></script>

<script src="{{ asset('frontend/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/tnsSlider.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/tooltip.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/toastr.min.js') }}"></script>

{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src=" {{ asset('frontend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src=" {{ asset('frontend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src=" {{ asset('frontend/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
{{-- <script src=" {{ asset('frontend/libs/datatable/js/jquery.dataTables.min.js')}}"></script> --}}

<script src="{{ asset('frontend/js/vendors/validation.js') }}"></script>
<script src="{{ asset('frontend/js/common.js') }}"></script>
<script src="{{ asset('frontend/js/course.js') }}"></script>
<script src="{{ asset('frontend/js/coursevideo.js') }}"></script>


<script src="{{ asset('frontend/js/payment.js') }}"></script>
{{-- <script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script><script id="zsiqscript" src="https://salesiq.zohopublic.com/widget?wc=siq4605044396440f1b620acf7e7aff45cb7c1758c52af8a5fac9b184144a95f114" defer></script> --}}
@if (isset(Auth::user()->role) && Auth::user()->role === 'user')
    <script src="{{ asset('frontend/js/studentJs.js') }}"></script>
@endif
@if (isset(Auth::user()->role) && Auth::user()->role === 'instructor')
    <script src="{{ asset('frontend/js/ementor.js') }}"></script>
@endif

@if (isset(Auth::user()->role) && Auth::user()->role === 'sub-instructor')
    <script src="{{ asset('frontend/js/ementor.js') }}"></script>
@endif


@if (isset(Auth::user()->role) && Auth::user()->role === 'institute')
    <script src="{{ asset('frontend/js/institute.js') }}"></script>
@endif

{{-- <script src="{{ asset('frontend/js/course.js') }}"></script> --}}
{{-- <script src="{{ asset('frontend/js/payment.js') }}"></script> --}}
