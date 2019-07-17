@extends('layouts.app')
@section('content')
<div class="bg-gray-200 shadow">
    <div class="container h-20 mx-auto flex items-center text-xl font-bold">
        <a href="{{ route('home') }}" class="hover:text-gray-600">Home</a>
        <p class="mx-4">></p>
        <p class="text-gray-600">Shop</p>
    </div>
</div>
<div class="sidebar-left container flex py-10 mx-auto">
    <div class="w-1/5">
        <div class="font-bold text-2xl pb-5">By Category</div>
        <ul class="font-normal ml-5">
             @foreach ($categories as $category)
                <li class="pb-3 {{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="text-xl hover:text-gray-600 font-semibold">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        
        <div class="font-bold pt-10">By Price
            <ul class="font-normal">
                <li>$0-$700</li>
                <li>$700-$2500</li>
                <li>$2500+</li>
            </ul>
        </div>
    </div>
    <div class="w-4/5 ml-32">
        <h1 class="text-3xl font-bold pb-5">{{ $categoryName }}</h1>
        <div class="flex justify-end">
            <p class="text-2xl font-bold mr-5">Price : </p>
            <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}" class="text-2xl font-semibold text-indigo-700 hover:text-indigo-500 mr-5">Low to High</a>
            <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}" class="text-2xl font-semibold text-green-700 hover:text-green-500">High to Low</a>
        </div>
        <div class="products md:flex md:flex-wrap py-10 text-center ">
            @forelse ($products as $product)
            <div class="product md:w-1/2 lg:w-1/3 my-4">
                <a href="{{ route('shop.show', ['product' => $product]) }}"><img class="mx-auto"
                        src="/img/products/{{ $product->slug }}.jpg" alt="product"></a>
                <a href="{{ route('shop.show', ['product' => $product]) }}"
                    class="font-semibold">{{ $product->name }}</a>
                <p>{{ $product->presentPrice() }}</p>
            </div>
            @empty
                <div class="w-full h-screen font-bold text-4xl text-indigo-600">No items found</div>
            @endforelse
        </div>
        {{-- end products --}}
        <div class="flex justify-center">
                {{ $products->appends(request()->input())->links() }}
        </div>
        
    </div>
</div>

@endsection