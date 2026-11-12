<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'XTIK PROGRAMMING - SMKN 2 Purwakarta')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/Logobaru.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Global App & Master Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/organigram.css') }}">

    @yield('styles')
</head>
<body>

    <div class="site-wrapper">

        <!-- ================= FLOATING PILL NAVBAR ================= -->
        @include('layouts.frontend_nav')

        <!-- MAIN PAGE CONTENT -->
        <main class="page-body">
            @yield('content')
        </main>

        <!-- ================= MODERN FOOTER ================= -->
        @include('layouts.frontend_footer')

    </div>

    @yield('scripts')

</body>
</html>