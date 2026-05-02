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
                <div class="bg-indigo-600 p-6 rounded-lg shadow-md hover:bg-indigo-700 transition cursor-pointer">
                    <h3 class="text-white text-lg font-bold">Browse Menu</h3>
                    <p class="text-indigo-100 mt-1">Explore our delicious categories.</p>
                </div>
                <div class="bg-emerald-600 p-6 rounded-lg shadow-md hover:bg-emerald-700 transition cursor-pointer">
                    <h3 class="text-white text-lg font-bold">My Orders</h3>
                    <p class="text-emerald-100 mt-1">Track your recent requests.</p>
                </div>
                <div class="bg-amber-500 p-6 rounded-lg shadow-md hover:bg-amber-600 transition cursor-pointer">
                    <h3 class="text-white text-lg font-bold">Account Settings</h3>
                    <p class="text-amber-100 mt-1">Manage your profile details.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
