<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{websiteTitle('Login')}}</title>
    <meta name="description" content="{!!general()->meta_description!!}" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="canonical" href="{{route('login')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        :root {
            --primary: #2e3192;
            --primary-dark: #24277a;
            --primary-light: #5b5fd6;
            --primary-50: #eeeffa;
            --navy: #14163f;
            --text: #1e2140;
            --muted: #6b7092;
            --border: #dcdfec;
            --danger: #e11d48;
            --success: #16a34a;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
            color: var(--text);
            background: #fff;
            -webkit-font-smoothing: antialiased;
        }
        a { color: var(--primary); text-decoration: none; }
        a:hover { color: var(--primary-light); }

        .auth { display: flex; min-height: 100vh; }

        /* ----- Brand panel ----- */
        .auth-brand {
            position: relative;
            overflow: hidden;
            flex: 0 0 46%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 56px;
            color: #fff;
            background: linear-gradient(140deg, var(--navy) 0%, var(--primary) 62%, var(--primary-light) 100%);
        }
        .auth-brand:before,
        .auth-brand:after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .12);
        }
        .auth-brand:before { width: 520px; height: 520px; right: -220px; top: -160px; background: rgba(255, 255, 255, .04); }
        .auth-brand:after { width: 360px; height: 360px; left: -140px; bottom: -150px; }
        .auth-brand > * { position: relative; z-index: 1; }
        .auth-brand .brand-logo img { width: 220px; max-width: 100%; height: auto; display: block; }
        .auth-brand h1 { font-size: 36px; line-height: 1.2; font-weight: 700; letter-spacing: -.02em; margin-bottom: 16px; }
        .auth-brand h1 span { color: #b9bbff; }
        .auth-brand p.lead { font-size: 16px; line-height: 1.7; color: rgba(255, 255, 255, .75); max-width: 440px; }
        .auth-features { list-style: none; margin-top: 32px; display: grid; gap: 14px; }
        .auth-features li { display: flex; align-items: center; gap: 12px; font-size: 15px; color: rgba(255, 255, 255, .9); }
        .auth-features i {
            flex: 0 0 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255, 255, 255, .12); font-size: 14px;
        }
        .auth-brand .brand-foot { font-size: 13px; color: rgba(255, 255, 255, .55); }

        /* ----- Form panel ----- */
        .auth-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 32px 48px;
            background: #f7f8fc;
        }
        .auth-top { display: flex; justify-content: space-between; align-items: center; }
        .auth-top .mobile-logo { display: none; }
        .auth-top .mobile-logo img { height: 34px; width: auto; }
        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            margin-left: auto;
            padding: 8px 14px; border-radius: 10px;
            border: 1px solid var(--border); background: #fff;
            font-size: 14px; font-weight: 500; color: var(--text);
            transition: all .2s;
        }
        .back-link:hover { border-color: var(--primary); color: var(--primary); }

        .auth-card-wrap { flex: 1; display: flex; align-items: center; justify-content: center; padding: 32px 0; }
        .auth-card {
            width: 100%;
            max-width: 440px;
            padding: 40px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e6e8f2;
            box-shadow: 0 1px 2px rgba(20, 22, 63, .04), 0 18px 48px rgba(20, 22, 63, .08);
        }
        .auth-card .icon-badge {
            width: 52px; height: 52px; border-radius: 14px; margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center;
            background: var(--primary-50); color: var(--primary); font-size: 20px;
        }
        .auth-card h2 { font-size: 26px; font-weight: 700; letter-spacing: -.01em; margin-bottom: 6px; }
        .auth-card .sub { color: var(--muted); font-size: 15px; margin-bottom: 28px; }

        .alert {
            display: flex; gap: 10px; align-items: flex-start;
            padding: 12px 14px; margin-bottom: 20px;
            border-radius: 10px; font-size: 14px; line-height: 1.5;
        }
        .alert i { margin-top: 3px; }
        .alert-danger { background: #fff1f3; color: #9f1239; border: 1px solid #ffd5dd; }
        .alert-success { background: #ecfdf3; color: #166534; border: 1px solid #bbf7d0; }

        .field { margin-bottom: 18px; }
        .field label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        .input-wrap { position: relative; }
        .input-wrap > i.lead-icon {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #a3a7c2; font-size: 15px; pointer-events: none; transition: color .2s;
        }
        .input-wrap input {
            width: 100%; height: 48px;
            padding: 0 46px 0 44px;
            font: inherit; font-size: 15px; color: var(--text);
            background: #fff;
            border: 1px solid var(--border); border-radius: 10px;
            outline: none; transition: border-color .2s, box-shadow .2s;
        }
        .input-wrap input::placeholder { color: #a3a7c2; }
        .input-wrap input:focus { border-color: var(--primary-light); box-shadow: 0 0 0 4px rgba(91, 95, 214, .14); }
        .input-wrap input:focus ~ i.lead-icon { color: var(--primary); }
        .input-wrap.has-error input { border-color: var(--danger); }
        .toggle-pass {
            position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
            width: 36px; height: 36px; border: 0; border-radius: 8px;
            background: transparent; color: var(--muted); cursor: pointer; font-size: 15px;
        }
        .toggle-pass:hover { background: var(--primary-50); color: var(--primary); }
        .field-error { display: block; margin-top: 6px; font-size: 13px; color: var(--danger); }

        .row-between { display: flex; justify-content: space-between; align-items: center; margin: 4px 0 24px; gap: 12px; }
        .check { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; color: var(--muted); cursor: pointer; user-select: none; }
        .check input { width: 17px; height: 17px; accent-color: var(--primary); cursor: pointer; }
        .row-between a { font-size: 14px; font-weight: 600; }

        .btn-submit {
            width: 100%; height: 50px;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            border: 0; border-radius: 10px;
            background: linear-gradient(90deg, var(--primary-light) 0%, var(--primary) 100%);
            color: #fff; font: inherit; font-size: 16px; font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(46, 49, 146, .28);
            transition: transform .15s, box-shadow .2s, opacity .2s;
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 14px 30px rgba(46, 49, 146, .35); }
        .btn-submit:active { transform: none; }
        .btn-submit[disabled] { opacity: .75; cursor: wait; }
        .btn-submit .spinner { display: none; width: 18px; height: 18px; border: 2px solid rgba(255, 255, 255, .4); border-top-color: #fff; border-radius: 50%; animation: spin .7s linear infinite; }
        .btn-submit.loading .spinner { display: inline-block; }
        .btn-submit.loading .btn-icon { display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .signup { margin-top: 24px; text-align: center; font-size: 14px; color: var(--muted); }
        .signup a { font-weight: 600; }

        .auth-foot { text-align: center; font-size: 13px; color: var(--muted); }

        @media (max-width: 991.98px) {
            .auth-brand { display: none; }
            .auth-main { padding: 20px 16px; }
            .auth-top .mobile-logo { display: block; }
            .auth-card { padding: 28px 22px; border-radius: 16px; }
            .auth-card h2 { font-size: 23px; }
        }
        @media (max-width: 400px) {
            .back-link span { display: none; }
        }
    </style>
</head>
<body>
<div class="auth">
    <!-- Brand panel -->
    <aside class="auth-brand">
        <a href="{{route('index')}}" class="brand-logo">
            <img src="{{asset('admin/app-assets/images/yg/logo-white.png')}}" alt="{{general()->title}}">
        </a>
        <div>
            <h1>Welcome back to <br><span>{{general()->title ?: 'Yes Global Tech'}}</span></h1>
            <p class="lead">Sign in to manage your website content: services, projects, blog posts and more, all from one place.</p>
            <ul class="auth-features">
                <li><i class="fa-solid fa-layer-group"></i> Manage services, projects &amp; pages</li>
                <li><i class="fa-solid fa-pen-nib"></i> Publish blog posts and updates</li>
                <li><i class="fa-solid fa-shield-halved"></i> Secure, role-based access</li>
            </ul>
        </div>
        <div class="brand-foot">&copy; {{date('Y')}} {{general()->title}}. All rights reserved.</div>
    </aside>

    <!-- Form panel -->
    <main class="auth-main">
        <div class="auth-top">
            <a href="{{route('index')}}" class="mobile-logo"><img src="{{asset('welcome/images/yesglobal/logo.png')}}" alt="{{general()->title}}"></a>
            <a href="{{route('index')}}" class="back-link"><i class="fa-solid fa-arrow-left"></i> <span>Back to website</span></a>
        </div>

        <div class="auth-card-wrap">
            <div class="auth-card">
                <div class="icon-badge"><i class="fa-solid fa-right-to-bracket"></i></div>
                <h2>Sign in</h2>
                <p class="sub">Enter your details to access your account.</p>

                @php
                    $loginError = session('error') ?: session('loginfail') ?: session('loginfailP');
                @endphp
                @if($loginError)
                <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $loginError }}</span></div>
                @endif
                @if(session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
                @endif

                <form action="{{route('login')}}" method="post" id="loginForm" novalidate>
                    @csrf
                    <div class="field">
                        <label for="username">Email, mobile or username</label>
                        <div class="input-wrap {{ $errors->has('username') ? 'has-error' : '' }}">
                            <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="you@example.com" autocomplete="username" required autofocus>
                            <i class="fa-regular fa-envelope lead-icon"></i>
                        </div>
                        @if($errors->has('username'))
                        <span class="field-error">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="input-wrap {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
                            <i class="fa-solid fa-lock lead-icon"></i>
                            <button type="button" class="toggle-pass" id="togglePass" aria-label="Show password"><i class="fa-regular fa-eye"></i></button>
                        </div>
                        @if($errors->has('password'))
                        <span class="field-error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="row-between">
                        <label class="check"><input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                        <a href="{{route('forgotPassword')}}">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-submit" id="loginBtn">
                        <span class="spinner"></span>
                        <span class="btn-text">Sign in</span>
                        <i class="fa-solid fa-arrow-right btn-icon"></i>
                    </button>
                </form>

                <p class="signup">Don't have an account? <a href="{{route('register')}}">Create one</a></p>
            </div>
        </div>

        <div class="auth-foot">Need help? Call <a href="tel:+8801628092045">+8801628-092045</a></div>
    </main>
</div>

<script>
    // Show / hide password
    document.getElementById('togglePass').addEventListener('click', function () {
        var input = document.getElementById('password');
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        this.innerHTML = show ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
        this.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
    });

    // Loading state on submit (browser validation still applies)
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        if (!this.checkValidity()) { e.preventDefault(); this.reportValidity(); return; }
        var btn = document.getElementById('loginBtn');
        btn.classList.add('loading');
        btn.setAttribute('disabled', 'disabled');
        btn.querySelector('.btn-text').textContent = 'Signing in...';
    });
</script>
</body>
</html>
