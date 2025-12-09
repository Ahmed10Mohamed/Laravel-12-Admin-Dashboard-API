@extends('admin-panel.layouts.app')
@section('content')





      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-align-top">
              @include('admin-panel.pages.auth.profile.include.header',['page'=>'profile'])

              </div>
              <div class="card mb-6">
                <!-- Account -->
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-6">
                    <img
                      src="{{asset(admin()->image)}}"
                      alt="user-avatar"
                      class="d-block w-px-100 h-px-100 rounded"
                      id="uploadedAvatar" />
                      <form  action="{{route('Profile.Update')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">رفع الصورة</span>
                        <i class="ti tabler-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload"
                          name="image"
                          class="account-file-input"
                          hidden
                          accept="image/png, image/jpeg" />
                      </label>
                      

                      <div>يُسمح بصيغ JPG وGIF وPNG. الحد الأقصى للحجم 800 كيلوبايت</div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                      <div class="mb-4 col-md-6">
                        <label for="fullName" class="form-label">اسم المستخدم</label>
                        <input
                          class="form-control"
                          type="text"
                          id="userName"
                          name="userName"
                            value="{{admin()->userName}}"
                          autofocus />
                      </div>
                      <div class="mb-4 col-md-6">
                        <label for="fullName" class="form-label">الاسم الكامل</label>
                        <input
                          class="form-control"
                          type="text"
                          id="fullName"
                          name="fullName"
                            value="{{admin()->fullName}}"
                          autofocus />
                      </div>
                    
                      <div class="mb-4 col-md-6">
                        <label for="email" class="form-label">البريد الالكترونى</label>
                        <input
                          class="form-control"
                          type="text"
                          id="email"
                          name="email"
                          value="{{ admin()->email }}"
                          placeholder="john.doe@example.com" />
                      </div>

                      <div class="mb-4 col-md-6">
                        <label class="form-label" for="phoneNumber">رقم الهاتف</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            id="phoneNumber"
                            name="phone"
                            value="{{ admin()->phone }}"
                            class="form-control"
                            placeholder="202 555 0111" />
                        </div>
                      </div>






                    </div>
                    <div class="mt-2">
                      <button type="submit" class="btn btn-primary me-3">حفظ</button>
                      <button type="reset" class="btn btn-label-secondary">الغاء</button>
                    </div>
                  </form>
                </div>
                <!-- /Account -->
              </div>

                  <form id="formAccountDeactivation" onsubmit="return false">


                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->



          @endsection

          @section('script')
 <!-- Page JS -->
 <script src="{{asset('adminFiles/js/pages-account-settings-account.js')}}"></script>

@endsection
