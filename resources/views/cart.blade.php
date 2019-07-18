@extends('layouts.app')
@section('content')
<div class="bg-gray-200 shadow">
    <div class="container h-20 mx-auto flex items-center text-xl font-bold">
        <a href="{{ route('home') }}" class="hover:text-gray-600">Home</a>
        <p class="mx-4">></p>
        <p class="text-gray-600">Shopping Cart</p>
    </div>
</div>
<div class="container mx-auto py-10">
    @if (session()->has('success_message'))
    <div class="bg-green-200 text-green-700 p-3 text-xl w-2/3 rounded-lg text-center mb-10">
        {{ session()->get('success_message') }}
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="bg-red-200 text-red-700 p-3 text-xl w-2/3 rounded-lg text-center mb-10">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (Cart::count() > 0)


    <h1 class="text-2xl font-bold mb-8">{{ Cart::count() }} item(s) in Shopping Cart</h1>

    <div class="flex">
        <div class="w-2/3 ">

            <div class="cart-table border-t-2 border-b-2 border-blue-600">
                @foreach (Cart::content() as $item)
                <div class="flex py-8">
                    <div class="w-1/6">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img
                                src="/img/products/{{ $item->model->slug }}.jpg" alt="item"></a>
                    </div>
                    <div class="w-1/3">
                        <a href="{{ route('shop.show', $item->model->slug) }}"
                            class="text-xl font-semibold">{{ $item->model->name }}</a>
                        <p>{{ $item->model->details }}</p>
                    </div>
                    <div class="w-1/6 py-8 text-center">
                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="post" class="pb-8">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="h-8 px-3 w-32 border-2 border-red-600 text-red-600 font-semibold hover:bg-red-600 hover:text-white">Remove</button>
                        </form>
                        <form action="{{ route('cart.save', $item->rowId) }}" method="post">
                            @csrf
                            <button type="submit"
                                class="h-8 px-3 w-32 border-2 border-green-600 text-green-600 font-semibold hover:bg-green-600 hover:text-white">Save
                                for later</button>
                        </form>
                    </div>
                    <div class="w-1/6 flex items-center justify-center text-xl">
                        <select class="quantity font-semibold bg-green-500 text-white p-3" data-id="{{ $item->rowId }}">
                            @for ($i = 1; $i < 5; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}
                                class='bg-white text-black'>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="w-1/6 flex items-center justify-center text-2xl font-semibold">
                        {{ presentPrice($item->subtotal) }}</div>
                </div>
                @endforeach
            </div>
            {{-- end cart-table --}}

            <div class="flex my-10 bg-gray-200">
                <div class="w-2/5 p-3 text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis iste
                    fugiat enim nesciunt omnis optio odit laboriosam ea id! Earum?</div>
                <div class="w-2/5 py-3 text-xl text-right">
                    <p>Subtotal</p>
                    @if (session()->has('coupon'))
                    <div class="flex justify-end">
                        <form action="{{ route('coupon.destroy') }}" class="text-red-600 font-semibold m-0 mr-5" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="hover:text-red-400">Remove</button>
                        </form>
                        <p>Discount<span class="font-bold"> ( {{ session()->get('coupon')['name'] }} )</span></p>
                    </div>
                    <p class="mt-4">New subtotal</p>
                    @endif
                    <p>Tax(10%)</p>
                    <p class="font-extrabold uppercase">Total</p>
                </div>
                <div class="w-1/5 py-3 pr-3 text-xl text-right">
                    <p>{{ presentPrice(Cart::subtotal()) }}</p>
                    @if (session()->has('coupon'))
                    <p class="border-b border-black w-2/3 ml-auto">- {{ presentPrice(getCoupon()->get('discount')) }}</p>
                    <p class="mt-4">{{ presentPrice(getCoupon()->get('newSubtotal')) }}</p>
                    @endif
                    <p>{{ presentPrice(getCoupon()->get('newTax')) }}</p>
                    <p class="font-extrabold">{{ presentPrice(getCoupon()->get('newTotal')) }}</p>
                </div>
            </div>
            {{-- end total --}}
        </div>
    </div>

    @else
    <h3 class="text-2xl font-bold text-indigo-800 mb-5">No items in Cart!</h3>
    <a href="{{ route('shop.index') }}" class=" block text-xl text-indigo-800 hover:text-indigo-600 mb-5">Continue Shopping</a>
    @endif

    @if (!session()->has('coupon'))
    <div class="w-2/3 mb-10">
        <h1 class="text-2xl font-bold mb-5">Have a Code?</h1>
        <form action="{{ route('coupon.store') }}" class="flex p-3 bg-gray-300" method="post">
            @csrf
            <input name="coupon_code" id="coupon_code" type="text" class="border-1 border-gray-500 p-3 text-2xl w-2/3">
            <button type="submit"
                class="w-1/3 bg-blue-600 flex justify-center items-center text-white font-bold hover:bg-blue-500 text-2xl">Apply</button>
        </form>
    </div>
    @endif
    {{-- end coupon --}}


    <div class="w-2/3 text-center">
        <a href="{{ route('checkout.index') }}"
            class="block bg-green-600 hover:bg-green-500 text-white font-bold text-2xl p-3">Proceed to Checkout</a>
    </div>
    {{-- end button proceed --}}

    @if (Cart::instance('saveForLater')->count() > 0)
    <h1 class="text-2xl font-bold my-8">{{ Cart::instance('saveForLater')->count() }} item(s) saved</h1>
    <div class="flex">
        <div class="w-2/3">
            <div class="cart-table border-t-2 border-b-2 border-green-600">
                @foreach (Cart::instance('saveForLater')->content() as $item)
                <div class="flex py-8">
                    <div class="w-1/6">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img
                                src="/img/products/{{ $item->model->slug }}.jpg" alt="item"></a>
                    </div>
                    <div class="w-1/3">
                        <a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                        <p>{{ $item->model->details }}</p>
                    </div>
                    <div class="w-1/6 py-8 text-center">
                        <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="post" class="pb-8">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="h-8 px-3 w-32 border-2 border-red-600 text-red-600 font-semibold hover:bg-red-600 hover:text-white">Remove</button>
                        </form>
                        <form action="{{ route('saveForLater.move', $item->rowId) }}" method="post" class="pb-8">
                            @csrf
                            <button type="submit"
                                class="h-8 px-3 w-32 border-2 border-green-600 text-green-600 font-semibold hover:bg-green-600 hover:text-white">Move
                                to cart</button>
                        </form>
                    </div>
                    <div class="w-1/6">
                        <select name="" id=""></select>
                    </div>
                    <div class="w-1/6">{{ $item->model->presentPrice() }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- end save for later --}}
    @else
    <h1 class="text-2xl font-bold text-green-500 my-8">You have no items saved for late!</h1>
    @endif
</div>
</div>
@include('layouts.alsolike')
@endsection
@section('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    (function() {
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                    .then(function(response){
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function(error){
                        window.location.href = '{{ route('cart.index') }}'
                    })
                })
            })
        })();
</script>
@endsection