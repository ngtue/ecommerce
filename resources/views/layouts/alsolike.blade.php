<div class="also-like bg-gray-400">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold">You might also like ...</h1>
        <div class="flex -mx-2 text-center pt-8" >
            @foreach ($mightAlsoLike as $product)
            <div class="w-1/4 border-2 border-gray-500 mx-2 bg-white w-64 h-64 pt-8">
                <a href="{{ route('shop.show', ['product' => $product]) }}"><img class="mx-auto "
                        src="/img/products/{{ $product->slug }}.jpg" alt="product"></a>
                <a href="{{ route('shop.show', ['product' => $product]) }}"
                    class="font-semibold">{{ $product->name }}</a>
                <p>{{ $product->presentPrice() }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>