<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Explore Our Menu') }}
            </h2>
            <a href="{{ route('student.cart.index') }}" class="relative inline-flex items-center p-2 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Bar -->
            <div class="mb-8 bg-white p-4 rounded-lg shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
                <form action="{{ route('student.menu') }}" method="GET" class="flex w-full md:w-auto gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search food..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full md:w-64">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Search
                    </button>
                </form>

                <div class="flex gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                    <a href="{{ route('student.menu') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        All
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('student.menu', ['category' => $category->id, 'search' => request('search')]) }}" 
                           class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap {{ request('category') == $category->id ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($menuItems as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 hover:shadow-md transition">
                        <div class="p-4">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover rounded-lg mb-4">
                            @else
                                <div class="w-full h-40 bg-gray-100 flex items-center justify-center rounded-lg mb-4 text-gray-400">
                                    No Image
                                </div>
                            @endif
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900">{{ $item->name }}</h3>
                                    <p class="text-xs text-gray-500 uppercase">{{ $item->category->name }}</p>
                                </div>
                                <div class="font-bold text-indigo-600">
                                    ₱{{ number_format($item->price, 2) }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $item->description }}</p>
                            
                            <div class="mt-4">
                                <a href="{{ route('student.cart.add', $item->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 italic">No food items found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
