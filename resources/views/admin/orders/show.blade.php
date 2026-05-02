<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h3 class="font-bold">Student Info</h3>
                            <p>Name: {{ $order->user->name }}</p>
                            <p>Email: {{ $order->user->email }}</p>
                        </div>
                        <div class="text-right">
                            <h3 class="font-bold">Status</h3>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h3 class="font-bold mb-2">Order Items</h3>
                        <table class="w-full text-left">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-2">{{ $item->menuItem->name }} x {{ $item->quantity }}</td>
                                    <td class="py-2 text-right">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="border-t font-bold">
                                <td class="py-2">Total</td>
                                <td class="py-2 text-right">₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="mt-4 border-t pt-4">
                            <div class="font-bold">Notes:</div>
                            <div class="italic text-gray-600">{{ $order->notes }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
