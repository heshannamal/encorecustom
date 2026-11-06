<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Encore Custome</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <script src="https://kit.fontawesome.com/4e5c8d5a83.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <!--Datepicker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    {{-- PDf Plugins --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">

    <!-- Bootstrap JS (Optional, if you need interactive components) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap JS (jQuery and Popper.js required for Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (required by Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Popper.js (required by Bootstrap JS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .body_class {
            margin: unset;
            background-color: #ffffff;
        }

        body {
            /* font-family: "SF Pro Text", "Myriad Set Pro", "SF Pro Icons", "Apple Legacy Chevron", "Helvetica Neue", "Helvetica", "Arial", sans-serif; */
            font-family: 'Mollen Personal Use', cursive !important;
        }

        @font-face {
            font-family: 'Mollen1';
            src: url('{{ ec_asset("fonts/Mollen/ebrima.ttf") }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: "Mollen Personal Use";
            src: url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.eot");
            src: url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.eot?#iefix")format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.woff2")format("woff2"),
                url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.woff")format("woff"),
                url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.ttf")format("truetype"),
                url("https://db.onlinewebfonts.com/t/3a0df172742dbc53a84f447466161fab.svg#Mollen Personal Use")format("svg");
        }

        /* Reusable class */
        .font-mollen-banner {
            font-family: 'Mollen Personal Use', cursive !important;
        }

        .ml-auto {
            margin-left: auto;
            /* Push the element to the right */
        }

        .content-div {
            position: relative;
            /* top: -83px; */
            /* height: 600px; */
            height: 100%;
        }

        .component {
            color: var(--bs-gray-800);
            background-color: var(--bs-gray-100);
            border: 1px solid var(--bs-gray-200);
            border-radius: .25rem;
        }

        .component-header {
            color: var(--bs-purple);
        }

        .btn-success {
            background-color: #47D6B6;
            border-color: #47D6B6;
        }

        .btn-success:hover {
            background-color: #40c1a4;
            border-color: #40c1a4;
        }

        .btn-success:focus {
            background-color: #40c1a4;
            border-color: #40c1a4;
        }

        .btn-success:disabled {
            color: #fff;
            border-color: #787878;
            background-color: #787878;
        }
    </style>
</head>

<body class="body_class" style=" background-size: cover;">

    @include('includes.encore_loading')

    <div id="wrapper">


        {{-- @include('layouts.navbar.sidebar') --}}

        {{-- @include('layouts.navbar.topnavbar') --}}

        {{-- <div class="content-div">
            @yield('content')
        </div> --}}

        <div>
            @include('layouts.customer_end_layouts.navbar.topnavbar')
        </div>
        <div>
            @include('layouts.customer_end_layouts.navbar.bottomnavbar')
        </div>

    </div>

    <script src="{{ asset('assets/js/customer_end/pace.min.js') }}"></script>

</body>

@if (session('success'))
    <script type="text/javascript">
        toastr.success('{{ session('success') }}', 'Success!');
    </script>
@endif

@if (session('error'))
    <script type="text/javascript">
        toastr.error('{{ session('error') }}', 'Error!');
    </script>
@endif

@if (session('warning'))
    <script type="text/javascript">
        toastr.warning('{{ session('warning') }}', 'Warning!');
    </script>
@endif

@if (session('info'))
    <script type="text/javascript">
        toastr.info('{{ session('info') }}', 'Info!');
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            toastr.error("{{ $error }}");
        </script>
    @endforeach
@endif

</html>