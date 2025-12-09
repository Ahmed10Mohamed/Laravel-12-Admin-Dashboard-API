


    <!-- Global js mandatory -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script><script src="../assets/vendor/cookie/jquery.cookie.js"></script>
    <!-- Global js ends -->

    <!-- Vendor or 3rd party js -->

    <!-- date range picker -->
    <script src="../assets/vendor/daterangepicker-master/moment.min.js"></script>
    <script src="../assets/vendor/daterangepicker-master/daterangepicker.js"></script>
    <!-- Vendor or 3rd party js ends -->

    <!-- Customized template js mandatory -->
    <script src="../assets/js/main.js"></script>
    <!-- Customized template js ends -->

    <!-- theme picker -->
    <script src="../assets/js/style-picker.js"></script>
    <!-- theme picker ends -->
    <script type="text/javascript" src="{{asset('js/toaster.js')}}"></script>
    <!-- BEGIN PAGE LEVEL JS-->
            @if(session()->has('success') )
            <script>toastr.success('{{ session()->get("success") }}')</script>


            @endif
            @if(session()->has('fail') || $errors->any() )

            <script>
            let failMessage = "{{ $errors->first() ?: session()->get('fail') }}" ;
            let failTitle = "Opps!"
            toastr.error(failMessage, failTitle);
            </script>


            @endif


    <!-- Customized page level js -->
    <script>
        'use strict'
        $(document).ready(function() {

        });

    </script>
    <!-- Customized page level js ends -->
</body>

<!-- Body ends -->

</html>
