@extends('layouts.app')

@section('content')
<div class="bg-white">
    <main>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl pt-16">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Shopping Cart</h1>

                <div class="mt-12">
                    <section aria-labelledby="cart-heading">
                        <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                        <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
                            @foreach ($items as $item)
                            <li class="flex py-6 sm:py-10">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('images/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}"
                                        class="h-24 w-24 rounded-lg object-contain object-center sm:h-32 sm:w-32">
                                </div>

                                <div class="relative ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                    <div>
                                        <div class="flex justify-between sm:grid sm:grid-cols-2">
                                            <div class="pr-6">
                                                <h3 class="text-2xl">
                                                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{
                                                        $item->product->name }}</a>
                                                </h3>
                                            </div>

                                            <p class="text-right text-lg font-medium text-gray-900">{{ 'Rp. ' .
                                                number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div
                                            class="mt-4 flex items-center sm:absolute sm:top-0 sm:left-1/2 sm:mt-0 sm:block">
                                            <label for="quantity-{{ $item->id }}" class="sr-only">Quantity, Nomad
                                                Tumbler</label>
                                            <form class="hidden" id="form-quantity-{{ $item->id }}"
                                                action="{{ route('summary.update_quantity', ['item' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <select form="form-quantity-{{ $item->id }}"
                                                x-on:change="$el.form.submit();" id="quantity-{{ $item->id }}"
                                                name="quantity"
                                                class="block max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-red-800 focus:outline-none focus:ring-1 focus:ring-red-800 sm:text-sm">
                                                @for ($i = 1; $i <= 15; $i++) <option value="{{ $i }}" {{ $i==$item->
                                                    quantity ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                            </select>

                                            <form id="{{ 'remove_from_cart_' . $item->id }}" class="hidden"
                                                action="{{ route('summary.remove_from_cart', ['item' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button form="{{ 'remove_from_cart_' . $item->id }}" type="submit"
                                                class="ml-4 text-sm font-medium text-red-800 hover:text-red-700 sm:ml-0 sm:mt-3">
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Order summary -->
                    <section aria-labelledby="summary-heading" class="mt-10 sm:ml-48 sm:pl-6">
                        <div class="rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:p-8">

                            <div class="flow-root">
                                <dl class="-my-4 divide-y divide-gray-200 text-sm">
                                    <div class="flex items-center justify-between py-4">
                                        <dt class="text-base font-medium text-gray-900">Jumlah kupon yang diperoleh</dt>
                                        <dd class="text-base font-medium text-gray-900">{{ $coupons . ' kupon' }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between py-4">
                                        <dt class="text-base font-medium text-gray-900">Total pembelian</dt>
                                        <dd class="text-base font-medium text-gray-900">{{ 'Rp. ' .
                                            number_format($total, 0, ',', '.') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-10">
                            <form class="hidden" id="checkout" method="POST" action="{{ route('summary.purchase') }}">
                                @csrf
                            </form>
                            <button form="checkout" type="submit"
                                class="w-full rounded-md border border-transparent bg-red-800 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 focus:ring-offset-gray-50">Checkout</button>
                        </div>

                        <div class="mt-6 text-center text-sm text-gray-500">
                            <p>
                                atau
                                <a href="{{ route('products') }}" class="font-medium text-red-800 hover:text-red-700">
                                    lanjut belanja
                                    <span aria-hidden="true"> &rarr;</span>
                                </a>
                            </p>
                        </div>
                    </section>
                    </form>
                </div>
            </div>
    </main>
</div>

@endsection