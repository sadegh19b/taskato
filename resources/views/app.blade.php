<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles & Scripts -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>

    @inertiaHead
    @routes
</head>

<body class="antialiased overflow-hidden">
    @inertia
</body>
</html>
