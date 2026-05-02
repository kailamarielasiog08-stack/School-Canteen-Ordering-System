<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Customer Information</h3>
                            <p class="text-gray-600 dark:text-gray-400">Name: {{ $order->user->name }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Email: {{ $order->user->email }}</p>
                        </div>
                        <div class="text-right">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Order Status</h3>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready for Pickup</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Order Items</h3>
                    <table class="w-full text-left mb-8">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="pb-2">Item</th>
                                <th class="pb-2 text-center">Qty</th>
                                <th class="pb-2 text-right">Price</th>
                                <th class="pb-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-b dark:border-gray-700 last:border-0">
                                    <td class="py-3">{{ $item->menuItem->name }}</td>
                                    <td class="py-3 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 text-right">${{ number_format($item->price, 2) }}</td>
                                    <td class="py-3 text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="pt-4 text-right font-bold">Total Amount:</td>
                                <td class="pt-4 text-right font-bold text-xl text-indigo-600">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    @if($order->notes)
                        <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <h4 class="font-bold text-gray-700 dark:text-gray-300">Notes:</h4>
                            <p class="text-gray-600 dark:text-gray-400 italic">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
