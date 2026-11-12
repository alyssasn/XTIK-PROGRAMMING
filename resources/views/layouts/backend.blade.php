<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - XTIK Programming')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/Logobaru.png') }}">

    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Global App & Backend CSS -->
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard.css') }}">

    @yield('styles')
</head>
<body>

    <div class="admin-container">

        <!-- ====== HEADER ====== -->
        @include('layouts.backend_header')

        <!-- ================= SIDEBAR ================= -->
        @include('layouts.backend_sidebar')

        <!-- ================= MAIN CONTENT ================= -->
        <div class="admin-main-wrapper">
            <main class="dashboard-content">
                @include('partials.flash')

                @yield('content')
            </main>

            <!-- ================= STABLE FOOTER ================= -->
            @include('layouts.backend_footer')
        </div>

    </div>

    @yield('scripts')

    <!-- Responsive Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const backdrop = document.querySelector('.sidebar-backdrop');
            
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (window.innerWidth <= 992) {
                        document.body.classList.toggle('sidebar-mobile-open');
                    } else {
                        document.body.classList.toggle('sidebar-collapsed');
                    }
                });
            }

            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    document.body.classList.remove('sidebar-mobile-open');
                });
            }

            // Close sidebar when clicking links on mobile
            document.querySelectorAll('.sidebar-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 992) {
                        document.body.classList.remove('sidebar-mobile-open');
                    }
                });
            });
        });
    </script>
</body>
</html>