@extends('layouts.app')

@section('title', 'Checkout')

@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>



@section('content')
<div class="container py-10 mx-auto">
    <h1 class="text-3xl font-bold pb-10">Checkout</h1>
    @if (session()->has('success_message'))
    <div class="bg-green-200 text-green-700 p-3 text-xl w-2/3 rounded-lg text-center mb-10">
        {{ session()->get('success_message') }}
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="bg-red-200 text-red-700 p-3 text-xl w-2/3 rounded-lg text-center mb-10">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="pl-3">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="flex">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold pb-10">Billing Details</h1>
            <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
                @csrf
                <div class="pb-5">
                    <label for="email" class="block text-xl font-semibold pb-5">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-300 w-5/6 p-3" value="{{ old('email') }}" required>
                </div>
                <div class="pb-5">
                    <label for="name" class="block text-xl font-semibold pb-5">Name</label>
                    <input type="text" name="name" id="email" class="bg-gray-300 w-5/6 p-3" value="{{ old('name') }}" required>
                </div>
                <div class="pb-5">
                    <label for="address" class="block text-xl font-semibold pb-5">Address</label>
                    <input type="text" name="address" id="address" class="bg-gray-300 w-5/6 p-3" value="{{ old('address') }}" required>
                </div>
                <div class="flex">
                    <div class="w-1/2">
                        <div class="pb-5">
                            <label for="city" class="block text-xl font-semibold pb-5">City</label>
                            <input type="text" name="city" id="city" class="bg-gray-300 w-5/6 p-3" value="{{ old('city') }}" required>
                        </div>
                        <div class="pb-5">
                            <label for="postal" class="block text-xl font-semibold pb-5">Postal Code</label>
                            <input type="text" name="postalcode" id="postalcode" class="bg-gray-300 w-5/6 p-3" value="{{ old('postalcode') }}" required>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="pb-5">
                            <label for="province" class="block text-xl font-semibold pb-5">Province</label>
                            <input type="text" name="province" id="province" class="bg-gray-300 w-5/6 p-3" value="{{ old('province') }}" required>
                        </div>
                        <div class="pb-5">
                            <label for="phone" class="block text-xl font-semibold pb-5">Phone</label>
                            <input type="text" name="phone" id="phone" class="bg-gray-300 w-5/6 p-3" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                </div>
                 {{-- end billing details --}}
                <h1 class="text-2xl font-bold pb-5">Payment Details</h1>
                <div class="pb-5">
                    <label for="name_on_card" class="block text-xl py-5 font-semibold">Name on Card</label>
                    <input type="text" class="w-full bg-gray-300 p-3" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}">
                </div>
                <div class="pb-5">
                    <label for="card-element" class=" block font-semibold text-xl pb-5">
                        Credit or debit card
                    </label>
                    <div id="card-element" class="text-xl">
                    </div>
                    <div id="card-errors" role="alert" class="text-red-500"></div>
                </div>
               
                <button type="submit" id="complete-order" class=" w-full bg-green-600 text-white font-bold p-3 text-xl hover:bg-green-500">Complete
                        Order</button>
               
                {{-- end payment details --}}
            </form>
        </div>
   
       
        <div class="w-1/2">
            <h1 class="text-2xl font-bold pb-10">Your Order</h1>
            <div class="border-red-500 border-t-2 border-b-2 mb-5">
                @foreach (Cart::content() as $item)
                <div class="flex py-10 items-center">
                    <div class="w-1/5 ">
                        <a href="{{ route('shop.show', $item->model) }}"><img src="img/products/{{ $item->model->slug }}.jpg" alt="product"></a>
                    </div>
                    <div class="w-3/5">
                        <p>{{ $item->model->name }}</p>
                        <p>{{ $item->model->details }}</p>
                        <p>{{ presentPrice($item->model->price) }}</p>
                    </div>
                    <div class="w-1/5 flex justify-end">
                        <p class="bg-green-500 text-white w-10 h-10 font-bold flex items-center justify-center text-2xl">
                            {{ $item->qty }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- end order --}}
            <div class="flex">
                <div class="w-2/3 text-2xl">
                    <p>Subtotal</p>
                    @if (session()->has('coupon'))
                    <div class="flex">
                        <p class="mr-5">Discount<span class="font-bold"> ( {{ session()->get('coupon')['name'] }} )</span></p>
                    </div>
                    <p class="mt-4">New subtotal</p>
                    @endif
                    <p>Tax</p>
                    <p class="font-extrabold">Total</p>
                </div>
                <div class="w-1/3 text-2xl text-right">
                    <p>{{ presentPrice(Cart::instance('default')->subtotal() )}}</p>
                    @if (session()->has('coupon'))
                    <p class="border-b border-black w-2/3 ml-auto ">- {{ presentPrice(getCoupon()->get('discount')) }}</p>
                    <p class="mt-4">{{ presentPrice(getCoupon()->get('newSubtotal')) }}</p>
                    @endif
                    <p>{{ presentPrice(getCoupon()->get('newTax')) }}</p>
                    <p class="font-extrabold">{{ presentPrice(getCoupon()->get('newTotal')) }}</p>
                </div>
            </div>
            {{-- end total --}}
            
        </div>
        {{-- end order impormation --}}
    </div>
</div>
@endsection
@section('extra-js')
<script>
    (function(){
            // Create a Stripe client.
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Segoe UI", "Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '24px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode:true,
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            //Disable the submit button to prevent repeated clicks
            document.getElementById('complete-order').disabled = true;

            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value,
            }

            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    //Enable the submit button
                    document.getElementById('complete-order').disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // // Submit the form
            form.submit();
        }
}());
</script>
@endsection