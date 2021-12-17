<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Store (Seller Dashboard)</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/portal.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datatables.min.css')}}">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>

<body class="app">
<header class="app-header fixed-top">
    <x-seller-master-nav></x-seller-master-nav><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href="{{route('index')}}"><span class="logo-text">E-Store</span></a>

            </div><!--//app-branding-->

            <x-seller-master-sidebar></x-seller-master-sidebar><!--//app-nav-->

        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->


    @yield('objects')



<!-- Javascript -->
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.datatables.min.js')}}"></script>
<!-- Charts JS -->
<script src="{{asset('assets/plugins/chart.js/chart.min.js')}}"></script>
{{--<script src="{{asset('assets/js/index-charts.js')}}"></script>--}}

<!-- Page Specific JS -->
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.app-utilities').click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url:'/markAsRead',
                success: function() {
                    $('.icon-badge').html('0');
                }
            })
        });
    });
</script>
@yield('scripts')

</body>
</html>

