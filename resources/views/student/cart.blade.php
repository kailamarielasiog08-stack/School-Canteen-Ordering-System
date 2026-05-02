<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(count($cart) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b dark:border-gray-700">
                                        <th class="pb-4 font-bold">Product</th>
                                        <th class="pb-4 font-bold text-center">Quantity</th>
                                        <th class="pb-4 font-bold text-right">Price</th>
                                        <th class="pb-4 font-bold text-right">Total</th>
                                        <th class="pb-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach($cart as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr class="border-b dark:border-gray-700 last:border-0" data-id="{{ $id }}">
                                            <td class="py-4">
                                                <div class="font-bold">{{ $details['name'] }}</div>
                                            </td>
                                            <td class="py-4 text-center">
                                                <input type="number" value="{{ $details['quantity'] }}" class="w-16 text-center border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md update-cart" min="1">
                                            </td>
                                            <td class="py-4 text-right">${{ number_format($details['price'], 2) }}</td>
                                            <td class="py-4 text-right font-bold">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                            <td class="py-4 text-right">
                                                <button class="text-red-500 hover:underline remove-from-cart" data-id="{{ $id }}">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('student.checkout') }}" method="POST" class="mt-8 border-t pt-8">
                            @csrf
                            <div class="mb-4">
                                <x-input-label for="notes" :value="__('Order Notes')" />
                                <textarea name="notes" id="notes" rows="2" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="text-xl font-bold text-gray-900 dark:text-white">
                                    Total: ${{ number_format($total, 2) }}
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('student.menu') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                        Back to Menu
                                    </a>
                                    <x-primary-button>Place Order</x-primary-button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Your cart is empty.</p>
                            <a href="{{ route('student.menu') }}" class="text-indigo-600 hover:underline">Browse Menu</a>
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
