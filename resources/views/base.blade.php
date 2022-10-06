<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @includeWhen(Route::currentRouteName() != 'web.login', 'includes.nav')
    @includeWhen(Route::currentRouteName() != 'web.login', 'includes.sidebar')
    @yield('content')
    @include('includes.js')
</body>
</html>
