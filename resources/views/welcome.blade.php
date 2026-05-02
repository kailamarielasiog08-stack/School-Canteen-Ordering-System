<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>School Canteen Ordering System</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-900">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1 class="text-4xl font-bold">School Canteen Ordering System</h1>
                </div>

                <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg p-12">
                    <p class="text-lg mb-8">Welcome to the school canteen ordering system. Order your food ahead and skip the line!</p>
                    
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-md font-bold hover:bg-indigo-700 transition">Get Started</a>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            School Canteen System &copy; {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
