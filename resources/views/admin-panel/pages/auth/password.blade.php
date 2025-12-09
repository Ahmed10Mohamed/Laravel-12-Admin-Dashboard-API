@extends('admin-panel.layouts.app')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-align-top">
              @include('admin-panel.pages.auth.profile.include.header',['page'=>'password'])

              </div>

                  <!-- Change Password -->
                  <div class="card mb-6">
                    <h5 class="card-header">تغير كلمة المرور</h5>
                    <div class="card-body pt-1">
                    <form method="POST" action="{{route('Profile.UpdatePassword')}}">
                            {{csrf_field()}}
                        <div class="row">
                          <div class="mb-6 col-md-6 form-password-toggle">
                            <label class="form-label" for="current_password">كلمة المرور الحالية</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                name="current_password"
                                id="current_password"
                                value="{{ old('current_password') }}"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-6 col-md-6 form-password-toggle">
                            <label class="form-label" for="password">كلمة المرور الجديدة</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                id="password"
                                name="password"
                                value="{{ old('password') }}"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                          </div>

                          <div class="mb-6 col-md-6 form-password-toggle">
                            <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                          </div>
                        </div>
                        <h6 class="text-body">المتطلبات:</h6>
                        <ul class="ps-4 mb-0">
                          <li class="mb-4">الحد الأدنى 8 أحرف - كلما زاد العدد كان ذلك أفضل </li>
                          <li class="mb-4">حرف واحد على الأقل من الأحرف الكبيرة</li>
                          <li>يجب أن يحتوى على حرف واحد على الأقل من الأحرف الخاصة</li>
                        </ul>
                        <div class="mt-6">
                          <button type="submit" class="btn btn-primary me-3">حفظ</button>
                          <button type="reset" class="btn btn-label-secondary">الغاء</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!--/ Change Password -->


              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->




@endsection
@section('script')
 <!-- Page JS -->
 <script src="{{asset('adminFiles/js/pages-account-settings-security.js')}}"></script>

@endsection
