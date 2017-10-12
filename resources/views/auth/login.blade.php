<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div class="login-content">

        <div class="logo">
            <img src="/img/piepschuim_logo.svg" alt="Piepschuim logo">
        </div>

        <form method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required></input>
            @if ($errors->has('email'))
            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif

            <input type="password" name="password" placeholder="Wachtwoord" required></input>
            @if ($errors->has('password'))
            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> @endif

            <button type="submit" name="submit" class="submit">Login</button>
        </form>
        <a href="/herstel-wachtwoord"  class="forgotPassword">Forgot your password?</a>
    </div>

    <div class="bg-boxes">
        <svg width="300px" height="100%" id="col1">
            <rect width="150px" height="150px" x="75px" y="75px" class="bubble" id="bub1" />
        </svg>
        <svg width="200px" height="100%" id="col2">
            <rect width="100px" height="100px" x="50px" y="50px" class="bubble" id="bub2" />
        </svg>
        <!--Here is a triangle-->
        <svg width="200px" height="100%" id="col6">
            <polygon points="50,150 100,50 150,150" class="bubble" id="bub6" />
        </svg>
        <svg width="200px" height="100%" id="col7">
            <rect width="100px" height="100px" x="50px" y="50px" class="bubble" id="bub7" />
        </svg>
        <svg width="200px" height="100%" id="col8">
            <rect width="100px" height="100px" x="50px" y="50px" class="bubble" id="bub8" />
        </svg>
        <svg width="100px" height="100%" id="col11">
            <rect width="50px" height="50px" x="25px" y="25px" class="bubble" id="bub11" />
        </svg>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>