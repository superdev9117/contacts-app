<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Contacts App - @yield('title')</title>
        <link rel="icon" href="{{ url('img/icon.png') }}">

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- materialize Core CSS -->
        <link rel="stylesheet" href="{{ url('css/materialize.css') }}">


        @yield('stylesheets')
        <!-- Custom CSS -->

    </head>

    <body>

        @yield('header')

        <div class="container">
            @yield('content')
        </div>

        <!-- Scripts -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
        <!-- custom scripts -->
        @yield('scripts')

    </body>

</html>