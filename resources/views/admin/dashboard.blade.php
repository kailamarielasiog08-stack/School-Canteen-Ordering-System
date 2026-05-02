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

            <!-- Analytics Section -->
            <div class="mt-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Top 3 Most Ordered Items</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sold</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($topItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-indigo-600">{{ $item->total_sold ?? 0 }} units</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">No sales data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
