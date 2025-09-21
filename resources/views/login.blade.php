<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <title>Login | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="Sign in to continue to {{ config('app.name') }}" name="description" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --brand:#2d6cdf; --brand-600:#1f56c1; --radius:14px;
            --card-bg:rgba(255,255,255,.88); --shadow:0 18px 44px rgba(0,0,0,.12);
        }
        @media (prefers-color-scheme: dark){ :root{ --card-bg:rgba(17,24,39,.78); } }

        body{min-height:100svh; display:grid; place-items:center; margin:0;
            background: radial-gradient(900px 600px at 10% -10%, rgba(45,108,223,.18), transparent 60%),
            radial-gradient(900px 600px at 90% -10%, rgba(109,213,237,.22), transparent 60%),
            linear-gradient(160deg,#eef2ff 0%,#f8fafc 60%,#f8fafc 100%);
        }
        @media (prefers-color-scheme: dark){ body{ background:#0b1220; }
            .brand-sub{ color:rgba(255,255,255,.7)!important; }
        }

        .auth-card{ width:min(480px, 92vw); background:var(--card-bg); backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px); border:1px solid rgba(255,255,255,.3); border-radius:var(--radius);
            box-shadow:var(--shadow); overflow:hidden; }

        .auth-header{ background:linear-gradient(120deg, var(--brand) 0%, var(--brand-600) 70%, #203b88 100%); color:#fff; }

        .logo img{ height:48px; filter:drop-shadow(0 4px 10px rgba(0,0,0,.2)); }

        .form-control{ border-radius:12px; padding:10px 14px; }
        .form-control:focus{ border-color:var(--brand); box-shadow:0 0 0 .2rem rgba(45,108,223,.15); }

        .btn-primary{
            --bs-btn-bg:var(--brand); --bs-btn-border-color:var(--brand);
            --bs-btn-hover-bg:var(--brand-600); --bs-btn-hover-border-color:var(--brand-600);
            border-radius:12px; padding:.65rem .95rem;
        }

        .brand-sub{ color:#6c757d; }
        .divider{ display:grid; grid-template-columns:1fr auto 1fr; gap:.75rem; align-items:center; margin:1rem 0; color:#6c757d; }
        .divider::before,.divider::after{ content:""; height:1px; background:rgba(0,0,0,.12); }

        @media (prefers-reduced-motion: reduce){ *{ transition:none!important; animation:none!important; } }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="auth-header text-center p-3">
        <a href="{{ route('home') }}" class="logo d-inline-flex align-items-center gap-2 text-decoration-none">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo" class="auth-logo" />
            <span class="fw-semibold text-white">{{ config('app.name') }}</span>
        </a>
        <div class="mt-2">
            <h5 class="mb-0 fw-semibold">Welcome</h5>
            <small class="text-white-50">Sign in to continue to {{ config('app.name') }}.</small>
        </div>
    </div>

    <div class="p-3 p-md-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="post" id="loginForm" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Show password"><i class="mdi mdi-eye-outline" aria-hidden="true"></i></button>
                    <div class="invalid-feedback">Password is required.</div>
                </div>
            </div>
{{--            <div class="d-flex align-items-center justify-content-between mt-2">--}}
{{--                <div class="form-check">--}}
{{--                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember" />--}}
{{--                    <label class="form-check-label" for="remember">Remember me</label>--}}
{{--                </div>--}}
{{--                <!-- <a href="{{ route('password.request') }}" class="small">Forgot password?</a> -->--}}
{{--            </div>--}}
            <div class="d-grid mt-3">
                <button class="btn btn-primary d-inline-flex align-items-center justify-content-center" type="submit" id="submitBtn">
                    <span class="btn-text">Log In</span>
                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
            <div class="divider small text-center"><span class="small">or</span></div>
            <p class="text-center small brand-sub mb-0">Need an account? Contact the administrator.</p>
        </form>
    </div>
</div>

<script>
    (function(){
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = submitBtn.querySelector('.spinner-border');
        const btnText = submitBtn.querySelector('.btn-text');
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        form.addEventListener('submit', function (e) {
            if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
            else { spinner.classList.remove('d-none'); btnText.textContent = 'Signing in…'; submitBtn.setAttribute('disabled','disabled'); }
            form.classList.add('was-validated');
        });

        toggleBtn.addEventListener('click', function(){
            const isPw = passwordInput.type === 'password';
            passwordInput.type = isPw ? 'text' : 'password';
            this.innerHTML = isPw ? '<i class="mdi mdi-eye-off-outline" aria-hidden="true"></i>' : '<i class="mdi mdi-eye-outline" aria-hidden="true"></i>';
            this.setAttribute('aria-label', isPw ? 'Hide password' : 'Show password');
        });
    })();
</script>
</body>
</html>
