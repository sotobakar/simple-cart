@extends('layouts.app')

@section('content')
<div class="bg-white">
    <h1 class="mb-8 text-center text-gray-900 text-4xl">List Produk</h1>
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 md:gap-y-10 lg:gap-x-8">
            @foreach($products as $product)
            <div>
                <div class="group relative">
                    <div class="w-full overflow-hidden rounded-md group-hover:opacity-75">
                        <img src="{{ asset('images/' . $product->image) }}"
                            alt="Hand stitched, orange leather long wallet."
                            class="h-40 w-full object-contain object-center">
                    </div>
                    <h3 class="mt-4 h-10 text-sm text-gray-700">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            {{ $product->name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-base font-medium text-gray-900">{{ "Rp. ". number_format($product->price, 0,
                        ',',
                        '.') }}</p>
                </div>
                <form id="{{ " add_to_cart_" . $product->id }}" class="hidden" method="POST" action="{{
                    route('products.add_to_cart', ['product' => $product->id]) }}">
                    @csrf
                </form>
                <button form="{{ " add_to_cart_" . $product->id }}" type="submit"
                    class="mt-2 w-full flex items-center justify-center rounded-md border border-transparent bg-red-600
                    px-4
                    py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2
                    focus:ring-red-500 focus:ring-offset-2">
                    <i class="mr-4 fal fa-cart-plus text-2xl"></i>
                    Tambah ke Keranjang</button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection