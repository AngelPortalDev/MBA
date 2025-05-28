
@include('admin.layouts.header')
<main id="page-content">
  <div class="header">
    <div class="save_loader d-none">
    <div class="save_loader-text">Processing...</div>
    <div class="save_loader-bar"></div>
  </div>
  
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

        <!-- top Menubar -->
    @include('admin.layouts.top-menubar')
    </div>

    <!--======================================
            END HEADER AREA
    ======================================-->

    @yield('content')
</main>

<!-- ================================
        END FOOTER AREA
================================= -->
@include('admin.layouts.footer')
