<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone' rel='stylesheet'>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src='https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js'></script>
        @livewireStyles
    </head>

    <body class='font-sans antialiased'>
        <div class='flex w-screen h-screen overflow-x-auto bg-base-100'>
            @include('layouts.sidebar')
            <div class='flex flex-col w-full min-h-screen px-5 ml-44'>
                <header class='pt-2'>
                    {{ $title ?? '' }}

                    @if(session()->has('success'))
                        <x-common.alert type='success' :message="session('success')" additionalClasses='mt-2' />
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-common.alert type='error' :message="$error" additionalClasses='mt-2'/>
                        @endforeach
                    @endif

                </header>
                <main class='flex-grow py-2'>
                    <!-- Page Content -->
                    {{ $slot }}
                </main>
                <footer class='p-2 text-gray-400'>
                    <p class='text-xs text-center'>
                        Copyright © 2023 Staff First Inc. All Rights Reserved.
                    </p>
                </footer>
            </div>
        </div>
        {{ $scripts ?? '' }}
        @livewireScripts
    </body>
</html>
