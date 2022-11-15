<!DOCTYPE html>
<html>
    <head>
        <!----base href="/"-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
        <title>Kloutfood</title>
        <!---stylesheet-->

        <!-- App -->
        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

         <!-- Vendor -->
         <link href="{{ asset(mix('css/vendor.css')) }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <!---stylesheet end-->


        <!---scripts-->
        <!-- Bootstrap -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>

        <!-- Vendor -->
        <script src="{{ asset(mix('js/vendor.js')) }}"></script>

        <!-- App -->
        <script src="{{ asset(mix('js/app.js')) }}"></script>


        <!---scripts end-->

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body style="max-height: 100vh;">
        @yield('content')

    </body>
    <footer>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-first">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Kloutfood Copyright © 2020. Todos los derechos reservados.
            </div>
            <!-- Copyright -->
        </div>
    </footer>
</html>

