<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>School Canteen Ordering System</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="antialiased bg-gray-50 text-gray-900">
        <!-- Basic Navbar -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center font-bold text-xl text-gray-800">
                        Canteen System
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <a href="#menu" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Our Menu</a>
                        @if (Route::has('login'))
                            @auth
                                <!-- Settings Dropdown -->
                                <div class="hidden sm:flex sm:items-center sm:ms-6">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <div>{{ Auth::user()->name }}</div>

                                                <div class="ms-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="url('/dashboard')">
                                                {{ __('Dashboard') }}
                                            </x-dropdown-link>

                                            <x-dropdown-link :href="route('profile.edit')">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>

                                            <!-- Authentication -->
                                            <form id="logout-form-welcome" method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    Swal.fire({
                                                                        title: 'Log Out?',
                                                                        text: 'Are you sure you want to sign out?',
                                                                        icon: 'question',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#4f46e5',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Yes, log out'
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('logout-form-welcome').submit();
                                                                        }
                                                                    });">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 font-medium hover:text-indigo-600 transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-bold hover:bg-indigo-700 transition">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <div class="bg-white py-12 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                    Order Your Food Online
                </h1>
                <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                    A simple and efficient way to order your canteen meals. Choose your food, pay online, and skip the line.
                </p>
                <div class="mt-8 flex justify-center space-x-4">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-800 text-white rounded-md font-semibold hover:bg-gray-700 transition">Get Started</a>
                    <a href="#menu" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-md font-semibold hover:bg-gray-50 transition">Browse Menu</a>
                </div>
            </div>
        </div>

        <!-- Menu Section -->
        <div id="menu" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-2">Available Food Items</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($menuItems as $item)
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->name }}</h3>
                                    <span class="text-indigo-600 font-bold">₱{{ number_format($item->price, 2) }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($item->description, 100) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold px-2 py-1 bg-gray-100 text-gray-600 rounded-full">{{ $item->category->name ?? 'Uncategorized' }}</span>
                                    
                                    @auth
                                        @if(auth()->user()->role === 'student')
                                            <a href="{{ route('student.cart.add', $item->id) }}" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800">Add to Cart &rarr;</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Log in to order</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 italic">No food items listed in the menu yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <footer class="bg-white border-t border-gray-200 py-8 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Canteen System. All rights reserved.
        </footer>

        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonColor: '#4f46e5'
                });
            @endif
        </script>
    </body>
</html>
