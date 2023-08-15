<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(session('downloadXml'))
        <meta http-equiv="refresh" content="5;url=/downloadxml">
    @endif
    <title>WPmedia crawler {{$pageTitle ?? ''}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite('resources/css/app.css')

</head>
<body class="antialiased">
<div class="p-6 text-left text-sm text-gray-500">
    <a href="https://www.linkedin.com/in/amr-osama-33767b15b/" target="_blank" class="flex inline-flex">
        Developed with
        <x-heart-icon></x-heart-icon>
        by Amr osama
    </a>
</div>
<div class="sm:absolute sm:top-0 sm:right-0 p-6 text-right z-10">
    <a href="{{ url('/') }}"
       class="font-semibold text-gray-600 hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-8">Home</a>
    <a href="{{ url('/admin') }}"
       class="font-semibold text-gray-600 hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-8">Admin</a>
</div>
<div class="flex justify-center">
    <img src="/wpmedia_logo.png" alt="not found">
</div>
<div>
    {{$slot}}
</div>
</body>
