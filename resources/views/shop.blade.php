<!-- resources/views/shop.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Shop</h1>

                    <div class="products">
                        @foreach($products as $product)
                            <div class="product-item mb-6 border-b pb-4">
                                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                                <p>{{ $product->description }}</p>
                                <p>Price: ${{ $product->price }}</p>

                                <form action="{{ route('place.order') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="mb-4">
                                        <label for="quantity" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity" min="1" value="1" required class="mt-1 block w-full" style="color:red;">
                                    </div>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Place Order
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
