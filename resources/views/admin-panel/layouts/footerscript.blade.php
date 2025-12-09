    <!-- build:js adminFiles/js/core.js')}} -->

    <script src="{{asset('adminFiles/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/js/menu.js')}}"></script>
        <!-- Vendors JS -->



    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('adminFiles/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/swiper/swiper.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/auto-focus.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/quill/quill.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/jquery-timepicker/jquery-timepicker.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/pickr/pickr.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@algolia/autocomplete-js.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>

		<script src="{{asset('adminFiles/ckeditor/ckeditor.js')}}"></script>
		<script src="{{asset('adminFiles/ckeditor/js/sample.js')}}"></script>

    <audio id="success-sound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_731e0b7b0f.mp3?filename=correct-2-46134.mp3" preload="auto"></audio>
        <audio id="error-sound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_7f6db52d14.mp3?filename=error-2-46134.mp3" preload="auto"></audio>
    


    <script src="{{asset('adminFiles/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('adminFiles/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')

    <script type="text/javascript" src="{{asset('js/toaster.js')}}"></script>
    <!-- BEGIN PAGE LEVEL JS-->
            @if(session()->has('success') )
            <script>toastr.success('{{ session()->get("success") }}')</script>


            @endif
            @if(session()->has('fail') || $errors->any() )

            <script>
            let failMessage = "{{ $errors->first() ?: session()->get('fail') }}" ;
            let failTitle = "Ops!"
            toastr.error(failMessage, failTitle);
            </script>


            @endif


  </body>
</html>






    <!-- Page JS -->
  </body>
</html>

