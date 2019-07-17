@extends('layouts.app')
@section('content')
<header>
    <div class="hero container mx-auto py-20 lg:flex text-center lg:text-left shadow-lg">
        <div class="lg:w-2/3">
            <div class="hero-demo">
                <h1 class="text-3xl lg:text-5xl font-bold text-white">Laravel Ecommerce</h1>
                <h1 class="text-3xl lg:text-5xl font-bold text-white">Demo</h1>
                <p class="text-normal text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, nisi!
                    Culpa commodi, quidem excepturi obcaecati odit itaque distinctio voluptate velit.</p>
            </div>
            <div class="hero-button flex mt-4 justify-center lg:justify-start">
                <a href="#"
                    class="button text-blue-500 border-2 border-blue-500 font-semibold hover:bg-blue-500 hover:text-white p-3 mr-4 w-20 text-center ">Blog</a>
                <a href="#"
                    class="button text-blue-500 border-2 border-blue-500 font-semibold hover:bg-blue-500 hover:text-white p-3 w-20 ">Github</a>
            </div>
        </div>
        <div class="lg:w-1/3 pt-10 lg:pt-0">
            <img src="/img/macbook-pro-laravel.png" alt="macbook" class="w-80 h-80 mx-auto">
        </div>
    </div>
    <!-- end hero -->
</header>
{{-- end header --}}
<div class="featured-section mt-10 shadow-lg">
    <div class="container text-center mx-auto">
        <h1 class="text-3xl font-semibold">Laravel Ecommerce</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At labore harum sint eligendi aperiam amet aut
            excepturi praesentium. Dolor, unde.</p>
        <div class="button-featured py-10 flex justify-center">
            <a href="#" class="button font-semibold bg-green-500 text-white p-3 w-32">Featured</a>
            <a href="#"
                class="button text-green-500 font-semibold  border-2 border-green-500 hover:bg-green-500 hover:text-white  p-3 w-32">On
                Sale</a>
        </div>
        <div class="products md:flex md:flex-wrap mt-10 -mx-2">
            @foreach ($products as $product)
            <div class="product md:w-1/2 lg:w-1/4 my-4">
                <a href="{{ route('shop.show', ['product' => $product]) }}"><img class="mx-auto"
                        src="/img/products/{{ $product->slug }}.jpg" alt="product"></a>
                <a href="{{ route('shop.show', ['product' => $product]) }}"
                    class="font-semibold">{{ $product->name }}</a>
                <p>{{ $product->presentPrice() }}</p>
            </div>
            @endforeach
        </div>
        <!-- end products -->
        <div class="button-more pt-10 pb-20">
            <a href="{{ route('shop.index') }}"
                class="button text-blue-500 border-2 border-blue-500 font-semibold hover:bg-blue-500 hover:text-white p-3">View
                more products</a>
        </div>
    </div>
    <!-- end container -->
</div>
<!-- end featured section -->
<div class="blog-section bg-gray-300 shadow-lg">
    <div class="blog-section container mx-auto text-center py-10">
        <h1 class="text-3xl font-semibold">From our Blog</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi dolorum praesentium nam voluptates vitae. Nam
            commodi laboriosam molestias facere ad.</p>
        <div class="blog-posts lg:flex pt-10">
            <div class="blog-post lg:w-1/3 pb-10 lg:pb-0">
                <a href="#"><img class="mx-auto" src="/img/blog1.png" alt="blog image"></a>
                <a href="#">
                    <p class="text-xl font-semibold">Blog Post Title 1</p>
                </a>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum, asperiores!</p>
            </div>
            <div class="blog-post lg:w-1/3 pb-10 lg:pb-0">
                <a href="#"><img class="mx-auto" src="/img/blog2.png" alt="blog image"></a>
                <a href="#">
                    <p class="text-xl font-semibold">Blog Post Title 2</p>
                </a>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum, asperiores!</p>
            </div>
            <div class="blog-post lg:w-1/3">
                <a href="#"><img class="mx-auto" src="/img/blog3.png" alt="blog image"></a>
                <a href="#">
                    <p class="text-xl font-semibold">Blog Post Title 3</p>
                </a>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum, asperiores!</p>
            </div>
        </div>
        <!-- end blog posts -->
    </div>
    <!-- end container -->
</div>
<!-- end blog section -->
@endsection