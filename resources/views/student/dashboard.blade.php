<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($readyOrders->count() > 0)
                <div class="mb-6 p-4 bg-indigo-600 text-white rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 me-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <span class="font-bold">Your order is ready!</span>
                            <p class="text-sm text-indigo-100">Please proceed to the canteen counter to pick up your food.</p>
                        </div>
                    </div>
                    <a href="{{ route('student.orders.index') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-md text-sm font-bold hover:bg-indigo-50 transition">
                        View Orders
                    </a>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-medium">
                    {{ __("Welcome back! What would you like to eat today?") }}
                </div>
            </div>

            <!-- Student Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <a href="{{ route('student.menu') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-lg text-indigo-600">Browse Menu</div>
                    <div class="text-sm text-gray-600">Explore food items</div>
                </a>
                <a href="{{ route('student.orders.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-lg text-emerald-600">My Orders</div>
                    <div class="text-sm text-gray-600">Track your orders</div>
                </a>
                <a href="{{ route('student.cart.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-lg text-amber-600">My Cart</div>
                    <div class="text-sm text-gray-600">View selected items</div>
                </a>
            </div>

            <!-- Category Highlights -->
            <div class="mt-8">
                <h3 class="font-semibold text-gray-800 leading-tight mb-4">Categories</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($categories as $category)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 text-center border border-gray-200">
                            <div class="font-bold text-gray-900">{{ $category->name }}</div>
                            <div class="text-xs text-gray-500">{{ $category->menuItems->count() }} items</div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No categories yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
