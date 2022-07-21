<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }} - Akses Ditolak.!</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset/sb-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/sb-admin') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }

        .footer {
            background-color: #f5f5f5;
        }
    </style>

</head>


<body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Akses Ditolak.!</h1>
            <p class="lead">{{ Auth::user()->nama }} Anda tidak memiliki akses untuk halaman ini.!</p>
            @if (Auth::user()->role == 'null')
            <form action="/logout" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary rounded-0">Logout</button>
                </form>
            @else
            <a href="{{ url('/dashboard') }}" class="btn btn-primary rounded-0" role="button" aria-pressed="true">Dashboard</a>
            @endif
        </div>
    </main>

    <script src="{{ asset('asset/sb-admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset/sb-admin') }}/js/sb-admin-2.min.js"></script>


</body>

</html>
