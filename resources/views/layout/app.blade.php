<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @yield('styles')
</head>
<body>
    {{-- Header Section --}}
    @include('partials.header')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>
</body>
</html>
