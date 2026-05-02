<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome back! What would you like to eat today?") }}
                </div>
            </div>

            <!-- Student Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <a href="{{ route('student.menu') }}" class="bg-indigo-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-white text-xl font-bold">Browse Menu</h3>
                    <p class="text-indigo-100 mt-1">Explore our delicious food categories.</p>
                </a>
                <a href="#" class="bg-emerald-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-white text-xl font-bold">My Orders</h3>
                    <p class="text-emerald-100 mt-1">Track and view your order history.</p>
                </a>
                <a href="{{ route('student.cart.index') }}" class="bg-amber-500 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-white text-xl font-bold">My Cart</h3>
                    <p class="text-amber-100 mt-1">Check out your selected items.</p>
                </a>
            </div>

            <!-- Category Highlights -->
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Explore by Category</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($categories as $category)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 text-center hover:border-indigo-500 transition cursor-pointer">
                            <h4 class="font-bold text-gray-800 dark:text-white">{{ $category->name }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $category->menu_items_count ?? $category->menuItems->count() }} Items</p>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No categories available yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
