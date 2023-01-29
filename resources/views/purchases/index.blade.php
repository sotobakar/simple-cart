@extends('layouts.app')

@section('content')
<div>
    <main>
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-0">
                <h1 class="text-2xl font-bold tracking-tight text-red-800 sm:text-3xl">Sejarah Pembelian</h1>
                <p class="mt-2 text-sm text-gray-500">Seluruh sejarah pembelian user beserta status pembeliannya</p>
            </div>
        </div>

        <section aria-labelledby="recent-heading" class="mt-16">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="mx-auto max-w-2xl space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
                    @foreach($purchases as $purchase)
                    <div class="border-t border-b border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border">
                        <div
                            class="flex items-center border-b border-gray-200 p-4 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:p-6">
                            <dl
                                class="grid flex-1 grid-cols-2 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-3">
                                <div>
                                    <dt class="font-medium text-red-800">Nomor pembelian</dt>
                                    <dd class="mt-1 text-gray-500">{{ $purchase->id }}</dd>
                                </div>
                                <div class="hidden sm:block">
                                    <dt class="font-medium text-red-800">Tanggal pembelian</dt>
                                    <dd class="mt-1 text-gray-500">
                                        <time datetime="2021-07-06">{{
                                            \Carbon\Carbon::parse($purchase->purchased_at)->translatedFormat("d F Y
                                            H:i")
                                            }}</time>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-red-800">Total pembelian</dt>
                                    <dd class="mt-1 font-medium text-red-800">{{ 'Rp. ' .
                                        number_format($purchase->total, 0, ',', '.') }}</dd>
                                </div>
                            </dl>

                            <div class="relative flex justify-end lg:hidden">
                                <div class="flex items-center">
                                    <button type="button"
                                        class="-m-2 flex items-center p-2 text-gray-400 hover:text-gray-500"
                                        id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Options for order WU88191111</span>
                                        <!-- Heroicon name: outline/ellipsis-vertical -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                        </svg>
                                    </button>
                                </div>

                                <!--
                                    Dropdown menu, show/hide based on menu state.
                
                                    Entering: "transition ease-out duration-100"
                                    From: "transform opacity-0 scale-95"
                                    To: "transform opacity-100 scale-100"
                                    Leaving: "transition ease-in duration-75"
                                    From: "transform opacity-100 scale-100"
                                    To: "transform opacity-0 scale-95"
                                -->
                                <div class="absolute right-0 z-10 mt-2 w-40 origin-bottom-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button"
                                    tabindex="-1">
                                    <div class="py-1" role="none">
                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                            tabindex="-1" id="menu-0-item-0">View</a>
                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                            tabindex="-1" id="menu-0-item-1">Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-6 sm:flex sm:justify-between">
                            <div class="flex items-center">
                                @if($purchase->purchase_status == 'open')
                                <span class="fa-stack text-xs">
                                    <i class="fas fa-circle fa-stack-2x text-green-500"></i>
                                    <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                                </span>
                                <p class="ml-2 text-sm font-medium text-gray-900">Status pembelian dibuka</p>
                                @else
                                <span class="fa-stack text-xs">
                                    <i class="fas fa-circle fa-stack-2x text-red-500"></i>
                                    <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                </span>
                                <p class="ml-2 text-sm font-medium text-gray-900">Status pembelian ditutup</p>
                                @endif
                            </div>
                        </div>

                        <!-- Products -->
                        <h4 class="sr-only">Produk</h4>
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($purchase->products as $item)
                            <li class="p-4 sm:p-6">
                                <div class="flex items-center sm:items-start">
                                    <div
                                        class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg bg-white sm:h-40 sm:w-40">
                                        <img src="{{ asset('images/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="h-full w-full object-contain object-center">
                                    </div>
                                    <div class="ml-6 flex-1 text-sm">
                                        <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                            <h5>{{ $item->product->name }}</h5>
                                            <p class="mt-2 sm:mt-0">{{ "Rp. " . number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="hidden text-gray-500 sm:mt-2 sm:block">Jumlah barang: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>
@endsection