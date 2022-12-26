<!doctype html>
<html lang="{{config('app.locale') == 'en' ? 'en' : 'en'}}" dir="{{config('app.locale') == 'en' ? 'ltr' : 'rtl'}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
          rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .table td, .table th {
            padding: 0.25rem;
        }
    </style>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="c-app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="{{asset('theme/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                                    </svg>
                                </span>
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       name="username" value="{{ old('username') }}" required
                                       autocomplete="username" autofocus placeholder="Username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{asset('theme/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                        </svg>
                                    </span>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-dark btn-sm px-4" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('theme/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('theme/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
</body>

</html>
