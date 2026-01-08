<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GymPro') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=black-ops-one:400|cairo:200,300,400,600,700,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-['Cairo'] text-white antialiased bg-gray-950 selection:bg-indigo-500 selection:text-white overflow-x-hidden">
    <div class="min-h-screen w-full flex">
        {{ $slot }}
    </div>
</body>

</html>
