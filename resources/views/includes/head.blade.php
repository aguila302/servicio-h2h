<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('page-title', 'Middleware')</title>

<!-- STYLE -->
<link rel="stylesheet" href="{{ asset('bootstrap/3.3.7/css/bootstrap.min.css') }}">
<!-- FONTAWESOME -->
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@stack('css-lib')
@stack('css-script')
