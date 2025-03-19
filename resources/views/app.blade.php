<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title inertia>{{ config('app.name', 'Directorio Dulce Haloween') }}</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    @routes
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @inertiaHead
</head>

<body class="font-sans">
    <div class="app-wrapper">
        @inertia
    </div>

    <!-- Google tag (gtag.js) -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-0VSJ0FF4E1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-0VSJ0FF4E1');
    </script>-->
</body>

</html>
