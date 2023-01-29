<div class="flex px-4 items-center">
    <div class="flex justify-center flex-1 gap-x-6">
        <a class="text-red-700 hover:text-red-800 font-medium text-lg" href="{{ route('products') }}">Produk</a>
        <a class="text-red-700 hover:text-red-800 font-medium text-lg" href="{{ route('purchases') }}">History</a>
    </div>
    @if(Auth::user())
    @if(Auth::user()->shopping_cart->count() > 0)
    <a href="{{ route('summary') }}" class="ml-auto flex items-center rounded-md px-4 py-2 bg-red-700 hover:bg-red-800 text-white">
        <span class="mr-2 font-bold">{{ Auth::user()->shopping_cart->sum('quantity') }}</span>
        <i class="mr-4 far fa-cart-arrow-down text-xl"></i>
        <span class="font-medium">Check Out</span>
    </a>
    @else
    <span class="font-medium">Belanja dulu, yuk!</span>
    @endif
    <div class="ml-4 flex items-center text-red-800">
        <i class="mr-3 fas fa-ticket-alt text-2xl"></i>
        {{ Auth::user()->coupons . ' Kupon' }}
    </div>
    <a class="ml-4 flex items-center font-medium text-gray-900 hover:text-gray-500" href="{{ route('logout')}}">
        <i class="mr-3 fas fa-sign-out"></i>
    Keluar
    </a>
    @endif
</div>