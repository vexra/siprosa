<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <div class="flex flex-grow">
                <aside class="w-64 bg-white border-r border-gray-100 flex-shrink-0">
                    <div class="p-4 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded-md @if(request()->routeIs('dashboard')) bg-gray-200 text-gray-800 @else text-gray-600 hover:bg-gray-100 @endif">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="{{ route('articles.index') }}" class="flex items-center py-2 px-4 rounded-md @if(request()->routeIs('articles.index')) bg-gray-200 text-gray-800 @else text-gray-600 hover:bg-gray-100 @endif">
                            <i class="fas fa-file-alt mr-3"></i> Artikel Saya
                        </a>
                        </div>
                </aside>
                
                <main class="flex-grow p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>