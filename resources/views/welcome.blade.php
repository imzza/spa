<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Spa Kit</title>
    {{-- <link rel="shortcut icon" href="./resources/assets/assets/img/lumberjaxe-logo.png" /> --}}
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        #preloader{
            position: fixed;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            /*background: #6f9fe6;*/
            background: #fff;
        }
        .loaderImg {
            position: fixed;
            z-index: 999;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
    </style>
    <script>
    window.onload=function () {
        document.querySelector('#preloader').remove()
    }
    </script>
</head>

<body>
<div id="preloader">
    <img class="loaderImg" src="{{ url('images/loader.gif') }}" alt="">
</div>
<div id="app"></div>
{{-- <script type="text/javascript" src="{{ asset(mix('public/js/manifest.js')) }}"></script>
<script type="text/javascript" src="{{ asset(mix('public/js/vendor.js')) }}"></script> --}}
<script type="text/javascript" src="{{ asset(mix('public/js/main.js')) }}"></script>
</body>

</html>
