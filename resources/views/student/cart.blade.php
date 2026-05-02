<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(count($cart) > 0)
                        <div class="flex flex-col lg:flex-row gap-8">
                            <!-- Cart Items -->
                            <div class="flex-1">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="border-b">
                                                <th class="pb-4 font-bold text-gray-700">Product</th>
                                                <th class="pb-4 font-bold text-center text-gray-700">Quantity</th>
                                                <th class="pb-4 font-bold text-right text-gray-700">Price</th>
                                                <th class="pb-4 font-bold text-right text-gray-700">Total</th>
                                                <th class="pb-4"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = 0 @endphp
                                            @foreach($cart as $id => $details)
                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                                <tr class="border-b last:border-0" data-id="{{ $id }}">
                                                    <td class="py-4">
                                                        <div class="font-bold text-gray-900">{{ $details['name'] }}</div>
                                                    </td>
                                                    <td class="py-4 text-center">
                                                        <input type="number" value="{{ $details['quantity'] }}" class="w-16 text-center border-gray-300 rounded-md update-cart" min="1">
                                                    </td>
                                                    <td class="py-4 text-right text-gray-600">₱{{ number_format($details['price'], 2) }}</td>
                                                    <td class="py-4 text-right font-bold text-gray-900">₱{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                                    <td class="py-4 text-right">
                                                        <button class="text-red-500 hover:text-red-700 transition remove-from-cart" data-id="{{ $id }}">
                                                            <svg class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('student.menu') }}" class="text-indigo-600 font-medium hover:underline flex items-center">
                                        <svg class="h-4 w-4 me-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Add more items
                                    </a>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="w-full lg:w-80">
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>
                                    
                                    <form action="{{ route('student.checkout') }}" method="POST">
                                        @csrf
                                        <div class="space-y-3 pb-4 border-b">
                                            <div class="flex justify-between text-gray-600">
                                                <span>Subtotal</span>
                                                <span>₱{{ number_format($total, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between text-gray-600">
                                                <span>Tax (0%)</span>
                                                <span>₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between py-4 text-xl font-extrabold text-gray-900">
                                            <span>Total</span>
                                            <span>₱{{ number_format($total, 2) }}</span>
                                        </div>

                                        <div class="mt-4 mb-6">
                                            <x-input-label for="notes" :value="__('Notes (Optional)')" />
                                            <textarea name="notes" id="notes" rows="2" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Any special requests?"></textarea>
                                        </div>

                                        <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-md">
                                            Confirm Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="bg-gray-100 h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Your cart is empty</h3>
                            <p class="text-gray-500 mb-6">Looks like you haven't added anything yet.</p>
                            <a href="{{ route('student.menu') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">
                                Browse Menu
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.querySelectorAll(".update-cart").forEach(input => {
            input.addEventListener("change", function(e) {
                e.preventDefault();
                let ele = this.closest("tr");
                fetch("{{ route('student.cart.update') }}", {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: ele.getAttribute("data-id"),
                        quantity: this.value
                    })
                }).then(() => window.location.reload());
            });
        });

        document.querySelectorAll(".remove-from-cart").forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                if(confirm("Are you sure you want to remove this item?")) {
                    let ele = this.closest("tr");
                    fetch("{{ route('student.cart.remove') }}", {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id: this.getAttribute("data-id")
                        })
                    }).then(() => window.location.reload());
                }
            });
        });
    </script>
</x-app-layout>
