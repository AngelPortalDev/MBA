<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <link href="{{ asset('frontend/libs/glightbox/dist/css/glightbox.min.css')}}" rel="stylesheet" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta name="description" content="" /> --}}
        <meta name="description" content="E-Ascencia offers a wide range of online courses in public speaking, Strategic Leadership, Entrepreneurship, Marketing and more. Enroll now to enhance your skills!" />
        {{-- <meta name="keywords" content="" /> --}}
        <meta name="keywords" content="online courses, E-Ascencia, Public speaking, Entrepreneurship, E-Ascencia, Professional development, Course enrollment, E-learning, Personal development, Business courses, Career growth" />
        <meta name="author" content="Codescandy" />
        <meta property="og:title" content="E-Ascencia: Online Learning for Public Speaking, Leadership, and More" />
        <meta property="og:description" content="Enroll in our accredited online courses to enhance your skills in public speaking, leadership, and more." />


        {{-- <title>{{ config('app.name', 'E-Ascencia: Online Learning Portal') }}</title> --}}
        <title>Malta Business Academy</title>
        <!-- Favicon icon-->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon/favicon.png')}}" />
        <!-- Libs CSS -->
        <link href="{{ asset('frontend/fonts/feather/feather.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/libs/bs-stepper/dist/css/bs-stepper.min.css')}}" rel="stylesheet" />
        {{-- <link href="{{ asset('frontend/libs/dropzone/dist/dropzone.css')}}" rel="stylesheet" /> --}}
        <link href="{{ asset('frontend/libs/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />

        
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/theme.min.css')}}" />

        <!-- Custom CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('frontend/css/upload-profile-photo.scss')}}"> --}}
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}" />
      
        <link rel="canonical" href="index.php" />
        <link href="{{ asset('frontend/libs/tiny-slider/dist/tiny-slider.css')}}" rel="stylesheet" />
       <script type="text/javascript" src="{{ asset('frontend/js/sweetalert.min.js')}}"></script>
       <script src="{{ asset('frontend/js/jquery.min.js')}}"></script><!-- JQUERY.MIN JS -->
       {{-- <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script><!-- JQUERY.MIN JS --> --}}
       {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> --}}
          <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WVZC796Q');</script>
        <!-- End Google Tag Manager -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-W7Z6Y4BCE8"></script>
 {{-- @vite('resources/ts/deploy.ts') --}}
 <script src="https://cdn.jsdelivr.net/npm/web3/dist/web3.min.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-W7Z6Y4BCE8');
</script>
<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '892482493094028');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=892482493094028&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@if(env('BROADCAST_DRIVER') == 'pusher')
  <script type="module" src="http://{{ env('VITE_URL') }}:5173/resources/js/app.js" defer></script>
  <script type="module" src="http://{{ env('VITE_URL') }}:5173/resources/js/broadcasting.js" defer></script>
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endif



<script>
  // $(document).ready(function() {
  //     var userIsLoggedIn = @json(auth()->check());
  //     var userRole = @json(auth()->user()->role ?? '');

  //     if (userIsLoggedIn && (userRole === 'instructor' || userRole === 'sub-instructor')) {
  //         function fetchNotification() {
  //             $.ajax({
  //                 url: '/ementor/get-notification',
  //                 method: 'GET',
  //                 success: function(data) {
  //                     $('.notification-item-number').text(data.count);
  //                     $('#notificationBody .list-group').html(data.data);
  //                 },
  //                 error: function(xhr, status, error) {
  //                     console.error('Error fetching notification count:', error);
  //                 }
  //             });
  //         }

  //         setInterval(fetchNotification, 5000);
  //     }
  // });

  $(document).ready(function() {
    if (typeof window.Echo !== 'undefined') {
      
        window.Echo.connector.options.auth = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        var userId = @json(auth()->id());

        
        window.Echo.channel('notification')
        .listen('NotificationSent', (e) => {
          $.ajax({
              url: '/ementor/get-notification',
              method: 'GET',
              success: function(data) {
                $('.notification-item-number').text(data.count);
                $('#notificationBody .list-group').html(data.data);
                
                // data.data.forEach(function(notification) {
                //     // Create notification item dynamically
                //     var notificationItem = `<li class="list-group-item bg-light">
                //         <div class="row">
                //             <div class="col">
                //                 <a href="${notification.url}" class="text-body text-decoration-none mark-as-read" data-notification-id="${notification.id}">
                //                     <div class="d-flex align-items-center">
                //                         <img src="${notification.avatar}" alt="Student Avatar" class="avatar-md rounded-circle" />
                //                         <div class="ms-3">
                //                             <strong>${notification.student_name}</strong> has submitted an <strong>${notification.exam_name}</strong> for the course <strong>${notification.course_name}</strong>.
                //                             <div class="fs-6 text-muted">
                //                                 <span>
                //                                     <span class="bi bi-clock text-success me-1"></span>
                //                                     ${notification.time_ago},
                //                                 </span>
                //                                 <span class="ms-1">${notification.time}</span>
                //                             </div>
                //                         </div>
                //                     </div>
                //                 </a>
                //             </div>
                //         </div>
                //     </li>`;

                //     // Append new notification to the list
                //     $('#notificationBody .list-group').prepend(notificationItem);
                // });
              },
              error: function(xhr, status, error) {
                  console.error('Error fetching notification count:', error);
              }
          });
        });

    }
});





  // $(document).ready(function() {
  //   var userIsLoggedIn = @json(auth()->check());
  //   var userRole = @json(auth()->user()->role ?? '');

  //   if (userIsLoggedIn && (userRole === 'instructor' || userRole === 'sub-instructor')) {
  //       function fetchNotification() {
  //           $.ajax({
  //               url: '/ementor/get-notification',
  //               method: 'GET',
  //               success: function(data) {
  //                   // Update notification count
  //                   $('.notification-item-number').text(data.count);

  //                   data.data.forEach(function(notification) {
  //                       // Create notification item dynamically
  //                       var notificationItem = `<li class="list-group-item bg-light">
  //                           <div class="row">
  //                               <div class="col">
  //                                   <a href="${notification.url}" class="text-body text-decoration-none mark-as-read" data-notification-id="${notification.id}">
  //                                       <div class="d-flex align-items-center">
  //                                           <img src="${notification.avatar}" alt="Student Avatar" class="avatar-md rounded-circle" />
  //                                           <div class="ms-3">
  //                                               <strong>${notification.student_name}</strong> has submitted an <strong>${notification.exam_name}</strong> for the course <strong>${notification.course_name}</strong>.
  //                                               <div class="fs-6 text-muted">
  //                                                   <span>
  //                                                       <span class="bi bi-clock text-success me-1"></span>
  //                                                       ${notification.time_ago},
  //                                                   </span>
  //                                                   <span class="ms-1">${notification.time}</span>
  //                                               </div>
  //                                           </div>
  //                                       </div>
  //                                   </a>
  //                               </div>
  //                           </div>
  //                       </li>`;

  //                       // Append new notification to the list
  //                       $('#notificationBody .list-group').prepend(notificationItem);
  //                   });
  //               },
  //               error: function(xhr, status, error) {
  //                   console.error('Error fetching notification count:', error);
  //               }
  //           });
  //       }

  //       var notificationInterval = setInterval(fetchNotification, 5000);

  //       // Optionally clear interval after a certain time or condition
  //       // clearInterval(notificationInterval); // Uncomment to stop after some time or condition
  //   }
  // });

</script>


    <style>

    .save_loader {
  /* background-color: blue; */
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: fixed;
  z-index: 999999;
  width: 100%;
  height: 100%;
  padding: 20%;
  border-radius: 10px;
  background: #ffffffb5;
  text-align: center;
}

.save_loader-text {
  font-size: 24px;
  color: #2b3990;
  margin-bottom: 20px;
  align-self: center;
  font-weight: bold;
}

.save_loader-bar {
  width: 50px;
  height: 50px;
  aspect-ratio: 1;
  border-radius: 50%;
  background:
          radial-gradient(farthest-side, #2b3990 94%, #0000) top/8px 8px no-repeat,
          conic-gradient(#0000 30%, #2b3990);
  -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
  animation: l13 1s infinite linear;
  margin-top: 10px;
  margin-left: 35px;
  margin: auto
}
@keyframes l13 {
    100% {
        transform: rotate(1turn);
    }
}
.document_loader_bar{
    width: 350px;  /* Width of the loader */
    height: 310px;  /* Height of the loader */
    aspect-ratio: 1; /* Maintain a square aspect ratio */
    border-radius: 50%; /* Makes the loader circular */
    background-image: url('../frontend/images/document-validation-low.gif'); /* Path to your image */
    background-size: contain; /* Ensure the image fits within the circle */
    background-repeat: no-repeat; /* Prevents repeating the image */
    background-position: center; /* Centers the image inside the circle */
    margin-top: 10px;
    margin-left: 35px;
    margin: auto;
    z-index: 1; /* Ensure the image is below the text */
}
.document_loader {
  /* background-color: blue; */
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: fixed;
  z-index: 999999;
  width: 100%;
  height: 100%;
  padding: 20%;
  border-radius: 10px;
  background: #ffffffb5;
  text-align: center;
}


.swal-button{
  background-color: #2b3990;
}
.swal-button-container{
  display: flex;
  justify-content: center;
}
.swal-button:hover{
  background-color: #2b3990 !important;
}
.swal-footer{
  display: flex;
  justify-content: center;
}
.swal-button--cancel{
  color: #000;
  background-color: #efefef;
}

.swal-button--cancel:hover{
  background-color: #efefef !important;
}
.swal-text{
  text-align: center;
}

@keyframes loader-bar-animation {
  0% {
    /* transform: translateX(-100%) rotate(270deg); */
    transform: translateX(-100%);
  }

  50% {
    /* transform: translateX(100%) rotate(-90deg); */
    transform: translateX(100%);
  }

  100% {
    /* transform: translateX(-100%) rotate(270deg); */
    transform: translateX(-100%);
  }
}



#customizeSettingsModal {
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
    }
    #customizeSettingsModal button:hover {
        background-color: #45a049; 
    }
    #customizeSettingsModal button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(72, 161, 100, 0.6); /* Button focus */
    }

    /* .autocomplete-results {
      position: absolute;
      z-index: 9999; 
      background: white;
      width: 100%;
      max-height: 300px;
      overflow-y: auto;
      border: 1px solid #ccc;
      box-shadow: 0px 2px 6px rgba(0,0,0,0.2);
    } */
.search-results-container {
        border: 1px solid #ddd;
        max-height: 300px;
        overflow-y: auto;
        border-radius: 5px;
        background-color: #fff;
        /* position: absolute; */
        z-index: 9999; 
    }

    .search-result-item {
        padding: 10px 15px;
        border-bottom: 1px solid #eee;
        transition: background 0.2s ease;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item a {
        color: #333;
        text-decoration: none;
        display: block;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
    }

    .no-results {
        padding: 10px 15px;
        color: #888;
        font-style: italic;
    } /*  Translate language */
/* #goog-gt-tt,.goog-te-banner-frame,.VIpgJd-ZVi9od-aZ2wEe-wOHMyf,.skiptranslate  {
    display: none !important;
}
.language-option.active {
    background-color: #007bff !important;
    color: white !important;
    font-weight: bold;
}
body {
    top: 0px !important;
    position: relative !important;
} */
        </style>

<body>
  <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WVZC796Q"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<div class="save_loader d-none">
  <div class="save_loader-text">Processing...</div>
  <div class="save_loader-bar"></div>
</div>
<div class="document_loader d-none">
  <div class="document_loader_bar"></div>
</div>
<!--======================================
        START HEADER AREA
    ======================================-->
  @include('frontend.layout.header')
<!--======================================
        END HEADER AREA
======================================-->
<main>
  @if (session('status') === 'logout')
        <script>
                swal({
                title: "Successfully Logged Out",
                text: '',
                icon: 'success',
            });
            </script>
  @endif
  <!-- popup modal -->
  <div id="customModal" class="custom-modal-swal" style="display: none;">
    <div class="modal-content-swal">
      <div id="modalIcon" class="modal-icon-swal"></div>
      <h3 id="modalTitle" class="modal-title-swal"></h3>
      <p id="modalMessage" class="modal-message-swal"></p>
      <button id="modalCancel" class="modal-close-btn cancel-btn" style="display: none;">Cancel</button>
      <button id="modalOk" class="modal-close-btn ok-btn" style="display: none;">OK</button>
    </div>
  </div>
  
  <!-- processing loader -->
  <div id="processingLoader" class="processing-loader" style="display: none;">
    <img src="{{asset('frontend/images/icons/Processing-Loader.gif')}}" alt="Processing...">
  </div>
 @yield('content')
 <!-- Cookie Consent Banner -->
 <div id="cookieConsentBanner" style="position: fixed; bottom: 0; width: 100%; background-color: #1a1a1a; color: #fff; padding: 20px 30px; text-align: center; z-index: 9999; border-radius: 12px 12px 0 0; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); display: none; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; transition: transform 0.3s ease-in-out;">
  <p style="margin: 0; font-size: 16px; line-height: 1.5; display: inline-block;">
      <strong>We use cookies</strong> to improve your experience on our site. By continuing to use this site, you accept our 
      <a href="/privacy-policy" target="_blank" style="color: #62c9f3; text-decoration: none;">Privacy Policy</a>.
  </p>
  <div style="margin-top: 10px; display: inline-block;">
    <button id="acceptCookies" style="margin-left: 15px; padding: 10px 20px; background-color: #4CAF50; border: none; color: white; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;">
      Accept All
    </button>
    <button id="rejectCookies" style="margin-left: 15px; padding: 10px 20px; background-color: #FF5733; border: none; color: white; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;">
      Reject All
    </button>
    <button id="customizeCookies" style="margin-left: 15px; padding: 10px 20px; background-color: #007BFF; border: none; color: white; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;">
      Customize Settings
    </button>
  </div>
</div>

<!-- Popup for Customize Settings -->
<div id="customizeSettingsModal" style="display: none; position: fixed; bottom: 20px; left: 20px; width: 80%; max-width: 500px; background: white; box-shadow: 0px 0px 10px rgba(0,0,0,0.2); padding: 20px; z-index: 10000; border-radius: 7px; overflow-y: auto;">
  <h3 style="margin-top: 0; font-size: 1.5em; font-weight: bold; color: #333; border-bottom: 1px solid gray; padding-bottom: 10px;">Customize Your Preferences </h3>

  <form id="customizeCookiesForm">
      <div class="mt-3" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1rem;">
          <div class="form-check form-switch d-flex flex-column  p-0" style="align-items: inherit">
            <div class="d-flex justify-content-between">
              
            <label class="form-check-label fw-semibold" for="flexSwitchCheckChecked"  style="color: #333">
              <i class="bi bi-lock-fill" style="font-size: 1.2em; color: #2b3990; margin-right: 10px;"></i>  Essential Cookies (Required)</label>

              {{-- <input class="form-check-input" type="checkbox" name="essentialCookies" checked disabled> --}}
              <p class="text-success fw-semibold mb-0 whitespace-nowrap">Always Active</p>
            </div>
            <p style="font-size: 0.9em; color: #666;" class="mb-0 mt-1">These cookies are essential for the website's basic functions, like secure log-ins and saving your consent preferences, without storing any personally identifiable data.
            </p>
            
          </div>
      </div>
      <div class="mt-3" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1rem;">
          <div class="form-check form-switch d-flex flex-column p-0" style="align-items: inherit">
            <div class="d-flex justify-content-between">
              <label class="form-check-label fw-semibold" for="flexSwitchCheckChecked" style="color: #333">
                <i class="bi bi-bar-chart-line-fill" style="font-size: 1.2em; color: #4CAF50; margin-right: 10px;"></i> Analytics Cookies</label>
              <input class="form-check-input" type="checkbox" name="analyticsCookies">
            </div>
            <p style="font-size: 0.9em; color: #666;" class="mb-0 mt-1">Allow us to collect data to improve our site through analytics.</p>
          </div>
      </div>
      <div class="mt-3" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1rem;">
          <div class="form-check form-switch d-flex flex-column p-0" style="align-items: inherit">
            <div class="d-flex justify-content-between">
              <label class="form-check-label fw-semibold" for="flexSwitchCheckChecked"  style="color: #333"><i class="bi bi-megaphone-fill" style="font-size: 1.2em; color: #FF5733; margin-right: 10px;"></i>Marketing Cookies</label>
              <input class="form-check-input" type="checkbox" name="marketingCookies">
            </div>
              <p style="font-size: 0.9em; color: #666;" class="mb-0 mt-1">Allow us to collect data for personalized advertising.</p>
          </div>
      </div>
      <div style="margin-top: 20px; text-align: right;">
          <button type="button" id="saveCookiePreferences" style="padding: 8px 15px; background-color: #2b3990; border: none; color: white; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease;">
              Save Preferences
          </button>
          <button type="button" id="closeCustomizeModal" style="padding: 8px 15px; background-color: #FF5733; border: none; color: white; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease;">
              Cancel
          </button>
      </div>
  </form>
</div>


<!-- Disable Overlay -->
<div id="cookieOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 9998; display: none;"></div>
</main>

<!-- ================================
         END FOOTER AREA
================================= -->
   {{-- @include('frontend.layout.footer') --}}
<!-- ================================
          END FOOTER AREA
================================= -->
 
<!-- Scroll top -->
<div class="btn-scroll-top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
        <path
            d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
    </svg>
</div>

@include('frontend.layout.script')
<script>

  // $(".select2").select2();
// rsp.setHeader("Access-Control-Allow-Methods", "GET,HEAD,POST,OPTIONS,PUT,DELETE,TRACE,CONNECT");
// rsp.setHeader("Access-Control-Allow-Headers", "cache-control,content-type,hash-referer,x-requested-with, x-xsrf-token");

// if ("OPTIONS".equals(req.getMethod())) {
//    rsp.setStatus(HttpServletResponse.SC_OK);
//    return;
// }

// $(document).ready(function() {
//         $(".heart-icon").click(function() {
//         $(this).toggleClass('bi-heart');
//         $(this).toggleClass('bi-heart-fill');
// });
// });

$(document).ready(function() {
    $(document).on('click', '.mark-as-read', function(event) {
        event.preventDefault(); // Stop immediate navigation

        var notificationId = $(this).data('notification-id');
        var linkUrl = $(this).attr('href'); 
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: '/ementor/mark-notification-read',
            method: 'POST',
            data: {
              id: notificationId,
            },
            headers: {
              "X-CSRF-TOKEN": csrfToken,
            },
            success: function() {
                window.location.href = linkUrl;
            },
            error: function(xhr) {
                window.location.href = linkUrl;
            }
        });
    });


    
    // Function to set a cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Expiry in days
        document.cookie = name + "=" + value + ";expires=" + date.toUTCString() + ";path=/";
    }

    // Function to get a cookie
    function getCookie(name) {
        const value = "; " + document.cookie;
        const parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }

    // Show cookie overlay and banner if not accepted or rejected
    if (!getCookie("cookieConsent")) {
        $("#cookieOverlay").fadeIn();
        $("#cookieConsentBanner").fadeIn();

        // Accept cookies
        $("#acceptCookies").on("click", function () {
            setCookie("cookieConsent", "accepted", 365); // Store consent for 1 year
            $("#cookieOverlay").fadeOut();
            $("#cookieConsentBanner").fadeOut();
        });

        // Reject cookies
        $("#rejectCookies").on("click", function () {
            setCookie("cookieConsent", "rejected", 365); // Store rejection for 1 year
            $("#cookieOverlay").fadeOut();
            $("#cookieConsentBanner").fadeOut();
        });

        // Open customize settings modal
        $("#customizeCookies").on("click", function () {
            $("#customizeSettingsModal").fadeIn();
        });

        // Save preferences from the customize settings modal
        $("#saveCookiePreferences").on("click", function () {
            const preferences = {
                essential: true,
                analytics: $("input[name='analyticsCookies']").is(":checked"),
                marketing: $("input[name='marketingCookies']").is(":checked"),
            };

            // Store preferences in a cookie
            setCookie("cookiePreferences", JSON.stringify(preferences), 365);
            setCookie("cookieConsent", "customized", 365); // Mark as customized

            $("#customizeSettingsModal").fadeOut();
            $("#cookieOverlay").fadeOut();
            $("#cookieConsentBanner").fadeOut();
        });

        // Close the modal
        $("#closeCustomizeModal").on("click", function () {
            $("#customizeSettingsModal").fadeOut();
        });
    }

  });

  document.addEventListener('wheel', function (event) {
      if (document.activeElement.type === "number") {
          event.preventDefault();
      }
  }, { passive: false });
    
  @if(session('optional_course_error'))
        swal({
            title: "Select Optional ECTS",
            text: "{{ session('optional_course_error') }}",
            icon: "warning",
            buttons: {
                select: {
                    text: "Select ECTS",
                    value: true,
                    className: "btn btn-primary",
                },
            },
            dangerMode: true,
        }).then((willSelect) => {
            if (willSelect) {
              const optionalMasterCourseId = "{{ session('optional_master_courseid') }}";
              if (!optionalMasterCourseId) {
                  window.location.href = "{{ route('student-my-learning') }}";
              }
            }
        });
    @endif
            
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


    

    // Check for the response from the backend and call selectOptionalCourse() if needed
    // @if(session('optionalCourseError'))
    // @endif

  </script>
  {{-- @if(Route::current()->getName() != 'checkout')

  <script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script><script id="zsiqscript" src="https://salesiq.zohopublic.com/widget?wc=siq4605044396440f1b620acf7e7aff45cb7c1758c52af8a5fac9b184144a95f114" defer></script>
@endif --}}
{{-- @if(Route::current()->getName() == 'english-test' || Route::current()->getName() == 'checkout') --}}
@if(Route::current()->getName() == 'receipt')
@else
<script>
  var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?67589';
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = url;
  var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#00e785",
      "ctaText":"Chat with us",
      "borderRadius":"25",
      "marginLeft": "0",
      "marginRight": "20",
      "marginBottom": "20",
      "ctaIconWATI":false,
      "position":"right"
  },
  "brandSetting":{
      "brandName":"E Ascencia",
      "brandSubTitle":"undefined",
      "brandImg":"https://www.eascencia.mt/frontend/images/brand/logo/logo.svg",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"",
      "backgroundColor":"#00e785",
      "ctaText":"Chat with us",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"35699389272"
  }
  };
  s.onload = function() {
      CreateWhatsappChatWidget(options);
  };
  var x = document.getElementsByTagName('script')[0];
  x.parentNode.insertBefore(s, x);


  
</script>
  {{-- <script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script><script id="zsiqscript" src="https://salesiq.zohopublic.com/widget?wc=siq4605044396440f1b620acf7e7aff45cb7c1758c52af8a5fac9b184144a95f114" defer></script> --}}
@endif

<script>
   $('.search-input').on('input', function () {
    const query = $(this).val().trim();
    const inputId = $(this).attr('id');
    let resultContainer;

    // Decide where to show results
    if (inputId === 'search-input-mobile') {
        resultContainer = $('#search-results-mobile');
    } else if (inputId === 'search-input-large') {
        resultContainer = $('#search-results-large');
    } else if (inputId === 'search-input-xl') {
        resultContainer = $('#search-results-xl');
    }

    if (query.length > 0) {
        $.ajax({
            url: '/search-suggestions',
            method: 'GET',
            data: { keyword: query },
            success: function (data) {
                resultContainer.empty();

                if (data.length > 0) {
                    data.forEach(course => {
                        let url = '';
                        const baseUrl = window.location.origin + "/";
                        if (course.category_id == '5') {
                            url = baseUrl + "dba-course-details/" + btoa(course.id);
                        } else if (course.category_id == '1') {
                            url = baseUrl + "course-details/" + btoa(course.id);
                        } else {
                            url = baseUrl + "master-course-details/" + btoa(course.id);
                        }

                        resultContainer.append(`
                            <div class="search-result-item">
                                <a href="${url}">
                                    <i class="bi bi-search me-2 text-muted"></i>
                                    ${course.course_title}
                                </a>
                            </div>
                        `);
                    });
                } else {
                    resultContainer.append('<div class="no-results">No courses found</div>');
                }
            }
        });
    } else {
        resultContainer.empty();
    }
});

  $(document).on('click',function(e){
    if(!$(e.target).closest('.headerSearch').length){
      $('.search-results-container').empty();
    }
  })
  $(".btn-remove-searchdata").on('click',function(e){
    $('#search-input-mobile').val('');
  });

  </script>

 </body>
</html>