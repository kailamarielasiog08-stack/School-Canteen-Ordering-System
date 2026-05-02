<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    @if(count($cart) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b dark:border-gray-700">
                                        <th class="pb-4 font-bold text-gray-600 dark:text-gray-400">Product</th>
                                        <th class="pb-4 font-bold text-gray-600 dark:text-gray-400 text-center">Quantity</th>
                                        <th class="pb-4 font-bold text-gray-600 dark:text-gray-400 text-right">Price</th>
                                        <th class="pb-4 font-bold text-gray-600 dark:text-gray-400 text-right">Total</th>
                                        <th class="pb-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach($cart as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr class="border-b dark:border-gray-700 last:border-0" data-id="{{ $id }}">
                                            <td class="py-6">
                                                <div class="flex items-center">
                                                    @if($details['image'])
                                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-16 h-16 rounded-xl object-cover mr-4">
                                                    @else
                                                        <div class="w-16 h-16 rounded-xl bg-gray-100 dark:bg-gray-700 mr-4"></div>
                                                    @endif
                                                    <div>
                                                        <h4 class="font-bold text-gray-800 dark:text-white">{{ $details['name'] }}</h4>
                                                        <p class="text-sm text-gray-500">${{ number_format($details['price'], 2) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-6 text-center">
                                                <div class="inline-flex items-center border dark:border-gray-600 rounded-lg overflow-hidden">
                                                    <input type="number" value="{{ $details['quantity'] }}" class="w-16 text-center border-0 dark:bg-gray-900 dark:text-white focus:ring-0 quantity update-cart" min="1">
                                                </div>
                                            </td>
                                            <td class="py-6 text-right text-gray-800 dark:text-white font-medium">${{ number_format($details['price'], 2) }}</td>
                                            <td class="py-6 text-right text-gray-800 dark:text-white font-bold">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                            <td class="py-6 text-right">
                                                <button class="text-red-500 hover:text-red-700 transition remove-from-cart" data-id="{{ $id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-10 flex flex-col md:flex-row justify-between items-start md:items-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Total: ${{ number_format($total, 2) }}</h3>
                                <p class="text-gray-500 text-sm mt-1">Tax and shipping will be calculated at checkout.</p>
                            </div>
                            <div class="mt-6 md:mt-0 flex space-x-4 w-full md:w-auto">
                                <a href="{{ route('student.menu') }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-xl font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 transition">
                                    Back to Menu
                                </a>
                                <button class="flex-1 md:flex-none px-10 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition transform hover:-translate-y-1">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-20">
                            <div class="w-24 h-24 bg-indigo-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Your cart is empty</h3>
                            <p class="text-gray-500 mt-2">Looks like you haven't added anything yet.</p>
                            <a href="{{ route('student.menu') }}" class="mt-8 inline-block px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 dark:shadow-none">
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
