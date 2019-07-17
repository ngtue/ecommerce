@extends('layouts.app')
@section('content')
<div class="bg-gray-200 shadow">
    <div class="container h-20 mx-auto flex items-center text-xl font-bold">
        <a href="{{ route('home') }}" class="hover:text-gray-600">Home</a>
        <p class="mx-4">></p>
        <a href="{{ route('shop.index') }}" class="hover:text-gray-600">Shop</a>
        <p class="mx-4">></p>
        <p class="text-gray-600">{{ $product->name }}</p>
    </div>
</div>
<div class="container mx-auto flex py-20">
    <div class="w-1/2 w-128 h-128 border-2 border-gray-500 mr-20 mb-20 flex items-center justify-center">
        <img src="/img/products/{{ $product->slug }}.jpg" alt="product" class="w-80 h-64">

    </div>
    <div class="w-1/2 pb-20">
        <h1 class="text-3xl font-bold pb-10">{{ $product->name }}</h1>
        <p class="text-xl text-gray-500 font-bold">{{ $product->details }}</p>
        <p class="text-3xl">{{ $product->presentPrice() }}</p>
        <p class="pb-20">{{ $product->description }}</p>
        
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
    
            <button type="submit" class="text-green-500 p-3 w-32 font-bold border-2 border-green-500 hover:text-white hover:bg-green-500">Add to Cart</button>
        </form>
    </div>
</div>
@include('layouts.alsolike')
@endsection