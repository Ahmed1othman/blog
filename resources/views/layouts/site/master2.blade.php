<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('assets/site/assets/favicon.ico')}}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{URL::asset('assets/site/css/styles.css')}}" rel="stylesheet" />
</head>
<body>


                            @yield('content')
                            @include('layouts.site.footer')
                            @include('layouts.site.footer-scripts')
        <!-- Page level plugins -->
    </body>
</html>
