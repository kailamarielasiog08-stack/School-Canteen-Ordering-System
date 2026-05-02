<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Tracking') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <div class="text-lg font-bold">Status: {{ strtoupper($order->status) }}</div>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-bold mb-4">Items Ordered</h3>
                        <table class="w-full text-left">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-2">{{ $item->menuItem->name }} x {{ $item->quantity }}</td>
                                    <td class="py-2 text-right">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="border-t">
                                <td class="py-4 font-bold">Total</td>
                                <td class="py-4 text-right font-bold text-lg">₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="mt-6 border-t pt-6">
                            <h4 class="font-bold">Notes:</h4>
                            <p class="text-gray-600 dark:text-gray-400 italic">{{ $order->notes }}</p>
                        </div>
                    @endif

                    <div class="mt-8">
                        <a href="{{ route('student.orders.index') }}" class="text-indigo-600 hover:underline">Back to My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
