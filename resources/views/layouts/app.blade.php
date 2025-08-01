<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>


    <meta charset="utf-8" />
    <title>Dashboard | Approx - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">



    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

@include('layouts.topbar')
@include('layouts.leftbar')
<div class="page-wrapper">
    <div class="page-content">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>

<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
<script src="{{asset('assets/js/pages/index.init.js')}}"></script>
<script src="{{asset('assets/js/DynamicSelect.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

</body>
</html>
