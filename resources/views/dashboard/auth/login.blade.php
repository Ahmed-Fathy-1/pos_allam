<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

    <title>AiTech - Sign In </title>
    {{-- @php $logo = \App\Models\Setting::findOrFail(1)->first();@endphp --}}
    {{-- <link rel="icon" type="image/png" class="" href="{{ asset('SuperAdmin/assets/images/'.$logo->image) }}" /> --}}

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('SuperAdmin/assets/css/app.css') }}" />

    <!-- Javascript Assets -->
    <script src="{{ asset('SuperAdmin/assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("dark-mode") === "dark" &&
            document.documentElement.classList.add("dark");
    </script>
</head>

<body class="is-header-blur is-sidebar-open">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
        <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh cloak flex grow bg-slate-50 dark:bg-navy-900">
        <!-- Main Content Wrapper -->
        <main class="grid w-full grow grid-cols-1 place-items-center">
            <div class="w-full max-w-[26rem] p-4 sm:px-5">
                {{-- @php
                    $setting = \App\Models\Setting::findOrFail(1);
                @endphp --}}
                <div class="text-center">
                    {{-- <img class="mx-auto" width="110" src="{{ asset('storage/uploads/images/settings/'.$setting->image) }}" alt="logo" /> --}}
                    <div class="mt-4">
                        <h2 class="text-xl font-semibold text-slate-600 dark:text-navy-100">
                            Welcome Back
                        </h2>
                        <p class="text-slate-400 dark:text-navy-300">
                            Please sign in to continue
                        </p>
                    </div>
                </div>
                <br>
                @if ($errors->any())
                <div class="alert flex space-x-2 rounded-lg border border-error px-4 py-4 text-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p>

                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </p>
                </div>
                @endif
                <br>

                <div class="card mt-5 rounded-lg p-5 lg:p-7">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label class="block">
                            <span>Email:</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Enter Username" name="email" type="text" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 transition-colors duration-200" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                            </span>
                        </label>

                        <label class="mt-4 block">
                            <span>Password:</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Enter Password" name="password" type="password" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 transition-colors duration-200" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                            </span>
                        </label>

                        <div class="mt-4 flex items-center justify-between space-x-2">
                            <label class="inline-flex items-center space-x-2">
                                <input
                                    class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox" />
                                <span class="line-clamp-1">Remember me</span>
                            </label>
                            <a href="#"
                                class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100">Forgot
                                Password?</a>
                        </div>
                        <button
                            class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Sign In
                        </button>

                    </form>
                </div>
        </main>
    </div>
</body>

</html>
