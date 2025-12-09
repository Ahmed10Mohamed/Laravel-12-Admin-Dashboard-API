    @extends('admin-panel.layouts.app')

    @section('content')
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <!-- العمود الرئيسي -->
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">

                            <!-- العمود الأيسر -->
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        {{ translate('wel come') }} {{ admin()->name }}! 🎉
                                    </h5>
                                    <p class="mb-4">
                                        {{ translate('We wish you a happy day managing the control panel.') }}
                                    </p>
                                </div>
                            </div>
                            <!-- نهاية العمود الأيسر -->

                            <!-- العمود الأيمن -->
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('adminFiles/img/illustrations/boy-with-rocket-light.png') }}"
                                        height="140" alt="View Badge User" data-app-dark-img="illustrations/welcome.png"
                                        data-app-light-img="illustrations/welcome.png" />
                                </div>
                            </div>
                            <!-- نهاية العمود الأيمن -->

                        </div>
                    </div>
                </div>
            </div>



            <!-- end -->


        </div>

        {{-- start info --}}
        <!-- user info cart -->
        <div class="card mb-6">

            <h4 class="card-header page_title">{{ translate('informations about me') }}</h4>

            <!-- Bootstrap Table with Header - Dark -->
            <div class="card-body">
                <div class="row justify-content-center">
                    <!-- start  -->
                    <div class="col-12 col-md-6">
                        <table class="table table-hover">
                            <tbody class="table-border-bottom-0" id="customerTable">
                                <tr>
                                    <th>{{ translate('full name') }}</th>
                                    <td>{{ admin()->fullName }}</td>
                                </tr>
                                <tr>
                                    <th>{{ translate('user name') }}</th>
                                    <td>{{ admin()->userName }}</td>
                                </tr>
                                <tr>
                                    <th>{{ translate('phone number') }}</th>
                                    <td>{{ admin()->phone }}</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>




                    <!-- end static -->


                    <!-- end -->
                </div>



            </div>

            {{-- end --}}

            <!-- / Content -->
        @endsection

        @section('script')
            <!-- Page JS -->
            <script src="{{ asset('adminFiles/js/app-ecommerce-dashboard.js') }}"></script>
        @endsection
        <!-- DataTable with Buttons -->
        \
