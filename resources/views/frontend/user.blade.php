<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - XTIK Programming SMKN 2 Purwakarta</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary-blue: #0b5aa2;
            --accent-blue: #2575fc;
            --navy-dark: #07264e;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --transition-smooth: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #071e3d 0%, #0d3264 50%, #0b5aa2 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Background Glowing Blobs */
        .bg-glow-1 {
            position: fixed;
            top: -100px;
            left: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(37, 117, 252, 0.35), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(40px);
            z-index: 0;
        }

        .bg-glow-2 {
            position: fixed;
            bottom: -120px;
            right: -120px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(11, 90, 162, 0.45), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(50px);
            z-index: 0;
        }

        /* Centered Modern Card */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 42px 38px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.4);
            animation: fadeInCard 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Card Header */
        .card-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-badge {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            margin-bottom: 16px;
            box-shadow: 0 10px 25px rgba(11, 90, 162, 0.2);
            border: 3px solid #eaf3fd;
            transition: var(--transition-smooth);
        }

        .logo-badge:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .logo-badge img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .card-subtitle {
            font-size: 0.88rem;
            color: #64748b;
            line-height: 1.5;
        }

        /* Alerts */
        .alert-box {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.88rem;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            line-height: 1.45;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 1rem;
            pointer-events: none;
            transition: var(--transition-smooth);
        }

        .form-input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border: 1.5px solid #cbd5e1;
            border-radius: 14px;
            font-size: 0.94rem;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            font-family: inherit;
            transition: var(--transition-smooth);
        }

        .form-input:focus {
            background: #ffffff;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(11, 90, 162, 0.12);
        }

        .form-input:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--primary-blue);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1rem;
            cursor: pointer;
            padding: 4px;
            transition: var(--transition-smooth);
        }

        .toggle-password:hover {
            color: #334155;
        }

        /* Options Row */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
            font-size: 0.85rem;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary-blue);
            cursor: pointer;
        }

        .badge-secure {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            color: #10b981;
            font-weight: 600;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #0b5aa2 0%, #2575fc 100%);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(11, 90, 162, 0.35);
            transition: var(--transition-smooth);
            font-family: inherit;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(11, 90, 162, 0.45);
            background: linear-gradient(135deg, #094782 0%, #1e60d0 100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Card Footer */
        .card-footer {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .back-link:hover {
            color: var(--primary-blue);
            transform: translateX(-3px);
        }

        .copyright-text {
            display: block;
            margin-top: 6px;
            font-size: 0.78rem;
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 32px 22px;
                border-radius: 22px;
            }
            .card-title {
                font-size: 1.35rem;
            }
            .logo-badge {
                width: 68px;
                height: 68px;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 14px;
            }
            .login-card {
                padding: 24px 16px;
                border-radius: 18px;
            }
            .card-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="login-card">

        <!-- HEADER -->
        <div class="card-header">
            <div class="logo-badge">
                <img src="{{ asset('image/Logobaru.png') }}" alt="Logo XTIK SMKN 2 Purwakarta">
            </div>
            <h1 class="card-title">Masuk Administrator</h1>
            <p class="card-subtitle">Sistem Informasi Ekstrakurikuler XTIK SMKN 2 Purwakarta</p>
        </div>

        <!-- NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-circle-check" style="font-size:1.1rem; flex-shrink:0;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- NOTIFIKASI ERROR -->
        @if ($errors->any())
            <div class="alert-box alert-error">
                <i class="fa-solid fa-circle-exclamation" style="font-size:1.1rem; flex-shrink:0;"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ route('login.post') }}" method="POST" autocomplete="on">
            @csrf

            <!-- USERNAME -->
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <div class="input-wrapper">
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-input"
                           placeholder="Masukkan username"
                           value="{{ old('username') }}"
                           required
                           autofocus>
                    <i class="fa-regular fa-user input-icon"></i>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-input"
                           placeholder="••••••••"
                           required>
                    <i class="fa-solid fa-lock input-icon"></i>
                    <button type="button" class="toggle-password" id="btnTogglePassword" aria-label="Lihat Password">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <!-- OPTIONS -->
            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat saya</span>
                </label>
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" class="btn-submit">
                <span>Masuk Sekarang</span>
                <i class="fa-solid fa-right-to-bracket"></i>
            </button>
        </form>

        <!-- FOOTER & KEMBALI KE BERANDA -->
        <div class="card-footer">
            <a href="{{ route('beranda') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Halaman Utama</span>
            </a>
            <span class="copyright-text">
                &copy; {{ date('Y') }} XTIK Programming SMKN 2 Purwakarta. Seluruh hak cipta dilindungi.
            </span>
        </div>

    </div>

    <!-- Toggle Password Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('btnTogglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (toggleBtn && passwordInput && eyeIcon) {
                toggleBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    eyeIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
                });
            }
        });
    </script>
</body>
</html>