<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Irelileyish</title>
    <link rel="stylesheet" href="/plugins/glightbox/css/glightbox.css" />
    <script src="/plugins/glightbox/js/glightbox.min.js"></script>
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
    @include('components.background')
    @vite(['resources/css/web.css'])
</body>
</html>