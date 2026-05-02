<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Tracking') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    <!-- Status Progress Tracker -->
                    <div class="mb-12">
                        <div class="flex items-center justify-between relative">
                            <div class="absolute left-0 top-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700 -translate-y-1/2 z-0"></div>
                            @php
                                $statuses = ['pending', 'preparing', 'ready', 'completed'];
                                $currentIdx = array_search($order->status, $statuses);
                            @endphp
                            @foreach($statuses as $index => $status)
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                        @if($index <= $currentIdx) bg-indigo-600 text-white @else bg-gray-200 dark:bg-gray-700 text-gray-500 @endif">
                                        @if($index < $currentIdx)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </div>
                                    <span class="mt-2 text-xs font-bold uppercase tracking-widest 
                                        @if($index <= $currentIdx) text-indigo-600 dark:text-indigo-400 @else text-gray-500 @endif">
                                        {{ $status }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-indigo-50 dark:bg-gray-900/50 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-900 mb-8">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Summary</h3>
                        <table class="w-full text-left">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">{{ $item->menuItem->name }} x {{ $item->quantity }}</td>
                                    <td class="py-2 text-right text-gray-800 dark:text-white font-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="border-t dark:border-gray-700">
                                <td class="pt-4 font-bold text-lg">Total Amount:</td>
                                <td class="pt-4 text-right font-bold text-2xl text-indigo-600">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="mb-8">
                            <h4 class="font-bold text-gray-700 dark:text-gray-300">My Notes:</h4>
                            <p class="text-gray-600 dark:text-gray-400 italic">{{ $order->notes }}</p>
                        </div>
                    @endif

                    <div class="flex justify-center">
                        <a href="{{ route('student.orders.index') }}" class="text-indigo-600 font-bold hover:underline">Back to My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
