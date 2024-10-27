@extends('layouts.app')

@section('content')
    <h1>Order Products</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div>
            <label for="product">Product:</label>
            <select id="product" name="product_id">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
        </div>
        <button type="submit">Place Order</button>
    </form>
@endsection
