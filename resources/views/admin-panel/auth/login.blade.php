<!doctype html>

<html
  lang="ar"
  class="layout-wide customizer-hide"
  dir="rtl"
  data-skin="default"
  data-assets-path="https://samionc.com/adminFiles/"
  data-template="vertical-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ translate('Drivo') }}</title>

    <meta name="description" content="{{ translate('Drivo') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('adminFiles/vendor/fonts/iconify-icons.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css')}}  -->

    <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/node-waves/node-waves.css')}}" />

    <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/pickr/pickr-themes.css')}}" />

    <link rel="stylesheet" href="{{asset('adminFiles/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('adminFiles/css/demo.css')}}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/@form-validation/form-validation.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}" />

    <!-- Page -->
    <link rel="stylesheet" href="{{asset('adminFiles/vendor/css/pages/page-auth.css')}}" />

    <link rel="stylesheet" href="{{asset('css/toaster.css')}}">


    <!-- Helpers -->
    <script src="{{asset('adminFiles/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js')}} in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js')}}.  -->
    <script src="{{asset('adminFiles/vendor/js/template-customizer.js')}}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{asset('adminFiles/js/config.js')}}"></script>
  </head>

  <body >
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
          <!-- Login -->
          <div class="card login_form">
            <div class="card-body">
              <h4 class="mb-1">{{ translate('Drivo') }} 👋</h4>

              <form action="{{ route('admin.login') }}" class="mb-6 " method="post">
                    {{csrf_field()}}

                <div class="mb-6 form-control-validation">
                  <label for="email" class="form-label">{{ translate('E-Mail or userName') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{old('email')}}"
                    placeholder="{{ translate('Please enter yout E-Mail Or userName') }}"
                    autofocus />
                </div>
                <div class="mb-6 form-password-toggle form-control-validation">
                  <label class="form-label" for="password">{{ translate('Password') }}</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                        name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
                  </div>
                </div>
                <div class="my-8">
                  <div class="d-flex justify-content-between">
                    <div class="form-check mb-0 ms-2">
                      <input class="form-check-input" type="checkbox" name="rememberMe" value="1" id="remember-me" />
                      <label class="form-check-label"   for="remember-me"> {{ translate('remember me') }} </label>
                    </div>

                  </div>
                </div>
                <div class="mb-6">
                  <button class="btn btn-primary d-grid w-100" type="submit">{{ translate('Login') }}</button>
                </div>
              </form>





            </div>
          </div>
          <!-- /Login -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="{{asset('adminFiles/vendor/libs/jquery/jquery.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/@algolia/autocomplete-js.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/pickr/pickr.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/hammer/hammer.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/libs/i18n/i18n.js')}}"></script>

    <script src="{{asset('adminFiles/vendor/js/menu.js')}}"></script>
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


    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('adminFiles/vendor/libs/@form-validation/auto-focus.js')}}"></script>

    <!-- Main JS -->

    <script src="{{asset('adminFiles/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('adminFiles/js/pages-auth.js')}}"></script>
  </body>
</html>
