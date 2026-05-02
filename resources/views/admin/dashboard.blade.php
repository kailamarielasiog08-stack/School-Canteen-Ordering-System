<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-medium">
                    {{ __("Welcome, Admin! You can manage the system here.") }}
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                    <div class="text-gray-500 font-medium uppercase text-xs">Total Students</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalStudents }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                    <div class="text-gray-500 font-medium uppercase text-xs">Menu Items</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalMenuItems }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                    <div class="text-gray-500 font-medium uppercase text-xs">Total Orders</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</div>
                </div>
            </div>

            <!-- Quick Management -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <a href="{{ route('admin.categories.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-gray-900">Categories</div>
                    <div class="text-sm text-gray-600">Manage categories</div>
                </a>
                <a href="{{ route('admin.menu-items.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-gray-900">Menu Items</div>
                    <div class="text-sm text-gray-600">Manage food menu</div>
                </a>
                <a href="{{ route('admin.students.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-gray-900">Students</div>
                    <div class="text-sm text-gray-600">View registered students</div>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 border border-gray-200 transition">
                    <div class="font-bold text-gray-900">Orders</div>
                    <div class="text-sm text-gray-600">View and track orders</div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
