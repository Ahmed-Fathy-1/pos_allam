
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Butcher</title>
    @include('Admin.layouts.head')
</head>
<body class="error-page">
<div id="global-loader" >
    <div class="whirly-loader"> </div>
</div>
<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="error-box">
        <h1>500</h1>
        <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Server Errors!</h3>
        <p class="h4 font-weight-normal">@section('message', __('Server Error')).</p>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Back to Home</a>
    </div>
</div>

<!-- jQuery -->
@include('Admin.layouts.footer-script')

</body>
</html>
