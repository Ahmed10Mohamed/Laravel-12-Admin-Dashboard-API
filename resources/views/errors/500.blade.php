<!doctype html>

<html lang="ar" dir="rtl"
  class="layout-wide customizer-hide"
  data-skin="default"
  data-assets-path="https://samionc.com/adminFiles/"
  data-template="vertical-menu-template"
  data-bs-theme="light">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>خطأ في الخادم</title>

  <meta name="description" content="" />

  <link rel="icon" type="image/x-icon" href="{{asset('adminFiles/img/favicon/favicon.ico')}}" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{asset('adminFiles/vendor/fonts/iconify-icons.css')}}" />

  <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/node-waves/node-waves.css')}}" />
  <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/pickr/pickr-themes.css')}}" />
  <link rel="stylesheet" href="{{asset('adminFiles/vendor/css/core.css')}}" />
  <link rel="stylesheet" href="{{asset('adminFiles/css/demo.css')}}" />
  <link rel="stylesheet" href="{{asset('adminFiles/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('adminFiles/vendor/css/pages/page-misc.css')}}" />

  <script src="{{asset('adminFiles/vendor/js/helpers.js')}}"></script>
  <script src="{{asset('adminFiles/vendor/js/template-customizer.js')}}"></script>
  <script src="{{asset('adminFiles/js/config.js')}}"></script>
</head>

<body>
  <!-- المحتوى -->

  <div class="container-xxl container-p-y">
    <div class="misc-wrapper text-center">
      <h1 class="mb-2 mx-2" style="line-height: 6rem; font-size: 6rem">500</h1>
      <h4 class="mb-2 mx-2">عذرًا، حدث خطأ!</h4>
      <p class="mb-6 mx-2">نواجه حالياً مشكلة في الخادم 😖</p>
      <p class="mb-4 mx-2">نعمل على حل المشكلة الآن.</p>
      <a @if(admin()) href="{{ route('Admin-Dashboard')}}" @else href="{{ url('/')}}" @endif  class="btn btn-primary mb-10">العودة إلى الرئيسية</a>
      <div class="mt-4">
        <img src="{{asset('adminFiles/img/illustrations/boy-with-laptop-dark.png')}}" alt="خطأ" width="225" class="img-fluid" />
      </div>
    </div>
  </div>

  <div class="container-fluid misc-bg-wrapper">
    <img src="{{asset('adminFiles/img/illustrations/bg-shape-image-light.png')}}" height="355" alt="خلفية" />
  </div>

  <!-- Core JS -->
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
  <script src="{{asset('adminFiles/js/main.js')}}"></script>

</body>
</html>
