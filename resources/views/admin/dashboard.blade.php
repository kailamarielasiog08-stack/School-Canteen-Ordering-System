<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome, Admin! You can manage the system here.") }}
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Students</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menu Items</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalMenuItems }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Orders</h3>
                    <p class="text-3xl font-bold text-amber-500 mt-2">{{ $totalOrders }}</p>
                </div>
            </div>

            <!-- Quick Management Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                <a href="{{ route('admin.categories.index') }}" class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all border-b-4 border-indigo-500">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-indigo-600 transition-colors">Manage Categories</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Organize your food items by category.</p>
                </a>
                <a href="{{ route('admin.menu-items.index') }}" class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all border-b-4 border-emerald-500">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-emerald-600 transition-colors">Menu Management</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Add, edit, or remove food items.</p>
                </a>
                <a href="{{ route('admin.students.index') }}" class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all border-b-4 border-amber-500">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-amber-600 transition-colors">Student Directory</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">View registered students.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
