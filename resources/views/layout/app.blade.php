<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="store-comment-url" content="{{ route('comments.store') }}">
    <meta name="user-image" content="{{ asset('storage/' . auth()->user()->image) }}">
    <meta name="user-name" content="{{ auth()->user()->name }}">
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
