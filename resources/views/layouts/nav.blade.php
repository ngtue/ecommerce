<div class="bg-gray-700">
    <div class="top-nav container md:flex mx-auto md:items-center py-6 text-center lg:text-left ">
        <div class="md:w-1/2 lg:1/3 text-3xl font-bold text-white">
            <a href="{{ route('home')}}">Laravel Ecommerce</a>
        </div>
        <div class="md:w-1/2 lg:w-2/3 justify-center flex text-xl font-semibold lg:justify-end uppercase text-white">
            <a href="{{ route('shop.index') }}" class="mx-4 hover:text-gray-500">Shop</a>
            <a href="#" class="mx-4 hover:text-gray-500">About</a>
            <a href="#" class="mx-4 hover:text-gray-500">Blog</a>
            <a href="{{ route('cart.index') }}" class="mx-4 hover:text-gray-500">Cart</a>
            @if (Cart::instance('default')->count())
            <div class="text-sm flex items-center justify-center w-8 h-8 bg-yellow-500 rounded-full">{{ Cart::instance('default')->count()}}</div>                
            @endif
        </div>
    </div>
</div>
<!-- end top-nav -->