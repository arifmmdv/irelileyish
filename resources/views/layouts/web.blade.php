<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
    @include('components.background')
    @vite(['resources/css/web.css'])
</body>
</html>