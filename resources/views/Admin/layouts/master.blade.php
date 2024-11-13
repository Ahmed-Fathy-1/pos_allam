<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Test Description Content  Meta Butcher ">
        <meta name="keywords" content="Test Keyword Content  Meta Butcher">
        <meta name="author" content="AiTech">
        <meta name="robots" content="noindex, nofollow">
            @include('Admin.layouts.head')
    </head>
    <body class="mini-sidebar">
        <div id="global-loader" >
            <div class="whirly-loader"> </div>
        </div>
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Header -->
                @include('Admin.layouts.main-header')
            <!-- Header -->
            <!-- Sidebar -->
                @include('Admin.layouts.sidebar')
            <!-- /Sidebar -->
            <div class="page-wrapper" @if(auth()->user()->hasRole('delivery')) style="margin: 0 !important;" @endif>
               @yield('content')
            </div>
        </div>
        <!-- /Main Wrapper -->
        @include('Admin.layouts.footer-script')
    </body>
</html>
