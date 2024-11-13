
<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ar', 'he', 'fa']) ? 'rtl' : 'ltr' }}">
  <head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>@yield('title')</title>

      @php
          $setting = \App\Models\Setting::findOrFail(1);
      @endphp
      <link rel="icon" type="image/png" class="h-11 w-11" src="{{ asset('storage/uploads/images/settings/'.$setting->image) }}" />

    {{-- <link rel="stylesheet" href="{{ asset(in_array(app()->getLocale(), ['ar']) ? 'assets/css/app-ar.css' : 'assets/css/app.css') }}">
    <script src="{{ asset(in_array(app()->getLocale(), ['ar']) ? 'assets/js/app-ar.js' : 'assets/js/app.js') }}" defer></script> --}}

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('SuperAdmin/assets/css/app.css') }}" />
    <script src="{{ asset('SuperAdmin/assets/js/app.js') }}" defer></script>

    @stack('style')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <script>
      /**
       * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
       */
      localStorage.getItem("dark-mode") === "dark" &&
        document.documentElement.classList.add("dark");
    </script>
  </head>

  <body class="is-header-blur">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div  id="root"  class="min-h-100vh cloak flex grow bg-slate-50 dark:bg-navy-900" >
      <!-- Sidebar -->
      @include('dashboard.layouts.sidebar')

      <!-- App Header Wrapper-->
      @include('dashboard.layouts.header')

      <!-- Mobile Searchbar -->
      @include('dashboard.layouts.mobile-searchbar')

      <!-- Right Sidebar -->
      {{-- @include('dashboard.layouts.right-sidebar') --}}

      <!-- Main Content Wrapper -->
       @yield('main')
  <!-- Footer Script -->

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                crossorigin="anonymous"></script>
 @include('dashboard.layouts.footer-script')
      @stack('scripts')


    </div>
  </body>
</html>

